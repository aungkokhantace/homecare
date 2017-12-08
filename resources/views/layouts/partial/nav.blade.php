<!-- begin #sidebar -->
<div id="sidebar" class="sidebar">
    <!-- begin sidebar scrollbar -->
    <div data-scrollbar="true" data-height="100%">
        <!-- begin sidebar nav -->
        <ul class="nav">
            <!-- begin sidebar minify button -->
            <li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>
            <!-- end sidebar minify button -->

            <li nav-id="enquiry">
                <a href="/enquiry">
                    <i class="fa fa-calendar"></i>
                    <span>Enquiry</span>
                </a>
            </li>

            <li nav-id="schedule">
                <a href="/schedule">
                    <i class="fa fa-calendar"></i>
                    <span>Schedule</span>
                </a>
            </li>

            <li nav-id="patient">
                <a href="/patient">
                    <i class="fa fa-users"></i>
                    <span>Patient</span>
                </a>
            </li>

            <li nav-id="packagesale">
                <a href="/packagesale">
                    <i class="fa fa-folder"></i>
                    <span>Package Sale</span>
                </a>
            </li>

            <li  nav-id='product'  class="has-sub">
                <a href="javascript:;">
                    <b class="caret pull-right"></b>
                    <i class="fa fa-suitcase"></i>
                    <span>Initial Setup</span>
                </a>
                <ul class="sub-menu">
                    <li nav-id="medication-category-manage">
                        <a href="/productcategory">
                            <span>Medication Category</span>
                        </a>
                    </li>

                    <li nav-id="medication">
                        <a href="/product">
                            <span>Medication</span>
                        </a>
                    </li>

                    <li nav-id="service-manage">
                        <a href="/service">
                            <span>Service</span>
                        </a>
                    </li>

                    <li nav-id="package">
                        <a href="/package">
                            <span>Package</span>
                        </a>
                    </li>

                    <li nav-id="investigation">
                        <a href="/investigation">
                            <span>Investigation</span>
                        </a>
                    </li>

                    <li nav-id="investigation-imaging">
                        <a href="/investigationimaging">
                            <span>Investigation Imaging</span>
                        </a>
                    </li>

                    <li nav-id="investigation-imaging">
                        <a href="/route">
                            <span>Route</span>
                        </a>
                    </li>

                    <li nav-id="allergy">
                        <a href="/allergy">
                            <span>Allergy</span>
                        </a>
                    </li>

                    <li nav-id="family-member">
                        <a href="/familymember">
                            <span>Family Member</span>
                        </a>
                    </li>

                    <li nav-id="family-history">
                        <a href="/familyhistory">
                            <span>Family History</span>
                        </a>
                    </li>

                    <li nav-id="medical-history">
                        <a href="/medicalhistory">
                            <span>Medical History</span>
                        </a>
                    </li>

                    <li nav-id="provisional-diagnosis">
                        <a href="/provisionaldiagnosis">
                            <span>Provisional Diagnosis</span>
                        </a>
                    </li>

                    <li nav-id="city">
                        <a href="/city">
                            <span>City</span>
                        </a>
                    </li>

                    <li nav-id="township">
                        <a href="/township">
                            <span>Township</span>
                        </a>
                    </li>

                    <li nav-id="zone">
                        <a href="/zone">
                            <span>Zone</span>
                        </a>
                    </li>

                    <li nav-id="car-type">
                        <a href="/cartype">
                            <span>Car Type</span>
                        </a>
                    </li>

                    <li nav-id="car-type-setup">
                        <a href="/cartypesetup">
                            <span>Car Price Setup</span>
                        </a>
                    </li>


                    <!-- <ul class="sub-menu">
                        <li nav-id="physical-examination-entry"><a href="/physicalexam/create">Entry</a></li>
                        <li nav-id="physical-examination-list"><a href="/physicalexam">List</a></li>
                    </ul> -->
                    <!-- </li> -->
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
                    <!-- <li nav-id="report-income-summary"><a href="/incomesummaryreport">Income Summary Report</a></li> -->
                    <!-- <li nav-id="report-sale-summary"><a href="/salesummaryreport">Sale Summary Report</a></li> -->
                    <li nav-id="report-sale-income"><a href="/saleincomereport">Sale Income Report</a></li>
                    <li nav-id="report-car-usage"><a href="/carusagereport">Car Usage Report</a></li>
                    <li nav-id="report-visit-record"><a href="/visitreport">Staff Visit Report</a></li>
                    <li nav-id="report-visit-record"><a href="/patientvisitreport">Patient Visit Report</a></li>
                    <!-- <li nav-id="report-visit-record"><a href="/patientdailyvisitreport">Patient Daily Visit Report</a></li> -->
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
                    <li nav-id="role">
                        <a href="/role">
                            <span>Role</span>
                        </a>
                    </li>

                    <li nav-id="permission">
                        <a href="/permission">
                            <span>Permission</span>
                        </a>
                    </li>
                    @endif

                    <li nav-id="staff">
                        <a href="/user">
                            <span>Staff</span>
                        </a>
                    </li>
                    <li nav-id="site-config">
                        <a href="/config">
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
                    <li nav-id="patient-case-summary-log">
                        <a href="/patient/log">
                            <span>Patient Case Summary Log</span>
                        </a>
                    </li>

                    <li nav-id="activities-manage" class="has-sub">
                        <a href="/activities">
                            <span>Activities</span>
                        </a>
                    </li>

                    @if(Auth::guard('User')->user()->role_id == '1')
                    <li nav-id="api-manage" class="has-sub">
                        <a href="/apilist/syncdownapi">
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
