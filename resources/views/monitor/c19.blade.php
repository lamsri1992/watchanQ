@extends('app.master')
@section('title',"EMERGENCY ROOM :: WATCHAN")
@section('content')
<style>
    .AutoScroll {
        max-height: 800px;
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
                <h1 class="card-title" style="font-size:45px;color:white;"><i class="fa fa-syringe"></i>
                    <strong>คิวรอลงทะเบียนรับวัคซีน</strong> : 
                    <span class="badge badge-pill badge-danger" style="font-size: 40px;">{{ $data }}</span> คิว
                </h1>
                <div class="AutoScroll scroller tableFixHead" id="id-1" data-config='{"delay" : 5000 , "amount" : 100}'>
                    <table class="table table-striped table-dark" width="100%" style="font-size:30px;">
                        <thead class="thead-dark">
                            <tr>
                                <th class="text-center">CID</th>
                                <th>ผู้ป่วย</th>
                                <th class="text-center"><i class="far fa-clock"></i> เวลา</th>
                            </tr>
                        </thead>
                        <tbody style="font-size:35px;">
                            @foreach($result as $res)
                            <tr>
                                <td class="text-center">{{ substr($res->patient_pid,0,8)."****" }}</td>
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