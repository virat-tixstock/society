<?php

namespace App\Http\Controllers;

use App\Models\Building;
use App\Models\Maintenance;
use App\Models\MaintenanceDetail;
use App\Models\MaintenanceType;
use App\Models\Member;
use App\Models\Notification;
use Illuminate\Http\Request;

class MaintenanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (\Auth::user()->can('manage maintenance')) {
            $maintenances = Maintenance::where('parent_id', parentId())->get();
            return view('maintenance.index', compact('maintenances'));
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
        if (\Auth::user()->can('create maintenance')) {
            $type = MaintenanceType::where('parent_id', parentId())->pluck('title', 'id');
            $type->prepend('Select type', '');
            $building = Building::where('parent_id', parentId())->pluck('name', 'id');
            $building->prepend('Select Building', '');
            $member = Member::where('parent_id', parentId())->pluck('name', 'id');
            $member->prepend('Select Member', '');
            return view('maintenance.create', compact('type', 'building','member'));
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
        if (\Auth::user()->can('create maintenance')) {
            $validator = \Validator::make(
                $request->all(),
                [
                    // 'building_id' => 'required',
                    'member_id' => 'required',
                    'month' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();
                return redirect()->back()->with('error', $messages->first());
            }
            $maintenance = new Maintenance();
            $maintenance->maintenance_id = $this->maintenanceNumber();
            // $maintenance->building_id = isset($request->building_id) ? $request->building_id : 0;
            $maintenance->member_id = isset($request->member_id) ? $request->member_id : 0;
            $maintenance->status = $request->status;
            $maintenance->month = $request->month;
            $maintenance->parent_id = parentId();
            $maintenance->save();

            if (!empty($request->type[0])) {
                foreach ($request->type as $key => $value) {
                    $details = new MaintenanceDetail();
                    $details->maintenance_id = $maintenance->id;
                    $details->type = $value;
                    $details->amount = $request->amount[$key];
                    $details->note = $request->note[$key];
                    $details->parent_id = parentId();
                    $details->save();
                }
            }
            $module = 'maintenance_create';
            $notification = Notification::where('parent_id', parentId())->where('module', $module)->first();
            $setting = settings();
            $errorMessage = '';
            if (!empty($notification) && $notification->enabled_email == 1) {
                $notification_responce = MessageReplace($notification, $maintenance->id);
                $data['subject'] = $notification_responce['subject'];
                $data['message'] = $notification_responce['message'];
                $data['module'] = $module;
                $data['logo'] = $setting['company_logo'];
                $to = $maintenance->Member->email;

                $response = commonEmailSend($to, $data);
                if ($response['status'] == 'error') {
                    $errorMessage = $response['message'];
                }
            }
            return redirect()->back()->with('success', __('Maintenance successfully created.') . '</br>' . $errorMessage);
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Maintenance  $maintenance
     * @return \Illuminate\Http\Response
     */
    public function show(Maintenance $maintenance)
    {
        if (\Auth::user()->can('show maintenance')) {
            return view('maintenance.show', compact('maintenance'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Maintenance  $maintenance
     * @return \Illuminate\Http\Response
     */
    public function edit(Maintenance $maintenance)
    {
        if (\Auth::user()->can('edit maintenance')) {
            $type = MaintenanceType::where('parent_id', parentId())->pluck('title', 'id');
            $type->prepend('Select type', '');
            $building = Building::where('parent_id', parentId())->pluck('name', 'id');
            $building->prepend('Select Building', '');
            $member = Member::where('parent_id', parentId())->where('building_id', $maintenance->building_id)->pluck('name', 'id');
            $member->prepend('Select Member', '');
            return view('maintenance.edit', compact('maintenance', 'type', 'building', 'member'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Maintenance  $maintenance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Maintenance $maintenance)
    {
        if (\Auth::user()->can('edit maintenance')) {
            $validator = \Validator::make(
                $request->all(),
                [
                    // 'building_id' => 'required',
                    'member_id' => 'required',
                    'month' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();
                return redirect()->back()->with('error', $messages->first());
            }
            // $maintenance->building_id = isset($request->building_id) ? $request->building_id : 0;
            $maintenance->member_id = isset($request->member_id) ? $request->member_id : 0;
            $maintenance->status = $request->status;
            $maintenance->month = $request->month;
            $maintenance->save();

            $ids = MaintenanceDetail::where('maintenance_id', $maintenance->id)->pluck('id', 'id');

            foreach ($request->type as $key => $value) {
                if (isset($request->maintenance_id[$key]) && in_array($request->maintenance_id[$key], $ids->toArray())) {
                    $details = MaintenanceDetail::find($request->maintenance_id[$key]);
                    $details->type = $value;
                    $details->amount = $request->amount[$key];
                    $details->note = $request->note[$key];
                    $details->save();
                    unset($ids[$request->employeement_id[$key]]);
                } else {
                    $details = new MaintenanceDetail();
                    $details->maintenance_id = $maintenance->id;
                    $details->type = $value;
                    $details->amount = $request->amount[$key];
                    $details->note = $request->note[$key];
                    $details->parent_id = parentId();
                    $details->save();
                }
            }

            if (count($ids) > 0) {
                foreach ($ids as $key => $id) {
                    if ($id) {
                        $exp_details = MaintenanceDetail::find($id);
                        if ($exp_details) {
                            $exp_details->delete();
                        }
                    }
                }
            }

            return redirect()->back()->with('success', __('Maintenance successfully updated.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Maintenance  $maintenance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Maintenance $maintenance)
    {
        if (\Auth::user()->can('delete maintenance')) {
            MaintenanceDetail::where('maintenance_id', $maintenance->id)->delete();
            $maintenance->delete();
            return redirect()->back()->with('success', __('Maintenance successfully deleted.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
    public function getTypeCost(Request $request)
    {
        $type = MaintenanceType::find($request->type);

        return response()->json($type->amount);
    }

    public function maintenanceNumber()
    {
        $latestMaintenance = Maintenance::where('parent_id', parentId())->latest()->first();
        if ($latestMaintenance == null) {
            return 1;
        } else {
            return $latestMaintenance->parent_id + 1;
        }
    }
}
