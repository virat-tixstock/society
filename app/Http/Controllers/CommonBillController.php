<?php

namespace App\Http\Controllers;

use App\Models\BillType;
use App\Models\CommonBill;
use Illuminate\Http\Request;

class CommonBillController extends Controller
{
    public function index()
    {
        if (\Auth::user()->can('manage common bill')) {
            $commonBills = CommonBill::where('parent_id', parentId())->get();
            return view('common_bill.index', compact('commonBills'));
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
        if (\Auth::user()->can('create common bill')) {
            $bill_types = BillType::where('parent_id', parentId())->pluck('title', 'id');
            $bill_types->prepend('Select Bill Type', '');
            return view('common_bill.create', compact('bill_types'));
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
        if (\Auth::user()->can('create common bill')) {
            $validator = \Validator::make(
                $request->all(),
                [
                    'bill_type' => 'required',
                    'amount' => 'required',
                    'date' => 'required',
                    'due_date' => 'required',

                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();
                return redirect()->back()->with('error', $messages->first());
            }

            $commonBill = new CommonBill();
            $commonBill->bill_type = $request->bill_type;
            $commonBill->amount = $request->amount;
            $commonBill->date = $request->date;
            $commonBill->due_date = $request->due_date;
            $commonBill->status = $request->status;
            if ($request->file('document')) {
                $extension = $request->document->getClientOriginalExtension();
                $name = \Str::uuid() . '.' . $extension;
                $img = $request->document->storeAs('upload/common_bill/', $name);
                $commonBill->document = $img;
            }
            $commonBill->parent_id = parentId();
            $commonBill->save();
            return redirect()->back()->with('success', __('Common bill successfully created.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CommonBill  $commonBill
     * @return \Illuminate\Http\Response
     */
    public function show(CommonBill $commonBill)
    {
        if (\Auth::user()->can('show common bill')) {
            return view('common_bill.show', compact('commonBill'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CommonBill  $commonBill
     * @return \Illuminate\Http\Response
     */
    public function edit(CommonBill $commonBill)
    {
        if (\Auth::user()->can('edit common bill')) {
            $bill_types = BillType::where('parent_id', parentId())->pluck('title', 'id');
            $bill_types->prepend('Select Bill Type', '');
            return view('common_bill.edit', compact('commonBill', 'bill_types'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CommonBill  $commonBill
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CommonBill $commonBill)
    {
        if (\Auth::user()->can('edit common bill')) {
            $validator = \Validator::make(
                $request->all(),
                [
                    'bill_type' => 'required',
                    'amount' => 'required',
                    'date' => 'required',
                    'due_date' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();
                return redirect()->back()->with('error', $messages->first());
            }

            $commonBill->bill_type = $request->bill_type;
            $commonBill->amount = $request->amount;
            $commonBill->date = $request->date;
            $commonBill->due_date = $request->due_date;
            $commonBill->status = $request->status;
            if ($request->file('document')) {
                $extension = $request->document->getClientOriginalExtension();
                $name = \Str::uuid() . '.' . $extension;
                $img = $request->document->storeAs('upload/common_bill/', $name);
                $commonBill->document = $img;
            }
            $commonBill->parent_id = parentId();
            return redirect()->back()->with('success', __('Common bill successfully updated.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CommonBill  $commonBill
     * @return \Illuminate\Http\Response
     */
    public function destroy(CommonBill $commonBill)
    {
        if (\Auth::user()->can('delete common bill')) {

            $commonBill->delete();
            return redirect()->back()->with('success', __('Common bill successfully deleted.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
}
