<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\User;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (\Auth::user()->can('manage attendance')) {
            $attendances = Attendance::where('parent_id', parentId())->get();
            return view('attendance.index', compact('attendances'));
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
        if (\Auth::user()->can('create attendance')) {
            $user = User::where('parent_id', parentId())->pluck('name', 'id');
            $user->prepend('Select User', '');
            return view('attendance.create', compact('user'));
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
        if (\Auth::user()->can('create attendance')) {
            $validator = \Validator::make(
                $request->all(),
                [
                    'user_id' => 'required',
                    'in_datetime' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();
                return redirect()->back()->with('error', $messages->first());
            }

            $attendance = new Attendance();
            $attendance->user_id = $request->user_id;
            $attendance->in_datetime = $request->in_datetime;
            $attendance->out_datetime = $request->out_datetime;
            $attendance->parent_id = parentId();
            $attendance->save();

            return redirect()->back()->with('success', __('Attendance successfully created.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function show(Attendance $attendance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function edit(Attendance $attendance)
    {
        if (\Auth::user()->can('create attendance')) {
            $user = User::where('parent_id', parentId())->pluck('name', 'id');
            $user->prepend('Select User', '');
            return view('attendance.create', compact('attendance', 'user'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attendance $attendance)
    {
        if (\Auth::user()->can('edit attendance')) {
            $validator = \Validator::make(
                $request->all(),
                [
                    'user_id' => 'required',
                    'in_datetime' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();
                return redirect()->back()->with('error', $messages->first());
            }

            $attendance->user_id = $request->user_id;
            $attendance->in_datetime = $request->in_datetime;
            $attendance->out_datetime = $request->out_datetime;
            $attendance->save();

            return redirect()->back()->with('success', __('Attendance successfully updated.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attendance $attendance)
    {
        if (\Auth::user()->can('delete attendance')) {

            $attendance->delete();

            return redirect()->back()->with('success', __('Attendance successfully deleted.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
}
