@extends('admin.layout.layout')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">Product Collection</h3>
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
		                  <h4 class="card-title">{{ $title }}</h4>
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
			              
		                  <form class="forms-sample" @if(empty($productCollection['id'])) action="{{ url('admin/add-edit-product-collection') }}" @else action="{{ url('admin/add-edit-product-collection/'.$productCollection['id']) }}" @endif method="post" enctype="multipart/form-data">
		                  	@csrf
		                  	<div class="row">
			                  	<div class="col-md-6">

				                    <div class="form-group">
				                      <label for="name">Product Collection Name</label>
				                      <input type="text" class="form-control" id="name" name="name"placeholder="Collection Name"  @if(!empty($productCollection['name'])) value="{{ $productCollection['name'] }}" @else value="{{ old('name') }}" @endif>
				                    </div>

									<div class="form-group">
			                            <label for="discount_type">Discount Type</label>
			                            <select class="form-control" id="discount_type" name="discount_type">
			                                <option value="">Select</option>
			                                <option value="amount"
		                                    @if (!empty($productCollection['discount_type']) && $productCollection['discount_type'] == 'amount') selected  @endif>BDT</option>

		                                    <option value="percentage"
		                                    @if (!empty($productCollection['discount_type']) && $productCollection['discount_type'] == 'percentage') selected  @endif>%</option>

		                                    <option value="same-price"
		                                    @if (!empty($productCollection['discount_type']) && $productCollection['discount_type'] == 'same-price') selected  @endif>No Change</option>
			                                <!-- <option value="amount">BDT</option>
											<option value="percentage">%</option>
											<option value="same-price">No Change</option> -->
			                            </select>
			                        </div>
				                    <div class="form-group">
				                        <label for="discount_amount">Discount Amount</label>
				                        <input type="number" class="form-control" id="discount_amount" name="discount_amount"placeholder="Amount"  @if(!empty($productCollection['discount_amount'])) value="{{ $productCollection['discount_amount'] }}" @else value="{{ old('discount_amount') }}" @endif>
				                    </div>
			                	</div>
				                <div class="col-md-6">
				                	<div class="form-group">
					                	<label for="description">Start Date</label>
										<input class="datepicker"id="start_datepicker" data-date-format="mm/dd/yyyy" name="start_date" placeholder="Start date" @if(!empty($productCollection['start_date'])) value="{{ $productCollection['start_date'] }}" @else value="{{ old('start_date') }}" @endif>
										<div class="input-group-addon">
										    <span class="glyphicon glyphicon-th"></span>
										</div>
				                	</div>
				                	<div class="form-group">
					                	<label for="description">End Date</label>
										<input class="datepicker"id="end_datepicker" data-date-format="mm/dd/yyyy" placeholder="End date"name="end_date" @if(!empty($productCollection['end_date'])) value="{{ $productCollection['end_date'] }}" @else value="{{ old('end_date') }}" @endif >
										<div class="input-group-addon">
										    <span class="glyphicon glyphicon-th"></span>
										</div>
				                	</div>
				                	<!-- <div class="form-group">
				                        <label for="description">Description</label>
				                        <textarea class="form-control" id="description" name="description"placeholder="Description here..."  @if(!empty($banner['description'])) value="{{ $banner['description'] }}" @else value="{{ old('description') }}" @endif></textarea>
				                    </div> -->
				                </div>
		                	</div>
		                	<button type="submit" class="btn btn-primary mr-2">Submit</button>
		                    <button type="reset" class="btn btn-light">Cancel</button>
		                  </form>
		                </div>
		              </div>
		            </div>
                </div>
    		</div>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://unpkg.com/gijgo@1.9.14/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.14/css/gijgo.min.css" rel="stylesheet" type="text/css" />
	<script>
        $('#start_datepicker').datepicker({
            uiLibrary: 'bootstrap4'
        });
    </script>
    <script>
        $('#end_datepicker').datepicker({
            uiLibrary: 'bootstrap4'
        });
    </script>
    <!-- content-wrapper ends -->
    @include('admin.layout.footer')
    <!-- partial -->
</div>
@endsection
