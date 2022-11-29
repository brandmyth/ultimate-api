@extends('admin.layout.layout')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">Customer Details</h3>
                        <h6 class="font-weight-normal mb-0"><a href="{{ url('admin/customers') }}">Back to Customers</a></h6>
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
                  <h4 class="card-title">Customer Personal Details</h4>
                    <div class="form-group">
                      <label>Email</label>
                      <input type="text" class="form-control" value="{{ $customerDetails['customer_email'] }}" readonly="">
                    </div>
                    <div class="form-group">
                      <label for="name">Customer Name</label>
                      <input type="text" class="form-control" value="{{ $customerDetails['customer_name'] }}" readonly="">
                    </div>
                    <div class="form-group">
                      <label for="mobile">Mobile</label>
                      <input type="text" class="form-control" value="{{ $customerDetails['customer_contact'] }}" readonly="">
                    </div>
                    <div class="form-group">
                      <label for="address">Gender</label>
                      <input type="text" class="form-control" value="{{ $customerDetails['customer_gender'] }}" readonly="">
                    </div>
              </div>
            </div>
        </div>
        <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Customer Address Details</h4>
                  @if(!empty($customerDetails['addresses']))
                    @foreach($customerDetails['addresses'] as $key=>$address)
                    <div class="form-group">
                      <label>Address {{++$key}}</label>
                      <textarea class="form-control" readonly="" rows="4">{{ $address['address'] }} &nbsp;{{ $address['area'] }} &nbsp;{{ $address['region'] }} &nbsp;{{ $address['city'] }} &nbsp;{{ $address['country'] }} &nbsp;
                      </textarea>
                    </div>
                    @endforeach
                    
                    @else
                    <h6>No Address Added!</h6>
                  @endif
              </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
    @include('admin.layout.footer')
    <!-- partial -->
</div>
@endsection