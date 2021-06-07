<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class callerController extends Controller
{
    public function opd()
    {
        $result = DB::table('t_visit_queue_transfer')
                ->leftJoin('t_visit', 't_visit.t_visit_id', '=', 't_visit_queue_transfer.t_visit_id')
                ->leftJoin('b_service_point', 'b_service_point.b_service_point_id', '=', 't_visit_queue_transfer.b_service_point_id')
                ->where('t_visit_queue_transfer.b_service_point_id', '=', '2060761082126')
                ->orwhere('t_visit_queue_transfer.b_service_point_id', '=', '240237369467307452')
                ->where('t_visit_queue_transfer.f_visit_type_id', '=', '0')
                ->where('t_visit_queue_transfer.visit_queue_map_queue', '<>', '0')
                ->orderBy('t_visit_queue_transfer.assign_date_time', 'asc')
                ->get();
        return view('caller.opd', ['result'=>$result]);
    }

    public function c19()
    {
        $result = DB::table('t_visit_queue_transfer')
                ->leftJoin('t_patient', 't_patient.patient_hn', '=', 't_visit_queue_transfer.visit_hn')
                ->leftJoin('t_visit', 't_visit.t_visit_id', '=', 't_visit_queue_transfer.t_visit_id')
                ->leftJoin('b_service_point', 'b_service_point.b_service_point_id', '=', 't_visit_queue_transfer.b_service_point_id')
                ->where('t_visit_queue_transfer.b_service_point_id', '=', '240237368319191413')
                ->orwhere('t_visit_queue_transfer.b_service_point_id', '=', '240237369996794657')
                ->where('t_visit_queue_transfer.f_visit_type_id', '=', '0')
                ->where('t_visit_queue_transfer.visit_queue_map_queue', '<>', '0')
                ->orderBy('t_visit_queue_transfer.assign_date_time', 'asc')
                ->get();
        return view('caller.c19', ['result'=>$result]);
    }
}
