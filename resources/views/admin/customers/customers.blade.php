@extends('admin.layout.layout')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Customers</h4>
                        @if(Session::has('success_message'))
                          <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Success:</strong> {{ Session::get('success_message')}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          @endif
                        <div class="table-responsive pt-3">
                            <table class="table table-bordered" id="ssDataTable">
                                <thead>
                                    <tr>
                                        <th> ID</th>
                                        <th> Name </th>
                                        <th> Email </th>
                                        <th> Contact No </th>
                                        <th> Gender </th>
                                        <th> Status </th>
                                        <th> Actions </th>
                                    </tr>
                                </thead>
                                <tbody>
                                	@foreach($customers as $customer)
                                    <tr>
                                        <td> {{ $customer['id'] }} </td>
                                        <td> {{ $customer['customer_name'] }} </td>
                                        <td> {{ $customer['customer_email'] }} </td>
                                        <td> {{ $customer['customer_contact'] }} </td>
                                        <td> {{ $customer['customer_gender'] }} </td>
                                        <td>
                                            @if($customer['status'] == 1)
                                                <a class="updateCustomerStatus" id="customer-{{ $customer['id'] }}" customer_id="{{ $customer['id'] }}" href="javascript:void(0)">
                                            	   <i style="font-size: 1.5rem;" class="mdi mdi-bookmark-check" status="Active"></i>
                                                </a>
                                            @else
                                            	<a class="updateCustomerStatus" id="customer-{{ $customer['id'] }}" customer_id="{{ $customer['id'] }}" href="javascript:void(0)">
                                                    <i style="font-size: 1.5rem;" class="mdi mdi-bookmark-outline" status="Inactive"></i>
                                                </a>
                                            @endif
                                   		 </td>
                                        <td> 
                                        	<a href="{{ url('admin/view-customer-details/'.$customer['id']) }}"><i style="font-size: 1.5rem;" class="mdi mdi mdi-file-document"></i>
                                            </a>
                                            <a href="javascript:void(0)" class="confirmDelete" module="customer" moduleid="{{ $customer['id'] }}"><i style="font-size: 1.5rem;" class="mdi mdi-file-excel-box"></i>
                                            </a>
                                        </td>
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
    <!-- content-wrapper ends -->
    <!-- footer -->
    @include('admin.layout.footer')
    <!-- partial -->
</div>

@endsection