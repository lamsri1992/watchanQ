@extends('app.master')
@section('title',"OPD :: CALLER")
@section('content')

<div class="col-md-12">
    <div class="card-body text-center" style="background-color:#17a2b8;border-radius: 25px;">
        <h1 class="card-title" style="font-size:45px;color:white;"><i class="fa fa-bullhorn"></i>
            <strong>ระบบเรียกคิวเข้ารับวัคซีน Covid-19</strong>
        </h1>
        <div class="text-right" style="padding-bottom: 1rem;">
            <button onClick="window.location.reload();" class="btn btn-warning btn-sm"><i class="fa fa-sync-alt"></i> Refresh</button>
        </div>
        <div id="refresh">
            <table class="table table-striped table-sm table-dark" width="100%">
                <thead class="thead-dark">
                    <tr>
                        <th class="text-center">CID</th>
                        <th>ผู้ป่วย</th>
                        <th class="text-center"><i class="far fa-clock"></i> เวลาถึงจุดรับบริการ</th>
                        <th class="text-center"><i class="far fa-play-circle"></i> ฟังก์ชั่นเรียกคิว</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($result as $res)
                    @php
                        $pname = $res->patient_firstname." ".$res->patient_lastname;
                    @endphp
                    <tr>
                        <td class="text-center">{{ $res->patient_pid }}</td>
                        <td>{{ $pname }}</td>
                        <td class="text-center">{{ $res->assign_date_time,11,10 }}</td>
                        @if ($res->b_service_point_id == '240237368319191413')
                        <td class="text-center">
                            <button class="btn btn-sm btn-success" id="oval" role="button"
                                onclick='responsiveVoice.speak("เชิญคุณ, {{ $pname }}, คุณ, {{ $pname }}, ที่จุดลงทะเบียน, ค่ะ","Thai Female",{rate: 0.9});'>
                                <i class="fa fa-volume-up"></i> เรียกผู้ป่วย 1
                            </button>
                        </td>
                        @else
                        <td class="text-center">
                            <button class="btn btn-sm btn-danger" id="oval" role="button"
                                onclick='responsiveVoice.speak("เชิญคุณ, {{ $pname }}, คุณ, {{ $pname }}, ที่จุดบริการ 8, ค่ะ","Thai Female",{rate: 0.9});'>
                                <i class="fa fa-volume-up"></i> รับใบนัด
                            </button>
                        </td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@php
    $data = count($result); $data_refresh = ($data * 5) * 1000;
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

