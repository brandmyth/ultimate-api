@extends('admin.layout.layout')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">{{ $title }}</h4>
                            @if (Session::has('success_message'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>Success:</strong> {{ Session::get('success_message') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            <div id="statusChangeMsgDiv">
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4">
                                    <h6>Order Information</h6>
                                    <p>Order No: {{ $order->order_number }}</p>
                                    <p>Order Status: {{ $order->status }}</p>
                                    <p>Total Price: {{ $order->pay_amount }}</p>
                                    <p>Payment Status: {{ $order->payment_status }}</p>
                                </div>
                                <div class="col-md-4">
                                    <h6>Customer Information</h6>
                                    <p>Customer Name: {{ $order->customer_name }}</p>
                                    <p>Customer Phone: {{ $order->customer_phone }}</p>
                                    <p>Customer Address: {{ $order->customer_address }}</p>
                                    <p>Customer City: {{ $order->customer_city }}</p>
                                </div>
                                <div class="col-md-4">
                                    <h6>Shipping Information</h6>
                                    <p>Shipping Name: {{ $order->shipping_name }}</p>
                                    <p>Shipping Phone: {{ $order->shipping_phone }}</p>
                                    <p>Shipping Address: {{ $order->shipping_address }}</p>
                                    <p>Shipping City: {{ $order->shipping_city }}</p>
                                </div>
                                {{-- Order No: {{$order->order_number}}<br> --}}
                                <div class="col-md-12">
                                    <table class="table table-striped">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Quantity</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Price</th>
                                                <th scope="col">Sub Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @for ($i = 0; $i < count($cart); $i++)
                                                <tr>
                                                    <th scope="row">{{ $i + 1 }}</th>
                                                    <td>{{ $cart[$i]['quantity'] }}</td>
                                                    <td>{{ $cart[$i]['name'] }}</td>
                                                    <td>{{ $cart[$i]['price'] }}</td>
                                                    <td>{{ $cart[$i]['quantity'] * $cart[$i]['price'] }}</td>
                                                </tr>
                                            @endfor
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <h6>Payment Method: {{ $order->payment_method }}</h6>
                                </div>
                                <div class="col-md-6">
                                    <table class="table">
                                        {{-- <thead class="thead-dark">
                                    <tr>
                                      <th scope="col">#</th>
                                      <th scope="col">Name</th>
                                      <th scope="col">Price</th>
                                      <th scope="col">Quantity</th>
                                      <th scope="col">Sub Total</th>
                                    </tr>
                                  </thead> --}}
                                        <tbody>
                                            <tr>
                                                <td>Sub Total: </td>
                                                <td>
                                                    {{ $order->pay_amount - $order->shipping_cost }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Vat: </td>
                                                <td>
                                                    {{ $order->vat }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Shipping: </td>
                                                <td>
                                                    {{ $order->shipping_cost }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Total: </td>
                                                <td>
                                                    {{ $order->pay_amount }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @push('scripts')
            <script type="text/javascript"></script>
        @endpush
        <!-- content-wrapper ends -->
        <!-- footer -->
        @include('admin.layout.footer')
        <!-- partial -->
    </div>
@endsection
