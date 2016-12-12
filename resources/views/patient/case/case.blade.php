@extends('layouts.master_patient')
@section('title','Case Summary')
@section('content')

        <!-- begin #content -->
<div id="content" class="content">

    <h1 class="page-header">Case Summary</h1>

    <br/>
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-body">
                <table class="table" style="word-wrap: break-word; table-layout: fixed;">
                    <tr>
                        <td height="20" width="20%">Name</td>
                        <td height="20" width="5%">-</td>
                        <td height="20" width="25%">{{isset($patient)? $patient->name:''}}</td>
                        <td height="20" width="20%">NRC/Passport No.</td>
                        <td height="20" width="5%">-</td>
                        <td height="20" width="25%">{{isset($patient)? $patient->nrc_no:''}}</td>
                    </tr>
                    <tr>
                        <td height="20" width="20%">Age/Gender</td>
                        <td height="20" width="5%">-</td>
                        <td height="20" width="25%">{{isset($age)?$age:''}}/{{isset($patient_gender)? $patient_gender:''}}</td>
                        <td height="20" width="20%">Patient Type</td>
                        <td height="20" width="5%">-</td>
                        <td height="20" width="25%">{{$patient_type}}</td>
                    </tr>
                    <tr>
                        <td height="20" width="20%">Registration Date</td>
                        <td height="20" width="5%">-</td>
                        <td height="20" width="25%">{{$registrationDate}}</td>
                        <td height="20" width="20%">Contact Phone</td>
                        <td height="20" width="5%">-</td>
                        <td height="20" width="25%">{{isset($patient)? $patient->phone_no:''}}</td>
                    </tr>
                    <tr>
                        <td height="20" width="20%">Date of Birth</td>
                        <td height="20" width="5%">-</td>
                        <td height="20" width="25%">{{$patientDob}}</td>
                        <td height="20" width="20%">Address</td>
                        <td height="20" width="5%">-</td>
                        <td height="20" width="25%">{{isset($patient)? $patient->address:''}}</td>
                    </tr>
                    <tr>
                        <td height="20" width="20%">Allergies</td>
                        <td height="20" width="5%">-</td>
                        <td height="20" width="25%">
                            @if((isset($patient)) && ($patient->having_allergy == 1))
                                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 allergy_div" style="padding:0px;">
                                    @if(isset($patient))
                                        @foreach($patient['allergies']['food'] as $allergy)
                                            @if($allergy->selected == 1)
                                                <label for="allergy">[Food] - {{$allergy->name}}</label><br/>
                                            @endif
                                        @endforeach

                                        @foreach($patient['allergies']['drug'] as $allergy)
                                            @if($allergy->selected == 1)
                                                <label for="allergy">[Drug] - {{$allergy->name}}</label><br/>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                            @else
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 allergy_div">
                                    <label for="allergy" class='text_big_blue'>No</label>
                                    <br/>
                                </div>
                            @endif
                        </td>
                        <td height="20" width="20%"></td>
                        <td height="20" width="5%"></td>
                        <td height="20" width="25%"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </table>

                <table class="table" style="word-wrap: break-word; table-layout: fixed;">
                    <tr bgcolor="#cccccc">
                        <td><h4>Case Summary</h4></td>
                    </tr>
                    <tr>
                        <td>{{isset($patient)? $patient->case_scenario:''}}</td>
                    </tr>
                </table>
                <hr>

                <div class="row">
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 col-lg-offset-2 col-md-offset-2 col-sm-offset-2 col-xs-offset-2">
                    </div>
                    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 col-lg-offset-11 col-md-offset-11 col-sm-offset-11 col-xs-offset-11">
                        <a target="_blank" href={{'/patient/export'}}><button class="form-control btn-primary" style="padding:0px;">Export PDF</button></a>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>
@stop