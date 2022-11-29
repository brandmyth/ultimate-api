@extends('admin.layout.layout')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">Manage Faq Categories</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
                	<div class="col-md-6 grid-margin stretch-card">
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
		                  <form class="forms-sample" @if(empty($faq_category['id'])) action="{{ url('admin/add-edit-faq-category') }}" @else action="{{ url('admin/add-edit-faq-category/'.$faq_category['id']) }}" @endif method="post" enctype="multipart/form-data">
		                  	@csrf
		                    <div class="form-group">
		                      <label for="name">Name</label>
		                      <input type="text" class="form-control" name="name"placeholder="Name"  @if(!empty($faq_category['name'])) value="{{ $faq_category['name'] }}" @else value="{{ old('name') }}" @endif>
		                       @error('name')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
		                    </div>
		                    <div class="form-group">
		                      <label for="order">Order</label>
		                      <input type="number" class="form-control" id="faq_cat_order" name="order" min="0"  @if(!empty($faq_category['order'])) value="{{ $faq_category['order'] }}" @else value="{{ old('order') }}" @endif>
		                       @error('order')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
		                    </div>
		                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
		                    <button type="reset" class="btn btn-light">Cancel</button>
		                  </form>
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