<?php

namespace App\Http\Controllers;

use App\Models\ExpenseType;
use App\Models\Building;
use App\Models\Expense;
use App\Models\ExpenseDetail;
use Illuminate\Http\Request;

class ExpenseController extends Controller
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
            $building = Building::where('parent_id', parentId())->pluck('name', 'id');
            $building->prepend(__('Select building'), '');
            $bill_types = ExpenseType::where('parent_id', parentId())->pluck('title', 'id');
            $bill_types->prepend('Select Bill Type', '');
            return view('expense.create', compact('building','bill_types'));
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
                    'expense_type' => 'required',
                    'date' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();
                return redirect()->back()->with('error', $messages->first());
            }
            $Expense = new Expense();
            $Expense->expense_id = $this->expenseNumber();
            // $Expense->building_id = isset($request->building_id) ? $request->building_id : 0;
            $Expense->expense_type = $request->expense_type;
            $Expense->date = $request->date;
            $Expense->parent_id = parentId();
            $Expense->save();

            if (!empty($request->bill_type[0])) {
                foreach ($request->bill_type as $key => $value) {
                    $details = new ExpenseDetail();
                    $details->bill_type = $value;
                    $details->expense_id = $Expense->id;
                    $details->amount = $request->amount[$key];
                    $details->note = $request->note[$key];
                    $details->parent_id = parentId();
                    $details->save();
                }
            }
            return redirect()->back()->with('success', __('expense successfully created.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Expense  $Expense
     * @return \Illuminate\Http\Response
     */
    public function show(Expense $expense)
    {
        return view('expense.show', compact('expense'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Expense  $Expense
     * @return \Illuminate\Http\Response
     */
    public function edit(Expense $expense)
    {
        if (\Auth::user()->can('edit expense')) {

            $building = Building::where('parent_id', parentId())->pluck('name', 'id');
            $building->prepend(__('Select building'), '');
            $bill_types = BillType::where('parent_id', parentId())->pluck('title', 'id');
            $bill_types->prepend('Select Bill Type', '');
            return view('expense.edit', compact('building', 'bill_types', 'expense'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Expense  $Expense
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Expense $Expense)
    {
        if (\Auth::user()->can('edit expense')) {
            $validator = \Validator::make(
                $request->all(),
                [
                    'expense_type' => 'required',
                    'bill_type' => 'required',
                    'amount' => 'required',
                    'date' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();
                return redirect()->back()->with('error', $messages->first());
            }
            $Expense->building_id = isset($request->building_id) ? $request->building_id : 0;
            $Expense->bill_type = $request->bill_type;
            $Expense->expense_type = $request->expense_type;
            $Expense->amount = $request->amount;
            $Expense->date = $request->date;
            if ($request->file('document')) {
                $extension = $request->document->getClientOriginalExtension();
                $name = \Str::uuid() . '.' . $extension;
                $img = $request->document->storeAs('upload/expense/', $name);
                $Expense->document = $img;
            }
            $Expense->save();

            $ids = ExpenseDetail::where('expense_id', $Expense->id)->pluck('id', 'id');

            foreach ($request->bill_type as $key => $value) {
                if (isset($request->expense_id[$key]) && in_array($request->expense_id[$key], $ids->toArray())) {
                    $details = ExpenseDetail::find($request->expense_id[$key]);
                    $details->bill_type = $value;
                    $details->amount = $request->amount[$key];
                    $details->note = $request->note[$key];
                    $details->save();
                    unset($ids[$request->employeement_id[$key]]);
                } else {
                    $details = new ExpenseDetail();
                    $details->bill_type = $value;
                    $details->expense_id = $Expense->id;
                    $details->amount = $request->amount[$key];
                    $details->note = $request->note[$key];
                    $details->parent_id = parentId();
                    $details->save();
                }
            }

            if (count($ids) > 0) {
                foreach ($ids as $key => $id) {
                    if ($id) {
                        $exp_details = ExpenseDetail::find($id);
                        if ($exp_details) {
                            $exp_details->delete();
                        }
                    }
                }
            }

            return redirect()->back()->with('success', __('expense successfully updated.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Expense  $Expense
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expense $Expense)
    {
        if (\Auth::user()->can('delete expense')) {
            $Expense->delete();
            return redirect()->back()->with('success', __('expense successfully deleted.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function expenseNumber()
    {
        $latestexpense = Expense::where('parent_id', parentId())->latest()->first();
        if ($latestexpense == null) {
            return 1;
        } else {
            return $latestexpense->parent_id + 1;
        }
    }
}
