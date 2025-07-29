<?php

namespace App\Http\Controllers;

use App\Models\MaintenanceType;
use Illuminate\Http\Request;

class MaintenanceTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (\Auth::user()->can('manage maintenance type')) {
            $types = MaintenanceType::where('parent_id', parentId())->get();
            return view('maintenance_type.index', compact('types'));
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
        if (\Auth::user()->can('create maintenance type')) {
            return view('maintenance_type.create');
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
        if (\Auth::user()->can('create maintenance type')) {
            $validator = \Validator::make(
                $request->all(),
                [
                    'title' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();
                return redirect()->back()->with('error', $messages->first());
            }

            $maintenanceType = new MaintenanceType();
            $maintenanceType->title = $request->title;
            $maintenanceType->amount = $request->amount;
            $maintenanceType->parent_id = parentId();
            $maintenanceType->save();
            return redirect()->back()->with('success', __('Maintenance type successfully created.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MaintenanceType  $maintenanceType
     * @return \Illuminate\Http\Response
     */
    public function show(MaintenanceType $maintenanceType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MaintenanceType  $maintenanceType
     * @return \Illuminate\Http\Response
     */
    public function edit(MaintenanceType $maintenanceType)
    {
        if (\Auth::user()->can('edit maintenance type')) {
            return view('maintenance_type.create', compact('maintenanceType'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MaintenanceType  $maintenanceType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MaintenanceType $maintenanceType)
    {
        if (\Auth::user()->can('edit maintenance type')) {
            $validator = \Validator::make(
                $request->all(),
                [
                    'title' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();
                return redirect()->back()->with('error', $messages->first());
            }

            $maintenanceType->title = $request->title;
            $maintenanceType->amount = $request->amount;
            $maintenanceType->save();
            return redirect()->back()->with('success', __('Maintenance type successfully updated.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MaintenanceType  $maintenanceType
     * @return \Illuminate\Http\Response
     */
    public function destroy(MaintenanceType $maintenanceType)
    {
        if (\Auth::user()->can('delete maintenance type')) {
            $maintenanceType->delete();
            return redirect()->back()->with('success', __('Maintenance type successfully deleted.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
}
