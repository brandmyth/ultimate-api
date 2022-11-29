@extends('admin.layout.layout')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-6 stretch-card" style="margin-bottom: 0.5rem; width: 2rem;">
                <!-- <div class="card">
                    <div class="card-body"> -->
                        <button class="btn btn-primary" style="width: 14rem;">Footer Copyright</button>
                        <!-- <h4 class="card-title">Brands</h4> -->

                    <!-- </div>
                </div> -->
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
    <!-- footer -->
    @include('admin.layout.footer')
    <!-- partial -->
</div>

@endsection
