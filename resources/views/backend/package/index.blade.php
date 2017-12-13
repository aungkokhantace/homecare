@extends('layouts.master')
@section('title','Package')
@section('content')

        <!-- begin #content -->
<div id="content" class="content">

    <h1 class="page-header">Package List</h1>

    @if(count(Session::get('message')) != 0)
        <div>
        </div>
    @endif


    <div class="row">
        <div class="col-md-10"></div>
        <div class="col-md-2">
            <div class="buttons pull-right">
                <button type="button" onclick='create_setup("package");' class="btn btn-default btn-md first_btn">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                </button>
                <button type="button" onclick='edit_setup("package");' class="btn btn-default btn-md second_btn">
                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                </button>
                <button type="button" onclick="delete_setup('package');" class="btn btn-default btn-md third_btn">
                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                </button>
            </div>
        </div>

    </div>

    {!! Form::open(array('id'=> 'frm_package' ,'url' => 'package/destroy', 'class'=> 'form-horizontal user-form-border')) !!}
    {{ csrf_field() }}
    <input type="hidden" id="selected_checkboxes" name="selected_checkboxes" value="">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="listing">
                <input type="hidden" id="pageSearchedValue" name="pageSearchedValue" value="">
                <table class="table table-striped list-table" id="list-table">

                    <thead>
                    <tr>
                        <th><input type='checkbox' name='check' id='check_all'/></th>
                        <th>Package Name</th>
                        <th>Service</th>
                        <th>Price</th>
                        <th>Inclusive Transport Charge</th>
                        {{--<th>Description</th>--}}
                        <th></th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th></th>
                        <th class="search-col" con-id="name">Package Name</th>
                        <th class="search-col" con-id="service">Service</th>
                        <th class="search-col" con-id="price">Price</th>
                        <th class="search-col" con-id="inclusive_transport_charge">Inclusive Transport Charge</th>
                        {{--<th class="search-col" con-id="description">Description</th>--}}
                        <th></th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach($package as $package)
                        <tr>
                            <td><input type="checkbox" class="check_source" name="edit_check" value="{{ $package->id }}" id="all"></td>
                            <td><a href="/package/edit/{{$package->id}}">{{$package->package_name}}</a></td>
                            <td>{{$servicesArray[$package->id]}}</td>
                            <td>{{$package->price}}</td>
                            <td>{{$package->inclusive_transport_charge}}</td>
                            {{--<td>{{$package->description}}</td>--}}
                            <td>
                                @if($package->status == 'confirm')
                                    {{'CONFIRM'}}
                                @else
                                    <a href="package/promotion/{{$package->id}}"><button type="button" class="btn btn-primary">Edit Promotion Plan</button></a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {!! Form::close() !!}

</div>
@stop

@section('page_script')
    <script type="text/javascript" language="javascript" class="init">
        $(document).ready(function() {

            $('#list-table tfoot th.search-col').each( function () {
                var title = $('#list-table thead th').eq( $(this).index() ).text();
                $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
            } );

            var table = $('#list-table').DataTable({
                aLengthMenu: [
                    [10,15,25, 50, 100, 200, -1],
                    [10,15,25, 50, 100, 200, "All"]
                ],
                iDisplayLength: 5,
                "order": [[ 1, "desc" ]],
                stateSave: false,
                "pagingType": "full",
                "dom": '<"pull-right m-t-20"i>rt<"bottom"lp><"clear">',
                "pageLength": 15
            });

            // Apply the search
            table.columns().eq( 0 ).each( function ( colIdx ) {
                $( 'input', table.column( colIdx ).footer() ).on( 'keyup change', function () {
                    table
                            .column( colIdx )
                            .search( this.value )
                            .draw();
                } );

            });

        });
    </script>
@stop
