@extends('admin.layout.layout')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">Manage Taxes</h3>
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
		                  <form class="forms-sample" @if(empty($tax['id'])) action="{{ url('admin/add-edit-tax') }}" @else action="{{ url('admin/add-edit-tax/'.$tax['id']) }}" @endif method="post" enctype="multipart/form-data">
		                  	@csrf
		                    <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" 
                                    name="title"placeholder="Title"
                                    @if (!empty($tax['title'])) value="{{ $tax['title'] }}" @else value="{{ old('title') }}" @endif>
                                @error('title')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="percentage">Percentage</label>
                                <input type="number" min="0" class="form-control" 
                                    name="percentage"placeholder="percentage"
                                    @if (!empty($tax['percentage'])) value="{{ $tax['percentage'] }}" @else value="{{ old('percentage') }}" @endif>
                                @error('percentage')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="priority">Priority</label>
                                <input type="number" min="0" class="form-control" 
                                    name="priority"placeholder="Order"
                                    @if (!empty($tax['priority'])) value="{{ $tax['priority'] }}" @else value="{{ old('priority') }}" @endif>
                                @error('priority')
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