<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\CustomerAddress;
use Illuminate\Support\Str;
use App\Models\Order;
use Symfony\Component\HttpFoundation\Response;
use Cart;

class OrderController extends Controller
{
    public function order(Request $request)
    {
        if ($request->isMethod('post')) {
            $message = "";
            $data = $request->all();


            $rules = [
                'products' => 'required',
                'payment_method' => 'required',
                'shipping_cost' => 'required',
                'vat' => 'required|numeric',
            ];
            $customMessages = [
                'products.required' => 'You need to add products to order!',
                'payment_method.required' => 'Payment method is required!',
                'shipping_cost.required' => 'Shipping cost is required!',
                'vat.required' => 'Product Price is required!',
                'vat.numeric' => 'Vat should be numeric!',
            ];
            $this->validate($request, $rules, $customMessages);

            if (empty($data['products']) || empty($data['payment_method']) || empty($data['shipping_cost']) || empty($data['vat'])) {
                $message = 'Products, Payment Method, Shipping Cost & Vat Required';
                return response()->json($message);
            }
            if ($data['customer_id']) {
                Cart::session($data['customer_id']);
            } else {
                Cart::session(150);
            }
            $i = 0;
            foreach ($data['products'] as $product) {
                // $i=$product['id'];
                Cart::add(array(
                    'id' => $i,
                    // 'id' =>$product['id'],
                    'name' => $product['product_name'],
                    'price' => $product['product_price'],
                    'quantity' => $product['qty']
                ));
                $i++;
                // dd($product['product_name']);
            }
            // dd(Cart::getContent());
            $order = new Order();
            if (!empty($data['customer_id'])) {
                $order->customer_id = $data['customer_id'];
            }
            $order->order_number = Str::random(6) . time();
            $order->cart = Cart::getContent();
            $order->totalQty = Cart::getTotalQuantity();

            if (empty($data['shipping_cost'])) {
                $order->shipping_cost = "0";
                if (!empty($data['vat'])) {
                    $order->pay_amount = Cart::getTotal() + (int)$data['vat'];
                } else {
                    $order->pay_amount = Cart::getTotal();
                }
            } else {
                if (!empty($data['vat'])) {
                    $order->pay_amount = Cart::getTotal() + (int)$data['shipping_cost'] + (int)$data['vat'];
                } else {
                    $order->pay_amount = Cart::getTotal() + (int)$data['shipping_cost'];
                }
                $order->shipping_cost = $data['shipping_cost'];
            }
            $order->payment_status = "pending";
            $order->payment_method = $data['payment_method'];
            $order->status = 1;
            if (!empty($data['order_note'])) {
                $order->order_note = $data['order_note'];
            }
            $order->vat = $data['vat'];
            if (!empty($data['customer_details'])) {
                $order->customer_name = $data['customer_details']['customer_name'];
                $order->customer_email = $data['customer_details']['customer_email'];
                $order->customer_phone = $data['customer_details']['customer_phone'];
                $order->customer_address = $data['customer_details']['customer_address'];
                $order->customer_city = $data['customer_details']['customer_city'];
                $order->customer_zip = $data['customer_details']['customer_zip'];
            }
            $order->shipping_name = $data['shipping_details']['customer_name'];
            $order->shipping_email = $data['shipping_details']['customer_email'];
            $order->shipping_phone = $data['shipping_details']['customer_phone'];
            $order->shipping_address = $data['shipping_details']['customer_address'];
            $order->shipping_city = $data['shipping_details']['customer_city'];
            $order->shipping_zip = $data['shipping_details']['customer_zip'];
            // dd($order);
            $order->save();

            // dd(Cart::getTotalQuantity());
            $message = 'Order Placed Successfully!';
            return response()->json($message);
        }
    }

    public function getCustomerOrders($customer_id)
    {
        $orders = Order::where('customer_id', $customer_id)->get();
        if (empty($orders[0])) {
            $message = 'You did not ordered anything yet!';
            return response()->json(['error_message' => $message]);
        }
        $allOrders = collect();
        foreach ($orders as $order) {
            $customValue['id'] = $order->id;
            $customValue['order_number'] = $order->order_number;
            $customValue['cart'] = json_decode($order->cart, 'true');
            $customValue['totalQty'] = $order->totalQty;
            $customValue['pay_amount'] = $order->pay_amount;
            $customValue['payment_status'] = $order->payment_status;
            $customValue['payment_method'] = $order->payment_method;
            $customValue['status'] = $order->status;
            $customValue['order_note'] = $order->order_note;
            $customValue['shipping_cost'] = $order->shipping_cost;
            $customValue['vat'] = $order->vat;
            $customValue['coupon_code'] = $order->coupon_code;
            $customValue['coupon_discount'] = $order->coupon_discount;
            $customValue['customer_name'] = $order->customer_name;
            $customValue['customer_phone'] = $order->customer_phone;
            $customValue['customer_address'] = $order->customer_address;
            $customValue['customer_city	'] = $order->customer_city;
            $customValue['customer_zip'] = $order->customer_zip;
            $customValue['shipping_name'] = $order->shipping_name;
            $customValue['shipping_email'] = $order->shipping_email;
            $customValue['shipping_phone'] = $order->shipping_phone;
            $customValue['shipping_address'] = $order->shipping_address;
            $customValue['shipping_city'] = $order->shipping_city;
            $customValue['order_date_time'] = $order->created_at;
            $allOrders->add($customValue);
        }
        return response($allOrders);
    }
}
