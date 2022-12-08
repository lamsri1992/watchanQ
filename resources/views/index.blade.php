@extends('app.master')
@section('title',"WATCHAN-H SOFT")
@section('content')
<style>
    body {
        background-image: url("img/hos.jpg");
        background-repeat: no-repeat;
        background-size: 100% 100%;
    }
</style>
<div class="card-body">
    <div class="row">
        <div class="col-md-12">
            <table class="table table-borderless">
                <thead class="thead-dark">
                    <tr class="text-center">
                        <th colspan="2">
                            <img src="{{ asset('img/wc_logo_1.png') }}" class="img img-fluid" width="20%">
                            <h1 style="font-weight: bold; font-size: 60px;">
                                WATCHAN-H SOFT : SMART QUEUE DISPLAY
                            </h1>
                            <span style="font-weight: lighter;">
                                พัฒนาโดยทีม IM โรงพยาบาลวัดจันทร์เฉลิมพระเกียรติ ๘๐ พรรษา
                            </span>
                        </th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    <tr>
                        <td width="50%">
                            <a href="{{ url('er') }}" class="btn btn-danger btn-block" style="font-size: 45px;" target="_blank">
                                <i class="fas fa-ambulance"></i>
                                คิวห้องฉุกเฉิน
                            </a>
                        </td>
                        <td width="50%">
                            <a href="{{ url('opd') }}" class="btn btn-warning btn-block" style="font-size: 45px;" target="_blank">
                                <i class="fas fa-notes-medical"></i>
                                คิวจุดซักประวัติ / หลังพบแพทย์
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <a href="#" class="btn btn-secondary btn-block" style="font-size: 45px;" target="_blank">
                                <i class="fas fa-user-md"></i>
                                คิวห้องตรวจแพทย์
                            </a>
                        </td>
                        <td>
                            <a href="#" class="btn btn-secondary btn-block" style="font-size: 45px;" target="_blank">
                                <i class="fas fa-tooth"></i>
                                คิวห้องทันตกรรม
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <a href="#" class="btn btn-secondary btn-block" style="font-size: 45px;" target="_blank">
                                <i class="fas fa-clinic-medical"></i>
                                คิวห้องคลินิก PCU
                            </a>
                        </td>
                        <td>
                            <a href="#" class="btn btn-secondary btn-block" style="font-size: 45px;" target="_blank">
                                <i class="fas fa-prescription-bottle-alt"></i>
                                คิวห้องเภสัชกรรม
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <a href="#" class="btn btn-secondary btn-block" style="font-size: 45px;" target="_blank">
                                <i class="fas fa-flask"></i>
                                คิวห้องชันสูตร
                            </a>
                        </td>
                        <td>
                            <a href="#" class="btn btn-success btn-block" style="font-size: 45px;" target="_blank">
                                <i class="fas fa-coffee"></i>
                                คิวรวม (จอร้านกาแฟ)
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="card-body">
                <div class="list-group">
                    <a href="#" class="list-group-item list-group-item-action">
                        <i class="fas fa-download"></i>
                        ดาวน์โหลด Queue Template (.psd)
                    </a>
                    <a href="#" class="list-group-item list-group-item-action">
                        <i class="far fa-file-alt"></i>
                        คู่มือการใช้งาน
                    </a>
                    <a href="#" class="list-group-item list-group-item-action">
                        <i class="fas fa-users"></i>
                        ทีมพัฒนาระบบ
                    </a>
                    <a href="https://github.com/lamsri1992/" class="list-group-item list-group-item-action" target="_blank">
                        <i class="fab fa-github"></i>
                        GitHub
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')

@endsection