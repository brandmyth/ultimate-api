@extends('admin.layout.layout')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">FAQ categories</h4>
                        <a href="{{ url('admin/add-edit-faq-category') }}" class="btn btn-primary float-right">Add Category</a>
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
                                        <th> Name </th>
                                        <th> Status </th>
                                        <th> Actions </th>
                                    </tr>
                                </thead>
                                <tbody>
                                	@foreach($faq_categories as $category)
                                    <tr>
                                        <td> {{ $category['id'] }} </td>
                                        <td> {{ $category['name'] }} </td>
                                        <td>
                                            @if($category['status'] == "Published")
                                                <a class="updateFaqCategoryStatus" id="faqCategory-{{ $category['id'] }}" faq_category_id="{{ $category['id'] }}" href="javascript:void(0)">
                                            	   <i style="font-size: 1.5rem;" class="mdi mdi-bookmark-check" status="Active"></i>
                                                </a>
                                            @else
                                            	<a class="updateFaqCategoryStatus" id="faqCategory-{{ $category['id'] }}" faq_category_id="{{ $category['id'] }}" href="javascript:void(0)">
                                                    <i style="font-size: 1.5rem;" class="mdi mdi-bookmark-outline" status="Inactive"></i>
                                                </a>
                                            @endif
                                   		 </td>
                                        <td> 
                                        	<a href="{{ url('admin/add-edit-faq-category/'.$category['id']) }}"><i style="font-size: 1.5rem;" class="mdi mdi-pencil-box"></i>
                                            </a>
                                            <a href="javascript:void(0)" class="confirmDelete" module="faq_category" moduleid="{{ $category['id'] }}"><i style="font-size: 1.5rem;" class="mdi mdi-file-excel-box"></i>
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