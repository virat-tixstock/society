<?php

namespace App\Http\Controllers;

use App\Models\ComplaintCategory;
use Illuminate\Http\Request;

class ComplaintCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (\Auth::user()->can('manage complaint category')) {
            $complaint_category = ComplaintCategory::where('parent_id', parentId())->get();
            return view('complaint_category.index', compact('complaint_category'));
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
        if (\Auth::user()->can('create complaint category')) {
            return view('complaint_category.create');
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
        if (\Auth::user()->can('create complaint category')) {
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

            $complaintCategory = new ComplaintCategory();
            $complaintCategory->title = $request->title;
            $complaintCategory->parent_id = parentId();
            $complaintCategory->save();

            return redirect()->back()->with('success', __('Complaint category successfully created.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ComplaintCategory  $complaintCategory
     * @return \Illuminate\Http\Response
     */
    public function show(ComplaintCategory $complaintCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ComplaintCategory  $complaintCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(ComplaintCategory $complaintCategory)
    {
        if (\Auth::user()->can('edit complaint category')) {
            return view('complaint_category.edit', compact('complaintCategory'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ComplaintCategory  $complaintCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ComplaintCategory $complaintCategory)
    {
        if (\Auth::user()->can('edit complaint category')) {
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

            $complaintCategory->title = $request->title;
            $complaintCategory->save();

            return redirect()->back()->with('success', __('Complaint category successfully updated.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ComplaintCategory  $complaintCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(ComplaintCategory $complaintCategory)
    {
        if (\Auth::user()->can('delete complaint category')) {
            $complaintCategory->delete();
            return redirect()->back()->with('success', __('Complaint category successfully deleted.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
}
