<!-- begin #sidebar -->
<div id="sidebar" class="sidebar">
    <!-- begin sidebar scrollbar -->
    <div data-scrollbar="true" data-height="100%">
        <!-- begin sidebar nav -->
        <ul class="nav">
            <!-- begin sidebar minify button -->
            <li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>
            <!-- end sidebar minify button -->

            <li nav-id='dashboard'  class="has-sub" >
                <a href="/patient/dashboard">
                    <b class="caret pull-right"></b>
                    <i class="fa fa-dashboard"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li nav-id='profile'  class="has-sub" >
                <a href="/patient/profile">
                    <b class="caret pull-right"></b>
                    <i class="fa fa-male"></i>
                    <span>Profile</span>
                </a>
            </li>

            <li nav-id='case'  class="has-sub" >
                <a href="/patient/case">
                    <b class="caret pull-right"></b>
                    <i class="fa fa-line-chart"></i>
                    <span>Case Summary</span>
                </a>
            </li>

            <li nav-id='invoice'  class="has-sub" >
                <a href="/patient/invoice">
                    <b class="caret pull-right"></b>
                    <i class="fa fa-folder"></i>
                    <span>Invoice</span>
                </a>
            </li>

            <li  nav-id='medications' class="has-sub">
                <a href="/patient/medication">
                    <b class="caret pull-right"></b>
                    <i class="fa fa-medkit"></i>
                    <span>Medications</span>
                </a>
            </li>


            <li  nav-id='schedulehistory'  class="has-sub">
                <a href="/patient/schedule">
                    <b class="caret pull-right"></b>
                    <i class="fa fa-calendar"></i>
                    <span>Schedule History</span>
                </a>
            </li>

            <li  nav-id='servicehistory'  class="has-sub">
                <a href="/patient/service">
                    <b class="caret pull-right"></b>
                    <i class="fa fa-automobile"></i>
                    <span>Service History</span>
                </a>
            </li>

            <li  nav-id='pakcagehistory'  class="has-sub">
                <a href="/patient/package">
                    <b class="caret pull-right"></b>
                    <i class="fa fa-suitcase"></i>
                    <span>Package History</span>
                </a>
            </li>

            <li  nav-id='bookingrequest'  class="has-sub">
                <a href="/patient/bookingrequest">
                    <b class="caret pull-right"></b>
                    <i class="fa fa-calendar"></i>
                    <span>Booking Request</span>
                </a>
            </li>
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

//        var submenu = '.sub-menu li';
        var hassub = '.has-sub';

//        $(submenu).removeClass('active');
        $(hassub).removeClass('active');

        $(".has-sub a").each(function () {
            var href = $(this).attr('href');

            if (path === href) {
                $(this).closest('li').addClass('active');
//                $(this).closest('.has-sub').addClass('active');
//                $(this).parents(".has-sub:eq(1)").toggleClass("active");
            }
        });
    });
</script>