@extends('layouts.master')
@section('title','Dashboard')
@section('content')
<style>
    .info-box{
        cursor: pointer;
    }
</style>

        <!-- begin #content -->
<div id="content" class="content">

    <h1 class="page-header">Dashboard</h1>

    <div class="row">
            <div class="col-md-3">
                <div class="info-box" onclick="redirect_to_list('user');">
                    <span class="info-box-icon bg-light-blue"><i class="ion ion-android-person"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Total Staff</span>
                        <span class="info-box-number">{{ $userCount }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </div>
            <div class="col-md-offset-1 col-md-3">
                <div class="info-box" onclick="redirect_to_list('patient');">
                    <span class="info-box-icon bg-red"><i class="ion ion-android-person"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Total Patient</span>
                        <span class="info-box-number">{{ $patientCount }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </div>
            <div class="col-md-offset-1 col-md-3">
                <div class="info-box" onclick="redirect_to_list('familymember');">
                    <span class="info-box-icon bg-orange"><i class="ion ion-android-person"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Total Family Member</span>
                        <span class="info-box-number">{{ $familyMemberCount }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-3">
            <div class="info-box" onclick="redirect_to_list('schedule');">
                <span class="info-box-icon bg-light-blue"><i class="ion ion-folder"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Total Schedule</span>
                    <span class="info-box-number">{{ $scheduleCount }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
        </div>
        <div class="col-md-offset-1 col-md-3">
            <div class="info-box" onclick="redirect_to_list('enquiry');">
                <span class="info-box-icon bg-red"><i class="ion ion-folder"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Total Enquiry</span>
                    <span class="info-box-number">{{ $enquiryCount }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
        </div>
        <div class="col-md-offset-1 col-md-3">
            <div class="info-box" onclick="redirect_to_list('route');">
                <span class="info-box-icon bg-orange"><i class="ion ion-folder"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Total Route</span>
                    <span class="info-box-number">{{ $routeCount }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-3">
            <div class="info-box" onclick="redirect_to_list('city');">
                <span class="info-box-icon bg-light-blue"><i class="ion ion-folder"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Total City</span>
                    <span class="info-box-number">{{ $cityCount }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
        </div>
        <div class="col-md-offset-1 col-md-3">
            <div class="info-box" onclick="redirect_to_list('township');">
                <span class="info-box-icon bg-red"><i class="ion ion-folder"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Total Township</span>
                    <span class="info-box-number">{{ $townshipCount }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
        </div>
        <div class="col-md-offset-1 col-md-3">
            <div class="info-box" onclick="redirect_to_list('zone');">
                <span class="info-box-icon bg-orange"><i class="ion ion-folder"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Total Zone</span>
                    <span class="info-box-number">{{ $zoneCount }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-3">
            <div class="info-box" onclick="redirect_to_list('cartype');">
                <span class="info-box-icon bg-light-blue"><i class="ion ion-folder"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Total Car Type</span>
                    <span class="info-box-number">{{ $carTypeCount }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
        </div>
        <div class="col-md-offset-1 col-md-3">
            <div class="info-box" onclick="redirect_to_list('productcategory');">
                <span class="info-box-icon bg-red"><i class="ion ion-folder"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Total Medication Category</span>
                    <span class="info-box-number">{{ $medicationCategoryCount }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
        </div>
        <div class="col-md-offset-1 col-md-3">
            <div class="info-box" onclick="redirect_to_list('product');">
                <span class="info-box-icon bg-orange"><i class="ion ion-folder"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Total Medication</span>
                    <span class="info-box-number">{{ $medicationCount }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-3">
            <div class="info-box" onclick="redirect_to_list('allergy');">
                <span class="info-box-icon bg-light-blue"><i class="ion ion-folder"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Total Allergy</span>
                    <span class="info-box-number">{{ $allergyCount }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
        </div>
        <div class="col-md-offset-1 col-md-3">
            <div class="info-box" onclick="redirect_to_list('service');">
                <span class="info-box-icon bg-red"><i class="ion ion-folder"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Total Service</span>
                    <span class="info-box-number">{{ $serviceCount }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
        </div>
        <div class="col-md-offset-1 col-md-3">
            <div class="info-box" onclick="redirect_to_list('package');">
                <span class="info-box-icon bg-orange"><i class="ion ion-folder"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Total Package</span>
                    <span class="info-box-number">{{ $packageCount }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-3">
            <div class="info-box" onclick="redirect_to_list('familyhistory');">
                <span class="info-box-icon bg-light-blue"><i class="ion ion-folder"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Total Family History</span>
                    <span class="info-box-number">{{ $familyHistoryCount }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
        </div>
        <div class="col-md-offset-1 col-md-3">
            <div class="info-box" onclick="redirect_to_list('medicalhistory');">
                <span class="info-box-icon bg-red"><i class="ion ion-folder"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Total Medical History</span>
                    <span class="info-box-number">{{ $medicalHistoryCount }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
        </div>
        <div class="col-md-offset-1 col-md-3">
            <div class="info-box" onclick="redirect_to_list('provisionaldiagnosis');">
                <span class="info-box-icon bg-orange"><i class="ion ion-folder"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Total Provisional Diagnosis</span>
                    <span class="info-box-number">{{ $provisionalDiagnosisCount }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
        </div>
    </div>

</div>
@stop

@section('page_script')
    <script type="text/javascript" language="javascript" class="init">
        function redirect_to_list(type){
            window.location = type;
        }
        $(document).ready(function() {

        });
    </script>
@endsection
