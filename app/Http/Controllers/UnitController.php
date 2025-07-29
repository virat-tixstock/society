<?php

namespace App\Http\Controllers;

use App\Models\Building;
use App\Models\Floor;
use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (\Auth::user()->can('manage unit')) {
            $units = Unit::where('parent_id', parentId())->get();
            return view('unit.index', compact('units'));
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
        if (\Auth::user()->can('create unit')) {
            $building = Building::where('parent_id', parentId())->pluck('name', 'id');
            $building->prepend(__('Select building'), '');
            $status = Unit::$status;
            return view('unit.create', compact('building', 'status'));
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
        if (\Auth::user()->can('create unit')) {
            $validator = \Validator::make(
                $request->all(),
                [
                    // 'building_id' => 'required',
                    // 'floor_id' => 'required',
                    'unit_number' => 'required',
                    'area' => 'required',
                    'type' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();
                return redirect()->back()->with('error', $messages->first());
            }
            $unit = new Unit();

            // $unit->building_id = $request->building_id;
            // $unit->floor_id = $request->floor_id;
            $unit->unit_number = $request->unit_number;
            $unit->parking = 0;
            $unit->area = $request->area;
            $unit->type = $request->type;
            $unit->status = $request->status;
            $unit->parent_id = parentId();
            $unit->save();
            return redirect()->back()->with('success', __('Unit successfully created.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function show(Unit $unit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function edit(Unit $unit)
    {
        if (\Auth::user()->can('edit unit')) {
            $building = Building::where('parent_id', parentId())->pluck('name', 'id');
            $building->prepend(__('Select building'), '');
            $floor = Floor::where('parent_id', parentId())->where('building_id', $unit->building_id)->pluck('name', 'id');
            $floor->prepend(__('Select floor'), '');
            $status = Unit::$status;
            return view('unit.edit', compact('building', 'floor', 'status', 'unit'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Unit $unit)
    {
        if (\Auth::user()->can('edit unit')) {
            $validator = \Validator::make(
                $request->all(),
                [
                    // 'building_id' => 'required',
                    // 'floor_id' => 'required',
                    'unit_number' => 'required',
                    'area' => 'required',
                    'type' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();
                return redirect()->back()->with('error', $messages->first());
            }

            // $unit->building_id = $request->building_id;
            // $unit->floor_id = $request->floor_id;
            $unit->unit_number = $request->unit_number;
            // $unit->parking = $request->parking;
            $unit->area = $request->area;
            $unit->type = $request->type;
            $unit->status = $request->status;
            $unit->save();
            return redirect()->back()->with('success', __('Unit successfully updated.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Unit $unit)
    {
        if (\Auth::user()->can('delete unit')) {
            $unit->delete();
            return redirect()->back()->with('success', __('Unit successfully deleted.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
}
