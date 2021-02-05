@extends('app.master')
@section('title',"OPD :: WATCHAN")
@section('content')
<style>
    .AutoScroll {
        max-height: 220px;
        overflow-y: scroll;
        overflow: hidden;
    }
    .tableFixHead thead th {
        position: sticky;
        top: 0;
        background-color: #343a40;
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
<div class="col-md-12">
    <div class="card-body text-center" style="background-color:#17a2b8;border-radius: 25px;">
        <h1 class="card-title" style="font-size:45px;color:white;"><i class="fa fa-hospital-user"></i>
            <strong>ระบบแสดงคิวเข้ารับบริการผู้ป่วยนอก</strong>
        </h1>
        <div class="row">
            <div class="col-md-5">
                <div id="opdSlide" class="carousel slide" style="background-color: #343a40" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active" data-interval="10000">
                            <img src="http://www.prdmh.com/images/Covid-19/%E0%B8%AD%E0%B8%94_%E0%B8%AE%E0%B8%94_%E0%B8%AA.jpg" width="480px" height="480px">
                        </div>
                        <div class="carousel-item" data-interval="10000">
                            <img src="http://www.prdmh.com/images/Covid-19/%E0%B9%80%E0%B8%8A%E0%B8%84%E0%B8%AD%E0%B8%A2%E0%B8%B2%E0%B8%87%E0%B9%84%E0%B8%A3_%E0%B8%82%E0%B8%B2%E0%B8%A7%E0%B9%84%E0%B8%AB%E0%B8%99%E0%B8%88%E0%B8%A3%E0%B8%87%E0%B8%9B%E0%B8%A5%E0%B8%AD%E0%B8%A1.jpg" width="480px" height="480px">
                        </div>
                        <div class="carousel-item" data-interval="10000">
                            <img src="http://www.prdmh.com/images/Covid-19/%E0%B8%A3%E0%B8%9E%E0%B8%88.%E0%B8%82%E0%B8%AD%E0%B8%99%E0%B9%81%E0%B8%81%E0%B8%99_info_4_%E0%B8%A0%E0%B8%B2%E0%B8%84_%E0%B9%80%E0%B8%AB%E0%B8%99%E0%B8%AD.jpg" width="480px" height="480px">
                        </div>
                        <div class="carousel-item" data-interval="10000">
                            <img src="http://www.prdmh.com/images/Covid-19/3%E0%B9%84%E0%B8%A13%E0%B8%95%E0%B8%AD%E0%B8%87_%E0%B9%82%E0%B8%84%E0%B8%A7%E0%B8%9419-01.jpg" width="480px" height="480px">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div id="liveQ">
                    <div class="AutoScroll scroller tableFixHead" id="id-1" data-config='{"delay" : 5000 , "amount" : 100}'>
                        <table class="table table-striped table-dark" style="font-size:30px;">
                            <thead class="">
                                <tr>
                                    <th colspan="3" class="text-center"><i class="fa fa-clipboard-list"></i> จุดรอซักประวัติ</th>
                                </tr>
                            </thead>
                            <tbody style="font-size:30px;">
                                @foreach($result as $res)
                                @php $hn = (int)$res->visit_hn;
                                @endphp
                                <tr>
                                    <td width="20%">
                                        <span style="font-weight: bold;">{{ "HN".$hn }}</span>
                                    </td>
                                    <td><i class="far fa-address-card"></i> 
                                        {{ $res->patient_firstname }} {{ substr($res->patient_lastname,0,9)."*****" }}
                                    </td>
                                    <td><i class="far fa-clock"></i> {{ substr($res->assign_date_time,11,10) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <br>
                    <div class="AutoScroll scroller tableFixHead" id="id-2" data-config='{"delay" : 5000 , "amount" : 100}'>
                        <table class="table table-striped table-light" style="font-size:30px;">
                            <thead class="thead-light">
                                <tr>
                                    <th colspan="3" class="text-center"><i class="fa fa-clinic-medical"></i> หลังพบแพทย์</th>
                                </tr>
                            </thead>
                            <tbody style="font-size:30px;">
                                @foreach($opd as $res)
                                @php $hn = (int)$res->visit_hn;
                                @endphp
                                <tr>
                                    <td width="20%">
                                        <span style="font-weight: bold;">{{ "HN".$hn }}</span>
                                    </td>
                                    <td><i class="far fa-address-card"></i> 
                                        {{ $res->patient_firstname }} {{ substr($res->patient_lastname,0,9)."*****" }}
                                    </td>
                                    <td><i class="far fa-clock"></i> {{ substr($res->assign_date_time,11,10) }}</td>
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

@php
    $data = count($result)+count($opd); $data_refresh = ($data * 2) * 1000;
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
