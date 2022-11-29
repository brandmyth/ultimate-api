@extends('admin.layout.layout')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{ $title }}</h4>
                        @if(Session::has('success_message'))
                          <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Success:</strong> {{ Session::get('success_message')}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          @endif
                          <div id="statusChangeMsgDiv">
                          </div>
                        <div class="table-responsive pt-3">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th> ID</th>
                                        <th> Customer </th>
                                        <th> Contact No </th>
                                        <th> Status </th>
                                        <th> Order Number </th>
                                        <th> Total Quantiy </th>
                                        <th> Total Amount </th>
                                        <th> Actions </th>
                                    </tr>
                                </thead>
                                <tbody>
                                	@foreach($orders as $order)
                                    <tr>
                                        <td> {{ $order['id'] }} </td>
                                        <td>{{ $order['customer_name']}}</td>
                                        <td>{{ $order['customer_phone']}}</td>
                                        <td>
                                            <select id="status-{{ $order['id'] }}" order_id="{{ $order['id'] }}" name="status" class="updateOrderStatus form-control" style="max-width: 10rem; min-width: 8rem;">
                                                <option>Select one</option>
                                                <option value="1" @if ($order['status'] == 'pending') selected @endif>Pending
                                                </option>
                                                <option value="2" @if ($order['status'] == 'processing') selected @endif>
                                                    Processing</option>
                                                <option value="3" @if ($order['status'] == 'completed') selected @endif>Completed
                                                </option>
                                                <option value="4" @if ($order['status'] == 'declined') selected @endif>Declined
                                                </option>
                                                <option value="5" @if ($order['status'] == 'on delivery') selected @endif>On delivery
                                                </option>
                                            </select>
                                        </td>
                                        <td>{{ $order['order_number'] }}</td>
                                        <td> {{ $order['totalQty'] }}</td>
                                        <td> {{ $order['pay_amount'] }}</td>
                                        
                                        
                                        <td> 
                                        	<a href="{{ url('admin/view-order-details/'.$order['id']) }}"><i style="font-size: 1.5rem;" class="mdi mdi-file-document"></i>
                                            </a>
                                            <a href="javascript:void(0)" class="confirmDelete" module="order" moduleid="{{ $order['id'] }}"><i style="font-size: 1.5rem;" class="mdi mdi-file-excel-box"></i>
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
    @push('scripts')
        <script type="text/javascript">
        </script>
    @endpush
    <!-- content-wrapper ends -->
    <!-- footer -->
    @include('admin.layout.footer')
    <!-- partial -->
</div>

@endsection