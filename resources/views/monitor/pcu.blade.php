@extends('app.master')
@section('title',"OPD :: WATCHAN")
@section('content')
<style>
    .AutoScroll {
        max-height: 580px;
        overflow-y: scroll;
        overflow: hidden;
    }
    .tableFixHead thead th {
        position: sticky;
        top: 0;
        background-color: #343a40;
    }
    .blink-text {
        animation: blinker 1s linear infinite;
    }
    @keyframes blinker {
    50% {
        opacity: 0;
    }
}
</style>
<div class="col-md-12">
    <div class="card-body text-center" style="background-color:#17a2b8;border-radius: 25px;">
        <h1 class="card-title" style="font-size:45px;color:white;"><i class="fa fa-hospital-user"></i>
            <strong>ระบบแสดงคิวเข้ารับบริการคลินิก PCU</strong>
        </h1>
        <div class="row">
            <div class="col-md-5">
                <div class="embed-responsive embed-responsive-4by3">
                    <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/videoseries?list=PLTdZgbsMlsm3lMOB9XYxqhZUHTU4AjWkU"
                        frameborder="0" allow="autoplay; encrypted-media">
                    </iframe>
                </div>
            </div>
            <div class="col-md-7">
                <div id="liveQ">
                    <div class="AutoScroll scroller tableFixHead" id="id-1" data-config='{"delay" : 3500 , "amount" : 80}'>
                        <table class="table table-striped table-dark" style="font-size:30px;">
                            <thead class="">
                                <tr>
                                    <th colspan="4" class="text-center"><i class="fa fa-clipboard-list"></i> คิวรอรับบริการ</th>
                                </tr>
                            </thead>
                            <tbody style="font-size:40px;">
                                @foreach($result as $res)
                                @php $hn = (int)$res->visit_hn;
                                @endphp
                                <tr>
                                    <td width="20%">
                                        <span style="font-weight: bold;">{{ $hn }}</span>
                                    </td>
                                    <td>
                                        {{ $res->patient_firstname }} {{ substr($res->patient_lastname,0,9)."*****" }}
                                    </td>
                                    <td>{{ substr($res->assign_date_time,11,10) }}</td>
                                    <td class="text-center">
                                        @if ($res->visit_queue_transfer_lab_status == 1)
                                            <span class="">
                                                <i class="fa fa-flask text-success"></i> รอผล
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid" style="padding-top: 1%;">
    <marquee scrollamount="7" style="background-color:#dc3545;border-radius: 25px;">
        <h1 class="text-white"><i class="fa fa-bullhorn"></i> คิวรอรับบริการ เรียงลำดับจากเวลาที่ส่งชื่อเข้าระบบ กรุณารอคิวตามลำดับ</h1>
    </marquee>
</div>

@php
    $data = count($result); $data_refresh = ($data * 2) * 1000;
    if($data_refresh == 0){ $data_settime = 10000; }else{ $data_settime=$data_refresh; }
    // echo $data_settime;
@endphp

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
