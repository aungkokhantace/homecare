<?php
/**
 * Created by PhpStorm.
 * Author: Wai Yan Aung
 * Date: 7/1/2016
 * Time: 10:51 AM
 */
?>

@extends('layouts.master')
@section('title','Page Not Found')
@section('content')

        <!-- begin #content -->
<div id="content" class="content">

    <!-- <h1 class="page-header">Error !</h1> -->

    <div class="row">
        <div class="col-md-12">
            <!-- <h1 class="page-header">Sorry, the requested page is not found</h1> -->
            <div class="wrapper row2">
              <div id="container" class="clear">
                <section id="fof" class="clear">
                  <div class="hgroup">
                    <h1><span><strong>4</strong></span><span><strong>0</strong></span><span><strong>4</strong></span></h1>
                    <h2>Error ! <span>Page Not Found</span></h2>
                  </div>
                  <p>For Some Reason The Page You Requested Could Not Be Found On Our Server</p>
                  <p><a href="javascript:history.go(-1)">&laquo; Go Back</a></p>
                </section>
              </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('page_script')
@stop
