@extends('layouts.master')
@section('title','Car Usage Report')
@section('content')

        <!-- begin #content -->
<div id="content" class="content">

    <h1 class="page-header">Car Usage Report</h1>
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
    </div>

    <div class="row">
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1"></div>
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <button type="button" onclick="check_to_redirect_to_list_without_type();" class="form-control btn-primary">Preview by List</button>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <button type="button" onclick="report_search_by_date('carusagereportbygraph');" class="form-control btn-primary">Preview by Graph</button>
        </div>
    </div>

    <br>
    <br>
    <div class="row">
            @foreach($colorsArray as $key=>$color)
                <div class="row">
                    <div class="col-md-1"><span style="display:block;background-color:{{$color}}; width: 20px; height: 20px;margin-left: 45px;"></span></div><span>{{$key}}</span>
                </div>
                <br>
            @endforeach
    </div>
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
            var graphData = <?php echo json_encode($graphData) ?>;
            var chartData = <?php echo json_encode($chartData) ?>;

            var chart = AmCharts.makeChart("linechartdiv", {
                "type": "serial",
                "theme": "light",
                "marginRight": 40,
                "marginLeft": 40,
                "autoMarginOffset": 20,
                "mouseWheelZoomEnabled":true,
                "dataDateFormat": "YYYY-MM-DD",
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
                "graphs": graphData,
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
                    "fileName": "Car_Usage_Report_By_Graph",
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