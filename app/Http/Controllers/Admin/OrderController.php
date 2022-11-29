<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\CustomerAddress;
use App\Models\Order;
use Maatwebsite\Excel\Concerns\ToArray;
use DB;
use Cart;

class OrderController extends Controller
{
    public function orders($type){
    	
    	$orders = Order::query();
    	if ($type != "all") {
    		$orders = $orders->where('status',$type);
    		$title = ucfirst($type)."Orders";
    	}
    	else{
    		$title = "All Orders";
    	}
    	$orders = $orders->get()->toArray();

    	return view('admin.orders.orders')->with(compact('orders','title'));
    }
	public function changeOrderStatus(Request $request)
    {

        if ($request->ajax()) {
            $data = $request->all();
            // dd($data);
            Order::where('id', $data['order_id'])->update(['status' => $data['status']]);

            return response()->json(['message' => 'Order Status Updated']);
        }
    }

	public function viewOrderDetails($id){
    	$title = "Order Details";
		$cart = array();
    	$order = Order::find($id);
    	$cart = json_decode($order->cart,'true');

    	return view('admin.orders.orderDetails')->with(compact('order','cart','title'));
    }
    // POS
    public function pos()
    {
        // $admin = Admin::all();
        // $category = DB::table('categories')->get();
        
        $customers = DB::table('customers')->get();
        $admin = DB::table('admins')->get();
        $product = DB::table('products')
        ->join('categories','products.category_id','categories.id')
        ->select('categories.category_name','products.*')
        ->get();
        return view('admin.pos.add_edit_pos', compact('customers','product'));
    }

    public function cartProduct(Request $request){
        $data = array();
        $data['id']=$request->id;
        $data['name']=$request->name;
        $data['price']=$request->price;
        // $data['quantity']=$request->qty;
         $data['quantity']= 1;

        $cart = Cart::add($data);
        if ($cart) {
            $notification=array(
                'message' => 'Product Added',
                'alert-type' => 'success',
                );
            return redirect()->back()->with($notification);
        }
        else{
            $notification=array(
                'message' => 'error',
                'alert-type' => 'success',
                );
            return redirect()->back()->with($notification);
        }
    }
    public function updateCartProduct(Request $request, $id){
        $quantity= $request->quantity;
        $id = $request->id;
        $update = Cart::update($id, ['quantity' => ['relative' => false,
            'value' => $quantity
            ]
        ]);
      
        if ($update) {
            $notification=array(
                'message' => 'Product update',
                'alert-type' => 'success',
                );
            return redirect()->back()->with($notification);
        }
        else{
            $notification=array(
                'message' => 'error',
                'alert-type' => 'success',
                );
            return redirect()->back()->with($notification);
        }
    }
    public function removeCartProduct($id){
        $remove = Cart::remove($id);
        if ($remove) {
            $notification=array(
                'message' => 'Product remove',
                'alert-type' => 'success',
                );
            return redirect()->back()->with($notification);
        }
        else{
            $notification=array(
                'message' => 'error',
                'alert-type' => 'success',
                );
            return redirect()->back()->with($notification);
        }
    }
    public function createInvoice(Request $request){
        $request->validate([
            'cus_id' => 'required',
        ],
        [
            'cus_id.required' => 'Select a customer first',
        ]);
        $customer_id=$request->cus_id;
        $customer=DB::table('customers')->where('id', $customer_id)->first();
        $contents=Cart::getContent();
        return view('admin.pos.invoice', compact('customer','contents'));
    }

    public function finalInvoice(Request $request){
        $request->validate([
            'payment_method' => 'required',
        ],
        [
            'payment_method.required' => 'Select your payment first',
        ]);
        $data = array();
        $data['customer_id'] = $request->customer_id;
        $data['order_date'] = $request->order_date;
        $data['status'] = $request->status;
        $data['payment_status'] = $request->payment_status;
        $data['totalQty'] = $request->totalQty;
        $data['payment_method'] = $request->payment_method;
        $data['pay_amount'] = $request->pay_amount;
        $data['due'] = $request->due;
        $contents = collect();
        foreach (Cart::getContent() as $cart) {
            $contents->add($cart);
        }
        $data['cart'] = $contents;
        $data['order_number'] = rand(1000, 9999).str_pad( $data['customer_id'], 3, STR_PAD_LEFT);
        $insert = DB::table('orders')->insert($data);  
        if ($insert) {
            $notification=array(
                'message' => 'Successfully invoice created',
                'alert-type' => 'success',
                );
            Cart::clear();
            // return redirect('admin/dashboard');
            return redirect('admin/dashboard')->with($notification);
        }
        else{
            $notification=array(
                'message' => 'error',
                'alert-type' => 'success',
                );
            return redirect()->back()->with($notification);
        }
    }
}





                                            // @for ($i = 0; $i < count($cart); $i++)
                                            //     <tr>
                                            //         <th scope="row">{{ $i + 1 }}</th>
                                            //         <td>{{ $cart[$i]['quantity'] }}</td>
                                            //         <td>{{ $cart[$i]['name'] }}</td>
                                            //         <td>{{ $cart[$i]['price'] }}</td>
                                            //         <td>{{ $cart[$i]['quantity'] * $cart[$i]['price'] }}</td>
                                            //     </tr>
                                            // @endfor