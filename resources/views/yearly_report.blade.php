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
	          <div class="col-md-12">
	              <div class="panel panel-default">
	                  <div class="panel-heading">
	                      <h3 class="panel-title text-danger">{{ date("Y") }} Yearly Expense 
	                      </h3>
	                  </div>
	                  <div class="panel-body">
	                      <div class="row">
	                          <div class="col-md-12 col-sm-12 col-xs-12">
	                             <table id="datatable" class="table table-striped table-bordered">
	                                  <thead>
	                                      <tr>
	                                          <th>Order Id</th>
	                                          <th>Amount</th>
	                                         
	                                      </tr>
	                                  </thead>
	                                  <tbody>
	                                  	@foreach($yearly as $row)
	                                      <tr>
	                                          <td>{{ $row->id }}</td>
	                                          <td>{{ $row->sub_total }}</td>
	                                      </tr>
	                                    @endforeach
	                                  </tbody>

	                              </table>
	                               @php
						            $order_year= date("Y");
						            $total=DB::Table('orders')->where('order_year',$order_year)->sum('sub_total');
						            @endphp
	                               <h4 align="center">Yearly Expense: {{ $total }} Taka</h4>
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