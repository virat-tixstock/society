<?php

namespace App\Http\Controllers;

use App\Models\BookingDetail;
use App\Models\BookingFacility;
use App\Models\Building;
use App\Models\Facility;
use App\Models\Member;
use App\Models\MaintenanceType;
use App\Models\Notification;
use Carbon\Carbon;
use Illuminate\Http\Request;


class BookingFacilityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (\Auth::user()->can('manage booking')) {
            $bookings = BookingFacility::where('parent_id', parentId())->get();
            return view('booking.index', compact('bookings'));
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
        if (\Auth::user()->can('create booking')) {
            $facility = Facility::where('parent_id', parentId())->pluck('name', 'id');
            $facility->prepend('Select Facility', '');
            $member = Member::where('parent_id', parentId())->pluck('name', 'id');
            $member->prepend('Select Member', '');
            $building = Building::where('parent_id', parentId())->pluck('name', 'id');
            $building->prepend(__('Select building'), '');
            return view('booking.create', compact('facility', 'member', 'building'));
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
        if (\Auth::user()->can('create booking')) {
            $validator = \Validator::make(
                $request->all(),
                [
                    // 'building_id' => 'required',
                    'member_name' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();
                return redirect()->back()->with('error', $messages->first());
            }
            $booking = new BookingFacility();
            $booking->booking_id = $this->bookingNumber();
            // $booking->building_id = isset($request->building_id) ? $request->building_id : 0;
            $booking->member_id = $request->member_id;
            $booking->member_name = $request->member_name;
            $booking->address = $request->address;
            $booking->status = $request->status;
            $booking->parent_id = parentId();
            $booking->save();

            if (!empty($request->facility[0])) {
                foreach ($request->facility as $key => $value) {
                    $details = new BookingDetail();
                    $details->facility = $value;
                    $details->booking_id = $booking->id;
                    $details->start_date = $request->start_date[$key];
                    $details->end_date = $request->end_date[$key];
                    $details->total_cost = $request->total_cost[$key];
                    $details->deposite_cost = $request->deposite_cost[$key];
                    $details->deposite_date = $request->deposite_date[$key];
                    $details->payment_type = $request->payment_type[$key];
                    $details->note = $request->note[$key];
                    $details->parent_id = parentId();
                    $details->save();
                }
            }
            $module = 'book_facility';
            $notification = Notification::where('parent_id', parentId())->where('module', $module)->first();
            $setting = settings();
            $errorMessage = '';
            if (!empty($notification) && $notification->enabled_email == 1) {
                $notification_responce = MessageReplace($notification, $booking->id);
                $data['subject'] = $notification_responce['subject'];
                $data['message'] = $notification_responce['message'];
                $data['module'] = $module;
                $data['logo'] = $setting['company_logo'];
                $to = $booking->Member->email;

                $response = commonEmailSend($to, $data);
                if ($response['status'] == 'error') {
                    $errorMessage = $response['message'];
                }
            }
            return redirect()->back()->with('success', __('Book Facility successfully created.'). '</br>'.$errorMessage);
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BookingFacility  $booking
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (\Auth::user()->can('show booking')) {
            $booking = BookingFacility::find($id);
            return view('booking.show', compact('booking'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BookingFacility  $bookingFacility
     * @return \Illuminate\Http\Response
     */
    public function edit(BookingFacility $bookingFacility)
    {
        if (\Auth::user()->can('edit booking')) {
            $type = MaintenanceType::where('parent_id', parentId())->pluck('title','id');
            $type->prepend('Select type', '');
            $facility = Facility::where('parent_id', parentId())->pluck('name', 'id');
            $facility->prepend('Select Facility', '');
            $member = Member::where('parent_id', parentId())->pluck('name', 'id');
            $member->prepend('Select Member', '');
            $building = Building::where('parent_id', parentId())->pluck('name', 'id');
            $building->prepend(__('Select building'), '');
            return view('booking.edit', compact('facility', 'member', 'building', 'bookingFacility','type'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BookingFacility  $bookingFacility
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BookingFacility $bookingFacility)
    {
        if (\Auth::user()->can('edit booking')) {
            $validator = \Validator::make(
                $request->all(),
                [
                    // 'building_id' => 'required',
                    'member_name' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();
                return redirect()->back()->with('error', $messages->first());
            }
            $charges = [];
            $amount = 0;
            $request->charges_type = array_filter($request->charges_type);
            $request->charges_amount = array_filter($request->charges_amount);
           if(!empty($request->charges_type) && !empty($request->charges_amount)){
                foreach($request->charges_type as $key=>$value){
                    $type = MaintenanceType::where('id',$request->charges_type[$key])->first();
                    $charges[$key]['type_id'] = $type->id;
                    $charges[$key]['type'] =  $type->title;
                    $charges[$key]['amount'] = $request->charges_amount[$key];
                    $charges[$key]['note'] = $request->charges_note[$key];
                    $amount += $request->charges_amount[$key];
                }
            }
            
            // $booking = new BookingFacility();
            // $booking->building_id = isset($request->building_id) ? $request->building_id : 0;
            $bookingFacility->member_id = $request->member_id;
            $bookingFacility->address = $request->address;
            $bookingFacility->status = $request->status;
            $bookingFacility->save();

            $details = $bookingFacility->BookingDetail[0];
            
            BookingDetail::where('booking_id',$details->booking_id)->update(
                [
                'facility'=>$request->facility,
                'start_date'=>$request->start_date,
                'end_date'=>$request->end_date,
                'total_cost'=>$request->total_cost,
                'deposite_cost'=>$request->deposite_cost,
                'deposite_date'=>$request->deposite_date,
                'payment_type'=>$request->payment_type,
                'note'=>$request->note,
                'maintenance_charges'=>json_encode($charges),
                'maintenance_amount'=>$amount
            ]);

            
            // if (!empty($request->facility[0])) {
            //     foreach ($request->facility as $key => $value) {
            //     }'
            // }
            // $ids = BookingDetail::where('booking_id', $booking->id)->pluck('id', 'id');

            // foreach ($request->facility as $key => $value) {
            //     if (isset($request->booking_id[$key]) && in_array($request->booking_id[$key], $ids->toArray())) {
            //         $details = BookingDetail::find($request->booking_id[$key]);
            //         $details->facility = $value;
            //         $details->start_date = $request->start_date[$key];
            //         $details->end_date = $request->end_date[$key];
            //         $details->total_cost = $request->total_cost[$key];
            //         $details->save();
            //         unset($ids[$request->booking_id[$key]]);
            //     } else {
            //         $details = new BookingDetail();
            //         $details->facility = $value;
            //         $details->start_date = $request->start_date[$key];
            //         $details->end_date = $request->end_date[$key];
            //         $details->total_cost = $request->total_cost[$key];
            //         $details->parent_id = parentId();
            //         $details->save();
            //     }
            // }

            // if (count($ids) > 0) {
            //     foreach ($ids as $key => $id) {
            //         if ($id) {
            //             $exp_details = BookingDetail::find($id);
            //             if ($exp_details) {
            //                 $exp_details->delete();
            //             }
            //         }
            //     }
            // }

            return redirect()->back()->with('success', __('expense successfully updated.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BookingFacility  $bookingFacility
     * @return \Illuminate\Http\Response
     */

    public function destroy(BookingFacility $bookingFacility)
    {
        if (\Auth::user()->can('delete booking')) {
            $bookingFacility->delete();
            return redirect()->back()->with('success', __('Booking facility successfully deleted.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function getMember(Request $request)
    {
        $member = Member::where('parent_id', parentId())->where('building_id', $request->building_id)->pluck('name', 'id');
        $member->prepend('Select Member', '');
        $select = '';
        foreach ($member as $key => $value) {
            $select .= '<option value="' . $key . '">' . $value . '</option>';
        }
        return response()->json($select);
    }

    public function getFacilityCost(Request $request)
    {
        $facility = Facility::find($request->facility);
        $start = Carbon::parse($request->start_date);
        $end = Carbon::parse($request->end_date);
        $total = $facility->amount;
        if ($start && $end) {
            $diff = $start->diffInDays($end) + 1;
            $total = $facility->amount * (!empty($diff) ? $diff : 1);
        }
        return response()->json($total);
    }

    public function bookingNumber()
    {
        $latestbooking = BookingFacility::where('parent_id', parentId())->latest()->first();
        if ($latestbooking == null) {
            return 1;
        } else {
            return $latestbooking->parent_id + 1;
        }
    }
}
