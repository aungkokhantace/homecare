/**
 * Created by Wai Yan Aung on 8/2/2016.
 */

function enquiry_confirm(id) {

    swal({
            title: "Are you sure?",
            text: "You want to confirm this enquiry !",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55 ",
            confirmButtonText: "Confirm",
            cancelButtonText: "Cancel",
            closeOnConfirm: false,
            closeOnCancel: true
        },
        function (isConfirm) {
            if (isConfirm) {
                $("#enquiry_confirm_id").val(id);
                $("#frm_enquiry_confirm_" + id).submit();
            } else {
                return;
            }
        });

}

function enquiry_cancel(id) {

    swal({
            title: "Are you sure?",
            text: "You will not be able to recover!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55 ",
            confirmButtonText: "Confirm",
            cancelButtonText: "Cancel",
            closeOnConfirm: false,
            closeOnCancel: true
        },
        function (isConfirm) {
            if (isConfirm) {
                $("#frm_enquiry_cancel_" + id).submit();
            } else {
                return;
            }
        });

}

function enquiry_search() {

    var enquiry_status = $("#enquiry_status").val();
    var enquiry_case_type = $("#enquiry_case_type").val();
    var from_date = $("#from_date").val();
    var to_date = $("#to_date").val();
    if(from_date == "" && to_date == ""){
        var form_action = "/enquiry/search/" + enquiry_status + "/" + enquiry_case_type;
    }
    else if(from_date == "" && to_date != "") {
        sweetAlert("Oops...", "Please Choose the date !");
        return;
    }
    else{

        var dateComparison = check_date(from_date, to_date);

        if(dateComparison){
            var form_action = "/enquiry/search/" + enquiry_status + "/" + enquiry_case_type + "/" + from_date + "/" + to_date;
        }
        else{
            sweetAlert("Oops...", "Please Choose the valid date !");
            return;
        }
    }
    window.location = form_action;
}

function schedule_search() {
    var schedule_status = $("#schedule_status").val();
    var from_date = $("#from_date").val();
    var to_date = $("#to_date").val();

    if(from_date == "" && to_date == ""){
        var form_action = "/schedule/search/" + schedule_status;
    }
    else if(from_date == "" && to_date != "") {
        sweetAlert("Oops...", "Please Choose the date !");
        return;
    }
    else{

        var dateComparison = check_date(from_date, to_date);


        if(dateComparison){
            var form_action = "/schedule/search/" + schedule_status + "/" + from_date + "/" + to_date;
        }
        else{
            sweetAlert("Oops...", "Please Choose the valid date !");
            return;
        }
    }
    window.location = form_action;
}

function check_date(from_date, to_date){

    var dateFirst = from_date.split('-');
    var dateSecond = to_date.split('-');
    var dateFistTemp = new Date(dateFirst[2], dateFirst[1], dateFirst[0]); //Year, Month, Date
    var dateSecondTemp = new Date(dateSecond[2], dateSecond[1], dateSecond[0]);

    if(dateSecondTemp < dateFistTemp){
        return false;
    }
    else{
        return true;
    }
}

function check_month(from_month, to_month){
    var dateFirst = from_month.split('-');
    var dateSecond = to_month.split('-');
    var dateFistTemp = new Date(dateFirst[1], dateFirst[0]); //Year, Month
    var dateSecondTemp = new Date(dateSecond[1], dateSecond[0]);

    if(dateSecondTemp < dateFistTemp){
        return false;
    }
    else{
        return true;
    }
}

function check_year(from_year, to_year){

    var dateFirst = from_year.split('-');
    var dateSecond = to_year.split('-');
    var dateFistTemp = new Date(dateFirst[0]); //Year
    var dateSecondTemp = new Date(dateSecond[0]);

    if(dateSecondTemp < dateFistTemp){
        return false;
    }
    else{
        return true;
    }
}

function package_schedule_create() {

    swal({
            title: "Are you sure?",
            text: "You want to create a new schedule for this package !",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55 ",
            confirmButtonText: "Confirm",
            cancelButtonText: "Cancel",
            closeOnConfirm: false,
            closeOnCancel: true
        },
        function (isConfirm) {
            if (isConfirm) {
                $("#frm_package_schedule_create").submit();
            } else {
                return;
            }
        });

}

function schedule_cancel(id) {

    swal({
            title: "Are you sure?",
            text: "You will not be able to recover!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55 ",
            confirmButtonText: "Confirm",
            cancelButtonText: "Cancel",
            closeOnConfirm: false,
            closeOnCancel: true
        },
        function (isConfirm) {
            if (isConfirm) {
                $("#frm_schedule_cancel_" + id).submit();
            } else {
                return;
            }
        });

}

function booking_request_confirm() {

    swal({
            title: "Are you sure?",
            text: "You want to confirm this request !",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55 ",
            confirmButtonText: "Confirm",
            cancelButtonText: "Cancel",
            closeOnConfirm: false,
            closeOnCancel: true
        },
        function (isConfirm) {
            if (isConfirm) {
                $("#frm_schedule_cancel").submit();

            } else {
                return;
            }
        });

}

function report_search_by_date(module) {
    var from_date = $("#from_date").val();
    var to_date = $("#to_date").val();

    if(from_date == "" && to_date == ""){
        sweetAlert("Oops...", "Please Choose the date !");
        return;
    }
    else if(from_date == "" && to_date != "") {
        sweetAlert("Oops...", "Please Choose the date !");
        return;
    }
    else if(from_date != "" && to_date == "") {
        sweetAlert("Oops...", "Please Choose the date !");
        return;
    }
    else{
        var dateComparison = check_date(from_date, to_date);

        if(dateComparison){
            var form_action = "/"+module+"/search/"+ from_date + "/" + to_date;
        }
        else{
            sweetAlert("Oops...", "Please Choose the valid date !");
            return;
        }
    }
    window.location = form_action;
}

function report_export(module) {
    var from_date = $("#from_date").val();
    var to_date = $("#to_date").val();

    if(from_date == "" && to_date == ""){
        var form_action = "/"+module+"/exportexcel";
    }
    else if(from_date == "" && to_date != "") {
        sweetAlert("Oops...", "Please Choose the date !");
        return;
    }
    else if(from_date != "" && to_date == "") {
        sweetAlert("Oops...", "Please Choose the date !");
        return;
    }
    else{
        var dateComparison = check_date(from_date, to_date);

        if(dateComparison){
            var form_action = "/"+module+"/exportexcel/"+ from_date + "/" + to_date;
        }
        else{
            sweetAlert("Oops...", "Please Choose the valid date !");
            return;
        }
    }
    window.location = form_action;
}

function visit_report_export(module){
    var type = $("#type").val();
    var from_date = $("#from_date").val();
    var to_date = $("#to_date").val();

    if(from_date == "" && to_date == ""){
        var form_action = "/"+module+"/exportexcel/"+ type;
    }
    else if(from_date == "" && to_date != "") {
        sweetAlert("Oops...", "Please Choose the date !");
        return;
    }
    else if(from_date != "" && to_date == "") {
        sweetAlert("Oops...", "Please Choose the date !");
        return;
    }
    else{
        var dateComparison = check_date(from_date, to_date);
        if(dateComparison){
            var form_action = "/"+module+"/exportexcel/"+ type + "/" + from_date + "/" + to_date;
        }
        else{
            sweetAlert("Oops...", "Please Choose the valid date !");
            return;
        }
    }
    window.location = form_action;
}

function visit_report_search(){
    var type = $("#type").val();
    var from_date = $("#from_date").val();
    var to_date = $("#to_date").val();

    if(from_date == "" && to_date == ""){
        var form_action = "/visitreport/search/" + type;
    }
    else if(from_date == "" && to_date != "") {
        sweetAlert("Oops...", "Please Choose the date !");
        return;
    }
    else if(from_date != "" && to_date == "") {
        sweetAlert("Oops...", "Please Choose the date !");
        return;
    }
    else{
        var dateComparison = check_date(from_date, to_date);

        if(dateComparison){
            var form_action = "/visitreport/search/" + type + "/" + from_date + "/" + to_date;
        }
        else{
            sweetAlert("Oops...", "Please Choose the valid date !");
            return;
        }
    }
    window.location = form_action;
}

function report_search_with_type(module){
    var type = $("#type").val();

    if(type == "yearly"){           //type is yearly
        var from_year = $("#from_year").val();
        var to_year = $("#to_year").val();

        if(from_year == "" && to_year == ""){
            sweetAlert("Oops...", "Please Choose the year !");
            return;
        }
        else if(from_year == "" && to_year != "") {
            sweetAlert("Oops...", "Please Choose the year !");
            return;
        }
        else if(from_year != "" && to_year == "") {
            sweetAlert("Oops...", "Please Choose the year !");
            return;
        }
        else{
            var dateComparison = check_year(from_year, to_year);

            if(dateComparison){
                var form_action = "/"+module+"/search/" + type + "/" + from_year + "/" + to_year;
            }
            else{
                sweetAlert("Oops...", "Please Choose the valid year !");
                return;
            }
        }
    }
    else if(type == "monthly"){         //type is monthly
        var from_month = $("#from_month").val();
        var to_month = $("#to_month").val();

        if(from_month == "" && to_month == ""){
            sweetAlert("Oops...", "Please Choose the month !");
            return;
        }
        else if(from_month == "" && to_month != "") {
            sweetAlert("Oops...", "Please Choose the month !");
            return;
        }
        else if(from_month != "" && to_month == "") {
            sweetAlert("Oops...", "Please Choose the month !");
            return;
        }
        else{
            var dateComparison = check_month(from_month, to_month);

            if(dateComparison){
                var form_action = "/"+module+"/search/" + type + "/" + from_month + "/" + to_month;
            }
            else{
                sweetAlert("Oops...", "Please Choose the valid month !");
                return;
            }
        }
    }
    else{       //type is daily
        var from_date = $("#from_date").val();
        var to_date = $("#to_date").val();

        if(from_date == "" && to_date == ""){
            sweetAlert("Oops...", "Please Choose the date !");
            return;
        }
        else if(from_date == "" && to_date != "") {
            sweetAlert("Oops...", "Please Choose the date !");
            return;
        }
        else if(from_date != "" && to_date == "") {
            sweetAlert("Oops...", "Please Choose the date !");
            return;
        }
        else{
            var dateComparison = check_date(from_date, to_date);

            if(dateComparison){
                var form_action = "/"+module+"/search/" + type + "/" + from_date + "/" + to_date;
            }
            else{
                sweetAlert("Oops...", "Please Choose the valid date !");
                return;
            }
        }
    }
    // alert(form_action);
    window.location = form_action;
}

function report_export_with_type(module){
    var type = $("#type").val();
    if(type == "yearly"){           //type is yearly
        var from_year = $("#from_year").val();
        var to_year = $("#to_year").val();

        if(from_year == "" && to_year == ""){
            sweetAlert("Oops...", "Please Choose the year !");
            return;
        }
        else if(from_year == "" && to_year != "") {
            sweetAlert("Oops...", "Please Choose the year !");
            return;
        }
        else if(from_year != "" && to_year == "") {
            sweetAlert("Oops...", "Please Choose the year !");
            return;
        }
        else{
            var dateComparison = check_year(from_year, to_year);

            if(dateComparison){
                var form_action = "/"+module+"/exportexcel/" + type + "/" + from_year + "/" + to_year;
            }
            else{
                sweetAlert("Oops...", "Please Choose the valid year !");
                return;
            }
        }
    }
    else if(type == "monthly"){         //type is monthly
        var from_month = $("#from_month").val();
        var to_month = $("#to_month").val();

        if(from_month == "" && to_month == ""){
            sweetAlert("Oops...", "Please Choose the month !");
            return;
        }
        else if(from_month == "" && to_month != "") {
            sweetAlert("Oops...", "Please Choose the month !");
            return;
        }
        else if(from_month != "" && to_month == "") {
            sweetAlert("Oops...", "Please Choose the month !");
            return;
        }
        else{
            var dateComparison = check_month(from_month, to_month);

            if(dateComparison){
                var form_action = "/"+module+"/exportexcel/" + type + "/" + from_month + "/" + to_month;
            }
            else{
                sweetAlert("Oops...", "Please Choose the valid month !");
                return;
            }
        }
    }
    else{       //type is daily
        var from_date = $("#from_date").val();
        var to_date = $("#to_date").val();

        if(from_date == "" && to_date == ""){
            var form_action = "/"+module+"/exportexcel";
        }
        else if(from_date == "" && to_date != "") {
            sweetAlert("Oops...", "Please Choose the date !");
            return;
        }
        else if(from_date != "" && to_date == "") {
            sweetAlert("Oops...", "Please Choose the date !");
            return;
        }
        else{
            var dateComparison = check_date(from_date, to_date);

            if(dateComparison){
                var form_action = "/"+module+"/exportexcel/" + type + "/" + from_date + "/" + to_date;
            }
            else{
                sweetAlert("Oops...", "Please Choose the valid date !");
                return;
            }
        }
    }

    window.location = form_action;
}

function check_to_redirect_to_graph_with_type(){
    var type = $("#type").val();
    if(type == "daily"){
        var from_date = $("#from_date").val();
        var to_date = $("#to_date").val();
        if(from_date == "" && to_date == ""){
            form_action = "/incomesummaryreportbygraph";
            window.location = form_action;
        }
        else{
            report_search_with_type('incomesummaryreportbygraph');
        }
    }
    else{
        report_search_with_type('incomesummaryreportbygraph');
    }
}

function check_to_redirect_to_list_with_type(){
    var type = $("#type").val();
    if(type == "daily"){
        var from_date = $("#from_date").val();
        var to_date = $("#to_date").val();
        if(from_date == "" && to_date == ""){
            form_action = "/incomesummaryreport";
            window.location = form_action;
        }
        else{
            report_search_with_type('incomesummaryreport');
        }
    }
    else{
        report_search_with_type('incomesummaryreport');
    }
}

function check_to_redirect_to_graph_without_type(){
    var from_date = $("#from_date").val();
    var to_date = $("#to_date").val();
    if(from_date == "" && to_date == ""){
        form_action = "/carusagereportbygraph";
        window.location = form_action;
    }
    else{
        report_search_by_date('carusagereportbygraph');
    }
}

function check_to_redirect_to_list_without_type(){
    var from_date = $("#from_date").val();
    var to_date = $("#to_date").val();
    if(from_date == "" && to_date == ""){
        form_action = "/carusagereport";
        window.location = form_action;
    }
    else{
        report_search_by_date('carusagereport');
    }
}

function enable_user(id) {
    swal({
            title: "Are you sure?",
            text: "Do you want to enable this user?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55 ",
            confirmButtonText: "Confirm",
            cancelButtonText: "Cancel",
            closeOnConfirm: false,
            closeOnCancel: true
        },
        function (isConfirm) {
            if (isConfirm) {
                $("#frm_enable_user_" + id).submit();
            } else {
                return;
            }
        });

}

function search_dashboard_by_year(){
    var year = $("#year").val();

    if(year == ""){
        sweetAlert("Oops...", "Please Choose the year !");
        return;
    }
    else{
        var form_action = "/dashboard/" + year;
    }
    window.location = form_action;
}

function schedule_tracking_report_search(){
    var type = $("#type").val();
    var from_date = $("#from_date").val();
    var to_date = $("#to_date").val();

    if(from_date == "" && to_date == ""){
        var form_action = "/scheduletrackingreport/search/" + type;
    }
    else if(from_date == "" && to_date != "") {
        sweetAlert("Oops...", "Please Choose the date !");
        return;
    }
    else if(from_date != "" && to_date == "") {
        sweetAlert("Oops...", "Please Choose the date !");
        return;
    }
    else{
        var dateComparison = check_date(from_date, to_date);

        if(dateComparison){
            var form_action = "/scheduletrackingreport/search/" + type + "/" + from_date + "/" + to_date;
        }
        else{
            sweetAlert("Oops...", "Please Choose the valid date !");
            return;
        }
    }

    window.location = form_action;
}
