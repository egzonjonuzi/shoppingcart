<div class="basket">
    <center><h5>Your shopping Cart</h5></center>
    <?php $total = 0; $total_with_discount = 0; $total_of_discount = 0; $total_shipping = 0; $total_payment = 0; $total_only_product = 0;?>
    @foreach($purchased_product as $products)
        <div class="card">
            <div class="img-wrap">
                <center>
                    <img class="img-thumbnail" src="{{ URL::asset('images/'.$products['product_image']) }}">
                </center>
            </div>
            <div class="card-body">
                <h6 class="card-title d-flex justify-content-center">{{$products['product_quantity'].' X '.$products['product_name']}}  </h6>
                <p class="card-text float-left inline-block price_total">Total</p>
                <p class="card-text float-right inline-block  price_total basket_price">{{number_format($products['product_total_without_discount'],2)}}
                    €</p>
            </div>
        </div>
        <?php
        $total += $products['product_total_without_discount'];
        $total_only_product += $products['product_total_without_discount'];
        $total_with_discount += $products['product_total'];
        $total_of_discount += (floatval($products['product_total_without_discount']) - (($products['product_total_without_discount']) / (1 + ($products['product_discount_percentage'] / 100))));
        ?>
    @endforeach
    @if(isset($steps) && $steps>3)
        <div class="card">
            <div class="card-body">
                <p class="card-text float-left inline-block price_total">Shipping</p>
                <p class="card-text float-right inline-block price_total payment_total basket_price">
                    <?php
                    foreach ($shipping_method as $method) {
                        if (isset($method['selected'])) {
                            echo $method['price'];
                            $total += $method['price'];
                            $total_with_discount += $method['price'];
                            $total_shipping = $method['price'];
                        }
                    }
                    ?>
                    €</p>
            </div>
        </div>
    @endif
    @if(isset($steps) && $steps>4)
        <div class="card">
            <div class="card-body">
                <p class="card-text float-left inline-block price_total">Payment</p>
                <p class="card-text float-right inline-block price_total payment_total basket_price">
                    <?php
                    foreach ($payment_method as $method) {
                        if (isset($method['selected'])) {
                            echo $method['price'];
                            $total += $method['price'];
                            $total_with_discount += $method['price'];
                            $total_payment = $method['price'];
                        }
                    }
                    ?>
                    €</p>
            </div>
        </div>
    @endif
    <div class="card">
        <div class="card-body nopaddingbottom">
            <p class="card-text float-left inline-block price_total">Total</p>
            <p class="card-text float-right inline-block price_total final_price price_total_product"
               data-price="{{$total_only_product}}">{{number_format($total_only_product,2)}} €</p>
        </div>
         @if(isset($steps) && $steps>4 && $customer_type_id==1)
        <div class="card-body nopaddingbottom">
           

                <p class="card-text float-left inline-block price_total">Warranty discount</p>
                <p class="card-text float-right inline-block price_total final_price warranty_total">{{number_format($total_of_discount,2)}}
                    €</p>
        </div>
        @endif
        <div class="card-body nopaddingbottom">
            <hr/>
            <p class="card-text float-left inline-block price_total">Shipping</p>
            <p class="card-text float-right inline-block price_total final_price shipping_total"
               data-price="{{$total_shipping}}">{{number_format($total_shipping,2)}} €</p>
        </div>

        <div class="card-body nopaddingbottom">
            <p class="card-text float-left inline-block price_total">Payment</p>
            <p class="card-text float-right inline-block price_total final_price">{{number_format($total_payment,2)}}
                €</p>
        </div>
        <div class="card-body nopaddingbottom">
            <hr/>
            <p class="card-text float-left inline-block price_total">Grand total</p>
            <p class="card-text float-right inline-block price_total final_price grand_total">{{number_format($total_with_discount,2)}}
                €</p>
        </div>
    </div>
</div>
</div>