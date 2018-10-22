<?php

namespace App\Http\Controllers;

use App\Product_warranty;
use DB;
use App\Customer;
use App\Customer_address;
use App\Customer_delivery_address;
use App\Order_complete;
use App\Payment_fee;
use Illuminate\Http\Request;
use App\Product;
use App\Order_details;
use App\Shipping_fee;
use App\Shopping_Steps;
use Session;


class ShoppingController extends Controller
{
    //Buying Steps
    public function index()
    {
        Session::forget('shopping_steps');
        Session::forget('shopping_data');
        Session::save();
        return redirect('/shopping');
    }

    public function get_shopping_products(Request $request)
    {
        //First Step
        if (Shopping_Steps::getSessionStatus() !== false) {  //Check if shopping has started
            $validatedData = $request->validate([
                'step' => 'nullable ']);
            if (isset($validatedData['step'])) {
                Shopping_Steps::setSessionStep(Shopping_Steps::getSessionStep() - 1);
                return redirect(url()->current());
            }

            if (Shopping_Steps::gotoStep(1) !== false) return Shopping_Steps::gotoStep(1);
            $order_details = Shopping_Steps::getSessionDataByStep(1);
            return view('shoppingView/shopping_products')->with(["products" => $order_details['data'], "menu" => Shopping_Steps::getMenu(), "btn_nav" => Shopping_Steps::getNavBtn()]);
        } else {
            Shopping_Steps::setSessionStep(1);
            return view('shoppingView/shopping_products')->with(["products" => Product::get(), "menu" => Shopping_Steps::getMenu(), "steps" => Shopping_Steps::getSessionStep(), "btn_nav" => Shopping_Steps::getNavBtn()]);
        }
    }

    public function post_shopping_products(Request $request)
    {
        if (Shopping_Steps::getSessionStep() !== false) {
            $validatedData = $request->validate([
                'product_name' => 'required',
                'product_quantity.*' => 'required',
                'product_id.*' => 'required',
                'product_price.*' => 'required',
                'product_total.*' => 'required',
                'product_image.*' => 'required',
                'customer_type_id' => 'required'
            ]);

            if (isset($validatedData['customer_type_id'])) {
                Shopping_Steps::setCustomerType(intval($validatedData['customer_type_id'][0]));
            }

            // if (Shopping_Steps::getCustomerType() == 1) {
            $validatedData['product_discount_percentage'] = 0;
            $validatedData['product_warranty_months'] = 0;
            $validatedData['product_total_without_discount'] = $validatedData['product_total'];
            // }

            $products_array = array();
            if (count($validatedData) > 0) {
                Shopping_Steps::setSessionStep(1);
                foreach ($validatedData[key($validatedData)] as $value) {
                    $products_array[] = new Order_details();

                }
                $prod_index = 0;
                foreach ($products_array as $value) {
                    $prod_temp = array();
                    foreach ($validatedData as $product_key => $product_value) {
                        if (is_array($product_value))
                            $prod_temp[$product_key] = $product_value[$prod_index];
                        else
                            $prod_temp[$product_key] = $product_value;
                    }
                    $products_array[$prod_index]->fill($prod_temp);
                    $prod_index++;
                }

                Shopping_Steps::setSessionData($products_array);
                Shopping_Steps::setSessionStep(2);

                return redirect()->route('contact');
            } else redirect('/');

        } else {
            echo redirect('/');
        }
    }

    public function get_shopping_client_information(Request $request)
    {
        if (Shopping_Steps::getSessionStatus() !== false) {
            $validatedData = $request->validate([
                'step' => 'nullable ']);
            if (isset($validatedData['step'])) {
                Shopping_Steps::setSessionStep(Shopping_Steps::getSessionStep() - 1);
                return redirect(url()->current());
            }
            if (Shopping_Steps::gotoStep(2) !== false) return Shopping_Steps::gotoStep(2);
            $order_details = Shopping_Steps::getSessionDataByStep(1); //get purchesed products
            $client_contact = Shopping_Steps::getSessionDataByStep(2); //get contact info;
            if (Shopping_Steps::getCustomerType() != null)
                return view('shoppingView/shopping_clientInformation')->with(["menu" => Shopping_Steps::getMenu(), "customer_type_id" => Shopping_Steps::getCustomerType(), "contact_info" => $client_contact['data'], "steps" => Shopping_Steps::getSessionStep(), "purchased_product" => $order_details['data'], "btn_nav" => Shopping_Steps::getNavBtn()]);
            else return view('shoppingView/shopping_clientInformation')->with(["menu" => Shopping_Steps::getMenu(), "contact_info" => $client_contact['data'], "steps" => Shopping_Steps::getSessionStep(), "purchased_product" => $order_details['data'], "btn_nav" => Shopping_Steps::getNavBtn()]);
        } else return redirect('/');
    }

    public function post_shopping_client_information(Request $request)
    {
        if (Shopping_Steps::getSessionStep() !== false) {
            if (Shopping_Steps::getCustomerType() == 2)
                $validatedData = $request->validate([
                    'email' => 'required',
                    'telephone' => 'required'
                ]);
            else
                $validatedData = $request->validate([
                    'email' => 'required',
                    'telephone' => 'required',
                    'company_name' => 'required',
                    'company_id' => 'required',
                    'taxi_id' => 'required'
                ]);

            Shopping_Steps::setSessionStep(2);
            $costumer = new Customer();
            if (Shopping_Steps::getCustomerType() == 2)
                $costumer->change_fillable(["telephone", "email"]);
            else $costumer->change_fillable(["telephone", "email", "company_id", "company_name", "taxi_id"]);
            $costumer->fill($validatedData);
            Shopping_Steps::setSessionData($costumer);
            Shopping_Steps::setSessionStep(3);

            return redirect()->route('address');

        } else {
            echo redirect('/');
        }
    }

    public function get_shopping_client_address(Request $request)
    {
        if (Shopping_Steps::getSessionStatus() !== false) {
            $validatedData = $request->validate([
                'step' => 'nullable ']);
            if (isset($validatedData['step'])) {
                Shopping_Steps::setSessionStep(Shopping_Steps::getSessionStep() - 1);
                return redirect(url()->current());
            }

            if (Shopping_Steps::gotoStep(3) !== false) return Shopping_Steps::gotoStep(3);

            $client_address = Shopping_Steps::getSessionDataByStep(3)['data'][0];
            $client_delivery_address = Shopping_Steps::getSessionDataByStep(3)['data'][1];
            $order_details = Shopping_Steps::getSessionDataByStep(1); //get purchesed products

            //die(json_encode(Shopping_Steps::getSessionDataByStep(3)['data']));
            return view('shoppingView/shopping_clientAddress')->with(["menu" => Shopping_Steps::getMenu(), "purchased_product" => $order_details['data'], "btn_nav" => Shopping_Steps::getNavBtn(), "steps" => Shopping_Steps::getSessionStep(), "client_address" => $client_address, "client_delivery_address" => $client_delivery_address]);
        }
        return redirect('/');
    }

    public function post_shopping_client_address(Request $request)
    {
        if (Shopping_Steps::getSessionStep() !== false) {
            $validatedData = $request->validate([
                'name.*' => 'required',
                'surname.*' => 'required',
                'product_id.*' => 'required',
                'street.*' => 'required',
                'house_number.*' => 'required',
                'zip.*' => 'required',
                'city.*' => 'required',
                'country.*' => 'required',
            ]);

            if (count($validatedData) > 0) {
                Shopping_Steps::setSessionStep(3);
                $products_array = array(new Customer_address(), new Customer_delivery_address());
                $prod_index = 0;
                foreach ($products_array as $value) {
                    $prod_temp = array();
                    foreach ($validatedData as $product_key => $product_value) {
                        $prod_temp[$product_key] = $product_value[$prod_index];
                    }
                    $products_array[$prod_index]->change_fillable("insert");
                    $products_array[$prod_index]->fill($prod_temp);
                    $prod_index++;
                }
                Shopping_Steps::setSessionData($products_array);
                Shopping_Steps::setSessionStep(4);

                return redirect()->route('shipping');
            } else redirect('/');

        } else {
            echo redirect('/');
        }
    }

    public function get_shopping_shipping_information(Request $request)
    {
        if (Shopping_Steps::getSessionStatus() !== false) {
            $validatedData = $request->validate([
                'step' => 'nullable ']);
            if (isset($validatedData['step'])) {
                Shopping_Steps::setSessionStep(Shopping_Steps::getSessionStep() - 1);
                return redirect(url()->current());
            }

            if (Shopping_Steps::gotoStep(4) !== false) return Shopping_Steps::gotoStep(4);
            $order_details = Shopping_Steps::getSessionDataByStep(1);

            if (Shopping_Steps::getCustomerType() != null) {
                $shipping_methods = Shipping_fee::where(array('customer_type_id'=> Shopping_Steps::getCustomerType(),'is_enabled'=>1))->with('shipping_method_name')->get(); //get purchesed products
                if (Shopping_Steps::getSessionDataByStep(4) != null) {
                    $selected_shipping_methods = Shopping_Steps::getSessionDataByStep(4);

                    foreach ($shipping_methods as $key => $value) {
                        if ($value['shipping_method_id'] == $selected_shipping_methods['data']['shipping_method_id']) {
                            $shipping_methods[$key]['selected'] = true;
                            break;
                        }
                    }
                }
            }

            return view('shoppingView/shopping_clientShipping')->with(["menu" => Shopping_Steps::getMenu(), "customer_type_id" => Session::get('customer_type_id'), "shipping_method" => $shipping_methods, "purchased_product" => $order_details['data'], "steps" => Shopping_Steps::getSessionStep(), "btn_nav" => Shopping_Steps::getNavBtn()]);
        }
    }

    public function post_shopping_shipping_information(Request $request)
    {

        if (Shopping_Steps::getSessionStep() !== false) {
            $validatedData = $request->validate([
                'shipping_method_id' => 'required',
                'customer_type_id' => 'required'
            ]);

            Shopping_Steps::setSessionStep(4);
            $validatedData['price'] = Shipping_fee::where(['customer_type_id' => Shopping_Steps::getCustomerType(), 'shipping_method_id' => $validatedData['shipping_method_id']])->firstOrFail()->price;
            $shipping = new Shipping_fee();
            $shipping->change_fillable(["shipping_method_id", "customer_type_id", "price"]);
            $shipping->fill($validatedData);
            Shopping_Steps::setSessionData($shipping);
            Shopping_Steps::setSessionStep(5);

            return redirect()->route('payment');

        } else {
            echo redirect('/');
        }
    }

    public function get_shopping_payment_information(Request $request)
    {
        $validatedData = $request->validate([
            'step' => 'nullable ']);
        if (isset($validatedData['step'])) {
            Shopping_Steps::setSessionStep(Shopping_Steps::getSessionStep() - 1);
            return redirect(url()->current());
        }

        if (Shopping_Steps::gotoStep(5) !== false) return Shopping_Steps::gotoStep(5);
        $order_details = Shopping_Steps::getSessionDataByStep(1);
        if (Shopping_Steps::getCustomerType() != null) {
            $shipping_methods = Shipping_fee::where(array('customer_type_id'=> Shopping_Steps::getCustomerType(),'is_enabled'=>1))->with('shipping_method_name')->get();
            $payment_methods = Payment_fee::where(array('customer_type_id'=> Shopping_Steps::getCustomerType(),'is_enabled'=>1))->with('payment_method_name')->get();
            $get_product_warranty = Product_warranty::all();

            foreach ($get_product_warranty as $key => $warranty) {
                if ($warranty->product_warranty_months == $order_details['data'][0]->product_warranty_months)
                    $get_product_warranty[$key]->selected = true;
            }

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
        }
        return view('shoppingView/shopping_clientPayment')->with(["warranty_method" => $get_product_warranty, "menu" => Shopping_Steps::getMenu(), "customer_type_id" => Session::get('customer_type_id'), "shipping_method" => $shipping_methods, "payment_method" => $payment_methods, "purchased_product" => $order_details['data'], "steps" => Shopping_Steps::getSessionStep(), "btn_nav" => Shopping_Steps::getNavBtn()]);
    }

    public function post_shopping_payment_information(Request $request)
    {
        if (Shopping_Steps::getSessionStep() !== false) {
            $validatedData = $request->validate([
                'payment_method_id' => 'required',
                'customer_type_id' => 'required',
                'product_warranty_id' => 'nullable'
            ]);

            if (Shopping_Steps::getCustomerType() != null && Shopping_Steps::getCustomerType() == 1 && !empty($validatedData['product_warranty_id'])) {
                $warranty_details = Product_warranty::where('product_warranty_id', $validatedData['product_warranty_id'])->firstOrFail();
                $get_products = Shopping_Steps::getSessionDataByStep(1)['data'];
                foreach ($get_products as $key => $value) {
                    $get_products[$key]->product_warranty_months = $warranty_details->product_warranty_months;
                    $get_products[$key]->product_discount_percentage = $warranty_details->product_warranty_discount_percentage;
                    $get_products[$key]->product_total_without_discount = $value['product_total_without_discount'];
                    $get_products[$key]->product_total = (($value['product_total_without_discount']) / (1 + ($warranty_details->product_warranty_discount_percentage / 100)));
                }
                Shopping_Steps::setSessionStep(1);
                Shopping_Steps::setSessionData($get_products);
            }

            Shopping_Steps::setSessionStep(5);
            $validatedData['price'] = Payment_fee::where(['customer_type_id' => Shopping_Steps::getCustomerType(), 'payment_method_id' => $validatedData['payment_method_id']])->firstOrFail()->price;
            $payment = new Payment_fee();
            $payment->change_fillable(["payment_method_id", "customer_type_id", "price"]);
            $payment->fill($validatedData);
            Shopping_Steps::setSessionData($payment);
            Shopping_Steps::setSessionStep(6);

            return redirect()->route('overall');

        } else {
            echo redirect('/');
        }
    }

    public function get_shopping_summary_information(Request $request)
    {
        if (Shopping_Steps::getSessionStep() !== false) {
            $validatedData = $request->validate([
                'step' => 'nullable ']);

            if (isset($validatedData['step'])) {
                Shopping_Steps::setSessionStep(Shopping_Steps::getSessionStep() - 1);
                return redirect(url()->current());
            }

            if (Shopping_Steps::gotoStep(6) !== false) return Shopping_Steps::gotoStep(6);

            $order_details = Shopping_Steps::getSessionDataByStep(1);
            $shipping_methods = Shipping_fee::where('customer_type_id', Shopping_Steps::getCustomerType())->with('shipping_method_name')->get();
            $payment_methods = Payment_fee::where('customer_type_id', Shopping_Steps::getCustomerType())->with('payment_method_name')->get();

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

            return view('shoppingView/shopping_clientSummary')->with(["menu" => Shopping_Steps::getMenu(), "customer_type_id" => Session::get('customer_type_id'), "shipping_method" => $shipping_methods, "payment_method" => $payment_methods, "purchased_product" => $order_details['data'], "steps" => Shopping_Steps::getSessionStep(), "btn_nav" => Shopping_Steps::getNavBtn()]);
        }
    }

    public function post_shopping_summary_information()
    {
        DB::transaction(function () {
            //show oder details
            $order_complete = new Order_complete();
            $order_complete->addCustomer();
            $order_complete->addCustomerAddress();
            $order_complete->addOrder();
            $order_complete->addOrderDetails();
            $order_complete->addOrderShipping();
            $order_complete->addOrderPayment();
            $order_complete->updateOrder();
            $order_complete->sendMail();
            Shopping_Steps::setSessionStep(7);
        }, 5);

        return redirect()->route('complete');

    }

    public function get_shopping_order_complete()
    {
        if (Shopping_Steps::getSessionStep() !== false) {
            Session::forget('shopping_steps');
            Session::forget('shopping_data');
            Session::forget('customer_type_id');
            Session::save();
            return view('shoppingView/shopping_clientComplete');
        } else return redirect('/');
    }

}