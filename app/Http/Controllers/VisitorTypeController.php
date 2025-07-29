<?php

namespace App\Http\Controllers;

use App\Models\VisitorType;
use Illuminate\Http\Request;

class VisitorTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (\Auth::user()->can('manage visitor type')) {
            $visitorType = VisitorType::where('parent_id', parentId())->get();
            return view('visitor_type.index', compact('visitorType'));
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
        if (\Auth::user()->can('create visitor type')) {
            return view('visitor_type.create');
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
        if (\Auth::user()->can('create visitor type')) {
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

            $visitorType = new VisitorType();
            $visitorType->title = $request->title;
            $visitorType->parent_id = parentId();
            $visitorType->save();

            return redirect()->back()->with('success', __('Visitor type successfully created.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VisitorType  $visitorType
     * @return \Illuminate\Http\Response
     */
    public function show(VisitorType $visitorType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VisitorType  $visitorType
     * @return \Illuminate\Http\Response
     */
    public function edit(VisitorType $visitorType)
    {
        if (\Auth::user()->can('edit visitor type')) {
            return view('visitor_type.edit', compact('visitorType'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VisitorType  $visitorType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VisitorType $visitorType)
    {
        if (\Auth::user()->can('edit visitor type')) {
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

            $visitorType->title = $request->title;
            $visitorType->save();

            return redirect()->back()->with('success', __('Visitor type successfully updated.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VisitorType  $visitorType
     * @return \Illuminate\Http\Response
     */
    public function destroy(VisitorType $visitorType)
    {
        if (\Auth::user()->can('delete visitor type')) {
            $visitorType->delete();
            return redirect()->back()->with('success', __('Visitor type successfully deleted.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
}
