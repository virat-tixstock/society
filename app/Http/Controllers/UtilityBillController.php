<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\ExpenseType;
use Illuminate\Http\Request;

class UtilityBillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (\Auth::user()->can('manage expense')) {
            $expenses = Expense::where('parent_id', parentId())->get();
            return view('expense.index', compact('expenses'));
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
        if (\Auth::user()->can('create expense')) {
            $type = ExpenseType::where('parent_id', parentId())->pluck('title', 'id');
            $type->prepend(__('Select Type'), '');
            return view('expense.create', compact('type'));
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
        if (\Auth::user()->can('create expense')) {
            $validator = \Validator::make(
                $request->all(),
                [
                    'title' => 'required',
                    'date' => 'required',
                    'amount' => 'required',
                    'type' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();
                return redirect()->back()->with('error', $messages->first());
            }
            $expense = new Expense();
            $expense->title = $request->title;
            $expense->date = $request->date;
            $expense->amount = $request->amount;
            $expense->type = $request->type;
            $expense->note = $request->note;
            $expense->parent_id = parentId();
            $expense->save();
            return redirect()->back()->with('success', __('Expense successfully created.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function show(Expense $expense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function edit(Expense $expense)
    {
        if (\Auth::user()->can('edit expense')) {
            $type = ExpenseType::where('parent_id', parentId())->pluck('title', 'id');
            $type->prepend(__('Select Type'), '');
            return view('expense.edit', compact('expense', 'type'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Expense $expense)
    {
        if (\Auth::user()->can('edit expense')) {
            $validator = \Validator::make(
                $request->all(),
                [
                    'title' => 'required',
                    'date' => 'required',
                    'amount' => 'required',
                    'type' => 'required',

                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();
                return redirect()->back()->with('error', $messages->first());
            }

            $expense->title = $request->title;
            $expense->date = $request->date;
            $expense->amount = $request->amount;
            $expense->type = $request->type;
            $expense->note = $request->note;
            $expense->save();
            return redirect()->back()->with('success', __('Expense successfully updated.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expense $expense)
    {
        if (\Auth::user()->can('delete expense')) {
            $expense->delete();
            return redirect()->back()->with('success', __('Expense successfully deleted.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
}
