<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class monitorController extends Controller
{
    public function er()
    {
        $result = DB::select("select distinct ovst.hn as hn,ovst.oqueue as queue,ovst.vstdate as date,ovst.vsttime as time,
        CONCAT(patient.pname,patient.fname) as p_name,patient.lname as l_name,pt_priority.`name` as `level`,
        pt_priority.id as color,ovstist.`name` as list,lab_head.lab_order_number as lab,
        xray_head.xray_order_number as xr,er_regist.observe as observe
        
        from ovst
        
        left join patient on patient.hn = ovst.hn
        left join ovstist on ovstist.ovstist = ovst.ovstist
        left join er_regist on er_regist.vn = ovst.vn
        left join er_emergency_type on er_emergency_type.er_emergency_type = er_regist.er_emergency_type
        left join pt_priority on pt_priority.id = ovst.pt_priority
        left join lab_head on lab_head.vn = ovst.vn
        left join xray_head on xray_head.vn = ovst.vn
        
        where ovst.vstdate = '".date('Y-m-d')."'
        and ovst.cur_dep = '027'
        and er_regist.finish_time is null
        group by ovst.hn
        order by ovst.vstdate,ovst.vsttime asc");
        // dd($result);
        return view('monitor.er',['result' => $result]);
    }

    public function opd()
    {
        $result = DB::select("select distinct ovst.hn as hn,ovst.oqueue as queue,ovst.vstdate as date,ovst.vsttime as time,
        CONCAT(patient.pname,patient.fname) as p_name,patient.lname as l_name,pt_priority.`name` as `level`,
        pt_priority.id as color,ovstist.`name` as list,lab_head.lab_order_number as lab,
        xray_head.xray_order_number as xr,er_regist.observe as observe
        
        from ovst
        
        left join patient on patient.hn = ovst.hn
        left join ovstist on ovstist.ovstist = ovst.ovstist
        left join er_regist on er_regist.vn = ovst.vn
        left join er_emergency_type on er_emergency_type.er_emergency_type = er_regist.er_emergency_type
        left join pt_priority on pt_priority.id = ovst.pt_priority
        left join lab_head on lab_head.vn = ovst.vn
        left join xray_head on xray_head.vn = ovst.vn
        
        where ovst.vstdate = '".date('Y-m-d')."'
        and ovst.cur_dep = '022'
        and er_regist.finish_time is null
        group by ovst.hn
        order by ovst.vstdate,ovst.vsttime asc");
        // dd($result);
        return view('monitor.opd',['result' => $result]);
    }
    
}
