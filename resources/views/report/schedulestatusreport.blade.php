@extends('layouts.master')
@section('title','Schedule Status Report')

@section('content')
<!-- begin #content -->
<div id="content" class="content">

    <h1 class="page-header">Schedule Status Report</h1>
    @if(count(Session::get('message')) != 0)
        <div>
        </div>
    @endif
    <br />

    <div class="row">
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
            <label for="from_date" class="text_bold_black">From Date</label>
        </div>

        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <div class="input-group date dateTimePicker" data-provide="datepicker" id="datepicker_from">
                <input type="text" class="form-control" id="from_date" name="from_date" value="{{isset($from_date)? $from_date : ''}}">
                <div class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </div>
            </div>
            <p class="text-danger">{{$errors->first('from_date')}}</p>
        </div>

        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1"></div>
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
            <label for="to_date" class="text_bold_black">To Date</label>
        </div>

        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <div class="input-group date dateTimePicker" data-provide="datepicker"  id="datepicker_to">
                <input type="text" class="form-control" id="to_date" name="date" value="{{isset($to_date)? $to_date : ''}}">
                <div class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </div>
            </div>
            <p class="text-danger">{{$errors->first('to_date')}}</p>
        </div>

        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1"></div>
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <button type="button" onclick="report_search_by_date('schedulestatusreport')" class="form-control btn-primary">Generate</button>
        </div>
    </div>
    <br/>
    <div class="row">
        <div class="col-md-12">
            <div id="piechartdiv"></div>
        </div>
    </div>
</div>
@stop

@section('page_script')
    <script type="text/javascript" language="javascript" class="init">
        $(document).ready(function() {
            var piechartData =<?php echo json_encode($schedules) ?>;
            var piechart = AmCharts.makeChart( "piechartdiv", {
                "type": "pie",
                "theme": "light",
                "dataProvider": piechartData,
                "valueField": "count",
                "titleField": "status",
                "balloon":{
                    "fixedPosition":true
                },
                "outlineAlpha": 0.4,
                "depth3D": 30,
                "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
                "angle": 30,
                "export": {
                    "enabled": true,
                    "fileName": "Schedule_Status_Report",
                    "menu": [ {
                        "class": "export-main",
                        "menu": [ {
                            "label": "Download as image",
                            "menu": [ "PNG", "JPG", "SVG", "PDF" ]
                        }, {
                            "label": "Print",
                            "format": "PRINT"
                        } ]
                    } ]
                },
                "listeners": [{
                    "event": "init",
                    "method": function(event) {
                        var chart = event.chart;
                        if (chart.colorField === undefined)
                            chart.colorField = "color";
                        for(var i = 0; i < chart.chartData.length; i++) {
                            if(chart.dataProvider[i].status == "new"){
                                chart.dataProvider[i].color = "#63abf3";
                            }
                            else if(chart.dataProvider[i].status == "complete"){
                                chart.dataProvider[i].color = "#6ce9a5";
                            }
                            else if(chart.dataProvider[i].status == "cancel"){
                                chart.dataProvider[i].color = "#f57a7d";
                            }
                            else{
                                chart.dataProvider[i].color = "#f2d380";
                            }
                        }
                        chart.validateData();
                        chart.animateAgain();
                    }
                }]
            });


            $('#datepicker_from').datepicker({
                format: 'dd-mm-yyyy',
                autoclose: true,
                defaultDate: "+1w",
                changeMonth: true,
                numberOfMonths: 1,
                allowInputToggle: true,
            });

            $('#datepicker_to').datepicker({
                format: 'dd-mm-yyyy',
                autoclose: true,
                defaultDate: "+1w",
                changeMonth: true,
                numberOfMonths: 1,
                allowInputToggle: true,
                minDate: "20-08-2016",

            });
        });
    </script>
@stop