<?php

namespace App\Http\Controllers;

use App\Models\Building;
use App\Models\Notification;
use App\Models\Parking;
use App\Models\ParkingSlot;
use App\Models\Unit;
use Illuminate\Http\Request;

class ParkingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (\Auth::user()->can('manage parking')) {
            $parkings = Parking::where('parent_id', parentId())->get();
            return view('parking.index', compact('parkings'));
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
        if (\Auth::user()->can('create parking')) {
            $building = Building::where('parent_id', parentId())->pluck('name', 'id');
            $building->prepend(__('Select building'), '');
            $slots = ParkingSlot::where('status', 'Unallocated')->where('parent_id', parentId())->pluck('name', 'id');
            $slots->prepend(__('Select Slot'), '');
            return view('parking.create', compact('slots', 'building'));
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
        if (\Auth::user()->can('create parking')) {
            $validator = \Validator::make(
                $request->all(),
                [
                    'parking_slot' => 'required',
                    'vehicle_type' => 'required',
                    'building_id' => 'required',
                    'unit_id' => 'required',
                    'vehicle_number' => 'required',
                    'vehicle_model' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();
                return redirect()->back()->with('error', $messages->first());
            }

            $parking = new Parking();
            $parking->parking_slot = $request->parking_slot;
            $parking->vehicle_type = $request->vehicle_type;
            $parking->building_id = $request->building_id;
            $parking->unit_id = $request->unit_id;
            $parking->vehicle_number = $request->vehicle_number;
            $parking->vehicle_model = $request->vehicle_model;
            $parking->description = $request->description;
            $parking->parent_id = parentId();
            $parking->save();

            $module = 'assign_parking';
            $notification = Notification::where('parent_id', parentId())->where('module', $module)->first();
            $setting = settings();
            $errorMessage = '';
            if (!empty($notification) && $notification->enabled_email == 1) {
                $notification_responce = MessageReplace($notification, $parking->Unit->Member->id);
                $data['subject'] = $notification_responce['subject'];
                $data['message'] = $notification_responce['message'];
                $data['module'] = $module;
                $data['logo'] = $setting['company_logo'];
                $to = $parking->Unit->Member->email;

                $response = commonEmailSend($to, $data);
                if ($response['status'] == 'error') {
                    $errorMessage = $response['message'];
                }
            }
            return redirect()->back()->with('success', __('Parking successfully created.'). '</br>'.$errorMessage);
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Parking  $parking
     * @return \Illuminate\Http\Response
     */
    public function show(Parking $parking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Parking  $parking
     * @return \Illuminate\Http\Response
     */
    public function edit(Parking $parking)
    {
        if (\Auth::user()->can('edit parking')) {
            $building = Building::where('parent_id', parentId())->pluck('name', 'id');
            $building->prepend(__('Select building'), '');
            $unit = Unit::where('parent_id', parentId())->where('building_id', $parking->building_id)->pluck('unit_number', 'id');
            $unit->prepend(__('Select Unit'), '');
            $slots = ParkingSlot::where('status', 'Unallocated')->where('parent_id', parentId())->pluck('name', 'id');
            $slots->prepend(__('Select Slot'), '');
            return view('parking.edit', compact('slots', 'unit', 'building', 'parking'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Parking  $parking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Parking $parking)
    {
        if (\Auth::user()->can('edit parking')) {
            $validator = \Validator::make(
                $request->all(),
                [
                    'parking_slot' => 'required',
                    'vehicle_type' => 'required',
                    'building_id' => 'required',
                    'unit_id' => 'required',
                    'vehicle_number' => 'required',
                    'vehicle_model' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();
                return redirect()->back()->with('error', $messages->first());
            }
            $old_slot = ParkingSlot::find($parking->parking_slot);
            $old_slot->status = 'Unallocated';
            $old_slot->save();

            $parking->parking_slot = $request->parking_slot;
            $parking->vehicle_type = $request->vehicle_type;
            $parking->building_id = $request->building_id;
            $parking->unit_id = $request->unit_id;
            $parking->vehicle_number = $request->vehicle_number;
            $parking->vehicle_model = $request->vehicle_model;
            $parking->description = $request->description;
            $parking->save();

            $slot = ParkingSlot::find($request->parking_slot);
            $slot->status = 'Allocated';
            $slot->save();
            return redirect()->back()->with('success', __('Parking successfully updated.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Parking  $parking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Parking $parking)
    {
        if (\Auth::user()->can('delete parking')) {
            $old_slot = ParkingSlot::find($parking->parking_slot);
            $old_slot->status = 'Unallocated';
            $old_slot->save();
            $parking->delete();
            return redirect()->back()->with('success', __('Parking successfully deleted.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function buildingUnit(Request $request)
    {
        $unit = Unit::where('parent_id', parentId())->where('building_id', $request->building_id)->pluck('unit_number', 'id');
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
    public function getSlot(Request $request)
    {
        $slot = ParkingSlot::where('parent_id', parentId())->where('type', $request->type)->pluck('name', 'id');
        $slot->prepend('Select Slot', '');
        $select = '';
        foreach ($slot as $key => $value) {
            $select .= '<option value="' . $key . '">' . $value . '</option>';
        }
        return response()->json($select);
    }
}
