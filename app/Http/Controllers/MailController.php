<?php

namespace App\Http\Controllers;
use Mail;
use DB;
use App\Payment_fee;
use App\Shipping_fee;
use App\Shopping_Steps;
use Session;

class MailController extends Controller
{
    public function basic_email(){

        $order_details = Shopping_Steps::getSessionDataByStep(1);
        $shipping_methods = Shipping_fee::where('customer_type_id', Shopping_Steps::getCustomerType())->with('shipping_method_name')->get();
        $payment_methods = Payment_fee::where('customer_type_id', Shopping_Steps::getCustomerType())->with('payment_method_name')->get();
        $client_data = Shopping_Steps::getSessionDataByStep(2)['data'];
        $client_address = Shopping_Steps::getSessionDataByStep(3)['data'][0];

        if (Shopping_Steps::getSessionDataByStep(4) != null) {
            $selected_shipping_methods = Shopping_Steps::getSessionDataByStep(4);
            foreach ($shipping_methods as $key => $value) {
                if ($value['shipping_method_id'] == $selected_shipping_methods['data']['shipping_method_id']) {
                    $shipping_methods[$key]['selected'] = true;
                    break;
                }
            }
        }
        if (Shopping_Steps::getSessionDataByStep(5) != null) {
            $selected_payment_methods = Shopping_Steps::getSessionDataByStep(5);
            foreach ($payment_methods as $key => $value) {
                if ($value['payment_method_id'] == $selected_payment_methods['data']['payment_method_id']) {
                    $payment_methods[$key]['selected'] = true;
                    break;
                }
            }
        }
        $data = ["shipping_method" => $shipping_methods, "payment_method" => $payment_methods, "purchased_product" => $order_details['data'],"client_address"=>$client_address,"steps"=>Shopping_Steps::getSessionStep(),"customer_type_id" => Session::get('customer_type_id')];

       return view('shoppingView/mail',$data);
    }
}
