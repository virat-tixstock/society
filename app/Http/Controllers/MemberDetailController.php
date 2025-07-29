<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\MemberDetail;
use Illuminate\Http\Request;

class MemberDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $member = Member::find($id);
        return view('member.details.create', compact('member'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        if (\Auth::user()->can('create member')) {
            $validator = \Validator::make(
                $request->all(),
                [
                    'name' => 'required',
                    'email' => 'required',
                    'phone_no' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();
                return redirect()->back()->with('error', $messages->first());
            }
            $member = new MemberDetail();
            $member->member_id = $id;
            $member->name = $request->name;
            $member->email = $request->email;
            $member->phone_no = $request->phone_no;
            $member->parent_id = parentId();
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
            $member->save();
            return redirect()->back()->with('success', __('Member detail successfully created.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MemberDetail  $memberDetail
     * @return \Illuminate\Http\Response
     */
    public function show(MemberDetail $memberDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MemberDetail  $memberDetail
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $detail)
    {
        $member = Member::find($id);
        $detail = MemberDetail::find($detail);

        return view('member.details.edit', compact('member', 'detail'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MemberDetail  $memberDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $detail, $id)
    {
        if (\Auth::user()->can('edit member')) {
            $validator = \Validator::make(
                $request->all(),
                [
                    'name' => 'required',
                    'email' => 'required',
                    'phone_no' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();
                return redirect()->back()->with('error', $messages->first());
            }
            $member = MemberDetail::find($detail);
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
            $member->save();
            return redirect()->back()->with('success', __('Member detail successfully updated.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MemberDetail  $memberDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $member = MemberDetail::find($id);
        $member->delete();
        return redirect()->back()->with('success', __('Member detail successfully deleted.'));
    }
}
