@extends('admin.layout.layout')
<style type="text/css">
.table-responsive {
    overflow-x: hidden !important;
}
</style>
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <h3 class="font-weight-bold text-center">Attributes</h3>
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        
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
		<div class="col-md-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">

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
              <br>

                    <div class="row justify-content-center">
                    <div class="card col-4">
                        <div class="card-body">
                            <h4 class="card-title">Add Attributes</h4>
                            <form class="col-12" action="{{ url('admin/set-attributes') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <div class="field_wrapper">
                                        <div>
                                            <input type="text" class="form-control" name="name" placeholder="Name" required />
                                            <!-- <a href="javascript:void(0);" class="btn add_button" title="Add field">+</a> -->
                                        </div>
                                    </div>
                                </div>                         
                                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
 
              <br>
           <h4 class="card-title">All Attributes</h4>
          <div class="table-responsive pt-3">
            <div class="row justify-content-center">  
            <div class="col-md-12">                       
               <form  action="{{ url('admin/update-attributes/') }}" method="post">
                @csrf
                <table class="table table-bordered" id="attribute_table">
                    <thead>
                        <tr>
                            <th> ID </th>
                             <th> Name </th>
                             <!--<th> SKU </th>
                            <th> Price </th>
                           <th> Stock </th>-->
                            <th> Actions </th> 
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($attributes as $attr)
                        <tr>
                        	<td> {{ $attr['id'] }} </td>
                            <td> {{ $attr['name'] }} </td>
                            <td> 
                                <a title="Delete Attributes" href="javascript:void(0)" class="confirmDelete" module="set-attribute" moduleid="{{ $attr['id'] }}"><i style="font-size: 2rem;" class="mdi mdi-file-excel-box"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                
              </form>
          </div>
            </div>
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