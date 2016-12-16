<?php
/**
 * Created by PhpStorm.
 * Author: Wai Yan Aung
 * Date: 7/25/2016
 * Time: 11:48 AM
 */
?>

@extends('layouts.master')
@section('title','Patient API Detail')
@section('content')

        <!-- begin #content -->
<div id="content" class="content">
    <h1 class="page-header">API List</h1>
    <div class="row">
        <ul class="nav nav-tabs">
            <li><a href="/apilist/syncdownapi" class="api-tab">Sync Down API</a></li>
            <li><a href="/apilist/invoiceapi" class="api-tab">Invoice API</a></li>
            <li><a href="/apilist/enquiryapi" class="api-tab">Enquiry API</a></li>
            <li><a href="/apilist/scheduleapi" class="api-tab">Schedule API</a></li>
            <li><a href="/apilist/patientpackageapi" class="api-tab">Patient Package API</a></li>
            <li><a href="/apilist/waytrackingapi" class="api-tab">Way Tracking API</a></li>
            <li class="active"><a href="#" class="api-active-tab">Patient API</a></li>
        </ul>
    </div>

    <div class="row">
        <h4>URL</h4>
        <p><b>http://localhost:8000/api/patient/upload</b></p>
    </div>
    <hr>
    <div class="row">
        <h4>Description</h4>
        <p>This API is for uploading patient data from tablet to server.</p>
        <ol>
            <li>Tablet uploads table with data according to API input format.</li>
            <li>In server side, activation keys from input json are checked.</li>
            <li>If valid, proceeds to next step. Else,stops by returning error message.</li>
            <li>In server side, check if keys of table(table names) exist.</li>
            <li>If key exists, gets IDs from value field and clear data with that IDs from database. Then, insert data into database.</li>
            <li>Else, stop and return with error message.</li>
            <li>If there is an error in data insertion, database is rolled back to its original state.</li>
            <li>After all tables are successfully inserted, commit database.</li>
            <li>After commit, only max key of way_tracking is generated and returned.</li>
            <li>API logs are recorded.</li>
        </ol>
    </div>
    <hr>
    <div class="row">
        <h4>Input Format</h4>
        <ul style="list-style-type:circle">
            <li>
                patient
                <ul style="list-style-type:none">
                    <li>patient_allergy</li>
                    <li>log_patient_case_summary</li>
                    <li>core_users</li>
                </ul>
            </li>
        </ul>
    </div>
    <hr>
    <div class="row">
        <h4>Sample Input JSON</h4>
        <pre>
        {
          "site_activation_key": "1234567",
          "tablet_activation_key": "aaaaa",
          "user_id": "U0002",
          "data": [
            {
              "patients": [
                {
                  "user_id": "U0012",
                  "name": "Aung Yin",
                  "nrc_no": "sdfsfds2323",
                  "email": "aungyin@gmail.com",
                  "patient_type_id": "1",
                  "gender": "male",
                  "phone_no": "23423",
                  "address": "yangon",
                  "township_id": "1",
                  "zone_id": "1",
                  "dob": "8.8.1990",
                  "remark": "1",
                  "case_scenario": "ww",
                  "having_allergy": "1",
                  "created_by": "U0001",
                  "updated_by": "",
                  "deleted_by": "",
                  "created_at": "2016-10-04 10:33:35",
                  "updated_at": "2016-10-04 10:33:35",
                  "deleted_at": "",
                  "patient_allergy": [
                    {
                      "patient_id": "U0012",
                      "allergy_id": "1"
                    }
                  ],
                  "log_patient_case_summary": [
                    {
                      "id": "U0002",
                      "patient_id": "U0012",
                      "case_summary": "wwwwww",
                      "created_by": "",
                      "updated_by": "U0001",
                      "deleted_by": "",
                      "created_at": "",
                      "updated_at": "2016-10-04 10:33:35",
                      "deleted_at": ""
                    }
                  ],
                  "core_users": {
                    "id": "U0012",
                    "name": "Aung Yin",
                    "password": "11111111",
                    "phone": "123456",
                    "email": "aungyin@gmail.com",
                    "fees": "",
                    "display_image": "img0000.png",
                    "mobile_image": "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",
                    "role_id": "5",
                    "address": "Yangon",
                    "active": "1",
                    "created_by": "U0001",
                    "updated_by": "",
                    "deleted_by": "",
                    "created_at": "2016-10-04 10:33:35",
                    "updated_at": "2016-10-04 10:33:35",
                    "deleted_at": ""
                  }
                }
              ]
            }
          ]
        }
        </pre>
    </div>
    <hr>
    <div class="row">
        <h4>Sample Output JSON</h4>
        <pre>
        {
          "aceplusStatusCode": 200,
          "aceplusStatusMessage": "Request success !",
          "tabletId": "U004",
          "max_key": [
            {
              "table_name": "patients",
              "max_key_id": 0
            },
            {
              "table_name": "core_users",
              "max_key_id": 0
            },
            {
              "table_name": "log_patient_case_summary",
              "max_key_id": 0
            }
          ],
          "data": [
            {
              "user_id": "U0006",
              "name": "Harry Potter",
              "nrc_no": "HP-234234234",
              "email": "harrypotter@gmail.com",
              "patient_type_id": 2,
              "gender": "male",
              "phone_no": "0978789789789",
              "address": "Howards",
              "township_id": 29,
              "zone_id": 0,
              "dob": "1993-01-14",
              "remark": "HP Remark",
              "case_scenario": "HP Case Summary",
              "having_allergy": 0,
              "created_by": "U0001",
              "updated_by": "U0001",
              "deleted_by": null,
              "created_at": "2016-12-14 16:37:04",
              "updated_at": "2016-12-14 16:37:04",
              "deleted_at": "",
              "patient_allergy": [

              ],
              "core_user": {
                "id": "U0006",
                "name": "Harry Potter",
                "password": "Vm10YVlWVXhUblJXYms1VFlUSjRVMWxzWkc5alZteHpWbTFHVGxKdGVGaFZiRkp6",
                "phone": "0978789789789",
                "email": "harrypotter@gmail.com",
                "fees": "0.00",
                "display_image": "",
                "mobile_image": null,
                "role_id": 5,
                "address": "Howards",
                "active": 1,
                "last_activity": null,
                "remember_token": null,
                "created_by": "U0001",
                "updated_by": "U0001",
                "deleted_by": null,
                "created_at": "2016-12-14 16:37:04",
                "updated_at": "2016-12-14 16:37:04",
                "deleted_at": ""
              },
              "log": [

              ]
            },
            {
              "user_id": "U0005",
              "name": "Jack Sparrow",
              "nrc_no": "abc-12345",
              "email": "U0005@gmail.com",
              "patient_type_id": 2,
              "gender": "male",
              "phone_no": "09789789789",
              "address": "Black Pearl",
              "township_id": 2,
              "zone_id": 1,
              "dob": "1982-02-25",
              "remark": "",
              "case_scenario": "",
              "having_allergy": 0,
              "created_by": "U0001",
              "updated_by": "U0001",
              "deleted_by": null,
              "created_at": "2016-12-14 11:46:35",
              "updated_at": "2016-12-14 15:20:00",
              "deleted_at": "",
              "patient_allergy": [

              ],
              "core_user": {
                "id": "U0005",
                "name": "Jack Sparrow",
                "password": "Vm0weE1GbFdiRmRXV0doVllteEtXRmx0Y3pGV1JteFZVMnBTVmsxWGVIcFhhMk0x",
                "phone": "09789789789",
                "email": "U0005@gmail.com",
                "fees": "0.00",
                "display_image": "",
                "mobile_image": "",
                "role_id": 5,
                "address": "Black Pearl",
                "active": 1,
                "last_activity": null,
                "remember_token": null,
                "created_by": "U0001",
                "updated_by": "U0001",
                "deleted_by": null,
                "created_at": "2016-12-14 11:46:35",
                "updated_at": "2016-12-14 15:20:41",
                "deleted_at": ""
              },
              "log": [

              ]
            },
            {
              "user_id": "U0011",
              "name": "nnjj",
              "nrc_no": "nbh",
              "email": "bjbh@gmail.com",
              "patient_type_id": 2,
              "gender": "male",
              "phone_no": "475",
              "address": "bj!k!k",
              "township_id": 3,
              "zone_id": 1,
              "dob": "1992-01-01",
              "remark": "mjb!k?lm",
              "case_scenario": "",
              "having_allergy": 0,
              "created_by": "U0002",
              "updated_by": "U0002",
              "deleted_by": null,
              "created_at": "2016-12-15 00:00:00",
              "updated_at": "",
              "deleted_at": "",
              "patient_allergy": [
                {
                  "patient_id": "U0011",
                  "allergy_id": 3
                }
              ],
              "core_user": {
                "id": "U0011",
                "name": "nnjj",
                "password": "VFZSSmVsRklRbWhqYlVaMFlWRTlQUW89",
                "phone": "475",
                "email": "bjbh@gmail.com",
                "fees": "0.00",
                "display_image": "",
                "mobile_image": "",
                "role_id": 5,
                "address": "bj!k!k",
                "active": 1,
                "last_activity": null,
                "remember_token": null,
                "created_by": "U0002",
                "updated_by": null,
                "deleted_by": null,
                "created_at": "",
                "updated_at": "",
                "deleted_at": ""
              },
              "log": [

              ]
            },
            {
              "user_id": "U0051",
              "name": "haker",
              "nrc_no": "",
              "email": "U0051@gmail.com",
              "patient_type_id": 1,
              "gender": "male",
              "phone_no": "123",
              "address": "fgh",
              "township_id": 1,
              "zone_id": 1,
              "dob": "1966-01-01",
              "remark": "",
              "case_scenario": "case scenario",
              "having_allergy": 0,
              "created_by": "U0002",
              "updated_by": "",
              "deleted_by": "",
              "created_at": "2016-12-15 18:24:38",
              "updated_at": "",
              "deleted_at": "",
              "patient_allergy": [

              ],
              "core_user": {
                "id": "U0051",
                "name": "haker",
                "password": "Y0dGeVlXMXBRREV5TXc9PQo=",
                "phone": "123",
                "email": "U0051@gmail.com",
                "fees": "0.00",
                "display_image": "",
                "mobile_image": "",
                "role_id": 5,
                "address": "fgh",
                "active": 0,
                "last_activity": null,
                "remember_token": null,
                "created_by": "U0002",
                "updated_by": "",
                "deleted_by": "",
                "created_at": "2016-12-15 18:24:38",
                "updated_at": "",
                "deleted_at": ""
              },
              "log": [

              ]
            },
            {
              "user_id": "U0012",
              "name": "Aung Yin",
              "nrc_no": "sdfsfds2323",
              "email": "aungyin@gmail.com",
              "patient_type_id": 1,
              "gender": "male",
              "phone_no": "23423",
              "address": "yangon",
              "township_id": 1,
              "zone_id": 1,
              "dob": "0000-00-00",
              "remark": "1",
              "case_scenario": "ww",
              "having_allergy": 1,
              "created_by": "U0001",
              "updated_by": "",
              "deleted_by": "",
              "created_at": "2016-10-04 10:33:35",
              "updated_at": "2016-10-04 10:33:35",
              "deleted_at": "",
              "patient_allergy": [
                {
                  "patient_id": "U0012",
                  "allergy_id": 1
                }
              ],
              "core_user": {
                "id": "U0012",
                "name": "Aung Yin",
                "password": "MTExMTExMTE=",
                "phone": "123456",
                "email": "aungyin@gmail.com",
                "fees": "0.00",
                "display_image": "58538df5da95b.jpg",
                "mobile_image": "\/9j\/4AAQSkZJRgABAQAAAQABAAD\/2wCEAAkGBxMTEhUQEhEVFRUXFhUXFRcXFxYXFxcVFRUXFxoYFRcYHSggGBolHRgVITEhJSkrLi4uFyAzODMsNygtLisBCgoKDg0OGxAQGi8lHx8rLS0tLS0tKy0tLS0tLS0tKy0tLS0rLS0tLS0tKy0tLSstLS0tLS0tLS0tLS0tLS0tLf\/AABEIAQMAwgMBIgACEQEDEQH\/xAAcAAABBAMBAAAAAAAAAAAAAAAAAQMEBgIFBwj\/xABEEAABAwIDBAgCBggFBAMAAAABAAIDBBESITEFQVFhBgcTInGBkbEyoUJScsHR8BQjYoKSouHxM1NjssIVFlSDJDRD\/8QAGgEAAwEBAQEAAAAAAAAAAAAAAAEDAgQFBv\/EACgRAQEAAgEEAgEDBQEAAAAAAAABAhEDBBIhMUFRMiJhcRMUM4Gxkf\/aAAwDAQACEQMRAD8A7YhCEAIQhACRKkQCJEpWKAEIQkYQhCZBCEJGEIQgBCEJkRCVIgBCEiAEiVIgyIQhIJCEITIIQhACRKkQCFYlZLEoAQsZZA0FznBrQLkkgAAbyToFx3pv1unE6DZ5AaLg1BGIk\/6TTkB+0QfDekbp+2+klJSC9TUMjNr4SSXkXtcMbdxFzbRU2t656BjsLIqmUfWbG1oPgJHh3yXEo5pJXulfdxPedI8lzieLib3KYfG+xIAI45ZehQeneKbrh2e7Vs7Db6TB6EtcVZKHplRSsfI2oaGRgGRzu6G3yAJO9eWBGToPO2Xqnaeomja9jH2a9uF4B+JoINjfmEB65oqtsrcbdCARroQCL30NjopC8qbO6Z18OER1koDbANxXaAN2E5W8l2zqv6wP+oB1POA2oY0OysBKzQuaNxB1HMa5lBL+hCEAJEqRMgUiUpEGEhQgoBEIQkEhCEJkEFCCgBIlSIBFoul3SJlDD2zy298mnF3ragFjXEbsyLeq3q5z14SRNomPeLydqBD9q1zf9nCCSN9gEBynpt05qtouwvLYacZtiaSQbb3usC8+OSqkTxlfQbkjtdRzWQiG9\/yzSaTY6gvs06bgMgOfMpK9wBAAdcZD+x0WMs7WtwRg4jlcE3+X5zUJjsJvqc\/UhA2Wareci4kDdlb5JguN0oTnYG2Kxt8vVBEU7Z0z4nNlY4sc1wLHNNnBw3tO4\/ioDWrZUUYLSHaW8rf0RTj0r0B6SivpGTXHat7k7RlaRuptuDhZwHO25WNee+pvarqfabYCTgqWOjPDGwF8bjzFnN\/fXoRBBIlQmREiVCDIkKVCAxQhCAkIQhBBCEIASJUIDFcj6\/6l4jp4RbCS9544m2aPCwcfVddXK+uDZb6ljpyQ2KmY61gcT5XOAwg7xlmdBz3BxwgNPC6eMRHxAX5qXTkDMbgT56feor3Yn3Od0j0n0sTcNrWccr7\/AFOiiT02HSw8Tn5Zm6sGxtiSSWLRfx0CtNB0DxtxyX5Kdzis47py7ssss87X90sd9ATw8Sup1PQAHUvIOWRDcvIX+afo+hEcejAB6n1OaV5ZDnE5cNnmwLsrqdSHLDy\/uFeukGwgInEaj8FQmDM+BRjn3QZYdqZ0LqcG0aMknKpiA\/fcGf8AJepF5k6AUDpNoUzmtxBksb38mtde\/qB5kcV6bVUaEIQgghCEyIkKySFBsUIQgH0IQgghCEAIQhAIq507oHTUj4o5GR3BBLrAYS0tIBJs3JxzOisi1G2+j8NTYyAhw0cMN\/Ah7S1w8QbIOPLUrRHiYDfOwdqCNzm8WkWIO8EKf0VoGzThptxz46AZq7dbfQswWrWyukD34HYsy04e53t4s0jlYAZWCr\/RfohLPD2zZBHnqVjL0pj7dZ2BsNjGhWeOlAFrLkjOjghw49qPDhbLG1lzf6pfci\/DiuhbCrbNERe5x3F2pUpqKXd8trVGKNpdI5rGjMlxAC5\/t\/rDpGXbD+tOgIBw+R3qx9JYWy3ZK3E1oJIOlhvKq1TtB1M6KCnoA9suEiRrmtiY0kgl5axxBFgTcg5i1yjcvjQ1qbazZu25KkujfEWYhkQDY+vKxVE2nCYpXMtuHoQF2LYNS+fF2kHZ4TbW9\/DIZeio3WdszBKyVoyc3CfEEn2PySws7jz9Nn1PUDhI2cjJz7NPJt2uH838q7euf9V8X\/xaduGxF3n0cLnxNl0BWxR5PiBCELaYQhCNAJClQUBghKhBnkIQgghCEAIQhAIkKVYlAaTpnsYVdFNT\/SLcTOIkjONnzAHmqJ0KpWz7MibmA9rr2NjfE4ahdWuq03ZDKYERizDI5wG4Yzit4A3HhZYzm4phdK7TdEYSYXSRBzoP8J1gDYOxAPIsHgOAPeBzW7MAY4W1Li9xJJzNr2voOQy9Vt47EKBXM\/WstvB+VlK+lZS1o79yMiLHzTkVELWDiAeax2zESwFpsbfNPbLkJjaTrbPxR8j42adTNY2wC5z1g04kDAXsaBc3e4NF92Z32ufJdG2lJkuS9bULpI6eNur52tGlrva5rb380SedFbqbdT6v8BpQ5mYBLLjTuWBtfcDcfuqzLV9Hdn9hAIrWOOVx\/fkc72IWzV5NRHK7uyoSJU2SoSBKgEQlSIBEIQgzqEIQQQhCAEIQgEWJWRWKARM1cIewsO8eh3fNPLU7f6R0tEzHVTtjBvYG5c631WNBcfRBzfwgUshaS12oNiEbSZ2lgHOaeLdc9VX5umtPPI18UcrW6OdI0MxD6JDbkga5kDctltOEzRXjkcw2yLCATyzBXNl9OnGeqemoWYAZZHHCL4i61j5b1lSbSiBEbZGcmhwvlyVJbsBjv8Sqqv2o8WZOf0gL8NFY+jmxGxYniIRtIs1u+3F51J8UfwrlxyTzW2r5bC5VSpdlurK2BxYTFTzOlLsrd1sYY228l2Mjk08lP21VF0hiYdBmeC1X\/cE1A4SRMbJHiAmjORLdA6N25wPHIgnkjDL9SeWFuLrN0KJsvaEdRE2eJ2JjhcHeOIcNzhoQpS6XLfDJKsQlCAVKkSoIJEqRAIhCEA6hCEAIQhACELCaVrWlznBrRmS4gADmTogFKj1tZHE0ySyMjYNXPcGj1K550s60WsJhoWtkIyMzs2A\/sNGb\/E2HiuZV9RLUv7aoldK\/i4\/CD9VujRyFlm5SOzi6PPPzfDqPSDrSiaTHRs7V1iO1cC2MHS7W\/E+3Ow5laPYXRX9IH6fVOdLK8ktc\/MgA7hoDe9raAACyo+C34eRXZNjPLaaFuA4ezZYjPIi45qWVtX5eLHiwkxntXNo7MDJGgDK1itls6odDlmWcN48OXJP1haTc+xWUZaRYEXUPlL4bqmroHDEHNv5XUPa+22taWxDG7loPErWv2aDmFIg2dustd2XpntxnlC2fRnCXuzc43J5laXpPFaJx8OV89L7ldP0cgWVR6dvDI2tBzcfYG\/3JSKcf6s5FBpdpTQStlgkcwsdi5E4bd9ujjYkFdA2J1tkWbW0+tv1kPzLo3H2J8FzesHecR\/dNxx3Gd+SvLp258GGf5R6I2R0roqm3Y1MZJ+gTgf8AwPsfkt2vLctLvcQfzwVh6PdKqyk\/w5nOZ\/lSd9luQJu390hbmbjz6Gz8a9CBCpnRrrFpqlzYngwSOGWMjA48Gv3HxA81cWvB0IO7I3zWpduHPDLC6yjNIhCbBEIQgHUIQgBCFB25tVlLBJUyYiyMXIaLuNyGgDdmSBnkg5LbqGOku34qKEzSnkxl+9I+1w1v3ncM1wjpDtuprXl88hLb92MEiNnJrd55nMrLpN0ifXVLppBhAGGJl7hjQfmScyfwFoMY91LLLb2Om6Wcc3ff\/ENkGo4LINspUzfpjdkRy4pzswRqs7dmgWXAPL2z\/Fdh6HVIkpIbG9mBh8Wd0+y47T2sWnd7K8dWG0LOkpXH\/UZz0a8f7T5onty9XhvDf06DJStOoTbqJu8BS2lDinqPK3UH9BaM25J4NsNE4DZLdLUPaM6IFcv6eVIdVGNmkTbH7R7x\/wCIXSNu7SbTQvnd9EWaPrPOTW+ZXFqmUm7ibueS5x4lxuT56pWOzpMN3uRcGd1jgWdikPBN6UYyMuMtwuka3TwUgNyd4LAN7qRNeYtb6fnirl1S7eFNWOp3\/wCHU4GXJ0mbfCT43weNlWX5D8\/n+yhS3Fi02IILSNQRmCOei1Klzcffjca9ToUHYO0P0imhqP8AMiY8jgXNBI8jcKcVZ4NmvBEIQgHUIQggqp1px4tmVFtxhPkJ47\/JWtafplBjoKpp\/wAiQ+bGlw+YCV9KcV1njf3jzyWEtDtXN+LiRud6fO6ejdmiMG1wd1vEHcsYm7vJQfR4zXg\/hz8VhBkcPp4J1pWNSy1nfnmgy1UJ+Jp7w+Y4FLsnaTo5WVDB34nC40uNLH7TSW342Tsb8hvTM0Vj2jRnvH1m7x48OaW2LPGq7rs2sZNEyWM3a9oc08juPAjQjkn3Bco6GdJhTd1xLqd5xZZmNx1cBw+s3W4uN4PU6SqZIwSMc17HC7XNIII5Fbl28bm4bx5ft8MiEoYsytH0v6SNo4MWRlfcRN4u+sf2W5X8hvTSxxuV1FK6yNrdpOKZvwQ5v4GRwzH7rSB4udwVJx4jfcsJJHyk3JzN3OOZJJJN+JuSfElSexsBYrNe1xYTDGSMMKAyyfwrCySrIHJ3ksGt0H5\/Oqc4jmm3uABJ8BzOgHqgqZqI8R5DX7h7+qizsspp05lRJsskFfTuPVTOXbLgv9Eys8mzPA+VlbVzrqSri+lmhOkU128myNBt\/EHnzXRVeengc01yX+SIQhNI8hCEAKo9aG1uxojG09+oPYjkwgmQ\/wAILfFwVuXIutqtx1kcO6KK\/wC\/IST\/ACtZ6rOV1HR02HfyT\/1RoNSPMfeFk9uufj4fiE3UNI7w8fxH55p8WeAQf7qL38buCMC+ifLQWHioURI7p1GnNv8AT8FNhdlp\/RKmag4Hd7J1rk0\/um\/D2KduDvySDXT07mPLmHJxuWn4S77jzU7YXSaopJMUejj34nnuO5jcHcwb8b6JZIw4WPuo5YHDs5NQMnDePvWpWMsJZpc6rrLlLP1dFhfbV0mJoPIAAu9QqTXVstRIZZ3l7zluyHBoGTR+dc0N2dxlcR6eyfZSAZDJPbGHBhh+MEEfKw4JyQaeqzFhkkkdfcsqGwFg8rNYucmGLAAQTpn7XWDI8R4AZnxP4A\/NFS\/4BzPpbNOBthnvzPhf7z7II29wF3HyWvrJN+85AKZO4DvEZ\/RH3+K11Sz62p15DgnCy9Oq9RE8RgqWNP60StLx+wWWYW8RcSea6euKdSED\/wBMmeMmCnIdzc6RhZl4Neu1q2Pp4fUTXJSIQhNA+hCEEFwbp3Li2jUkn6bW+TY2N+5d5XBenbB\/1GpIOWMHzwNuPW6xn6d3Qfnf4aYG6Yg7ji3zHgnbrGoZcBw1Ck9jE5WECz7cj4FOQmyYbIHNLTvG+6boZrtLd7DY\/chpspISRcNvbM+G\/NNtY5mos05g5H2W4aBhDBu+Z3qDTytJ7PFYXOAnnuB3ZqEzrevtGa7em6mMH7uRUqZl8WQDh8QGjgPpBTKOT9WG65m9+F1q5+Nlry0scxGTtePFPYr6LZdiwjCWNxZbhmLJOxaB8Dd\/DQckf1J9DSAHJHH8lTp6MObiYLG17bj4c1qpn2Fx\/RamUs2zpkXZJiWcA5EO3WuQfZMGVzjbw99UNja3M5lEtp2Sezr5MUmh7rRca5vIsBbU5W81Lr2OjdhkY5jsu64WIFu745WW06s9jdrIaqQ2Y11o8hYlotiz4G9uYS7YmO0K55h+AWa1+tmNFrjm44j4Fbcn9aXKyep8q8DmS74t3EeW4+Poo5aCdC4+ZPoN3kuov6G0bWxxOa4yFwJdc4sNjdrzpnw9FvodmxRMwxRtYP2QB6nUppZdXjrxHNOr2vdTbQhuC1kp7F922yf8G764Zn4rvC5tVwhz2tdoXDPeDcWI5g5jmF0grfHdx53UZd2W9BCRKqIJCEIQQXnrb03aVM79cU0xB73wl7raN4WXoCpLsLsIu7CcI071ss\/FcYouhjy0Nmk7Nw+Jos8g7wXaEjiMlPkdvRZ44W21Vww8v5vwStJ5bt43+Oau46AA6VPqz+qi1XQKob8Ekb+WbD8xb5qb051PHflTXMseHjcZjXVaqKsw1ViLMNmuPMkWPl96tVZsyaE\/rYnN56t+Vwqltigmmd+qic5jMnEb3a5DU2FtE4XNy6xln2vDDk4HVt7ed1pXtuLjUKHs3bbsIjkaRI3I4srjiQRdYyVhuWnL8FLDGy2OvumWMyjZuqnua03007vDKxKnbLmDmWJsQ45DgQOO7VaKi2ngcWO+Bxu225x1Hnr6rN20e\/ncOt5EXSyx+NHPPy221Ir4bNv8QNgeWqgsiebFoN\/D70zLWO+InL1UR20XN0cbb+CMd61o7jJ8rOypa12ZVP6Q7WDXgNaCDi38CLWUrtS8Wxa\/PzWg25TuOEgHIkH8+S3xYTflz9XlnhhvD2doqtzpXv8A2RhF8gCf6fNTI8T3tjB7zzhb4\/2z8lq6FmE35WPjdX3q62cx036VKQGRghl97zrYb7DLLiq3UcuOeWPF3X2t+0Y+xomUcFg6QCPF9Vpye8+V\/MhTqOjho4GxsaDI7ME8d73chf2CZkkEry\/A87mCwAte9zfibfJPQCYAnAC8i2Ikm3gLaKW3Jd60kyVrWx9kH45H2c928C+RPPgPwU1j+75LT7N2JhcXkkuJuSVtp8glLWLpp3i88Y4yN9wuiFc\/pM6mEf6jT6EFX9W4vSPL7gQhCqilIQkKAFRBJeR\/2j7q9BUGM953ifdS5fhbh+W1gKdlksFHgTz47qUUvtXNubQOHswMRecIBzAvvPIa+SwodkxsjEcTXWHE6k5knmTcrY12ycRDx8QNwsqWXCf1lxzAJb8swl+1U348NbNsJjh34w7xAKaPRiBtiaZpccmjCLq50wjdm1wPgQVk8NDgXeS12Mzmy9KVP0dYcn0zP4GkeyjS9F4TrAw207treBXRHOa5NupmovGc58o5vUdEInC2AjwJWum6DMO+QeY\/BdWdRtWH6CEdtnqqf3Wf25VD0KaP\/wBH\/wAv4KUOg0Dj3nyHlcD2C6V+gBKKBvBKYU8urzvyolB0FpGZ9iCeLru\/3XVipdjsbo0ALftpAE6yIBamDnvLa18FE0WyUwQN4J\/CEhat60nvaJJGFqa4ZLcTsO5aysYbLGTeLVbFZesiHDEfRrlelT+isV6l79zWW83EfgVcLqnFP0p8v5BKsUKqSWUiCkQAqVTQ2keODj7q6qr1DcNRI3iQ4fvC\/wB6lyz0rxX2dYyyejNlngFkhasabZiyblp2ncnGkLMAIJp5tnN1tnxGXsoFfST2tFUPYdbkMk8iJAcvCysb4lFkpSd5WLj9NzL7Up+19q0xu6GCqZ+xeGT3LfZbHZ3WPSOPZ1AkpX8J24WnwkF228SFvX0JORJUKfo5G\/4mNd4i\/unLkLMa31LVRyND45GvadC0hwPgQnrqnM6DwNOKIOgf9aF7oz54TY+BT4pNow\/BPHUNH0Zm4X+AkjsPVpWtl2z7WsIVbh6SPZ3aqnkhP1rdpHf7bRceJAW6pNoskGJjmuHEEH2TljNxsSrpcSxEgQ6QJkXtAlxKLK8HeoctSW7wUrTkbNzlrdqSANKiybRJ4+Njb1UKeV0vcYMTtwHuTuCVu25i23RKK0bpN73n0bl74lvVEoKcRxsjH0WgX4nefM3UoFWk1HPld3ZUJEJkmJEITIirvSCnLZBML2IAJ3AjS\/iLeisSQrOU3NNY5au1ZgrxoVKFW071tXUsf+Wz+EfgmJNmwnWJvkLeyx2VTvjXmYcUNqwuZ9LukVVRV08EYY5jQ18QcCThLA7CSD9r0Wsoett4OGWk8Sx\/3OH3rGqr2eJft2VtS3isu3aueUXWXSOsXtkZ9pl\/my628PTqiOk8Y8Th90bF4svpbRKFkHKsf98Uf\/lQj99qwf1g0Ddapnlc+wT2zcMp8LXiSdp+yVS39Z9B9F8j\/swy+5aFFk60YfoUtQ7mQxo+br\/JB48eWXqL+SDqFCrNlxSHEG4HWIxN7rtDvGq53VdZ1QcoqJreb5Cf5WtHutTU9YG0CyQFsbS5tmFgtgJcCXWdixmwIGgzvmifur\/a8uvTqwoXt0luOYH3KndKunsdI7smDt5R8TWGwb9t2djy18FzeGWsmcXTVlQWn6PavAPiAbAclIbsyNosBZLxFuPpcr5zbDafWjVFt2QRx7ruLnnythV16rdoSVNIZ5yHydtIMWFos0BlgLDIC5XG9skYhG3RtyftHd5D3XXup5ttn\/8Auk9mqmMjn6jCYzwvzHJ1qYYU80rbjOtWYWDSsggMroSIQE1IhCZBIUISDErEoQmbg\/WOb7WmB4RDy7FipdXC0TCw1CEKV9vY4P8AHP8ATZ0kYtpuCmRwN+qEIWHWydC0bgkwjghCQZApxiRCDvtmxM1mtkIQL6ZRnJJO6wPIH5BCEFfVVKmF8zmV2jqn\/wDo\/wDuk\/4oQqz287qf8X+14YnmIQtvNOtWYQhACEIQH\/\/Z",
                "role_id": 5,
                "address": "Yangon",
                "active": 1,
                "last_activity": null,
                "remember_token": null,
                "created_by": "U0001",
                "updated_by": "",
                "deleted_by": "",
                "created_at": "2016-10-04 10:33:35",
                "updated_at": "2016-10-04 10:33:35",
                "deleted_at": ""
              },
              "log_patient_case_summary": [
                {
                  "id": "U0002",
                  "patient_id": "U0012",
                  "case_summary": "wwwwww",
                  "created_by": "",
                  "updated_by": "U0001",
                  "deleted_by": "",
                  "created_at": "0000-00-00 00:00:00",
                  "updated_at": "2016-10-04 10:33:35",
                  "deleted_at": ""
                },
                {
                  "id": "U0002",
                  "patient_id": "U0012",
                  "case_summary": "wwwwww",
                  "created_by": "",
                  "updated_by": "U0001",
                  "deleted_by": "",
                  "created_at": "0000-00-00 00:00:00",
                  "updated_at": "2016-10-04 10:33:35",
                  "deleted_at": ""
                },
                {
                  "id": "U0002",
                  "patient_id": "U0012",
                  "case_summary": "wwwwww",
                  "created_by": "",
                  "updated_by": "U0001",
                  "deleted_by": "",
                  "created_at": "0000-00-00 00:00:00",
                  "updated_at": "2016-10-04 10:33:35",
                  "deleted_at": ""
                }
              ]
            }
          ]
        }
        </pre>
    </div>
    <hr>
</div>
@stop

@section('page_script')

@stop