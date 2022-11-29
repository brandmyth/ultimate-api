@extends('admin.layout.layout')
<style type="text/css">
.table-responsive {
    overflow-x: hidden !important;
}
.custom-textbox-size{
    width: 25rem;
}
</style>
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <h3 class="font-weight-bold text-center">Attributes</h3>
        <div class="row justify-content-center">
            <div class="col-md-12 ">
                <div class="row justify-content-center">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Add Attributes</h4>
                        <form  action="{{ url('admin/add-attributes') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <div class="field_wrapper">
                                    <div>
                                        <input type="text" class="custom-textbox-size" name="name" placeholder="Name" required />
                                        <!-- <a href="javascript:void(0);" class="btn add_button" title="Add field">+</a> -->
                                    </div>
                                </div>
                            </div>                         
                            <button type="submit" class="btn btn-primary mr-2">Submit</button>
                        </form>
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