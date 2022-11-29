@extends('admin.layout.layout')
@section('content')
<style>
    /*.fa-check::before{
        display: none;
    }*/
    .update-number{
        width: 25%;
        height: 2.5rem;
    }
    .dataTables_length{
        display: none;
    }
* {
  box-sizing: border-box;
}
.invoice-table{
    padding: 1.5rem;
}
/*.customer-box{
    margin: 1rem;
    background-color: #ddd;
}*/
.btn-add-customer{
    width: 100%;
    
}
.customer-box,
.columns {
  padding: 15px 15px 15px 15px;
}

.price {
  list-style-type: none;
  border: 1px solid #eee;
  margin: 0;
  padding: 0;
  -webkit-transition: 0.3s;
  transition: 0.3s;
}

.price:hover {
  box-shadow: 0 8px 12px 0 rgba(0,0,0,0.2)
}

.price .header {
/*  background-color: #111;*/
  color: #000;
  font-size: 25px;
}

.price li {
  border-bottom: 1px solid #eee;
  padding: 20px;
  text-align: center;
}

.price .grey {
  background-color: #eee;
  font-size: 20px;
}

.button {
  background-color: #0098b8;
  border: none;
  color: white;
  padding: 10px 25px;
  text-align: center;
  text-decoration: none;
  font-size: 18px;
}

@media only screen and (max-width: 600px) {
  .columns {
    width: 100%;
  }
}
</style>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row pt-5">
            <div class="col-lg-6">
                
                <div class="row invoice-table text-center">
                	<table class="table">
                		<thead>
                			<tr>
            					<th>Name</th>
            					<th>Quantity</th>
            					<th>Single Price</th>
            					<th>Sub Total</th>
            					<th>Action</th>
            				</tr>
                		</thead>

                		@php
                        $cart_product = Cart::getContent();
                		@endphp

            			<tbody>
            				@foreach($cart_product as $show_cart)
            				<tr>
            					<th>{{ $show_cart->name }}</th>
            					<th>
            						<form action="{{ url('admin/cart-pos-product-update/'.$show_cart->id) }}" method="post">
            							@csrf
            							<input class="text-center update-number" type="number" name="quantity" value="{{$show_cart->quantity}}">
            							<button type="submit" class="btn btn-sm btn-success"><i class="fas fa-check"></i></button>
            						</form>
            					</th>
            					<th>{{$show_cart->price}}</th>
            					<th>{{$show_cart->quantity * $show_cart->price}}</th>
            					<th><a href="{{ url('admin/cart-pos-product-remove/'.$show_cart->id) }}"><i class="fa-solid fa-trash text-danger"></i></a></th>
            				</tr>
            				@endforeach
            			</tbody>
                	</table>
                </div>





                <div class="columns">
            <ul class="price">
                
                <!-- <li class="grey text-danger">Product not added</li> -->
            </ul>




                <form method="POST" action="{{ url('admin/create-invoice') }}">
                    @csrf
                    @if ($errors ->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
           <!--  <h5 class="text-center pt-3">Customer</h5> -->
                    
                    <ul class="price">
                        <li class="header">Invoice</li>
                        <li>
                            <div class="row customer-box">
                                <div class="col-lg-8">
                                    <select class="form-control" id="cus_id" name="cus_id">
                                        <option selected disabled value="">Select existing user</option>
                                        @foreach($customers as $customers)
                                            <option value="{{ $customers->id }}" >{{ $customers->customer_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-4">
                                    <a href="" class="btn btn-add-customer btn-primary"  data-toggle="modal" data-target="#exampleModal">Add customer</a>
                                </div>
                            </div>
                        </li>

                        
                        <li>Quantity: {{Cart::getContent()->count()}}</li>
                        <li>Sub Total: {{Cart::getSubTotal()}}</li>
                        <li>Total: {{Cart::getTotal()}}</li>
                        <li class="grey"><button type="submit" class="btn button">Create Invoice</button></li>
                        <!-- <button type="submit" class="btn btn-success">Create Invoice</button> -->
                    </ul>
                    <!-- <div class="grey">
                        <button type="submit" class="btn btn-success">Create Invoice</button>
                    </div> -->
                    </form>
                </div>
                
            </div>




            <div class="col-lg-6">
                <table class="table table-bordered" id="ssDataTable">
                    <thead>
                        <tr>
                            <th> Add  </th>
                            <th> Product Name </th>
                            <th> Category </th>
                            <th> Price </th>
                            <th> Who Add </th>
                            <th> Qty </th>
                            <th> Image </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($product as $product)
                        <tr class="text-center">
                            <form action="{{ url('admin/cart-pos-product') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $product->id }}">
                                <input type="hidden" name="name" value="{{ $product->product_name }}">
                                <input type="hidden" name="price" value="{{ $product->product_price }}">
                                <input type="hidden" name="quantity" value="{{ $product->product_qty }}">
                                <td> 
                                    <button type="submit" class="btn btn-sm btn-info"><i class="fa-solid fa-square-plus"></i></button>
                            </td>
                            <td> {{ $product->product_name }} </td>
                            <td> {{ $product->category_name }} </td>
                            <td> {{ $product->product_price }} </td>
                            
                            <td> 
                                @if($product->admin_type =="vendor")
                                <a target="_blank" href="{{ url('admin/view-vendor-details/'.$product->admin_id) }}">
                                    {{ ucfirst($product->admin_type) }}</a>
                                @else
                                    {{ ucfirst($product->admin_type) }} 
                                @endif
                            </td>
                            <td> {{ $product->product_qty }} </td>
                            <td> 
                                @if(!empty($product->product_image))
                                
                                    <img class="img-fluid" src="{{ asset('frontend/images/product_images/small/'.$product->product_image) }}">
                                @else
                                <a href=""><i class="fa-solid fa-square-plus"></i></a>
                                    <img class="img-fluid" src="{{ asset('frontend/images/product_images/small/dummy.png') }}">
                                @endif
                            </td>
                            </form>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Customer</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        

        <div class="row">
                    <div class="col-md-12 grid-margin stretch-card">
                      <div class="card">
                        <div class="card-body">
                          <form class="forms-sample" action="{{ url('admin/add-customer') }}"  method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                              <label>Name</label>
                              <input type="text" class="form-control" id="customer_name" name="customer_name"placeholder="Name" autocomplete="off">
                            </div>
                            <div class="form-group">
                              <label>Password</label>
                              <input type="password" class="form-control" id="customer_password" name="customer_password"placeholder="Password" autocomplete="off">
                            </div>
                            <div class="form-group">
                              <label>Email</label>
                              <input type="text" class="form-control" id="customer_email" name="customer_email"placeholder="Email" autocomplete="off">
                            </div>
                            <div class="form-group">
                              <label for="name">DOB</label>
                              <input type="date" class="form-control" id="customer_dob" name="customer_dob"placeholder="DOB">
                            </div>
                            <div class="form-group">
                              <label for="mobile">Contact No</label>
                              <input type="text" class="form-control" id="customer_contact" name="customer_contact" placeholder="Contact No">
                            </div>
                            <div class="form-group">
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="radio" name="customer_gender" id="customer_gender" value="male">
                                  <label class="form-check-label" for="inlineRadio1">male</label>
                                </div>
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="radio" name="customer_gender" id="customer_gender" value="female">
                                  <label class="form-check-label" for="inlineRadio2">female</label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mr-2">Submit</button>
                            <button type="reset" class="btn btn-light">Cancel</button>
                          </form>
                        </div>
                      </div>
                    </div>
                </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<!-- End Modal -->
@endsection
