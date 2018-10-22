<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Session;


class Shopping_Steps extends Model
{
    private static $session_shopping_steps_name = "shopping_steps";
    private static $session_shopping_data_name = "shopping_data";

    private static $session_shopping_customer_type ="customer_type_id";

    public static function getSessionStatus()
    {
        if ((Session::has(self::$session_shopping_steps_name) && Session::has(self::$session_shopping_steps_name) != NULL) && (Session::has(self::$session_shopping_data_name) && Session::has(self::$session_shopping_data_name) != NULL)) {
            return true;
        } else return false;
    }

    public static function getSessionStep()
    {
        if (Session::has(self::$session_shopping_steps_name))
            return Session::get(self::$session_shopping_steps_name);
        else return false;
    }

    public static function setSessionStep($id_step)
    {
        if ($id_step != null && is_numeric($id_step)) {
            if ($id_step < 1) $id_step = 1;
            else if ($id_step > count(Shopping_Steps::getMenu())) $id_step = count(Shopping_Steps::getMenu());
            Session::put(self::$session_shopping_steps_name, $id_step);
        }
    }

    public static function gotoStep($id_function_step=null, $route_string = false)
    {
        if (Session::has(self::$session_shopping_steps_name)) {
            if ( Shopping_Steps::getSessionStep() == $id_function_step) return false;
            if($route_string===false)
            $id_function_step = Shopping_Steps::getSessionStep();

            switch ($id_function_step) {
                case 1:
                    if ($route_string)
                        return route('products');
                    else
                        return redirect()->route('products');
                    break;
                case 2:
                    if ($route_string )
                        return route('contact');
                    else return redirect()->route('contact');
                case 3:
                    if ($route_string )
                        return route('address');
                   else return redirect()->route('address');
                case 4:
                    if ($route_string )
                        return route('shipping');
                    else return redirect()->route('shipping');
                case 5:
                    if ($route_string )
                        return route('payment');
                    else return redirect()->route('payment');
                case 6:
                    if ($route_string )
                        return route('overall');
                    else return redirect()->route('overall');
                case 7:
                    if ($route_string )
                        return route('complete');
                    else return redirect()->route('complete');
                default:
                    if ($route_string )
                        return '/';
                    else
                    return redirect('/');
                    break;
            }
        } else {
            return redirect('/');
        }
    }

    public static function getSessionDataByStep($id_step)
    {
        foreach (Session::get(self::$session_shopping_data_name) as $key => &$value) {
            if (isset($value['id']) && $value['id'] == $id_step) {
                return $value;
            }
        }
    }

    public static function setSessionData($data)
    {
        if (Shopping_Steps::getSessionStatus() !== false) {
            $found = false;
            $session_data = Session::get(self::$session_shopping_data_name);
            foreach ($session_data as $key => &$value) {
                if (isset($value['id']) && intval($value['id']) === Shopping_Steps::getSessionStep()) {
                    $session_data[$key]['data'] = $data;
                    $found = true;
                    break;
                }
            }
            if ($found === false) {
                $session_data[] = array("id" => Shopping_Steps::getSessionStep(), "data" => $data);
            }
            Session::put(Shopping_Steps::$session_shopping_data_name, $session_data);

        } else if (Shopping_Steps::getSessionStep() !== false) {
            $data = array(array("id" => Shopping_Steps::getSessionStep(), "data" => $data));
            Session::put(Shopping_Steps::$session_shopping_data_name, $data);
        }
    }

    public static function getMenu()
    {
        $menu = array(
            array("id" => 1, "menu_title" => "Shopping Cart", "url" => redirect()->route('products')),
            array("id" => 2, "menu_title" => "Contact", "url" => redirect()->route('contact')),
            array("id" => 3, "menu_title" => "Address", "url" => redirect()->route('products')),
            array("id" => 4, "menu_title" => "Shipping", "url" => redirect()->route('products')),
            array("id" => 5, "menu_title" => "Payment", "url" => redirect()->route('products')),
            array("id" => 6, "menu_title" => "Overall", "url" => redirect()->route('products')));

        foreach ($menu as $key => $value) {
            if (Shopping_Steps::getSessionStep() == $value['id']) $menu[$key]['active'] = true;
            else $menu[$key]['active'] = false;
        }
        return $menu;
    }

    public static function getNavBtn()
    {
        $menu = Shopping_Steps::getMenu();
        $btn_result = array();
        if (Shopping_Steps::getSessionStep() > 0) $btn_result['back'] = array("url" => Shopping_Steps::gotoStep(Shopping_Steps::getSessionStep()-1,true)."?step=true");
        if (Shopping_Steps::getSessionStep() + 1 < count($menu)) $btn_result['next'] = array("url" => Shopping_Steps::gotoStep(Shopping_Steps::getSessionStep()+1,true));
        return $btn_result;
    }

    public static function setCustomerType($type) {
        Session::put(Shopping_Steps::$session_shopping_customer_type,$type);
    }

    public static function getCustomerType() {
        if(Session::has(Shopping_Steps::$session_shopping_customer_type)) return Session::get(Shopping_Steps::$session_shopping_customer_type);
        else return null;
    }
}
