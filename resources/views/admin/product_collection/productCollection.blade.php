@extends('admin.layout.layout')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Product Collection</h4>
                        <a href="{{ url('admin/add-edit-product-collection') }}" class="btn btn-primary float-right">Add Collection</a>
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
                                        <th> Name </th>
                                        <th> Start Date </th>
                                        <th> End Date </th>
                                        <th> Discount Amount </th>
                                        <th> Discount Type </th>
                                        <th> Actions </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($productCollection as $ban)
                                    <tr>
                                        <td> {{ $ban['name'] }} </td>
                                        <td> {{ $ban['start_date'] }} </td>
                                        <td> {{ $ban['end_date'] }} </td>
                                        <td> {{ $ban['discount_amount'] }} </td>
                                        <td> {{ $ban['discount_type'] }} </td>
                                        <td> 
                                            <a href="{{ url('admin/add-edit-product-collection/'.$ban['id']) }}"><i style="font-size: 1.5rem;" class="mdi mdi-pencil-box"></i>
                                            </a>
                                            <a href="javascript:void(0)" class="confirmDelete" module="product-collection" moduleid="{{ $ban['id'] }}"><i style="font-size: 1.5rem;" class="mdi mdi-file-excel-box"></i>
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