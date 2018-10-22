@extends('layouts.client')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-8">
                <div class="row">
                    <div class="col-12">
                        <h5 class="">Payment Details</h5>
                    </div>
                    <div class="col-12">
                        <hr>
                    </div>
                </div>
                <form method="POST" action="{{route('payment_post')}}">
                    {{csrf_field()}}
                    <div class="row">

                        @foreach($payment_method as $method)
                            <div class="col-12">
                                <label class="customradio">
                                    @if(isset($method['selected']))
                                        <input type="radio" checked="checked" data-price="{{$method['price']}}"
                                               name="payment_method_id" value="{{$method['payment_method_id']}}">
                                    @else
                                        <input type="radio" data-price="{{$method['price']}}" name="payment_method_id"
                                               value="{{$method['payment_method_id']}}">
                                    @endif
                                    <span class="checkmark"></span>
                                    <label class="checkbox_ship">
                                        @if (is_object($method['payment_method_name'])) {{$method['payment_method_name']['payment_method_name']. ' - '.$method['payment_method_name']['payment_method_description']}}  @else {{$method['payment_method_name']. ' - '.$method['payment_method_description'] }} @endif </label>
                                    <p class="float-right price_ship">€ {{$method['price']}}</p></label>
                                <hr>
                            </div>
                        @endforeach
                        <input type="hidden" name="customer_type_id" value="{{json_encode($customer_type_id)}}"/>
                    </div>

                    @if(isset($customer_type_id) && $customer_type_id==1)
                        <div class="row">
                            <div class="col-12">
                                <h5 class="">Warranty Details</h5>
                            </div>
                            <div class="col-12">
                                <hr>
                            </div>
                        </div>


                        <div class="row">

                            @foreach($warranty_method as $method)
                                <div class="col-12">
                                    <label class="customradio">
                                        @if(isset($method['selected']))
                                            <input type="radio" checked="checked"
                                                   data-price="{{$method['product_warranty_discount_percentage']}}"
                                                   name="product_warranty_id"
                                                   value="{{$method['product_warranty_id']}}">
                                        @else
                                            <input type="radio"
                                                   data-price="{{$method['product_warranty_discount_percentage']}}"
                                                   name="product_warranty_id"
                                                   value="{{$method['product_warranty_id']}}">
                                        @endif
                                        <span class="checkmark"></span>
                                        <label class="checkbox_ship">
                                            {{$method['product_warranty_months']. ' - Months Warranty '}}</label>
                                        <p class="float-right price_ship"> {{$method['product_warranty_discount_percentage']}}
                                            %</p></label>
                                    <hr>
                                </div>
                            @endforeach

                        </div>
                    @endif

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

        <script src="{{ URL::asset('js/code/paymentView.js') }}"></script>
    </div>

@endsection