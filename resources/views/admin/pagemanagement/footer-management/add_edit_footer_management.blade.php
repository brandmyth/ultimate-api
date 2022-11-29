@extends('admin.layout.layout')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">Manage Footer</h3>
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
		                  <form class="forms-sample" @if(empty($footerManagement['id'])) action="{{ url('admin/add-edit-manage-footer') }}" @else action="{{ url('admin/add-edit-manage-footer/'.$footerManagement['id']) }}" @endif method="post" enctype="multipart/form-data">
		                  	@csrf
		                    <div class="form-group">
		                      <label for="address">Address</label>
		                      <input type="text" class="form-control" id="address" name="address"placeholder="address"  @if(!empty($footerManagement['address'])) value="{{ $footerManagement['address'] }}" @else value="{{ old('address') }}" @endif>
		                    </div>

		                    <div class="form-group">
		                      <label for="office_contact">Office Contact</label>
		                      <input type="number" class="form-control" id="office_contact" name="office_contact"placeholder="office_contact"  @if(!empty($footerManagement['office_contact'])) value="{{ $footerManagement['office_contact'] }}" @else value="{{ old('office_contact') }}" @endif>
		                    </div>

		                    <div class="form-group">
		                      <label for="email">Office Email</label>
		                      <input type="text" class="form-control" id="email" name="email"placeholder="email"  @if(!empty($footerManagement['email'])) value="{{ $footerManagement['email'] }}" @else value="{{ old('email') }}" @endif>
		                    </div>

		                    <div class="form-group">
		                      <label for="working_hour">Working Hour</label>
		                      <input type="text" class="form-control" id="working_hour" name="working_hour"placeholder="working_hour"  @if(!empty($footerManagement['working_hour'])) value="{{ $footerManagement['working_hour'] }}" @else value="{{ old('working_hour') }}" @endif>
		                    </div>

		                    <div class="form-group">
		                      <label for="copyright_description">Copyright</label>
		                      <input type="text" class="form-control" id="copyright_description" name="copyright_description"placeholder="copyright_description"  @if(!empty($footerManagement['copyright_description'])) value="{{ $footerManagement['copyright_description'] }}" @else value="{{ old('copyright_description') }}" @endif>
		                    </div>

		                    <div class="form-group">
		                      <label for="hotline_no">Hotline Number</label>
		                      <input type="number" class="form-control" id="hotline_no" name="hotline_no"placeholder="hotline_no"  @if(!empty($footerManagement['hotline_no'])) value="{{ $footerManagement['hotline_no'] }}" @else value="{{ old('hotline_no') }}" @endif>
		                    </div>

		                    <div class="form-group">
		                      <label for="hotline_description">Hotline Title</label>
		                      <input type="text" class="form-control" id="hotline_description" name="hotline_description"placeholder="hotline_description"  @if(!empty($footerManagement['hotline_description'])) value="{{ $footerManagement['hotline_description'] }}" @else value="{{ old('hotline_description') }}" @endif>
		                    </div>

		                    <div class="form-group">
		                      <label for="hotline_logo">Hotline logo</label>
						      <label for="files" class="btn"><img class="img-fluid" src="{{ asset('frontend/images/social_icons/'.$footerManagement['hotline_logo']) }}"></label>
						      <p>Click logo to change</p>
						      <input class="form-control" id="files" style="visibility:hidden;" type="file"  name="hotline_logo"
						      @if(!empty($footerManagement['hotline_logo'])) value="{{ $footerManagement['hotline_logo'] }}" @else value="{{ old('hotline_logo') }}" @endif>
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
<script>
$("#files").change(function() {
  filename = this.files[0].name;
  console.log(filename);
});
</script>
@endsection