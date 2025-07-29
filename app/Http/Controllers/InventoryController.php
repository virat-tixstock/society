<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (\Auth::user()->can('manage inventory')) {
            $inventories = Inventory::where('parent_id', parentId())->get();
            return view('inventory.index', compact('inventories'));
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
        if (\Auth::user()->can('create inventory')) {
            return view('inventory.create');
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
        if (\Auth::user()->can('create inventory')) {
            $validator = \Validator::make(
                $request->all(),
                [
                    'name' => 'required',
                    'amount' => 'required',
                    'qty' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();
                return redirect()->back()->with('error', $messages->first());
            }

            $inventory = new Inventory();
            $inventory->name = $request->name;
            $inventory->amount = $request->amount;
            $inventory->qty = $request->qty;
            $inventory->parent_id = parentId();
            $inventory->save();
            return redirect()->back()->with('success', __('Inventory successfully created.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function show(Inventory $inventory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function edit(Inventory $inventory)
    {
        if (\Auth::user()->can('edit inventory')) {
            return view('inventory.edit', compact('inventory'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inventory $inventory)
    {
        if (\Auth::user()->can('edit inventory')) {
            $validator = \Validator::make(
                $request->all(),
                [
                    'name' => 'required',
                    'amount' => 'required',
                    'qty' => 'required',

                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();
                return redirect()->back()->with('error', $messages->first());
            }

            $inventory->name = $request->name;
            $inventory->amount = $request->amount;
            $inventory->qty = $request->qty;
            $inventory->save();
            return redirect()->back()->with('success', __('Inventory successfully updated.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inventory $inventory)
    {
        if (\Auth::user()->can('delete inventory')) {
            $inventory->delete();
            return redirect()->back()->with('success', __('Inventory successfully deleted.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
}
