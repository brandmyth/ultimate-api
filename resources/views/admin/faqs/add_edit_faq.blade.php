@extends('admin.layout.layout')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">Manage Faqs</h3>
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
		                  <form class="forms-sample" @if(empty($faq['id'])) action="{{ url('admin/add-edit-faq') }}" @else action="{{ url('admin/add-edit-faq/'.$faq['id']) }}" @endif method="post" enctype="multipart/form-data">
		                  	@csrf
		                  	<div class="form-group">
                                <label for="category_id">Select Category</label>
                                <select class="form-control" name="category_id">
                                    <option value="">Select</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category['id'] }}"
                                            @if (!empty($faq['category_id']) && $faq['category_id'] == $category['id']) selected @endif>
                                            {{ $category['name'] }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
		                    <div class="form-group">
		                    	<label for="question">Question</label>
                                <textarea class="form-control" name="question" rows="3">@if(!empty($faq['question'])) {{ $faq['question'] }}@else{{ old('question') }} @endif</textarea>
                                @error('question')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
		                    </div>
		                    <div class="form-group">
		                    	<label for="answer">Answer</label>
                                <textarea class="form-control" name="answer" rows="3">@if(!empty($faq['answer'])) {{ $faq['answer'] }}@else{{ old('answer') }} @endif</textarea>
                                @error('answer')
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