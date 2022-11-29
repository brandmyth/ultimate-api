@extends('admin.layout.layout')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">Manage Homepage Banner</h3>
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
		                  <form class="forms-sample" @if(empty($banner['id'])) action="{{ url('admin/add-edit-homepage-banner') }}" @else action="{{ url('admin/add-edit-homepage-banner/'.$banner['id']) }}" @endif method="post" enctype="multipart/form-data">
		                  	@csrf
		                    <div class="form-group">
		                      <label for="title">Banner Title</label>
		                      <input type="text" class="form-control" id="title" name="title"placeholder="Title"  @if(!empty($banner['title'])) value="{{ $banner['title'] }}" @else value="{{ old('title') }}" @endif>
		                    </div>

		                    <div class="form-group">
		                      <label for="sub_title">Banner Sub Title</label>
		                      <input type="text" class="form-control" id="sub_title" name="sub_title"placeholder="Sub Title"  @if(!empty($banner['sub_title'])) value="{{ $banner['sub_title'] }}" @else value="{{ old('sub_title') }}" @endif>
		                    </div>
		                    
		                   
		                    <div class="form-group">
		                      <label for="banner_image">Banner Image</label>
		                      <input type="file" class="form-control" id="banner_image" name="banner_image">
		                      @if(!empty($banner['banner_image']))
		                      <a target="_blank" href="{{ url('frontend/images/banner_images/'.$banner['banner_image']) }}">View Image</a>&nbsp;|&nbsp;<a href="javascript:void(0)" class="confirmDelete" module="banner-image" moduleid="{{ $banner['id'] }}">Delete Image
                                            </a>
		                      @endif
		                    </div>

		                    <div class="form-group">
		                      <label for="link">Banner URL</label>
		                      <input type="text" class="form-control" id="link" name="link"placeholder="URL"  @if(!empty($banner['link'])) value="{{ $banner['link'] }}" @else value="{{ old('link') }}" @endif>
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