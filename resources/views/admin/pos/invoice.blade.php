@extends('admin.layout.layout')
@section('content')	

<style type="text/css">
.table > tbody > tr > .no-line {
    border-top: none;
}
.table > thead > tr > .no-line {
    border-bottom: none;
}
.table > tbody > tr > .thick-line {
    border-top: 2px solid;
}
.no-line-shadow{
	border: none !important;
}
.display-none{
    display: none;
}
.modal-header .close {
    margin: -1rem -1rem -1rem 0rem !important;
}
.pull-right{
    padding-left: 5rem;
    padding-top:  0.2rem;
    margin-bottom: 0rem !important;
}
</style>

<div class="container">
    <div class="row">
        <div class="col-xl-12">
    		<div class="invoice-title">
    			<h2 class="text-center">Invoice</h2>
    			<h5 class="text-center">Order # 12345</h5>
    		</div>
    		<hr>
    		<div class="row">
    			<div class="col-xl-6">
    				<address>
    				<strong>Billed To:</strong><br>
    					Name: {{ $customer->customer_name }}<br>
    					Contact No: {{ $customer->customer_contact }}<br>
    					Email: {{ $customer->customer_email }}<br>
    				</address>
    			</div>
    			<div class="col-xl-6 text-right">
    				<address>
        			<strong>Shipped To:</strong><br>
    					Jane Smith<br>
    					1234 Main<br>
    					Apt. 4B<br>
    					Springfield, ST 54321
    				</address>
    			</div>
    		</div>
    		<div class="row">
    			<div class="col-xl-6">
    				<address>
    					<strong>Payment Method:</strong><br>
    					Visa ending **** 4242<br>
    					jsmith@email.com
    				</address>
    			</div>
    			<div class="col-xl-6 text-right">
    				<address>
    					<strong>Order ID:</strong><br>
    					<h6>Create order table and show id</h6>
    					<strong>Order Date:</strong><br>
    					{{date('d/m/y')}}<br><br>
    				</address>
    			</div>
    		</div>
    	</div>
    </div>
    <div class="row">
    	<div class="col-md-12">
    		<div class="panel panel-default">
    			<div class="panel-heading">
    				<h3 class="panel-title"><strong>Order summary</strong></h3>
    			</div>
    			<div class="panel-body">
    				<div class="table-responsive">
    					<table class="table table-condensed" id="tblData">
    						<thead>
                                <tr>
        							<td><strong>Item</strong></td>
        							<td class="text-center"><strong>Name</strong></td>
        							<td class="text-center"><strong>Quantity</strong></td>
        							<td class="text-center"><strong>Unit Cost</strong></td>
        							<td class="text-center"><strong>Total</strong></td>
                                </tr>
    						</thead>
    						<tbody>
    							@php
    								$sl=1;
    							@endphp
    							@foreach($contents as $content)
    							<tr>
    								<td>{{ $sl++ }}</td>
    								<td class="text-center">{{ $content->name }}</td>
    								<td class="text-center">{{ $content->quantity }}</td>
    								<td class="text-center">{{ $content->price }}</td>
    								<td class="text-center">{{ $content->price*$content->quantity }}</td>
    							</tr>
                               @endforeach
                               	<tr>
    								<td class="thick-line"></td>
    								<td class="thick-line"></td>
    								<td class="thick-line"></td>
    								<td class="thick-line text-center"><strong>Sub Total: </strong></td>
    								<td class="thick-line text-center">{{ Cart::getSubTotal() }}</td>
    							</tr>
    							<tr>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line text-center"><strong>Vat: </strong></td>
    							</tr>
    							<tr>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line text-center"><strong>Total: </strong></td>
    								<td class="no-line text-center">{{ Cart::getTotal() }}</td>
    							</tr>
    						</tbody>
    						<tfoot>
    							<tr>
    								<th class="no-line-shadow col-lg-12">
                                        <div class="row">
                                        <div class="col-lg-12 text-center">
                                            <a href="" class="btn btn-add-customer btn-primary"  data-toggle="modal" data-target="#exampleModal">Submit</a>
                                        </div>  		
                                        </div>							
    								</th>
    							</tr>
    						</tfoot>
    					</table>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Invoice of {{$customer->customer_name}}</h5>
                <h5 class="pull-right">total: {{Cart::getTotal()}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 grid-margin stretch-card">
                      <div class="card">
                        <div class="card-body">
                          <form class="forms-sample" action="{{ url('admin/final-invoice') }}"  method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="customer_id" value="{{$customer->id}}">
                            <input type="hidden" name="order_date" value="{{ date('d/m/y') }}">
                            <input type="hidden" name="status" value="pending">
                            <input type="hidden" name="payment_status" value="pending">
                            <input type="hidden" name="totalQty" value="{{Cart::getContent()->count()}}">
                            <div class="">
                                <p>Payment</p>
                                <select class="form-control" id="payment_method" name="payment_method">

                                    <option selected disabled value="">Select Payment</option>
                                    <option value="handcash">Handcash</option>
                                    <option value="bkash">Bkash</option>
                                    <option value="due">Due</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Amount</label>
                                <input type="text" class="form-control" id="pay_amount" name="pay_amount"placeholder="amount" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label>Due</label>
                                <input type="text" class="form-control" id="due" name="due"placeholder="Due" autocomplete="off">
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                <button type="reset" class="btn btn-warning" data-dismiss="modal">Cancel</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Modal -->
@endsection