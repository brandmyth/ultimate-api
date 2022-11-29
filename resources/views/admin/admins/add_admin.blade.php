@extends('admin.layout.layout')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">Manage Admins</h3>
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
		                  <form class="forms-sample" action="{{ url('admin/add-admin') }}"  method="post" enctype="multipart/form-data">
		                  	@csrf
		                    <div class="form-group">
		                      <label>Username</label>
		                      <input type="text" class="form-control" id="email" name="email"placeholder="Email" value="{{ old('email') }}">
		                    </div>
		                    @if(Auth::guard('admin')->user()->type=="superadmin")
		                    <div class="form-group">
		                      <label>Adimn Type</label>
		                      <select class="form-control" id="type" name="type">
		                        <option value="">Select Type</option>
		                        <option value="admin">Admin</option>
		                        <option value="staff">Staff</option>
		                      </select>
		                    </div>
		                    @elseif(Auth::guard('admin')->user()->type=="admin")
		                    <div class="form-group">
		                      <label>Admin Type</label>
		                      <input type="text" class="form-control" id="type" name="type" value="staff" readonly>
		                    </div>
		                    @endif
		                    <div class="form-group">
		                      <label for="name">Name</label>
		                      <input type="text" class="form-control" id="name" name="name"placeholder="Name" value="{{ old('name') }}">
		                    </div>
		                    <div class="form-group">
		                      <label for="mobile">Mobile</label>
		                      <input type="text" class="form-control" id="mobile" name="mobile"placeholder="Mobile" value="{{ old('mobile') }}">
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