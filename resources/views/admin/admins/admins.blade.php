@extends('admin.layout.layout')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{ $title }}</h4>
                        @if(Auth::guard('admin')->user()->type == "superadmin" || Auth::guard('admin')->user()->type == "admin")
                        <a href="{{ url('admin/add-admin') }}" class="btn btn-primary float-right">Add Admin</a>
                        @endif
                        @if(Session::has('success_message'))
                          <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Success:</strong> {{ Session::get('success_message')}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          @endif
                        <div class="table-responsive pt-3">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Admin ID</th>
                                        <th> Name </th>
                                        <th> Type </th>
                                        <th> Mobile </th>
                                        <th> Email </th>
                                        <th> Image </th>
                                        <th> Status </th>
                                        <th> Actions </th>
                                    </tr>
                                </thead>
                                <tbody>
                                	@foreach($admins as $admin)
                                    <tr>
                                        <td> {{ $admin['id'] }} </td>
                                        <td> {{ $admin['name'] }} </td>
                                        <td> {{ $admin['type'] }} </td>
                                        <td> {{ $admin['mobile'] }} </td>
                                        <td> {{ $admin['email'] }} </td>
                                        <td> 
                                            @if(!empty($admin['image']))
                                               <img class="img-fluid"  src="{{ asset('admin/images/photos/'.$admin['image']) }}">
                                            @else
                                                <img class="img-fluid" src="{{ asset('admin/images/photos/dummy.png') }}">
                                            @endif
                                        </td>
                                        <td> 
                                        @if($admin['status'] == 1)
                                            <a class="updateAdminStatus" id="admin-{{ $admin['id'] }}" admin_id="{{ $admin['id'] }}" href="javascript:void(0)">
                                        	   <i style="font-size: 1.5rem;" class="mdi mdi-bookmark-check" status="Active"></i>
                                            </a>
                                        @else
                                        	<a class="updateAdminStatus" id="admin-{{ $admin['id'] }}" admin_id="{{ $admin['id'] }}" href="javascript:void(0)">
                                                <i style="font-size: 1.5rem;" class="mdi mdi-bookmark-outline" status="Inactive"></i>
                                            </a>
                                        @endif
                                   		 </td>
                                        <td> 
                                        @if($admin['type'] == "vendor")
                                        	<a href="{{ url('admin/view-vendor-details/'.$admin['id']) }}"><i style="font-size: 1.5rem;" class="mdi mdi-file-document"></i>
                                            </a>
                                        @elseif($admin['type'] != "superadmin")
                                            <a href="javascript:void(0)" class="confirmDelete" module="admin" moduleid="{{ $admin['id'] }}"><i style="font-size: 1.5rem;" class="mdi mdi-file-excel-box"></i>
                                            </a>
                                        @endif
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