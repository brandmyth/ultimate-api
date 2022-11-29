<?php use App\Models\ProductsFilter ?>
@extends('admin.layout.layout')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Filter Values</h4>
                        <a href="{{ url('admin/add-edit-filter-value') }}" class="btn btn-primary float-right">Add Filter Value</a>
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
                                        <th> Filter ID </th>
                                        <th> Filter Name </th>
                                        <th> Filter Value </th>
                                        <th> Status </th>
                                        <th> Actions </th>
                                    </tr>
                                </thead>
                                <tbody>
                                	@foreach($filter_values as $filter)
                                    <tr>
                                        <td> {{ $filter['id'] }} </td>
                                        <td> {{ $filter['filter_id'] }} </td>
                                        <td> <?php
                                                echo $getFilterName = ProductsFilter::getFilterName($filter['filter_id']); 
                                            ?> 
                                        </td>
                                        <td> {{ $filter['filter_value'] }} </td>
                                        <td>
                                            @if($filter['status'] == 1)
                                                <a class="updateFilterValueStatus" id="filter-{{ $filter['id'] }}" filter_id="{{ $filter['id'] }}" href="javascript:void(0)">
                                            	   <i style="font-size: 1.5rem;" class="mdi mdi-bookmark-check" status="Active"></i>
                                                </a>
                                            @else
                                            	<a class="updateFilterValueStatus" id="filter-{{ $filter['id'] }}" filter_id="{{ $filter['id'] }}" href="javascript:void(0)">
                                                    <i style="font-size: 1.5rem;" class="mdi mdi-bookmark-outline" status="Inactive"></i>
                                                </a>
                                            @endif
                                   		 </td>
                                        <td> 
                                        	<a href="{{ url('admin/add-edit-filter/'.$filter['id']) }}"><i style="font-size: 1.5rem;" class="mdi mdi-pencil-box"></i>
                                            </a>
                                            <a href="javascript:void(0)" class="confirmDelete" module="filter" moduleid="{{ $filter['id'] }}"><i style="font-size: 1.5rem;" class="mdi mdi-file-excel-box"></i>
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