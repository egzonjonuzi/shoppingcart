<html>
<head>
    <style>
        .banner-color {
            background-color: #eb681f;
        }

        .title-color {
            color: #0066cc;
        }

        .button-color {
            background-color: #0066cc;
        }

        @media screen and (min-width: 500px) {
            .banner-color {
                background-color: #0066cc;
            }

            .title-color {
                color: #eb681f;
            }

            .button-color {
                background-color: #eb681f;
            }
        }
    </style>
</head>
<?php $total = 0; $total_with_discount = 0; $total_of_discount = 0; $total_shipping = 0; $total_payment = 0; $total_only_product = 0;?>
<body>
<div style="background-color:#ececec;padding:0;margin:0 auto;font-weight:200;width:100%!important">

    <table align="center" border="0" cellspacing="0" cellpadding="0"
           style="table-layout:fixed;font-weight:200;font-family:Helvetica,Arial,sans-serif" width="100%">
        <tbody>
        <tr>
            <td align="center">
                <center style="width:100%">
                    <table bgcolor="#FFFFFF" border="0" cellspacing="0" cellpadding="0"
                           style="margin:0 auto;max-width:800px;font-weight:200;width:inherit;font-family:Helvetica,Arial,sans-serif"
                           width="800">
                        <tbody>
                        <tr>
                            <td bgcolor="#F3F3F3" width="100%"
                                style="background-color:#f3f3f3;padding:12px;border-bottom:1px solid #ececec">
                                <table border="0" cellspacing="0" cellpadding="0"
                                       style="font-weight:200;width:100%!important;font-family:Helvetica,Arial,sans-serif;min-width:100%!important"
                                       width="100%">
                                    <tbody>
                                    <tr>
                                        <td align="left" valign="middle" width="50%"><span
                                                    style="margin:0;color:#4c4c4c;white-space:normal;display:inline-block;text-decoration:none;font-size:12px;line-height:20px"></span>
                                        </td>
                                        <td valign="middle" width="50%" align="right" style="padding:0 0 0 10px"><span
                                                    style="margin:0;color:#4c4c4c;white-space:normal;display:inline-block;text-decoration:none;font-size:12px;line-height:20px"></span>
                                        </td>
                                        <td width="1">&nbsp;</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>

                        <tr>
                            <td align="left">
                                <table border="0" cellspacing="0" cellpadding="0"
                                       style="font-weight:200;font-family:Helvetica,Arial,sans-serif" width="100%">
                                    <tbody>
                                    <tr>
                                        <td width="100%">
                                            <table border="0" cellspacing="0" cellpadding="0"
                                                   style="font-weight:200;font-family:Helvetica,Arial,sans-serif"
                                                   width="100%">
                                                <tbody>
                                                <tr>
                                                    <td align="center" bgcolor="#8BC34A"
                                                        style="padding:20px 48px;color:#ffffff" class="banner-color">
                                                        <table border="0" cellspacing="0" cellpadding="0"
                                                               style="font-weight:200;font-family:Helvetica,Arial,sans-serif"
                                                               width="100%">
                                                            <tbody>
                                                            <tr>
                                                                <td align="center" width="100%">
                                                                    <h1 style="padding:0;margin:0;color:#ffffff;font-weight:500;font-size:20px;line-height:24px">
                                                                        Your order details</h1>
                                                                </td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td align="center" style="padding:20px 0 10px 0">
                                                        <table border="0" cellspacing="0" cellpadding="0"
                                                               style="font-weight:200;font-family:Helvetica,Arial,sans-serif"
                                                               width="100%">
                                                            <tbody>
                                                            <tr>
                                                                <td align="center" width="100%"
                                                                    style="padding: 0 15px;text-align: justify;color: rgb(76, 76, 76);font-size: 12px;line-height: 18px;">
                                                                    <h3 style="font-weight: 600; padding: 0px; margin: 0px; font-size: 16px; line-height: 24px; text-align: center;"
                                                                        class="title-color"></h3>
                                                                    <p style="margin: 20px 0 30px 0;font-size: 15px;text-align: center;">
                                                                        Thank you for your
                                                                        order {{$client_address['name']}} {{$client_address['surname']}}
                                                                        , below you will find your order details.</p>

                                                                </td>
                                                            </tr>
                                                            </tbody>

                                                        </table>
                                                    </td>
                                                </tr>
                                                <tr>
                                                </tr>
                                                <tr>
                                                </tr>
                                                <tr>
                                                    <td align="center" style="padding-left: 30px;">
                                                        <table border="0" cellspacing="0" cellpadding="0"
                                                               style="font-weight:200;font-family:Helvetica,Arial,sans-serif"
                                                               width="100%">
                                                            <thead>
                                                            <th align="left">Product</th>
                                                            <th align="left">Quantity</th>
                                                            <th align="left">Price</th>
                                                            <th align="left">Total</th>
                                                            </thead>
                                                            <tbody>
                                                            @foreach($purchased_product as $products)
                                                                <tr>
                                                                    <td>{{$products['product_name']}}</td>
                                                                    <td style="padding-left: 30px;">{{$products['product_quantity']}}</td>
                                                                    <td>{{$products['product_price']}} €</td>
                                                                    <td>{{number_format($products['product_total_without_discount'],2)}}
                                                                        €
                                                                    </td>
                                                                </tr>
                                                                <?php
                                                                $total += $products['product_total_without_discount'];
                                                                $total_only_product += $products['product_total_without_discount'];
                                                                $total_with_discount += $products['product_total'];
                                                                $total_of_discount += (floatval($products['product_total_without_discount']) - (($products['product_total_without_discount']) / (1 + ($products['product_discount_percentage'] / 100))));
                                                                ?>

                                                            @endforeach

                                                            <?php


                                                            foreach ($shipping_method as $method) {
                                                                if (isset($method['selected'])) {

                                                                    $total += $method['price'];
                                                                    $total_with_discount += $method['price'];
                                                                    $total_shipping = $method['price'];


                                                                }
                                                            }




                                                            foreach ($payment_method as $method) {
                                                                if (isset($method['selected'])) {

                                                                    $total += $method['price'];

                                                                    $total_with_discount += $method['price'];
                                                                    $total_payment = $method['price'];
                                                                }
                                                            }
                                                            ?>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                                </tbody>

                                            </table>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <hr width="93%">
                            </td>
                        </tr>
                        <tr>
                            <td align="right" style="padding-right: 92px;">
                                <b>Total: {{number_format($total_only_product,2)}} €</b>
                            </td>
                        </tr>
                        @if($customer_type_id==1)
                            <tr>
                                <td align="right" style="padding-right: 92px;">
                                    <b>Warranty Discount: {{number_format($total_of_discount,2)}} €</b>
                                </td>
                            </tr>
                        @endif
                        <tr>
                            <td align="right" style="padding-right: 92px;">
                                <b>Shipping: {{number_format($total_shipping,2)}} €</b>
                            </td>
                        </tr>
                        <tr>
                            <td align="right" style="padding-right: 92px;">
                                <b>Payment: {{number_format($total_payment,2)}} €</b>
                            </td>
                        </tr>

                        <tr>
                            <td align="right" style="padding-right: 92px;">
                                <b>Grand Total: {{number_format($total_with_discount,2)}} €</b>
                            </td>
                        </tr>
                        <tr>
                            <td align="left">
                                <table bgcolor="#FFFFFF" border="0" cellspacing="0" cellpadding="0"
                                       style="padding:0 24px;color:#999999;font-weight:200;font-family:Helvetica,Arial,sans-serif"
                                       width="100%">
                                    <tbody>
                                    <tr>
                                        <td align="center" width="100%">
                                            <table border="0" cellspacing="0" cellpadding="0"
                                                   style="font-weight:200;font-family:Helvetica,Arial,sans-serif"
                                                   width="100%">
                                                <tbody>
                                                <tr>
                                                    <td align="center" valign="middle" width="100%"
                                                        style="border-top:1px solid #d9d9d9;padding:12px 0px 20px 0px;text-align:center;color:#4c4c4c;font-weight:200;font-size:12px;line-height:18px">
                                                        Regards,
                                                        <br><b>The Turbado Team</b>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="center" width="100%">
                                            <table border="0" cellspacing="0" cellpadding="0"
                                                   style="font-weight:200;font-family:Helvetica,Arial,sans-serif"
                                                   width="100%">
                                                <tbody>
                                                <tr>
                                                    <td align="center" style="padding:0 0 8px 0" width="100%"></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </center>
            </td>
        </tr>
        </tbody>
    </table>
</div>
</body>
</html>