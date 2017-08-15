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
    <h3 class="center_aligned">Monthly Visit Graph</h3>
    <div class="col-md-12">
         <div class="row">
            <div class="col-md-1"><span class="colored-span mo-color"></span></div><div class="col-md-1"><span>MO</span></div>
            <div class="col-md-1"><span class="colored-span musculo-color"></span></div><div class="col-md-1"><span>Musculo</span></div>
            <div class="col-md-1"><span class="colored-span neuro-color"></span></div><div class="col-md-1"><span>Neuro</span></div>
            <div class="col-md-1"><span class="colored-span nutrition-color"></span></div><div class="col-md-1"><span>Nutrition</span></div>
            <div class="col-md-1"><span class="colored-span blooddrawing-color"></span></div><div class="col-md-2"><span>Blood Drawing</span></div>
        </div> 
        
        <div id="visit_chart_div"></div><br><br><hr><br>
    </div>

    <h3 class="center_aligned">Monthly Gross Profit Graph</h3>
      <div class="col-md-12">
      <div class="row">
            <div class="col-md-1"><span class="colored-span mo-color"></span></div><div class="col-md-1"><span>MO</span></div>
            <div class="col-md-1"><span class="colored-span musculo-color"></span></div><div class="col-md-1"><span>Musculo</span></div>
            <div class="col-md-1"><span class="colored-span neuro-color"></span></div><div class="col-md-1"><span>Neuro</span></div>
            <div class="col-md-1"><span class="colored-span nutrition-color"></span></div><div class="col-md-1"><span>Nutrition</span></div>
            <div class="col-md-1"><span class="colored-span blooddrawing-color"></span></div><div class="col-md-1"><span>Blood Drawing</span></div>
            <div class="col-md-1"><span class="colored-span packagesale-color"></span></div><div class="col-md-1"><span>Package Sale</span></div>
    </div> 

        <div id="profit_chart_div"></div>
    </div>  

</div>
@stop

@section('page_script')
    <script type="text/javascript" language="javascript" class="init">
        $(document).ready(function() {
            //start visit chart
            var visit_chart;
            var visitChartData =<?php echo json_encode($patient_visits) ?> ;
            console.log(visitChartData);
            var visit_chart = AmCharts.makeChart("visit_chart_div", {
                "type": "serial",
                "theme": "light",
                "marginRight": 40,
                "marginLeft": 40,
                "autoMarginOffset": 20,
                "mouseWheelZoomEnabled":true,
                // "dataDateFormat": "YYYY-MM-DD",
                "dataDateFormat": "YYYY-MM",
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
                    "drop":true,
                    "adjustBorderColor":false,
                    "color":"#ffffff"
                    },
                    "bullet": "round",
                    "bulletBorderAlpha": 1,
                    "bulletColor": "#FFFFFF",
                    "bulletSize": 3,
                    "hideBulletsCount": 50,
                    "lineThickness": 2,
                    "title": "MO Visits",
                    "useLineColorForBulletBorder": true,
                    "valueField": "mo_visits",
                    "lineColorField": "mo_visits_color",
                    "balloonText": "<span style='font-size:11px;'>[[value]]</span>"
                },
                {
                    "id": "g2",
                    "balloon":{
                    "drop":true,
                    "adjustBorderColor":false,
                    "color":"#ffffff"
                    },
                    "bullet": "round",
                    "bulletBorderAlpha": 1,
                    "bulletColor": "#FFFFFF",
                    "bulletSize": 5,
                    "hideBulletsCount": 50,
                    "lineThickness": 2,
                    "title": "Musculo Visits",
                    "useLineColorForBulletBorder": true,
                    "valueField": "musculo_visits",
                    "lineColorField": "musculo_visits_color",
                    "balloonText": "<span style='font-size:11px;'>[[value]]</span>"
                },
                {
                    "id": "g3",
                    "balloon":{
                    "drop":true,
                    "adjustBorderColor":false,
                    "color":"#ffffff"
                    },
                    "bullet": "round",
                    "bulletBorderAlpha": 1,
                    "bulletColor": "#FFFFFF",
                    "bulletSize": 5,
                    "hideBulletsCount": 50,
                    "lineThickness": 2,
                    "title": "Neuro Visits",
                    "useLineColorForBulletBorder": true,
                    "valueField": "neuro_visits",
                    "lineColorField": "neuro_visits_color",
                    "balloonText": "<span style='font-size:11px;'>[[value]]</span>"
                },
                {
                    "id": "g4",
                    "balloon":{
                    "drop":true,
                    "adjustBorderColor":false,
                    "color":"#ffffff"
                    },
                    "bullet": "round",
                    "bulletBorderAlpha": 1,
                    "bulletColor": "#FFFFFF",
                    "bulletSize": 5,
                    "hideBulletsCount": 50,
                    "lineThickness": 2,
                    "title": "Nutrition Visits",
                    "useLineColorForBulletBorder": true,
                    "valueField": "nutrition_visits",
                    "lineColorField": "nutrition_visits_color",
                    "balloonText": "<span style='font-size:11px;'>[[value]]</span>"
                },
                {
                    "id": "g5",
                    "balloon":{
                    "drop":true,
                    "adjustBorderColor":false,
                    "color":"#ffffff"
                    },
                    "bullet": "round",
                    "bulletBorderAlpha": 1,
                    "bulletColor": "#FFFFFF",
                    "bulletSize": 5,
                    "hideBulletsCount": 50,
                    "lineThickness": 2,
                    "title": "Blood Drawing Visits",
                    "useLineColorForBulletBorder": true,
                    "valueField": "blood_drawing_visits",
                    "lineColorField": "blood_drawing_visits_color",
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
                    "enabled": false
                },
                "dataProvider": visitChartData
            });
            
        });
    </script>

    <script type="text/javascript" language="javascript" class="init">
        $(document).ready(function() {
            //start visit chart
            var profit_chart;
            var profitChartData =<?php echo json_encode($profits) ?> ;
            console.log(profitChartData);
            var profit_chart = AmCharts.makeChart("profit_chart_div", {
                "type": "serial",
                "theme": "light",
                "marginRight": 40,
                "marginLeft": 40,
                "autoMarginOffset": 20,
                "mouseWheelZoomEnabled":true,
                // "dataDateFormat": "YYYY-MM-DD",
                "dataDateFormat": "YYYY-MM",
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
                    "drop":true,
                    "adjustBorderColor":false,
                    "color":"#ffffff"
                    },
                    "bullet": "round",
                    "bulletBorderAlpha": 1,
                    "bulletColor": "#FFFFFF",
                    "bulletSize": 3,
                    "hideBulletsCount": 50,
                    "lineThickness": 2,
                    "title": "MO Visits",
                    "useLineColorForBulletBorder": true,
                    "valueField": "mo_visits",
                    "lineColorField": "mo_visits_color",
                    "balloonText": "<span style='font-size:11px;'>[[value]]</span>"
                },
                {
                    "id": "g2",
                    "balloon":{
                    "drop":true,
                    "adjustBorderColor":false,
                    "color":"#ffffff"
                    },
                    "bullet": "round",
                    "bulletBorderAlpha": 1,
                    "bulletColor": "#FFFFFF",
                    "bulletSize": 5,
                    "hideBulletsCount": 50,
                    "lineThickness": 2,
                    "title": "Musculo Visits",
                    "useLineColorForBulletBorder": true,
                    "valueField": "musculo_visits",
                    "lineColorField": "musculo_visits_color",
                    "balloonText": "<span style='font-size:11px;'>[[value]]</span>"
                },
                {
                    "id": "g3",
                    "balloon":{
                    "drop":true,
                    "adjustBorderColor":false,
                    "color":"#ffffff"
                    },
                    "bullet": "round",
                    "bulletBorderAlpha": 1,
                    "bulletColor": "#FFFFFF",
                    "bulletSize": 5,
                    "hideBulletsCount": 50,
                    "lineThickness": 2,
                    "title": "Neuro Visits",
                    "useLineColorForBulletBorder": true,
                    "valueField": "neuro_visits",
                    "lineColorField": "neuro_visits_color",
                    "balloonText": "<span style='font-size:11px;'>[[value]]</span>"
                },
                {
                    "id": "g4",
                    "balloon":{
                    "drop":true,
                    "adjustBorderColor":false,
                    "color":"#ffffff"
                    },
                    "bullet": "round",
                    "bulletBorderAlpha": 1,
                    "bulletColor": "#FFFFFF",
                    "bulletSize": 5,
                    "hideBulletsCount": 50,
                    "lineThickness": 2,
                    "title": "Nutrition Visits",
                    "useLineColorForBulletBorder": true,
                    "valueField": "nutrition_visits",
                    "lineColorField": "nutrition_visits_color",
                    "balloonText": "<span style='font-size:11px;'>[[value]]</span>"
                },
                {
                    "id": "g5",
                    "balloon":{
                    "drop":true,
                    "adjustBorderColor":false,
                    "color":"#ffffff"
                    },
                    "bullet": "round",
                    "bulletBorderAlpha": 1,
                    "bulletColor": "#FFFFFF",
                    "bulletSize": 5,
                    "hideBulletsCount": 50,
                    "lineThickness": 2,
                    "title": "Blood Drawing Visits",
                    "useLineColorForBulletBorder": true,
                    "valueField": "blood_drawing_visits",
                    "lineColorField": "blood_drawing_visits_color",
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
                    "enabled": false
                },
                "dataProvider": profitChartData
            });
            
        });
    </script>
@endsection
