@extends('app.master')
@section('title',"EMERGENCY ROOM :: WATCHAN")
@section('content')
<style>
    .AutoScroll {
        max-height: 540px;
        overflow-y: scroll;
        overflow: hidden;
    }
    .tableFixHead thead th { 
        position: sticky;
        top: 0; 
    }
    .blink-text {
        animation: blinker 3s linear infinite;
    }
    @keyframes blinker {
    50% {
        opacity: 0;
    }
}
</style>
    @php
        $data = count($result); $data_refresh = ($data * 3) * 1000;
        if($data_refresh == 0){ $data_settime = 10000; }else{ $data_settime=$data_refresh; }
        // echo $data_settime;
    @endphp
<div class="row">
    <div class="col-md-12">
        <div class="card-body text-center" style="background-color:#17a2b8;border-radius: 25px;">
            <div id="liveQ">
                <h1 class="card-title" style="font-size:45px;color:white;"><i class="fa fa-user-injured"></i>
                    <strong>คิวรอตรวจห้องฉุกเฉิน</strong> : 
                    <span class="badge badge-pill badge-danger" style="font-size: 40px;">{{ $data }}</span> คิว
                </h1>
                <div class="AutoScroll scroller tableFixHead" id="id-1" data-config='{"delay" : 5000 , "amount" : 100}'>
                    <table class="table table-striped table-dark" width="100%" style="font-size:30px;">
                        <thead class="thead-dark">
                            <tr>
                                <th class="text-center">HN</th>
                                <th>ผู้ป่วย</th>
                                <th class="text-center"><i class="far fa-clock"></i> เวลา</th>
                                <th class="text-center" width="25%"> สถานะ</th>
                                <th class="text-center"> รายการ</th>
                            </tr>
                        </thead>
                        <tbody style="font-size:35px;">
                            @foreach($result as $res)
                            @php
                                if($res->f_emergency_status_id==0){$style='light';}
                                else if ($res->f_emergency_status_id==1){$style='dark';}
                                else if ($res->f_emergency_status_id==2){$style='warning';}
                                else if ($res->f_emergency_status_id==3){$style='danger';}
                                else if ($res->f_emergency_status_id==4){$style='danger';}
                                else if ($res->f_emergency_status_id==5){$style='success';}
                                else {$style='light';}
                                $hn = (int)$res->visit_hn;
                            @endphp
                            <tr>
                                <td class="text-center">{{ $hn }}</td>
                                <td>{{ $res->patient_firstname }} {{ substr($res->patient_lastname,0,15)."*****" }}</td>
                                <td class="text-center">{{ substr($res->assign_date_time,11,10) }}</td>
                                <td class="text-center">
                                    <span class="badge badge-{{ $style }} btn-block" style="font-size: 35px;">
                                        {{ $res->emergency_status_description }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    @if ($res->visit_queue_transfer_lab_status == 1)
                                        <span class="" style="font-size: 35px;">
                                            <i class="fa fa-flask text-success"></i> {{ "รอผลแลบ" }}
                                        </span>
                                    @endif
                                    @if ($res->f_emergency_status_id == 0 || $res->f_emergency_status_id == '')
                                        <span class="" style="font-size: 35px;">
                                            <i class="far fa-comment-dots text-warning"></i> {{ 'รอซักประวัติ' }}
                                        </span>
                                    @endif
                                    @if ($res->visit_locking == 1)
                                        <span class="" style="font-size: 35px;">
                                            <i class="fas fa-stethoscope text-success"></i> {{ 'กำลังตรวจ' }}
                                        </span>
                                    @endif
                                    @if ($res->b_service_point_id == '2402024154365')
                                        <span class="" style="font-size: 35px;">
                                            <i class="fa fa-procedures text-danger"></i> {{ "นอนดูอาการ" }}
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="text-center blink-text" style="padding-top: 1%;">
                <h1 class="badge badge-danger btn-block" style="font-size: 40px;"> หากรอคอยนานเกินกว่า 20 นาที ให้ติดต่อพยาบาลที่เค้าท์เตอร์</h1>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
<script type="text/javascript">
    $(document).ready(function() {
        var refreshId = setInterval(function() {
            $('#liveQ').load(document.URL +  ' #liveQ');
        }, {{ $data_settime }});
    });
</script>
@endsection