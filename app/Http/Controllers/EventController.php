<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Member;
use App\Models\Notification;
use App\Models\BookingFacility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (\Auth::user()->can('manage event')) {
            $events = Event::where('parent_id', parentId())->get();
            return view('event.index', compact('events'));
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
        if (\Auth::user()->can('create event')) {
            return view('event.create');
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
        if (\Auth::user()->can('create event')) {
            $validator = \Validator::make(
                $request->all(),
                [

                    'name' => 'required',
                    'start_datetime' => 'required',
                    'end_datetime' => 'required',

                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();
                return redirect()->back()->with('error', $messages->first());
            }

            $event = new Event();
            $event->name = $request->name;
            $event->start_datetime = $request->start_datetime;
            $event->end_datetime = $request->end_datetime;
            $event->note = $request->note;
            if ($request->file('document')) {
                $extension = $request->document->getClientOriginalExtension();
                $name = \Str::uuid() . '.' . $extension;
                $img = $request->document->storeAs('upload/event/', $name);
                $event->document = $img;
            }
            $event->parent_id = parentId();
            $event->save();

            $module = 'event_create';
            $notification = Notification::where('parent_id', parentId())->where('module', $module)->first();
            $setting = settings();
            $errorMessage = '';
            $member = Member::where('parent_id', parentId())->pluck('email');
            if (!empty($notification) && $notification->enabled_email == 1) {
                $notification_responce = MessageReplace($notification, $event->id);
                $data['subject'] = $notification_responce['subject'];
                $data['message'] = $notification_responce['message'];
                $data['module'] = $module;
                $data['logo'] = $setting['company_logo'];
                $to = $member->toArray();

                $response = commonEmailSend($to, $data);
                if ($response['status'] == 'error') {
                    $errorMessage = $response['message'];
                }
            }
            return redirect()->back()->with('success', __('Event successfully created.') . '</br>' . $errorMessage);
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        if (\Auth::user()->can('edit event')) {
            return view('event.edit', compact('event'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        if (\Auth::user()->can('edit event')) {
            $validator = \Validator::make(
                $request->all(),
                [
                    'name' => 'required',
                    'start_datetime' => 'required',
                    'end_datetime' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();
                return redirect()->back()->with('error', $messages->first());
            }

            $event->name = $request->name;
            $event->start_datetime = $request->start_datetime;
            $event->end_datetime = $request->end_datetime;
            $event->note = $request->note;
            if ($request->file('document')) {
                $extension = $request->document->getClientOriginalExtension();
                $name = \Str::uuid() . '.' . $extension;
                $img = $request->document->storeAs('upload/event/', $name);
                $event->document = $img;
            }
            $event->save();
            return redirect()->back()->with('success', __('Event successfully updated.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        if (\Auth::user()->can('delete event')) {
            $event->delete();
            return redirect()->back()->with('success', __('Event successfully deleted.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
    public function calendar()
    {
        if (\Auth::user()->can('manage calendar')) {
            $bookings = Event::where('parent_id', parentId())->get();
            
            $eventData = $currentMonth = [];
            foreach ($bookings as $booking) {
                $event = [
                    'title' => $booking->name,
                    'start' =>  date("Y-m-d", strtotime($booking->start_datetime)),
                    'ends' =>  date("Y-m-d", strtotime($booking->end_datetime)),
                ];
                $eventData[] = $event;
                $currentMonthEvent = [
                    'title' => $booking->name,
                    'start' =>  date("Y-m-d", strtotime($booking->start_datetime)),
                    'ends' =>  date("Y-m-d", strtotime($booking->end_datetime)),
                ];
                $currentMonth[] = $currentMonthEvent;
            }

            $facilityBooking = BookingFacility::with(['BookingDetail'=>function($query){
                return $query->where('start_date','>=',Date('Y-m-d'));
            }])->get();
            if($facilityBooking->count() > 0){
                foreach ($facilityBooking as $booking) {
                    $event = [
                        'title' => '('.$booking->BookingDetail[0]->Facility->name.' Time: '.date("H:i", strtotime($booking->BookingDetail[0]->start_date)) .' - '.date("H:i", strtotime($booking->BookingDetail[0]->end_date)).')',
                        'start' =>  date("Y-m-d H:i:s", strtotime($booking->BookingDetail[0]->start_date)),
                        'ends' =>  date("Y-m-d H:i:s", strtotime($booking->BookingDetail[0]->end_date)),
                    ];
                    $eventData[] = $event;
                    $currentMonthEvent = [
                        'title' => $booking->member_name.'('.$booking->BookingDetail[0]->Facility->name.')',
                        'start' =>  date("Y-m-d H:i:s", strtotime($booking->BookingDetail[0]->start_date)),
                        'ends' =>  date("Y-m-d H:i:s", strtotime($booking->BookingDetail[0]->end_date)),
                    ];
                    $currentMonth[] = $currentMonthEvent;
                }
            }
            return view('event.calendar', compact('bookings', 'eventData', 'currentMonth'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }
}
