@extends('admin.layout.layout')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Products</h4>
                        <a href="{{ url('admin/add-edit-product') }}" class="btn btn-primary float-right">Add Product</a>
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
                                        <th> Product Name</th>
                                        <th> Product Image</th>
                                        <th> Category</th>
                                        <th> Section </th>
                                        <th> Added By </th>
                                        <th> Status </th>
                                        <th> Actions </th>
                                    </tr>
                                </thead>
                                <tbody>
                                	@foreach($products as $product)
                                    <tr>
                                        <td> {{ $product['id'] }} </td>
                                        <td> {{ $product['product_name'] }} </td>
                                        <td> 
                                            @if(!empty($product['product_image']))
                                                <img class="img-fluid" src="{{ asset('frontend/images/product_images/small/'.$product['product_image']) }}">
                                            @else
                                                <img class="img-fluid" src="{{ asset('frontend/images/product_images/small/dummy.png') }}">
                                            @endif
                                        </td>
                                        <td> {{ $product['category']['category_name'] }} </td>
                                        <td> {{ $product['section']['name'] }} </td>
                                        <td> 
                                            @if($product['admin_type']=="vendor")
                                            <a target="_blank" href="{{ url('admin/view-vendor-details/'.$product['admin_id']) }}">{{ ucfirst($product['admin_type']) }}</a>
                                            @else
                                                {{ ucfirst($product['admin_type']) }} 
                                            @endif
                                        </td>
                                        <td>
                                            @if($product['status'] == 1)
                                                <a class="updateProductStatus" id="product-{{ $product['id'] }}" product_id="{{ $product['id'] }}" href="javascript:void(0)">
                                            	   <i style="font-size: 1.5rem;" class="mdi mdi-bookmark-check" status="Active"></i>
                                                </a>
                                            @else
                                            	<a class="updateProductStatus" id="product-{{ $product['id'] }}" product_id="{{ $product['id'] }}" href="javascript:void(0)">
                                                    <i style="font-size: 1.5rem;" class="mdi mdi-bookmark-outline" status="Inactive"></i>
                                                </a>
                                            @endif
                                   		 </td>
                                        <td> 
                                        	<a title="Edit Product" href="{{ url('admin/add-edit-product/'.$product['id']) }}"><i style="font-size: 1.5rem;" class="mdi mdi-pencil-box"></i>
                                            </a>
                                            <a title="Delete Product" href="javascript:void(0)" class="confirmDelete" module="product" moduleid="{{ $product['id'] }}"><i style="font-size: 1.5rem;" class="mdi mdi-file-excel-box"></i>
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