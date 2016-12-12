@extends('layouts.master')
@section('title','Income Summary Report By Graph')
@section('content')

<!-- begin #content -->
<div id="content" class="content">

    <h1 class="page-header">Income Summary Report</h1>
    @if(count(Session::get('message')) != 0)
        <div>
        </div>
    @endif
    <br />

    <div class="row">
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
            <label for="type" class="text_bold_black">Types</label>
        </div>

        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <select class="form-control" name="type" id="type" onchange="switchPicker();">
                @if(isset($type) && $type == "daily")
                    <option value="daily" selected>Daily</option>
                @else
                    <option value="daily">Daily</option>
                @endif
                @if(isset($type) && $type == "monthly")
                    <option value="monthly" selected>Monthly</option>
                @else
                    <option value="monthly">Monthly</option>
                @endif
                @if(isset($type) && $type == "yearly")
                    <option value="yearly" selected>Yearly</option>
                @else
                    <option value="yearly">Yearly</option>
                @endif
            </select>
            <p class="text-danger">{{$errors->first('type')}}</p>
        </div>
    </div>
    <br>

    {{--Start Datepicker--}}
    <div class="row days" style="display:none;">
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
            <label for="from_date" class="text_bold_black">From Date</label>
        </div>

        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <div class="input-group date dateTimePicker" data-provide="datepicker" id="datepicker_from">
                <input type="text" class="form-control" id="from_date" name="from_date" value="{{isset($from_date)?$from_date:''}}">
                <div class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </div>
            </div>
        </div>
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1"></div>

        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
            <label for="to_date" class="text_bold_black">To Date</label>
        </div>

        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <div class="input-group date dateTimePicker" data-provide="datepicker"  id="datepicker_to">
                <input type="text" class="form-control" id="to_date" name="to_date" value="{{isset($to_date)?$to_date:''}}">
                <div class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </div>
            </div>
        </div>
    </div>
    {{--End Datepicker--}}
    <br class="days">

    {{--Start Monthpicker--}}
    <div class="row months" style="display:none;">
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
            <label for="from_month" class="text_bold_black">From Month</label>
        </div>

        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <div class="input-group date dateTimePicker" data-provide="datepicker" id="monthpicker_from">
                <input type="text" class="form-control" id="from_month" name="from_month" value="{{isset($from_month)?$from_month:''}}">
                <div class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </div>
            </div>
        </div>
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1"></div>

        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
            <label for="to_month" class="text_bold_black">To Month</label>
        </div>

        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <div class="input-group date dateTimePicker" data-provide="datepicker"  id="monthpicker_to">
                <input type="text" class="form-control" id="to_month" name="to_month" value="{{isset($to_month)?$to_month:''}}">
                <div class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </div>
            </div>
        </div>
    </div>
    {{--End Monthpicker--}}
    <br class="months">

    {{--Start Yearpicker--}}
    <div class="row years" style="display:none;">
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
            <label for="from_year" class="text_bold_black">From Year</label>
        </div>

        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <div class="input-group date dateTimePicker" data-provide="datepicker" id="yearpicker_from">
                <input type="text" class="form-control" id="from_year" name="from_year" value="{{isset($from_year)?$from_year:''}}">
                <div class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </div>
            </div>
        </div>
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1"></div>

        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
            <label for="to_year" class="text_bold_black">To Year</label>
        </div>

        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <div class="input-group date dateTimePicker" data-provide="datepicker"  id="yearpicker_to">
                <input type="text" class="form-control" id="to_year" name="to_year" value="{{isset($to_year)?$to_year:''}}">
                <div class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </div>
            </div>
        </div>
    </div>
    {{--End Yearpicker--}}
    <br class="years">

    <div class="row">
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1"></div>

        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <button type="button" onclick="check_to_redirect_to_list_with_type();" class="form-control btn-primary">Preview By List</button>
        </div>

        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <button type="button" onclick="report_search_with_type('incomesummaryreportbygraph');" class="form-control btn-primary">Preview By Graph</button>
        </div>
    </div>
    <br>
    <br>
    <div class="row">
        <div class="col-md-12">
            <div id="linechartdiv"></div>
        </div>
    </div>

</div>
@stop

@section('page_script')
    <script type="text/javascript" language="javascript" class="init">
        $(document).ready(function() {

            var chartData = <?php echo json_encode($chartData) ?>;
            var chart = AmCharts.makeChart("linechartdiv", {
                "type": "serial",
                "theme": "light",
                "marginRight": 40,
                "marginLeft": 40,
                "autoMarginOffset": 20,
                "mouseWheelZoomEnabled":true,
                "dataDateFormat": "DD-MM-YYYY",
                "valueAxes": [{
                    "id": "v1",
                    "axisAlpha": 0,
                    "position": "left",
                    "ignoreAxisWidth":true
                }],
                "balloon": {
                    "borderThickness": 1,
                    "shadowAlpha": 0
                },
                "graphs": [{
                    "id": "g1",
                    "balloon":{
                        "drop":false,
                        "adjustBorderColor":false,
                        "color":"#ffffff"
                    },
                    "bullet": "round",
                    "bulletBorderAlpha": 1,
                    "bulletColor": "#FFFFFF",
                    "bulletSize": 5,
                    "hideBulletsCount": 50,
                    "lineThickness": 2,
                    "title": "red line",
                    "useLineColorForBulletBorder": true,
                    "valueField": "amount",
                    "balloonText": "<span style='font-size:11px;'>[[value]]</span>"
                }],
                "chartScrollbar": {
                    "graph": "g1",
                    "oppositeAxis":false,
                    "offset":30,
                    "scrollbarHeight": 80,
                    "backgroundAlpha": 0,
                    "selectedBackgroundAlpha": 0.1,
                    "selectedBackgroundColor": "#888888",
                    "graphFillAlpha": 0,
                    "graphLineAlpha": 0.5,
                    "selectedGraphFillAlpha": 0,
                    "selectedGraphLineAlpha": 1,
                    "autoGridCount":true,
                    "color":"#AAAAAA"
                },
                "chartCursor": {
                    "pan": true,
                    "valueLineEnabled": true,
                    "valueLineBalloonEnabled": true,
                    "cursorAlpha":1,
                    "cursorColor":"#258cbb",
                    "limitToGraph":"g1",
                    "valueLineAlpha":0.2,
                    "valueZoomable":true
                },
                "valueScrollbar":{
                    "oppositeAxis":false,
                    "offset":50,
                    "scrollbarHeight":10
                },
                "categoryField": "date",
                "categoryAxis": {
                    "parseDates": true,
                    "dashLength": 1,
                    "minorGridEnabled": true
                },
                "export": {
                    "enabled": true,
                    "fileName": "Income_Summary_Report_By_Graph",
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
                "dataProvider": chartData
            });

            chart.addListener("rendered", zoomChart);

            zoomChart();

            function zoomChart() {
                chart.zoomToIndexes(chart.dataProvider.length - 40, chart.dataProvider.length - 1);
            }


            AmCharts.checkEmptyData = function(chart) {
                if (0 == chart.dataProvider.length) {
                    // set min/max on the value axis
                    chart.valueAxes[0].minimum = 0;
                    chart.valueAxes[0].maximum = 100;

                    // add dummy data point
                    var dataPoint = {
                        dummyValue: 0
                    };
                    dataPoint[chart.categoryField] = '';
                    chart.dataProvider = [dataPoint];

                    // add label
                    chart.addLabel(0, '50%', 'The chart contains no data', 'center');

                    // set opacity of the chart div
                    chart.chartDiv.style.opacity = 0.5;

                    // redraw it
                    chart.validateNow();
                }
            }

            AmCharts.checkEmptyData(chart);

            //Start Daypickers
            $('#datepicker_from').datepicker({
                format: 'dd-mm-yyyy',
                autoclose: true,
                defaultDate: "+1w",
                changeMonth: true,
                numberOfMonths: 1,
                allowInputToggle: true
            });

            $('#datepicker_to').datepicker({
                format: 'dd-mm-yyyy',
                autoclose: true,
                defaultDate: "+1w",
                changeMonth: true,
                numberOfMonths: 1,
                allowInputToggle: true,
                minDate: "20-08-2016"
            });
            //End Daypickers

            //Start Monthpickers
            $('#monthpicker_from').datepicker({
                format: 'mm-yyyy',
                viewMode: "months",
                minViewMode: "months",
                allowInputToggle: true,
                autoclose: true
            });

            $('#monthpicker_to').datepicker({
                format: "mm-yyyy",
                viewMode: "months",
                minViewMode: "months",
                allowInputToggle: true,
                autoclose: true
            });
            //End Monthpickers

            //Start Yearpickers
            $('#yearpicker_from').datepicker({
                format: "yyyy",
                viewMode: "years",
                minViewMode: "years",
                allowInputToggle: true,
                autoclose: true
            });

            $('#yearpicker_to').datepicker({
                format: "yyyy",
                viewMode: "years",
                minViewMode: "years",
                allowInputToggle: true,
                autoclose: true
            });
            //End Yearpickers

            var currentType = document.getElementById("type").value;
            if(currentType == "yearly"){
                $('.days').hide();
                $('.months').hide();
                $('.years').show();
            }
            else if(currentType == "monthly"){
                $('.days').hide();
                $('.months').show();
                $('.years').hide();
            }
            else{
                $('.days').show();
                $('.months').hide();
                $('.years').hide();
            }

        });

        function switchPicker(){
            var type = document.getElementById("type").value;
            if(type == "yearly"){
                $('.days').hide();
                $('.months').hide();
                $('.years').show();
            }
            else if(type == "monthly"){
                $('.days').hide();
                $('.months').show();
                $('.years').hide();
            }
            else{
                $('.days').show();
                $('.months').hide();
                $('.years').hide();
            }
        }
    </script>
@stop