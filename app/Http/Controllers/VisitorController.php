<?php

namespace App\Http\Controllers;

use App\Models\Building;
use App\Models\Floor;
use App\Models\Notification;
use App\Models\Unit;
use App\Models\Visitor;
use App\Models\VisitorType;
use Illuminate\Http\Request;

class VisitorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (\Auth::user()->can('manage visitor')) {
            $visitors = visitor::where('parent_id', parentId())->get();
            return view('visitor.index', compact('visitors'));
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
        if (\Auth::user()->can('create visitor')) {
            $building = Building::where('parent_id', parentId())->pluck('name', 'id');
            $building->prepend(__('Select building'), '');
            $type = VisitorType::where('parent_id', parentId())->pluck('title', 'id');
            $type->prepend(__('Select type'), '');
            return view('visitor.create', compact('building', 'type'));
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
        if (\Auth::user()->can('create visitor')) {
            $validator = \Validator::make(
                $request->all(),
                [
                    'building_id' => 'required',
                    'floor_id' => 'required',
                    'unit_id' => 'required',
                    'phone_no' => 'required',
                    'visitor_name' => 'required',
                    'type' => 'required',
                    'visit_datetime' => 'required',
                    'end_datetime' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();
                return redirect()->back()->with('error', $messages->first());
            }
            $visitor = new Visitor();
            $visitor->building_id = $request->building_id;
            $visitor->floor_id = $request->floor_id;
            $visitor->unit_id = $request->unit_id;
            $visitor->phone_no = $request->phone_no;
            $visitor->visitor_name = $request->visitor_name;
            $visitor->type = $request->type;
            $visitor->visit_datetime = $request->visit_datetime;
            $visitor->end_datetime = $request->end_datetime;
            $visitor->purpose = $request->purpose;
            $visitor->parent_id = parentId();
            $visitor->save();

            $module = 'visitor_create';
            $notification = Notification::where('parent_id', parentId())->where('module', $module)->first();
            $setting = settings();
            $errorMessage = '';
            if (!empty($notification) && $notification->enabled_email == 1) {
                $notification_responce = MessageReplace($notification, $visitor->id);
                $data['subject'] = $notification_responce['subject'];
                $data['message'] = $notification_responce['message'];
                $data['module'] = $module;
                $data['logo'] = $setting['company_logo'];
                $to = $visitor->Unit->Member->email;

                $response = commonEmailSend($to, $data);
                if ($response['status'] == 'error') {
                    $errorMessage = $response['message'];
                }
            }
            return redirect()->back()->with('success', __('Visitor successfully created.'). '</br>'.$errorMessage);
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Visitor  $visitor
     * @return \Illuminate\Http\Response
     */
    public function show(Visitor $visitor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Visitor  $visitor
     * @return \Illuminate\Http\Response
     */
    public function edit(Visitor $visitor)
    {
        if (\Auth::user()->can('create visitor')) {
            $building = Building::where('parent_id', parentId())->pluck('name', 'id');
            $building->prepend(__('Select building'), '');
            $floor = Floor::where('parent_id', parentId())->where('building_id', $visitor->building_id)->pluck('name', 'id');
            $floor->prepend(__('Select floor'), '');
            $unit = Unit::where('parent_id', parentId())->where('building_id', $visitor->building_id)->where('floor_id', $visitor->floor_id)->pluck('unit_number', 'id');
            $unit->prepend(__('Select unit'), '');
            $type = VisitorType::where('parent_id', parentId())->pluck('title', 'id');
            $type->prepend(__('Select type'), '');
            return view('visitor.edit', compact('building', 'visitor', 'floor', 'unit', 'type'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Visitor  $visitor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Visitor $visitor)
    {
        if (\Auth::user()->can('edit visitor')) {
            $validator = \Validator::make(
                $request->all(),
                [
                    'building_id' => 'required',
                    'floor_id' => 'required',
                    'unit_id' => 'required',
                    'phone_no' => 'required',
                    'visitor_name' => 'required',
                    'type' => 'required',
                    'visit_datetime' => 'required',
                    'end_datetime' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();
                return redirect()->back()->with('error', $messages->first());
            }
            $visitor->building_id = $request->building_id;
            $visitor->floor_id = $request->floor_id;
            $visitor->unit_id = $request->unit_id;
            $visitor->phone_no = $request->phone_no;
            $visitor->visitor_name = $request->visitor_name;
            $visitor->type = $request->type;
            $visitor->visit_datetime = $request->visit_datetime;
            $visitor->end_datetime = $request->end_datetime;
            $visitor->purpose = $request->purpose;
            $visitor->save();
            return redirect()->back()->with('success', __('Visitor successfully updated.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Visitor  $visitor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Visitor $visitor)
    {
        if (\Auth::user()->can('delete visitor')) {
            $visitor->delete();
            return redirect()->back()->with('success', __('Visitor successfully deleted.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
}
