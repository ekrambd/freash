@extends('layouts.app')
@section('content')
<div class="content-page">
  <div class="content">
        <div class="container">
            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="pull-left page-title">Welcome !</h4>
                    <ol class="breadcrumb pull-right">
                        <li><a href="#">Echobvel</a></li>
                        <li class="active">IT</li>
                    </ol>
                </div>
            </div>

            <!-- Start Widget -->
            <div class="row">
	          <div class="col-md-8">
	              <div class="panel panel-default">
	                  <div class="panel-heading">
	                  	@foreach($report as $v_report)
	                      <h3 class="panel-title">
	                      	
	                      	
                              {{$v_report->edit_date}}
                            

	                      </h3>
	                    @endforeach
	                      
	                  </div>

	                  
	                  <div class="panel-body">
	                      <div class="row">
	                          <div class="col-md-12 col-sm-12 col-xs-12">
	                              <table id="datatable" class="table table-striped table-bordered">
	                                  <thead>
	                                      <tr>
	                                          <th>Sl</th>
	                                          <th>Employee Name</th>
	                                          <th>Attendences Status</th>
	                                      </tr>
	                                  </thead>

	                           
	                                  <tbody>
	                                  	<?php
	                                  	$sl=1;
	                                  	?>
	                                  	@foreach($report as $row)
	                                      <tr>
	                                          <td>{{ $sl++ }}</td>
	                                          <td>{{ $row->name }}</td>
	                                          @if( $row->attendence == 'Present' )
	                                          <td  class="badge badge-success">Present</td>
	                                          @else
	                                           <td class="badge badge-danger">{{$row->attendence}}</td>
	                                          @endif
	                                      </tr>

	                                    @endforeach
	                                  </tbody>
	                              </table>
	                          </div>
	                      </div>
	                  </div>
	              </div>
	          </div>
            </div>
        </div> <!-- container -->            
    </div> <!-- content -->
</div>


@endsection