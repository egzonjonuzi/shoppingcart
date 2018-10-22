@extends('layouts.client')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-8">
            	 <div class="row">
                                <div class="col-12">
                                    <h5 class="">Shipping Details</h5>
                                </div>
                                <div class="col-12">
                                    <hr>
                                </div>
                            </div>
                <form method="POST" action="{{route('shipping_post')}}">
                    {{csrf_field()}}
               <div class="row">

                   @foreach($shipping_method as $method)
                       <div class="col-12">
                       	<label class="customradio">
                       		@if(isset($method['selected']))
                           <input type="radio" checked="checked" data-price="{{$method['price']}}" name="shipping_method_id" value="{{$method['shipping_method_id']}}">
                           @else 
                           <input type="radio" data-price="{{$method['price']}}" name="shipping_method_id" value="{{$method['shipping_method_id']}}">
                           @endif
                           <span class="checkmark"></span>
                           <label class="checkbox_ship">
                            @if (is_object($method['shipping_method_name'])) {{$method['shipping_method_name']['shipping_method_name']. ' - '.$method['shipping_method_name']['shipping_method_description']}}  @else {{$method['shipping_method_name']. ' - '.$method['shipping_method_description'] }} @endif </label> <p class="float-right price_ship">€ {{$method['price']}}</p></label>
                           <hr>
                       </div>
                       @endforeach
                       <input type="hidden" name="customer_type_id" value="{{json_encode($customer_type_id)}}" />
                            </div>

                            <div class="row buttons_row">
                        <div class="col-6">
                            @if(isset($btn_nav['back']))
                                <a href="{{$btn_nav['back']['url']}}"
                                   class="form-control col-4 btn btn_back">Backwards</a>
                            @endif
                        </div>
                        <div class="col-6">

                            <button type="submit" class="form-control col-4 float-right btn btn-light btn_next">
                                Continue
                            </button>

                        </div>

        </div>
            </div>
        </form>

             <div class="col-4">
             	 @include ('layouts.basketcard')
            </div>

        </div>


    </div>
    <script src="{{ URL::asset('js/code/shippingView.js') }}"></script>
@endsection