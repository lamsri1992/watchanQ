@extends('app.master')
@section('title',"EMERGENCY ROOM :: WATCHAN")
@section('content')
<style>
    body {
        background-image: url("img/FRAME-Q.png");
    }
    .AutoScroll {
        max-height: 720px;
        overflow-y: scroll;
        overflow: hidden;
    }
    .tableFixHead thead th { 
        position: sticky;
        top: 0;
        z-index: 10001 !important;
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
        <div id="liveQ">
            <div class="card-body" style="margin-top: -2rem;">
                <div class="text-center">
                    <h1 style="font-weight: bold; font-size: 65px;">
                        <strong>คิวรอตรวจห้องฉุกเฉิน</strong>
                        <span class="badge badge-pill badge-danger">
                            {{ count($result) }} คน
                        </span>
                    </h1>
                </div>
                <div class="card-body" style="margin-top: 3.5rem;">
                    <div class="AutoScroll scroller tableFixHead" id="id-1" data-config='{"delay" : 3000 , "amount" : 200}'>
                        <table class="table table-striped table-borderless" width="100%" style="font-size:40px;">
                            <thead class="thead-dark">
                                <tr>
                                    <th class="text-center"><i class="far fa-clock"></i> เวลา</th>
                                    <th class="text-center">HN</th>
                                    <th>ผู้ป่วย</th>
                                    <th class="text-center"> สถานะ</th>
                                    <th class="text-center"> รายการ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($result as $res)
                                @php
                                    if($res->color == 0){$style='#28a745';}
                                    else if ($res->color == 1){$style='#ffc107';}
                                    else if ($res->color == 2){$style='#dc3545';}
                                    else if ($res->color == 3){$style='#ff33e6';}
                                    else if ($res->color == 4){$style='#6c757d';}
                                    $hn = (int)$res->hn;
                                @endphp
                                <tr>
                                    <td class="text-center">{{ $res->time }}</td>
                                    <td class="text-center">{{ $hn }}</td>
                                    <td>{{ $res->p_name." ".substr($res->l_name,0,15)."*****" }}</td>
                                    <td class="text-center">
                                        <span class="badge" style="background-color: {{ $style }};font-size: 35px;">
                                            {{ $res->level }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        @if (isset($res->lab))
                                            <span class="badge badge-primary" style="font-size: 35px;">
                                                <i class="fa fa-flask"></i>
                                                {{ "แลบ" }}
                                            </span>
                                        @endif
                                        @if (isset($res->xr))
                                        <span class="badge badge-warning" style="font-size: 35px;">
                                            <i class="fa fa-x-ray"></i>
                                            {{ "รังสี" }}
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
        <div class="card-body">
            <div class="text-center blink-text">
                <div class="card-body">
                    <h1 class="badge badge-danger btn-block" style="font-size: 35px;"> หากรอคอยนานเกินกว่า 20 นาที ให้ติดต่อพยาบาลที่เค้าท์เตอร์</h1>
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