<?php

namespace App\Http\Controllers;


use App\Customer_type;
use App\Payment_method;
use App\Shipping_fee;
use App\Payment_fee;
use App\Shipping_method;
use Illuminate\Http\Request;
use App\Order;
use DB;
use Session;

class AdminController extends Controller
{
    public function index()
    {
        $order_information = Order::with('customer')->with('products')->get();
        return view('adminView/adminDashboard')->with(array('order_table' => $order_information));
    }

    public function get_shipping()
    {
        $shipping_fee_customer = Shipping_fee::where("customer_type_id", 2)->with('customer_type')->with('shipping_method_name')->get();
        $shipping_fee_company = Shipping_fee::where("customer_type_id", 1)->with('customer_type')->with('shipping_method_name')->get();
        return view('adminView/adminShipping')->with(array('shipping_fee_customer' => $shipping_fee_customer, 'shipping_fee_company' => $shipping_fee_company,"shipping_methods"=>Shipping_method::all(),"customer_type"=>Customer_type::all()));

    }

    public function post_add_shipping_method(Request $request)
    {
        $validatedData = $request->validate([
            'shipping_method_name' => 'required',
            'shipping_method_description' => 'nullable'
        ]);
        $shipping_method = new Shipping_method();
        $shipping_method->change_fillable(["shipping_method_name", "shipping_method_description"]);
        $shipping_method->fill($validatedData);

        //DB::transaction(function () use ($shipping_method) {
            $shipping_method->save();
            return response()->json(array(200, "success", Shipping_method::all()));
       // });

       // return response()->json(array(500, "error", route('admin_shipping')));
    }

    public function post_add_shipping_fee(Request $request)
    {
        $validatedData = $request->validate([
            'shipping_method_id' => 'required',
            'customer_type_id' => 'required',
            'price' => 'required'
        ]);
        $shipping_fee = new Shipping_fee();
        $shipping_fee->change_fillable(["shipping_method_id", "customer_type_id","price"]);
        $shipping_fee->fill($validatedData);

       // DB::transaction(function () use ($shipping_fee) {
            $shipping_fee->save();
            return redirect()->route('admin_shipping');
       // });

      //  return response()->json(array(500, "error", route('admin_shipping')));
    }

    public function get_payment()
    {
        $payment_fee_customer = Payment_fee::where("customer_type_id", 2)->with('customer_type')->with('payment_method_name')->get();
        $payment_fee_company = Payment_fee::where("customer_type_id", 1)->with('customer_type')->with('payment_method_name')->get();
        return view('adminView/adminPayment')->with(array('payment_fee_customer' => $payment_fee_customer, 'payment_fee_company' => $payment_fee_company,"payment_methods"=>Payment_method::all(),"customer_type"=>Customer_type::all()));
    }

    public function post_add_payment_method(Request $request)
    {
        $validatedData = $request->validate([
            'payment_method_name' => 'required',
            'payment_method_description' => 'nullable'
        ]);
        $payment_method = new Payment_method();
        $payment_method->change_fillable(["payment_method_name", "payment_method_description"]);
        $payment_method->fill($validatedData);

        //DB::transaction(function () use ($shipping_method) {
        $payment_method->save();
        return response()->json(array(200, "success", Payment_method::all()));
        // });

        // return response()->json(array(500, "error", route('admin_shipping')));
    }

    public function post_add_payment_fee(Request $request)
    {
        $validatedData = $request->validate([
            'payment_method_id' => 'required',
            'customer_type_id' => 'required',
            'price' => 'required'
        ]);
        $payment_fee = new Payment_fee();
        $payment_fee->change_fillable(["payment_method_id", "customer_type_id","price"]);
        $payment_fee->fill($validatedData);

        // DB::transaction(function () use ($shipping_fee) {
        $payment_fee->save();
        return redirect()->route('admin_payment');
        // });

        //  return response()->json(array(500, "error", route('admin_shipping')));
    }
}

?>