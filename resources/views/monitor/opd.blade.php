@extends('app.master')
@section('title',"OPD :: WATCHAN")
@section('content')
<style>
    .AutoScroll {
        max-height: 300px;
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
<div class="col-md-12">
    <div class="card-body text-center" style="background-color:#17a2b8;border-radius: 25px;">
        <h1 class="card-title" style="font-size:45px;color:white;"><i class="fa fa-hospital-user"></i>
            <strong>ระบบแสดงคิวเข้ารับบริการผู้ป่วยนอก</strong>
        </h1>
        <div class="row">
            <div class="col-md-7">
                <div class="embed-responsive embed-responsive-4by3" style="height: 500px;">
                    <iframe height="500" style="border-radius: 25px;"
                        src="https://www.youtube.com/embed/videoseries?list=PLs5m0uHKO9RDBcGsCCcb4KAVcbbEij8xv"
                        frameborder="0" allow="autoplay; encrypted-media">
                    </iframe>
                </div><hr>
                <div class="text-center blink-text">
                    <h1 class="badge badge-danger btn-block" style="font-size: 30px;">หากรอคอยนานเกินกว่า 20 นาที ให้ติดต่อพยาบาลที่เค้าท์เตอร์</h1>
                </div>
            </div>
            <div class="col-md-5">
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
                                    <td class="text-center">{{ $hn }}</td>
                                    <td>{{ $res->patient_firstname }} {{ substr($res->patient_lastname,0,15)."*****" }}</td>
                                    <td class="text-center">{{ substr($res->assign_date_time,11,10) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="AutoScroll scroller tableFixHead" id="id-1" data-config='{"delay" : 5000 , "amount" : 100}'>
                        <table class="table table-striped table-light" style="font-size:30px;">
                            <thead class="">
                                <tr>
                                    <th colspan="3" class="text-center"><i class="fa fa-clinic-medical"></i> หลังพบแพทย์</th>
                                </tr>
                            </thead>
                            <tbody style="font-size:30px;">
                                @foreach($opd as $res)
                                @php $hn = (int)$res->visit_hn;
                                @endphp
                                <tr>
                                    <td class="text-center">{{ $hn }}</td>
                                    <td>{{ $res->patient_firstname }} {{ substr($res->patient_lastname,0,15)."*****" }}</td>
                                    <td class="text-center">{{ substr($res->assign_date_time,11,10) }}</td>
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
