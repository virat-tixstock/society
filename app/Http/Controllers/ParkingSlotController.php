<?php

namespace App\Http\Controllers;

use App\Models\ParkingSlot;
use Illuminate\Http\Request;

class ParkingSlotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (\Auth::user()->can('manage parking slot')) {
            $slots = ParkingSlot::where('parent_id', parentId())->get();
            return view('parking_slot.index', compact('slots'));
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
        if (\Auth::user()->can('create parking slot')) {
            return view('parking_slot.create');
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
        if (\Auth::user()->can('create parking slot')) {
            $validator = \Validator::make(
                $request->all(),
                [
                    'name' => 'required',
                    'type' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();
                return redirect()->back()->with('error', $messages->first());
            }

            $parkingSlot = new ParkingSlot();
            $parkingSlot->name = $request->name;
            $parkingSlot->type = $request->type;
            $parkingSlot->status = 'Unallocated';
            $parkingSlot->parent_id = parentId();
            $parkingSlot->save();
            return redirect()->back()->with('success', __('Parking Slot successfully created.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ParkingSlot  $parkingSlot
     * @return \Illuminate\Http\Response
     */
    public function show(ParkingSlot $parkingSlot)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ParkingSlot  $parkingSlot
     * @return \Illuminate\Http\Response
     */
    public function edit(ParkingSlot $parkingSlot)
    {
        if (\Auth::user()->can('edit parking slot')) {
            return view('parking_slot.edit', compact('parkingSlot'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ParkingSlot  $parkingSlot
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ParkingSlot $parkingSlot)
    {
        if (\Auth::user()->can('edit parking slot')) {
            $validator = \Validator::make(
                $request->all(),
                [
                    'name' => 'required',
                    'type' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();
                return redirect()->back()->with('error', $messages->first());
            }

            $parkingSlot->name = $request->name;
            $parkingSlot->type = $request->type;
            $parkingSlot->status = $request->status;
            $parkingSlot->save();
            return redirect()->back()->with('success', __('Parking Slot successfully updated.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ParkingSlot  $parkingSlot
     * @return \Illuminate\Http\Response
     */
    public function destroy(ParkingSlot $parkingSlot)
    {
        if (\Auth::user()->can('delet parking slot')) {
            $parkingSlot->delete();
            return redirect()->back()->with('success', __('Parking Slot successfully deleted.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
}
