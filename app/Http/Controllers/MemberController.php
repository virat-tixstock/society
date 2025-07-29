<?php

namespace App\Http\Controllers;

use App\Models\Building;
use App\Models\Floor;
use App\Models\Member;
use App\Models\MemberDetail;
use App\Models\Notification;
use App\Models\Unit;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (\Auth::user()->can('manage member')) {
            $members = Member::where('parent_id', parentId())->get();
            return view('member.index', compact('members'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (\Auth::user()->can('create member')) {
            $building = Building::where('parent_id', parentId())->pluck('name', 'id');
            $building->prepend(__('Select building'), '');
            $unit = Unit::pluck('unit_number','id');
            return view('member.create', compact('building','unit'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (\Auth::user()->can('create member')) {
            $validator = \Validator::make(
                $request->all(),
                [
                    'name' => 'required',
                    'email' => 'required',
                    'phone_no' => 'required',
                    // 'image' => 'required',
                    // 'building_id' => 'required',
                    // 'floor_id' => 'required',
                    'unit_id' => 'required',
                    // 'family_details' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();
                return redirect()->back()->with('error', $messages->first());
            }
            $member = new Member();
            $member->name = $request->name;
            $member->email = $request->email;
            $member->phone_no = $request->phone_no;
            if ($request->file('image')) {
                $extension = $request->image->getClientOriginalExtension();
                $name = \Str::uuid() . '.' . $extension;
                $img = $request->image->storeAs('upload/member/', $name);
                $member->image = $img;
            }
            if ($request->file('document')) {
                $extension = $request->document->getClientOriginalExtension();
                $name = \Str::uuid() . '.' . $extension;
                $img = $request->document->storeAs('upload/member/document/', $name);
                $member->document = $img;
            }
            // $member->building_id = $request->building_id;
            // $member->floor_id = $request->floor_id;
            $member->unit_id = $request->unit_id;
            $member->family_details = json_encode($request->family_details);
            $member->parent_id = parentId();
            $member->save();

            $module = 'member_create';
            $notification = Notification::where('parent_id', parentId())->where('module', $module)->first();
            $setting = settings();
            $errorMessage = '';
            if (!empty($notification) && $notification->enabled_email == 1) {
                $notification_responce = MessageReplace($notification, $member->id);
                $data['subject'] = $notification_responce['subject'];
                $data['message'] = $notification_responce['message'];
                $data['module'] = $module;
                $data['logo'] = $setting['company_logo'];
                $to = $member->email;

                $response = commonEmailSend($to, $data);
                if ($response['status'] == 'error') {
                    $errorMessage = $response['message'];
                }
            }

            return redirect()->back()->with('success', __('Member successfully created.'). '</br>'.$errorMessage);
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function show(Member $member)
    {
        $details = MemberDetail::where('parent_id', parentId())->where('member_id', $member->id)->get();
        return view('member.show', compact('member', 'details'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function edit(Member $member)
    {
        if (\Auth::user()->can('edit member')) {
            $building = Building::where('parent_id', parentId())->pluck('name', 'id');
            $building->prepend(__('Select building'), '');
            $floor = Floor::where('parent_id', parentId())->where('building_id', $member->building_id)->pluck('name', 'id');
            $floor->prepend(__('Select floor'), '');
            $unit = Unit::where('parent_id', parentId())->where('id', $member->unit_id)->pluck('unit_number', 'id');
            //->where('building_id', $member->building_id)->where('id', $member->floor_id)->pluck('unit_number', 'id');
            $unit->prepend(__('Select unit'), '');
            return view('member.edit', compact('building', 'member', 'floor', 'unit'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Member $member)
    {
        if (\Auth::user()->can('edit member')) {
            $validator = \Validator::make(
                $request->all(),
                [
                    'name' => 'required',
                    'email' => 'required',
                    'phone_no' => 'required',
                    // 'image' => 'required',
                    // 'building_id' => 'required',
                    // 'floor_id' => 'required',
                    'unit_id' => 'required',
                    // 'family_details' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();
                return redirect()->back()->with('error', $messages->first());
            }
            $member->name = $request->name;
            $member->email = $request->email;
            $member->phone_no = $request->phone_no;
            if ($request->file('image')) {
                $extension = $request->image->getClientOriginalExtension();
                $name = \Str::uuid() . '.' . $extension;
                $img = $request->image->storeAs('upload/member/', $name);
                $member->image = $img;
            }
            // $member->building_id = $request->building_id;
            // $member->floor_id = $request->floor_id;
            $member->unit_id = $request->unit_id;
            $member->family_details = json_encode($request->family_details);
            $member->save();
            return redirect()->back()->with('success', __('Member successfully updated.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function destroy(Member $member)
    {
        if (\Auth::user()->can('delete member')) {
            $member->delete();
            return redirect()->back()->with('success', __('Member successfully deleted.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function getFloor(Request $request)
    {
        $floor = Floor::where('parent_id', parentId())->where('building_id', $request->building_id)->pluck('name', 'id');
        $floor->prepend('Select Floor', '');
        $select = '';
        foreach ($floor as $key => $value) {
            $select .= '<option value="' . $key . '">' . $value . '</option>';
        }
        return response()->json($select);
    }
    public function getUnit(Request $request)
    {
        $unit = Unit::where('parent_id', parentId())->where('building_id', $request->building_id)->where('floor_id', $request->floor_id)->pluck('unit_number', 'id');
        $unit->prepend('Select Unit', '');
        $select = '';
        foreach ($unit as $key => $value) {
            if (intval($value)) {
                $select .= '<option value="' . $key . '">' . 100 + $value . '</option>';
            } else {
                $select .= '<option value="' . $key . '">' . $value . '</option>';
            }
        }
        return response()->json($select);
    }
}
