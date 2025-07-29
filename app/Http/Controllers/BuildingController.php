<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Building;
use App\Models\Floor;
use App\Models\Unit;
use App\Models\UtilityBill;
use App\Models\Visitor;
use Illuminate\Http\Request;

class BuildingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (\Auth::user()->can('manage building')) {
            $buildings = Building::where('parent_id', parentId())->get();
            return view('building.index', compact('buildings'));
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
        if (\Auth::user()->can('create building')) {
            return view('building.create');
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
        if (\Auth::user()->can('create building')) {
            $validator = \Validator::make(
                $request->all(),
                [
                    'name' => 'required',
                    'floor' => 'required',
                    'unit' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();
                return redirect()->back()->with('error', $messages->first());
            }
            $building = new Building();
            $building->name = $request->name;
            $building->parent_id = parentId();
            $building->save();

            for ($i = 1; $i <= $request->floor; $i++) {
                $floor = new Floor();
                $floor->name = ordinal($i);
                $floor->building_id = $building->id;
                $floor->parent_id = parentId();
                $floor->save();
                for ($j = 1; $j <= $request->unit; $j++) {
                    $unit = new Unit();
                    $unit->building_id = $building->id;
                    $unit->floor_id = $floor->id;
                    $unit->unit_number = 100 + $j;
                    $unit->parking = 0;
                    $unit->area = $request->area;
                    $unit->type = $request->type;
                    $unit->status = 'Unsold';
                    $unit->parent_id = parentId();
                    $unit->save();
                }
            }


            return redirect()->back()->with('success', __('Building successfully created.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Building  $building
     * @return \Illuminate\Http\Response
     */
    public function show(Building $building)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Building  $building
     * @return \Illuminate\Http\Response
     */
    public function edit(Building $building)
    {
        if (\Auth::user()->can('edit building')) {
            return view('building.edit', compact('building'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Building  $building
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Building $building)
    {
        if (\Auth::user()->can('edit building')) {
            $validator = \Validator::make(
                $request->all(),
                [
                    'name' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();
                return redirect()->back()->with('error', $messages->first());
            }
            $building->name = $request->name;
            $building->save();

            return redirect()->back()->with('success', __('Building successfully updated.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Building  $building
     * @return \Illuminate\Http\Response
     */
    public function destroy(Building $building)
    {
        if (\Auth::user()->can('edit building')) {
            $floor = Floor::where('building_id', $building)->delete();
            $unit = Unit::where('building_id', $building)->delete();
            $asset = Asset::where('building', $building)->delete();
            $utility_bill = UtilityBill::where('building_id', $building)->delete();
            $visitor = Visitor::where('building_id', $building)->delete();
            $building->delete();
            return redirect()->back()->with('success', __('Building successfully deleted.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
}
