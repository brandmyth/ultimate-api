@extends('admin.layout.layout')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">Manage Homepage Advertisement</h3>
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
		                  <form class="forms-sample" @if(empty($advertisement['id'])) action="{{ url('admin/add-edit-homepage-advertisement') }}" @else action="{{ url('admin/add-edit-homepage-advertisement/'.$advertisement['id']) }}" @endif method="post" enctype="multipart/form-data">
		                  	@csrf
		                    <div class="form-group">
		                      <label for="title">Advertisement Title</label>
		                      <input type="text" class="form-control" id="title" name="title"placeholder="Title"  @if(!empty($advertisement['title'])) value="{{ $advertisement['title'] }}" @else value="{{ old('title') }}" @endif>
		                    </div>

		                    <div class="form-group">
		                      <label for="sub_title">Advertisement Sub Title</label>
		                      <input type="text" class="form-control" id="sub_title" name="sub_title"placeholder="Sub Title"  @if(!empty($advertisement['sub_title'])) value="{{ $advertisement['sub_title'] }}" @else value="{{ old('sub_title') }}" @endif>
		                    </div>
		                    
		                   
		                    <div class="form-group">
		                      <label for="advertisement_image">Advertisement Image</label>
		                      <input type="file" class="form-control" id="advertisement_image" name="advertisement_image">
		                      @if(!empty($advertisement['advertisement_image']))
		                      <a target="_blank" href="{{ url('frontend/images/advertisement_images/'.$advertisement['advertisement_image']) }}">View Image</a>&nbsp;|&nbsp;<a href="javascript:void(0)" class="confirmDelete" module="advertisement-image" moduleid="{{ $advertisement['id'] }}">Delete Image
                                            </a>
		                      @endif
		                    </div>

		                    <div class="form-group">
		                      <label for="url">Advertisement URL</label>
		                      <input type="text" class="form-control" id="url" name="url"placeholder="URL"  @if(!empty($advertisement['url'])) value="{{ $advertisement['url'] }}" @else value="{{ old('url') }}" @endif>
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