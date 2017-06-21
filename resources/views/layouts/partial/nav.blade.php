<!-- begin #sidebar -->
<div id="sidebar" class="sidebar">
    <!-- begin sidebar scrollbar -->
    <div data-scrollbar="true" data-height="100%">
        <!-- begin sidebar nav -->
        <ul class="nav">
            <!-- begin sidebar minify button -->
            <li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>
            <!-- end sidebar minify button -->

            <li nav-id='enquiry'  class="has-sub">
                <a href="javascript:;">
                    <b class="caret pull-right"></b>
                    <i class="fa fa-calendar"></i>
                    <span>Enquiry</span>
                </a>

                <ul class="sub-menu">
                    <li nav-id="enquiry-entry"><a href="/enquiry/create">Entry</a></li>
                    <li nav-id="enquiry-entry"><a href="/enquiry">List</a></li>
                </ul>
            </li>

            <li nav-id='schedule'  class="has-sub">
                <a href="javascript:;">
                    <b class="caret pull-right"></b>
                    <i class="fa fa-calendar"></i>
                    <span>Schedule</span>
                </a>

                <ul class="sub-menu">
                    <li nav-id="schedule-entry"><a href="/schedule/create">Entry</a></li>
                    <li nav-id="schedule-entry"><a href="/schedule">List</a></li>
                </ul>
            </li>

            <li  nav-id='patient'  class="has-sub">
                <a href="javascript:;">
                    <b class="caret pull-right"></b>
                    <i class="fa fa-users"></i>
                    <span>Patient Setup</span>
                </a>
                <ul class="sub-menu">
                    <li nav-id="patient-entry"><a href="/patient/create">Entry</a></li>
                    <li nav-id="patient-list"><a href="/patient">List</a></li>
                </ul>
            </li>

            <li nav-id='package-sale'  class="has-sub" >
                <a href="javascript:;">
                    <b class="caret pull-right"></b>
                    <i class="fa fa-folder"></i>
                    <span>Package Sale</span>
                </a>

                <ul class="sub-menu">
                    <li nav-id="package-sale-entry"><a href="/packagesale/create">Entry</a></li>
                    <li nav-id="package-usage-list"><a href="/packagesale">Patient Package Usage List</a></li>
                </ul>
            </li>

            <li  nav-id='product'  class="has-sub">
                <a href="javascript:;">
                    <b class="caret pull-right"></b>
                    <i class="fa fa-suitcase"></i>
                    <span>Initial Setup</span>
                </a>
                <ul class="sub-menu">
                    <li nav-id="medication-category-manage" class="has-sub">
                        <a href="javascript:;">
                            <b class="caret pull-right"></b>
                            <span>Medication Category</span>
                        </a>

                        <ul class="sub-menu">
                            <li nav-id="medication-category-entry"><a href="/productcategory/create">Entry</a></li>
                            <li nav-id="medication-category-list"><a href="/productcategory">List</a></li>
                        </ul>
                    </li>
                    <li nav-id="medication" class="has-sub">
                        <a href="javascript:;">
                            <b class="caret pull-right"></b>
                            <span>Medication</span>
                        </a>

                        <ul class="sub-menu">
                            <li nav-id="medication-entry"><a href="/product/create">Entry</a></li>
                            <li nav-id="medication-list"><a href="/product">List</a></li>

                        </ul>
                    </li>
                    <li nav-id="service-manage" class="has-sub">
                        <a href="javascript:;">
                            <b class="caret pull-right"></b>
                            <span>Service</span>
                        </a>

                        <ul class="sub-menu">
                            {{--<li nav-id="service-entry"><a href="/service/create">Entry</a></li>--}}
                            <li nav-id="service-list"><a href="/service">List</a></li>
                        </ul>
                    </li>
                    <li nav-id="package" class="has-sub">
                        <a href="javascript:;">
                            <b class="caret pull-right"></b>
                            <span>Package</span>
                        </a>

                        <ul class="sub-menu">
                            <li nav-id="package-entry"><a href="/package/create">Entry</a></li>
                            <li nav-id="package-list"><a href="/package">List</a></li>
                        </ul>
                    </li>
                    <li nav-id="investigation-manage" class="has-sub">
                        <a href="javascript:;">
                            <b class="caret pull-right"></b>
                            <span>Investigation</span>
                        </a>

                        <ul class="sub-menu">
                            {{--<li nav-id="investigation-entry"><a href="/investigation/create">Entry</a></li>--}}
                            <li nav-id="investigation-list"><a href="/investigation">List</a></li>
                        </ul>
                    </li>

                    <li nav-id="investigation-imaging-manage" class="has-sub">
                        <a href="javascript:;">
                            <b class="caret pull-right"></b>
                            <span>Investigation Imaging</span>
                        </a>

                        <ul class="sub-menu">
                            {{--<li nav-id="investigation-entry"><a href="/investigationimaging/create">Entry</a></li>--}}
                            <li nav-id="investigation-imaging-list"><a href="/investigationimaging">List</a></li>
                        </ul>
                    </li>

                    <li nav-id="route" class="has-sub">
                        <a href="javascript:;">
                            <b class="caret pull-right"></b>
                            <span>Route</span>
                        </a>

                        <ul class="sub-menu">
                            <li nav-id="route-entry"><a href="/route/create">Entry</a></li>
                            <li nav-id="route-list"><a href="/route">List</a></li>
                        </ul>
                    </li>

                    <li nav-id="allergy" class="has-sub">
                        <a href="javascript:;">
                            <b class="caret pull-right"></b>
                            <span>Allergy</span>
                        </a>

                        <ul class="sub-menu">
                            <li nav-id="allergy-entry"><a href="/allergy/create">Entry</a></li>
                            <li nav-id="allergy-list"><a href="/allergy">List</a></li>

                        </ul>
                    </li>
                    <li nav-id="allergy" class="has-sub">
                        <a href="javascript:;">
                            <b class="caret pull-right"></b>
                            <span>Family Member</span>
                        </a>

                        <ul class="sub-menu">
                            <li nav-id="allergy-entry"><a href="/familymember/create">Entry</a></li>
                            <li nav-id="allergy-list"><a href="/familymember">List</a></li>

                        </ul>
                    </li>
                    <li nav-id="allergy" class="has-sub">
                        <a href="javascript:;">
                            <b class="caret pull-right"></b>
                            <span>Family History</span>
                        </a>

                        <ul class="sub-menu">
                            <li nav-id="allergy-entry"><a href="/familyhistory/create">Entry</a></li>
                            <li nav-id="allergy-list"><a href="/familyhistory">List</a></li>

                        </ul>
                    </li>
                    <li nav-id="allergy" class="has-sub">
                        <a href="javascript:;">
                            <b class="caret pull-right"></b>
                            <span>Medical History</span>
                        </a>

                        <ul class="sub-menu">
                            <li nav-id="allergy-entry"><a href="/medicalhistory/create">Entry</a></li>
                            <li nav-id="allergy-list"><a href="/medicalhistory">List</a></li>

                        </ul>
                    </li>
                    <li nav-id="allergy" class="has-sub">
                        <a href="javascript:;">
                            <b class="caret pull-right"></b>
                            <span>Provisional Diagnosis</span>
                        </a>

                        <ul class="sub-menu">
                            <li nav-id="allergy-entry"><a href="/provisionaldiagnosis/create">Entry</a></li>
                            <li nav-id="allergy-list"><a href="/provisionaldiagnosis">List</a></li>

                        </ul>
                    </li>

                    <li nav-id="city-manage" class="has-sub">
                        <a href="javascript:;">
                            <b class="caret pull-right"></b>
                            <span>City</span>
                        </a>

                        <ul class="sub-menu">
                            <li nav-id="city-category-entry"><a href="/city/create">Entry</a></li>
                            <li nav-id="city-list"><a href="/city">List</a></li>
                        </ul>
                    </li>
                    <li nav-id="township" class="has-sub">
                        <a href="javascript:;">
                            <b class="caret pull-right"></b>
                            <span>Township</span>
                        </a>

                        <ul class="sub-menu">
                            <li nav-id="township-entry"><a href="/township/create">Entry</a></li>
                            <li nav-id="township-list"><a href="/township">List</a></li>

                        </ul>
                    </li>
                    <li nav-id="zone-manage" class="has-sub">
                        <a href="javascript:;">
                            <b class="caret pull-right"></b>
                            <span>Zone</span>
                        </a>

                        <ul class="sub-menu">
                            <li nav-id="zone-entry"><a href="/zone/create">Entry</a></li>
                            <li nav-id="zone-list"><a href="/zone">List</a></li>
                        </ul>
                    </li>
                    <li nav-id="car-type" class="has-sub">
                        <a href="javascript:;">
                            <b class="caret pull-right"></b>
                            <span>Car Type</span>
                        </a>

                        <ul class="sub-menu">
                            <li nav-id="car-type-entry"><a href="/cartype/create">Entry</a></li>
                            <li nav-id="car-type-list"><a href="/cartype">List</a></li>

                        </ul>
                    </li>
                    <li nav-id="car-price-setup-manage" class="has-sub">
                        <a href="javascript:;">
                            <b class="caret pull-right"></b>
                            <span>Car Price Setup</span>
                        </a>

                        <ul class="sub-menu">
                            <li nav-id="car-price-setup-entry"><a href="/cartypesetup/create">Entry</a></li>
                            <li nav-id="car-price-setup-list"><a href="/cartypesetup">List</a></li>
                        </ul>
                    </li>

                    {{--<li nav-id="physical-examination" class="has-sub">--}}
                    {{--<a href="javascript:;">--}}
                    {{--<b class="caret pull-right"></b>--}}
                    {{--<span>Physical Examination</span>--}}
                    {{--</a>--}}

                    {{--<ul class="sub-menu">--}}
                    {{--<li nav-id="physical-examination-entry"><a href="/physicalexam/create">Entry</a></li>--}}
                    {{--<li nav-id="physical-examination-list"><a href="/physicalexam">List</a></li>--}}

                    {{--</ul>--}}
                    {{--</li>--}}
                </ul>
            </li>

            <li nav-id='report'  class="has-sub" >
                <a href="javascript:;">
                    <b class="caret pull-right"></b>
                    <i class="fa fa-line-chart"></i>
                    <span>Report</span>
                </a>

                <ul class="sub-menu">
                    <li nav-id="report-schedule-status"><a href="/schedulestatusreport">Schedule Status Report</a></li>
                    <li nav-id="report-income-summary"><a href="/incomesummaryreport">Income Summary Report</a></li>
                    <li nav-id="report-sale-summary"><a href="/salesummaryreport">Sale Summary Report</a></li>
                    <li nav-id="report-car-usage"><a href="/carusagereport">Car Usage Report</a></li>
                    <li nav-id="report-visit-record"><a href="/visitreport">Staff Visit Report</a></li>
                    <li nav-id="report-visit-record"><a href="/patientvisitreport">Patient Visit Report</a></li>
                    <li nav-id="report-visit-record"><a href="/patientdailyvisitreport">Patient Daily Visit Report</a></li>
                </ul>
            </li>

            <li  nav-id='site-setup'  class="has-sub">
                <a href="javascript:;">
                    <b class="caret pull-right"></b>
                    <i class="fa fa-gear"></i>
                    <span>Site Setup</span>
                </a>
                <ul class="sub-menu">

                    @if(Auth::guard('User')->user()->role_id == '1')
                    <li nav-id="modifier-manage" class="has-sub">
                        <a href="javascript:;">
                            <b class="caret pull-right"></b>
                            <span>Role</span>
                        </a>

                        <ul class="sub-menu">
                            <li nav-id="modifier-manage-modifier"><a href="/role/create">Entry</a></li>
                            <li nav-id="modifier-manage-modifierpanel"><a href="/role">List</a></li>
                        </ul>
                    </li>
                    <li nav-id="modifier-manage" class="has-sub">
                        <a href="javascript:;">
                            <b class="caret pull-right"></b>
                            <span>Permission</span>
                        </a>

                        <ul class="sub-menu">
                            <li nav-id="modifier-manage-modifier"><a href="/permission/create">Entry</a></li>
                            <li nav-id="modifier-manage-modifierpanel"><a href="/permission">List</a></li>

                        </ul>
                    </li>
                    @endif
                    <li nav-id="modifier-create" class="has-sub">
                        <a href="javascript:;">
                            <b class="caret pull-right"></b>
                            <span>Staff</span>
                        </a>

                        <ul class="sub-menu">
                            <li nav-id="modifier-create-modifier"><a href="/user/create">Entry</a></li>
                            <li nav-id="modifier-create-modifierpanel"><a href="/user">List</a></li>
                        </ul>
                    </li>
                    <li nav-id="">
                        <a href="/config">
                            <b class="caret pull-right"></b>
                            <span>Site Config</span>
                        </a>
                    </li>
                </ul>
            </li>

            @if(Auth::guard('User')->user()->role_id == '1' || Auth::guard('User')->user()->role_id == '2')
            <li  nav-id='patient'  class="has-sub">
                <a href="javascript:;">
                    <b class="caret pull-right"></b>
                    <i class="fa fa-archive"></i>
                    <span>Log</span>
                </a>
                <ul class="sub-menu">
                    <li nav-id="patient-manage" class="has-sub">
                        <a href="javascript:;">
                            <b class="caret pull-right"></b>
                            <span>Patient</span>
                        </a>

                        <ul class="sub-menu">
                            <li nav-id="patient-entry"><a href="/patient/log">Case Summary Log</a></li>
                        </ul>
                    </li>

                    <li nav-id="activities-manage" class="has-sub">
                        <a href="/activities">
                            <b class="caret pull-right"></b>
                            <span>Activities</span>
                        </a>
                    </li>

                    @if(Auth::guard('User')->user()->role_id == '1')
                    <li nav-id="api-manage" class="has-sub">
                        <a href="/apilist/syncdownapi">
                            <b class="caret pull-right"></b>
                            <span>API List</span>
                        </a>
                    </li>
                    @endif

                    <li nav-id="pricehistory-manage" class="has-sub">
                        <a href="javascript:;">
                            <b class="caret pull-right"></b>
                            <span>Price History</span>
                        </a>

                        <ul class="sub-menu">
                            <li nav-id="patient-entry"><a href="/pricehistory/all/0">Single Price History</a></li>
                            <li nav-id="patient-list"><a href="/multiplepricehistory/all/0">Multiple Price History</a></li>
                        </ul>
                    </li>

                    @if(Auth::guard('User')->user()->role_id == '1')
                    <li nav-id="tablet-issues-manage" class="has-sub">
                        <a href="/tabletissues/all">
                            <b class="caret pull-right"></b>
                            <span>Tablet Issues</span>
                        </a>
                    </li>
                    @endif
                </ul>
            </li>
            @endif

            @if(Auth::guard('User')->user()->role_id == '1')
                <li nav-id='enquiry'  class="has-sub">
                    <a href="javascript:;">
                        <b class="caret pull-right"></b>
                        <i class="fa fa-calendar"></i>
                        <span>Import</span>
                    </a>

                    <ul class="sub-menu">
                        <li nav-id="import-entry"><a href="/import">CSV Import</a></li>
                    </ul>
                </li>
            @endif


        </ul>
        <!-- end sidebar nav -->
    </div>
    <!-- end sidebar scrollbar -->
</div>
<div class="sidebar-bg"></div>    <!-- end #sidebar -->

<script type="text/javascript">
    $(document).ready(function() {
        //make sidebar active current tab when a page is selected
        var path = window.location.pathname;
//        path = path.replace(/\/$/, "");
//        path = decodeURIComponent(path);
        var submenu = '.sub-menu li';
        var hassub = '.has-sub';

        $(hassub).removeClass('active');
        $(submenu).removeClass('active');

        $(".sub-menu li a").each(function () {
            var href = $(this).attr('href');

            if (path === href) {
                $(this).closest('li').addClass('active');
                $(this).closest('.has-sub').addClass('active');
                $(this).parents(".has-sub:eq(1)").toggleClass("active");
            }
        });
    });
</script>