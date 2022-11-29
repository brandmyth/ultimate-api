@extends('admin.layout.layout')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">Attributes</h3>
                    </div>
                    <div class="col-12 col-xl-4">
                        <div class="justify-content-end d-flex">
                            <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                                <button class="btn btn-sm btn-light bg-white dropdown-toggle" type="button" id="dropdownMenuDate2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                <i class="mdi mdi-calendar"></i> Today (10 Jan 2021)
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuDate2">
                                    <a class="dropdown-item" href="#">January - March</a>
                                    <a class="dropdown-item" href="#">March - June</a>
                                    <a class="dropdown-item" href="#">June - August</a>
                                    <a class="dropdown-item" href="#">August - November</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
                	<div class="col-md-12 grid-margin stretch-card">
		              <div class="card">
		                <div class="card-body">
		                  <h4 class="card-title">Add Attribute</h4>
		                  @if(Session::has('error_message'))
			              <div class="alert alert-danger alert-dismissible fade show" role="alert">
			                <strong>Error:</strong> {{ Session::get('error_message')}}
			                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			                  <span aria-hidden="true">&times;</span>
			                </button>
			              </div>
			              @endif
			              @if(Session::has('success_message'))
			              <div class="alert alert-success alert-dismissible fade show" role="alert">
			                <strong>Success:</strong> {{ Session::get('success_message')}}
			                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			                  <span aria-hidden="true">&times;</span>
			                </button>
			              </div>
			              @endif

			              @if ($errors->any())
			                <div class="alert alert-danger alert-dismissible fade show" role="alert">
			                      @foreach ($errors->all() as $error)
			                        <li>{{ $error }}</li>
			                      @endforeach
			                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			                    <span aria-hidden="true">&times;</span>
			                  </button>
			                </div>
			              @endif
		                  <form class="forms-sample" action="{{ url('admin/add-edit-attributes/'.$product['id']) }}" method="post">
		                  	@csrf
		                    <div class="form-group">
		                      <label for="product_name">Product Name</label>
		                      &ensp;{{ $product['product_name'] }}
		                    </div>
		                    <div class="form-group">
		                      <label for="product_code">Product Code</label>
		                      &ensp;{{ $product['product_code'] }}
		                    </div>
		                    <div class="form-group">
		                      <label for="product_price">Product Price</label>
		                      &ensp;{{ $product['product_price'] }}
		                    </div>
		                    
		                    <div class="form-group">
		                      @if(!empty($product['product_image']))
		                      	<img class="img-fluid" src="{{ asset('frontend/images/product_images/small/'.$product['product_image']) }}">
		                      @else
		                      	<img class="img-fluid" src="{{ asset('frontend/images/product_images/small/dummy.png') }}">
		                      @endif
		                    </div>
		                    <div class="form-group">
		                    	<div class="field_wrapper">
								    <div>
								    	<input type="text" name="sku[]" placeholder="sku" required />
								        <input type="text" name="size[]" placeholder="Size" required />
								        <input type="text" name="weight[]" placeholder="Weight"  required />
								        <input type="text" name="color[]" placeholder="color"  required />
								        <a href="javascript:void(0);" class="btn add_button" title="Add field">+</a>
								    </div>
								</div>
		                    </div>		                   
		                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
		                    <button type="reset" class="btn btn-light">Cancel</button>
		                  </form>
		                  <br>
		               <h4 class="card-title">Product Attributes</h4>
		              <div class="table-responsive pt-3">
                           <form  action="{{ url('admin/update-attributes/'.$product['id']) }}" method="post">
		                  	@csrf
                            <table class="table table-bordered" id="attribute_table">
                                <thead>
                                    <tr>
                                        <th> ID </th>
                                        <th> Size </th>
                                        <th> SKU </th>
                                        <th> Price </th>
                                        <th> Stock </th>
                                        <th> Actions </th>
                                    </tr>
                                </thead>
                                <tbody>
                                	@foreach($product['attributes'] as $attribute)
                                    <tr>
                                        <td> {{ $attribute['id'] }} 
                                        	<input type="hidden" name="attributeId[]" value="{{ $attribute['id'] }}">
                                        </td>
                                        <td> {{ $attribute['size'] }} </td>
                                        <td> {{ $attribute['sku'] }} </td>
                                        <td> <input type="number" name="price[]" value="{{ $attribute['price'] }}" required> </td>
                                        <td> <input type="number" name="stock[]" value="{{ $attribute['stock'] }}" required> </td>
                                        <td>
                                            @if($attribute['status'] == 1)
                                                <a class="updateAttributeStatus" id="attribute-{{ $attribute['id'] }}" attribute_id="{{ $attribute['id'] }}" href="javascript:void(0)">
                                            	   <i style="font-size: 1.5rem;" class="mdi mdi-bookmark-check" status="Active"></i>
                                                </a>
                                            @else
                                            	<a class="updateAttributeStatus" id="attribute-{{ $attribute['id'] }}" attribute_id="{{ $attribute['id'] }}" href="javascript:void(0)">
                                                    <i style="font-size: 1.5rem;" class="mdi mdi-bookmark-outline" status="Inactive"></i>
                                                </a>
                                            @endif
                                   		 </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <button type="submit" class="btn btn-primary mr-2 float-right">Update Attributes</button>
		                  </form>
                        </div>
		                </div>
		              </div>

		            </div>
                </div>

    </div>
    <!-- content-wrapper ends -->
    @include('admin.layout.footer')
    <!-- partial -->
</div>
@endsection