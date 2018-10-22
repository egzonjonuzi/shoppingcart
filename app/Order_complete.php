<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Mail;
use Session;

class Order_complete extends Model
{
    private $customer_id;
    private $order_id;
    private $order_total = 0;

    public function addCustomer()
    {
        //get customer main info
        if (Shopping_Steps::getSessionDataByStep(2)['data'] != null) {
            $customer = Shopping_Steps::getSessionDataByStep(2)['data'];
            $customer->fillable(['email', 'telephone']);
            $customer->save();
            $customer_id = $customer->id;
            if (!empty($customer_id)) {
                $this->customer_id = $customer->id;
                return true;
            } else return false;
        } else return false;
    }

    public function addCustomerAddress()
    {

        if (Shopping_Steps::getSessionDataByStep(3)['data'] != null && count(Shopping_Steps::getSessionDataByStep(3)['data']) == 2) {
            $customer_address_info = Shopping_Steps::getSessionDataByStep(3)['data'];

            $customer_address = $customer_address_info[0];
            $customer_delivery_address = $customer_address_info[1];
            $customer_address->change_fillable("insert_db");
            $customer_delivery_address->change_fillable("insert_db");
            $customer_address->customer_id = $this->customer_id;
            $customer_delivery_address->customer_id = $this->customer_id;
            $customer_address->save();
            $customer_delivery_address->save();

            $customer_address_id = $customer_address->id;
            $customer_delivery_address_id = $customer_delivery_address->id;


            if (empty($customer_address_id) || empty($customer_delivery_address_id)) return false;
            else return true;

        } else return false;
    }

    public function addOrder($data = array())
    {
        $order = new Order();
        $order->change_fillable(['customer_id']);
        $order->fill(['customer_id' => $this->customer_id]);
        $order->save();
        $this->order_id = $order->id;
        if (!empty($this->order_id)) return true;
        else return false;
    }

    public function addOrderDetails()
    {

        if (Shopping_Steps::getSessionDataByStep(1)['data'] != null) {
            $products = Shopping_Steps::getSessionDataByStep(1)['data'];
            foreach ($products as $key => $value) {
                if (isset($value['product_total']))

                    $this->order_total += floatval($value['product_total']);
                $value->change_fillable($value->fillable_insert_db);
                //$value->hidden = ['product_name','product_image'];
                $value->order_id = $this->order_id;

                if (isset($value->product_name)) ;
                unset($value->product_name);

                if (isset($value->product_image)) ;
                unset($value->product_image);
                $value->save();
                $order_details_id = $value->id;
                if (empty($order_details_id)) return false;

            }
            return true;
        }
    }

    public function addOrderShipping($data = array())
    {
        if (Shopping_Steps::getSessionDataByStep(4)['data'] != null) {
            $shipping_method = Shopping_Steps::getSessionDataByStep(4)['data'];
            $order_shipping = new Order_shipping();
            $order_shipping->change_fillable(['shipping_method_id', 'price', 'order_id']);
            $order_shipping->fill(['shipping_method_id' => $shipping_method['shipping_method_id'], 'price' => $shipping_method['price'], 'order_id' => $this->order_id]);
            $order_shipping->save();
            $order_shipping_id = $order_shipping->id;
            if (!empty($order_shipping_id)) return true;
            else return false;
        } else return false;
    }

    public function addOrderPayment($data = array())
    {
        if (Shopping_Steps::getSessionDataByStep(5)['data'] != null) {
            $payment_method = Shopping_Steps::getSessionDataByStep(5)['data'];
            $order_payment = new Order_payment();
            $order_payment->change_fillable(['payment_method_id', 'price', 'order_id']);
            $order_payment->fill(['payment_method_id' => $payment_method['payment_method_id'], 'price' => $payment_method['price'], 'order_id' => $this->order_id]);
            $order_payment->save();
            $order_payment_id = $order_payment->id;
            if (!empty($order_payment_id)) return true;
            else return false;
        } else return false;
    }

    public function updateOrder()
    {
        Order::where('order_id', $this->order_id)
            ->update(['order_total' => $this->order_total]);
        return true;
    }


    public function sendMail()
    {
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

        $data = ["shipping_method" => $shipping_methods, "payment_method" => $payment_methods, "purchased_product" => $order_details['data'], "client_address" => $client_address, "steps" => Shopping_Steps::getSessionStep(), "customer_type_id" => Session::get('customer_type_id')];

        Mail::send(['html' => '/shoppingView/mail'], $data, function ($message) {
            $client_data = Shopping_Steps::getSessionDataByStep(2)['data'];
            $client_address = Shopping_Steps::getSessionDataByStep(3)['data'][0];
            $message->to($client_data->email, $client_address->name . " " . $client_address->surname)->subject
            ('Your order at Turbado');
            $message->from('laravel.laravel.ks@gmail.com', 'Turbado Team');
        });

        if (Mail::failures()) {

            return false;
        }

        Mail::send(['html' => '/shoppingView/mail'], $data, function ($message) {
            $client_address = Shopping_Steps::getSessionDataByStep(3)['data'][0];
            $admin_data = User::firstOrFail();
            $message->to($admin_data->email, $client_address->name)->subject
            ('Turbado new order from ' . $client_address->name . ' ' . $client_address->surname);
            $message->from('laravel.laravel.ks@gmail.com', 'Turbado Team');

        });

        if (Mail::failures()) {
            return false;
        }

        return true;

    }

}
