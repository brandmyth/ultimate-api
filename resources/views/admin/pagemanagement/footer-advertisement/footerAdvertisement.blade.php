@extends('admin.layout.layout')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Footer Advertisement</h4>
                        <a href="{{ url('admin/add-edit-footer-advertisement') }}" class="btn btn-primary float-right">Add Advertisement</a>
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
                                        <th> Title </th>
                                        <th> Sub Title </th>
                                        <th> Url </th>
                                        <th> Image </th>
                                        <th> Actions </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($advertisement as $ban)
                                    <tr>
                                        <td> {{ $ban['id'] }} </td>
                                        <td> {{ $ban['title'] }} </td>
                                        <td> {{ $ban['sub_title'] }} </td>
                                        <td> {{ $ban['url'] }} </td>
                                        <td> 
                                            @if(!empty($ban['advertisement_image']))
                                                <img class="img-fluid" src="{{ asset('frontend/images/footer_advertisement_images/'.$ban['advertisement_image']) }}">
                                            @else
                                                <img class="img-fluid" src="{{ asset('frontend/images/footer_advertisement_images/dummy.png') }}">
                                            @endif
                                        </td>
                                        <td> 
                                            <a href="{{ url('admin/add-edit-footer-advertisement/'.$ban['id']) }}"><i style="font-size: 1.5rem;" class="mdi mdi-pencil-box"></i>
                                            </a>
                                            <a href="javascript:void(0)" class="confirmDelete" module="footer-advertisement" moduleid="{{ $ban['id'] }}"><i style="font-size: 1.5rem;" class="mdi mdi-file-excel-box"></i>
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