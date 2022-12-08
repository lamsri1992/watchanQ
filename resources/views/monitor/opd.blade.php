@extends('app.master')
@section('title',"OPD :: WATCHAN")
@section('content')
<style>
    body {
        background-image: url("img/FRAME-OPD.png");
        background-repeat: no-repeat;
        background-size: 100% 100%;
    }
    .AutoScroll {
        max-height: 600px;
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
$data = count($result); $data_refresh = ($data * 5) * 1000;
if($data_refresh == 0){ $data_settime = 10000; }else{ $data_settime=$data_refresh; }
// echo $data_settime;
@endphp
<div class="row">
    <div class="col-md-12">
        <div id="liveQ">
            <div class="card-body" style="margin-top: -2rem;">
                <div class="text-center">
                    <h1 style="font-weight: bold; font-size: 65px;">
                        <strong>คิวจุดซักประวัติผู้ป่วย</strong>
                        <span class="badge badge-pill badge-danger" style="font-size: 60px;">
                            {{ count($result) }} คน
                        </span>
                    </h1>
                </div>
                <div class="card-body" style="margin-top: 3.5rem;">
                    <div class="AutoScroll scroller tableFixHead" id="id-1" data-config='{"delay" : 3000 , "amount" : 200}'>
                        <table class="table" width="100%" style="font-size:40px;">
                            <thead class="thead-dark">
                                <tr>
                                    <th class="text-center">
                                        <i class="fa fa-list-ol"></i>
                                    </th>
                                    <th>ชื่อ-สกุล</th>
                                    <th class="text-center">เวลารอคอย</th>
                                    <th class="text-center">ประเภท</th>
                                    <th class="text-center">รายการ</th>
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
                                    $cur_time = date('H:i:s');
                                    $from_time = strtotime($res->time); 
                                    $to_time = strtotime($cur_time); 
                                    $diff_minutes = round(abs($from_time - $to_time) / 60). " นาที";
                                @endphp
                                <tr style="background-color: {{ $style }};">
                                    <td class="text-center">
                                        <span class="badge badge-pill badge-light btn-block" style="font-size: 40px;">
                                            {{ $res->queue }}
                                        </span>
                                    </td>
                                    <td>
                                        <span style="font-weight: bold;">
                                            {{ $res->p_name." ".substr($res->l_name,0,15)."xxxxx" }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge badge-pill btn-block badge-secondary" style="font-size: 40px;font-weight: bold;">
                                            <i class="far fa-clock"></i>
                                            {{ $diff_minutes }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span class="" style="font-size: 40px;font-weight: bold;">
                                            {{ $res->list }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        @if (isset($res->lab))
                                            <span class="badge badge-primary" style="font-size: 40px;font-weight: bold;">
                                                <i class="fa fa-flask"></i>
                                            </span>
                                        @endif
                                        @if (isset($res->xr))
                                        <span class="badge badge-warning" style="font-size: 40px;font-weight: bold;">
                                            <i class="fa fa-x-ray"></i>
                                        </span>
                                        @endif
                                        @if (isset($res->observe))
                                        <span class="badge badge-dark" style="font-size: 40px;font-weight: bold;">
                                            <i class="fa fa-bed"></i>
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
                    <h1 class="badge badge-danger btn-block" style="font-size: 40px;"> หากรอคอยนานเกินกว่า 20 นาที ให้ติดต่อพยาบาลที่เค้าท์เตอร์</h1>
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
            $(function() {
                var Toast = Swal.mixin({
                    position: 'top-end',
                    toast: true,
                    showConfirmButton: false,
                    timer: 3000,
                });
                    Toast.fire({
                    icon: 'success',
                    title: 'Auto Refresh {{ $data_settime }} ms '
                })
            });
        }, {{ $data_settime }});
    });
</script>
@endsection