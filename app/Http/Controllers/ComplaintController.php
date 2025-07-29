<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use App\Models\ComplaintCategory;
use App\Models\Member;
use App\Models\Notification;
use Illuminate\Http\Request;

class ComplaintController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (\Auth::user()->can('manage complaint')) {
            $complaints = Complaint::where('parent_id', parentId())->get();
            return view('complaint.index', compact('complaints'));
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
        if (\Auth::user()->can('create complaint')) {
            $member = Member::where('parent_id', parentId())->pluck('name', 'id');
            $member->prepend('Select Member', '');
            $category = ComplaintCategory::where('parent_id', parentId())->pluck('title', 'id');
            $category->prepend('Select Category', '');
            $status = Complaint::$status;
            return view('complaint.create', compact('member', 'status', 'category'));
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
        if (\Auth::user()->can('create complaint')) {
            $validator = \Validator::make(
                $request->all(),
                [
                    'type' => 'required',
                    'nature' => 'required',
                    'title' => 'required',
                    'category' => 'required',
                    'member_id' => 'required',
                    'date' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();
                return redirect()->back()->with('error', $messages->first());
            }

            $complaint = new Complaint();
            $complaint->type = $request->type;
            $complaint->nature = $request->nature;
            $complaint->title = $request->title;
            $complaint->category = $request->category;
            $complaint->member_id = $request->member_id;
            $complaint->date = $request->date;
            $complaint->status = $request->status;
            $complaint->note = $request->note;
            if ($request->file('document')) {
                $extension = $request->document->getClientOriginalExtension();
                $name = \Str::uuid() . '.' . $extension;
                $img = $request->document->storeAs('upload/complaint/', $name);
                $complaint->document = $img;
            }
            $complaint->parent_id = parentId();
            $complaint->save();

            $module = 'complaint_create';
            $notification = Notification::where('parent_id', parentId())->where('module', $module)->first();
            $setting = settings();
            $errorMessage = '';
            if (!empty($notification) && $notification->enabled_email == 1) {
                $notification_responce = MessageReplace($notification, $complaint->id);
                $data['subject'] = $notification_responce['subject'];
                $data['message'] = $notification_responce['message'];
                $data['module'] = $module;
                $data['logo'] = $setting['company_logo'];
                $to = $complaint->Member->email;

                $response = commonEmailSend($to, $data);
                if ($response['status'] == 'error') {
                    $errorMessage = $response['message'];
                }
            }
            return redirect()->back()->with('success', __('Complaint successfully created.'). '</br>'.$errorMessage);
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Complaint  $complaint
     * @return \Illuminate\Http\Response
     */
    public function show(Complaint $complaint)
    {
        if (\Auth::user()->can('show complaint')) {
            return view('complaint.show', compact('complaint'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Complaint  $complaint
     * @return \Illuminate\Http\Response
     */
    public function edit(Complaint $complaint)
    {
        if (\Auth::user()->can('edit complaint')) {
            $member = Member::where('parent_id', parentId())->pluck('name', 'id');
            $member->prepend('Select Member', '');
            $status = Complaint::$status;
            $category = ComplaintCategory::where('parent_id', parentId())->pluck('title', 'id');
            $category->prepend('Select Category', '');
            return view('complaint.edit', compact('status', 'member', 'complaint', 'category'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Complaint  $complaint
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Complaint $complaint)
    {
        if (\Auth::user()->can('edit complaint')) {
            $validator = \Validator::make(
                $request->all(),
                [
                    'type' => 'required',
                    'nature' => 'required',
                    'title' => 'required',
                    'category' => 'required',
                    'member_id' => 'required',
                    'date' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();
                return redirect()->back()->with('error', $messages->first());
            }

            $complaint->type = $request->type;
            $complaint->nature = $request->nature;
            $complaint->title = $request->title;
            $complaint->category = $request->category;
            $complaint->member_id = $request->member_id;
            $complaint->date = $request->date;
            $complaint->document = $request->document;
            $complaint->status = $request->status;
            $complaint->note = $request->note;
            if ($request->file('document')) {
                $extension = $request->document->getClientOriginalExtension();
                $name = \Str::uuid() . '.' . $extension;
                $img = $request->document->storeAs('upload/complaint/', $name);
                $complaint->document = $img;
            }
            $complaint->save();
            return redirect()->back()->with('success', __('Complaint successfully created.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Complaint  $complaint
     * @return \Illuminate\Http\Response
     */
    public function destroy(Complaint $complaint)
    {
        if (\Auth::user()->can('delete complaint')) {

            $complaint->delete();
            return redirect()->back()->with('success', __('Complaint successfully deleted.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
}
