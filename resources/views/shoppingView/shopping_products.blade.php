@extends('layouts.client')

@section('content')
<link rel="stylesheet" href="{{ URL::asset('css/shopping_cart.css') }}">

<div class="container">


<div class="card">
    <form class="form-horizontal" method="POST" action="{{ route('products_post') }}">
     {{csrf_field()}}

<table class="table table-hover shopping-cart-wrap">
<thead class="text-muted">
<tr class="d-flex">
  <th class="col-4">{{ __('shop.product') }}</th>
  <th class="col-2" >{{ __('shop.price') }}</th>
  <th class="col-4" >{{ __('shop.quantity') }}</th>
  <th class="col-2" >{{ __('shop.total') }}</th>
 
</tr>
</thead>
<tbody>
       <?php $subtotal=0; ?>
  @foreach($products as $product)
<tr class="d-flex">
    <td class="col-4 align-middle">
<figure class="media">
    <div class="img-wrap"><img src="{{ URL::asset('images/') }}/{{$product['product_image']}}" class="img-thumbnail img-sm"></div>
    <figcaption class="media-body">
        <h6 class="title text-truncate"> {{$product['product_name']}}</h6>
         <input type="hidden" name="product_id[]" value="{{$product['product_id']}}">
        <input type="hidden" name="product_name[]" value="{{$product['product_name']}}">
        <input type="hidden" name="product_image[]" value="{{$product['product_image']}}">
        <input type="hidden" name="customer_type_id[]" />
    </figcaption>
</figure> 
    </td>
        <td class="col-2 align-middle"> 
        <div class="price-wrap"> 
            <var class="price">{{$product['product_price']}}</var> 
            <input type="hidden" name="product_price[]" value="{{$product['product_price']}}">
        </div> <!-- price-wrap .// -->
    </td>
    <td class="col-4 align-middle"> 

        <div class="col-6">
                  <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                    <button type="button" class="btn btn-primary btn-sm minus-btn" ><i class="fa fa-minus"></i></button>
                                </div>
                                <input type="text" name="product_quantity[]" class="form-control form-control-sm quantity_input" value="{{$product['product_quantity']}}" min="1">
                                <div class="input-group-prepend">
                                    <button type="button" class="btn btn-primary btn-sm plus-btn"><i class="fa fa-plus"></i></button>
                                </div>
                            </div>
                        </div>
    
    </td>
    <td class="col-2 align-middle"> 
        <div class="price-wrap"> 
            <var class="price price_total">
                @if (!empty($product['product_total']))
                    {{$product['product_total']}}
                @else
                    {{$product['product_price']}}
                @endif
                 EUR
               </var>
            @if (!empty($product['product_total']))
            <input type="hidden" name="product_total[]" value="{{$product['product_total']}}">
            @else
            <input type="hidden" name="product_total[]" value="{{$product['product_price']}}">
            @endif
        </div> <!-- price-wrap .// -->
    </td>

</tr>

<?php
if (!empty($product['product_total']))
    $subtotal+= $product['product_total'];
else
    $subtotal+= $product['product_price'];
?>
@endforeach
</tbody>
</table>
</div> <!-- card.// -->

<div class="row">
<div class="col-12">
    <div class="float-right">
        <p class="subtotal_title">Subtotal: </p> <p class="subtotal_value">€ {{$subtotal}}</p>
    </div>
</div>
</div>

<div class="row">
    <div class="col-12">
<div class="btn-toolbar float-right "> 
    <button type="submit" class="btn btn-primary  btn-space" data-id="2"><i class="fas fa-user"></i> Order as Customer</button>
    <button type="submit" class="btn btn-primary  btn-space" data-id="1"><i class="fas fa-building"></i> Order as Company</button>
   </div>
</div>
</div>
 </form>
<!-- order methods as a costumer or as company-->
</div> 



<!--container end.//-->

<script src="{{ URL::asset('js/shopping_cart.js') }}"></script>
<script src="{{ URL::asset('js/code/productsView.js') }}"></script>
@endsection
