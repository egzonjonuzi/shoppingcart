@extends('layouts.client')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-8">
                <form method="post" action="{{route('address_post')}}">
                    {{csrf_field()}}
                    <div class="row">

                        <div class="col-12">
                            <div class="contact_panel">
                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="">Billing Address</h5>
                                    </div>
                                    <div class="col-12">
                                        <hr>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group ">
                                            <label class="control-label " for="name">
                                                Name
                                            </label>
                                            <input class="form-control" name="name[]" type="text"
                                                   value="{{$client_address['name']}}"
                                                   placeholder="Name" required/>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group ">
                                            <label class="control-label " for="surname">
                                                Surname
                                            </label>
                                            <input class="form-control" name="surname[]" type="text"
                                                   value="{{$client_address['surname']}}"
                                                   placeholder="Surname" required/>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group ">
                                            <label class="control-label " for="street">
                                                Street
                                            </label>
                                            <input class="form-control" name="street[]" type="text"
                                                   value="{{$client_address['street']}}"
                                                   placeholder="Street" required/>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group ">
                                            <label class="control-label " for="house_number">
                                                House number
                                            </label>
                                            <input class="form-control" name="house_number[]" type="text"
                                                   value="{{$client_address['house_number']}}"
                                                   placeholder="House number" required/>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group ">
                                            <label class="control-label " for="zip">
                                                Zip
                                            </label>
                                            <input class="form-control" name="zip[]" type="text" placeholder="Zip"
                                                   value="{{$client_address['zip']}}" required/>

                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group ">
                                            <label class="control-label " for="city">
                                                City
                                            </label>
                                            <input class="form-control" name="city[]" type="text"
                                                   value="{{$client_address['city']}}"
                                                   placeholder="City" required/>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group ">
                                            <label class="control-label " for="country">
                                                Country
                                            </label>
                                            <input class="form-control" name="country[]" type="text"
                                                   value="{{$client_address['country']}}"
                                                   placeholder="Country" required/>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="checkbox col-12">
                                    @if($client_address['house_number'] !== $client_delivery_address['house_number'])
                                        <input type="checkbox" id="delivery_enabled" checked="checked">
                                    @else
                                        <input type="checkbox" id="delivery_enabled">
                                    @endif
                                    <label><font style="vertical-align: inherit;"><font
                                                    style="vertical-align: inherit;">Deliver to another
                                                address</font></font></label>
                                </div>
                            </div>
                            @if($client_address['house_number'] === $client_delivery_address['house_number'])
                                <div class="delivery_panel" style="display: none;">
                                    @else
                                        <div class="delivery_panel">
                                 @endif
                                            <div class="row">
                                                <div class="col-12">
                                                    <h5 class="">Delivery Address</h5>
                                                </div>
                                                <div class="col-12">
                                                    <hr>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group ">
                                                        <label class="control-label " for="name">
                                                            Name
                                                        </label>
                                                        <input class="form-control" name="name[]" type="text"
                                                               value="{{$client_delivery_address['name']}}"
                                                               placeholder="Name" />
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group ">
                                                        <label class="control-label " for="surname">
                                                            Surname
                                                        </label>
                                                        <input class="form-control" name="surname[]" type="text"
                                                               value="{{$client_delivery_address['surname']}}"
                                                               placeholder="Surname" />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group ">
                                                        <label class="control-label " for="street">
                                                            Street
                                                        </label>
                                                        <input class="form-control" name="street[]" type="text"
                                                               value="{{$client_delivery_address['street']}}"
                                                               placeholder="Street" />
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group ">
                                                        <label class="control-label " for="house_number">
                                                            House number
                                                        </label>
                                                        <input class="form-control" name="house_number[]" type="text"
                                                               value="{{$client_delivery_address['house_number']}}"
                                                               placeholder="House number" />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-4">
                                                    <div class="form-group ">
                                                        <label class="control-label " for="zip"/>
                                                        Zip
                                                        </label>
                                                        <input class="form-control" name="zip[]" type="text"
                                                               placeholder="Zip"
                                                               value="{{$client_delivery_address['zip']}}" />
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="form-group ">
                                                        <label class="control-label " for="city">
                                                            City
                                                        </label>
                                                        <input class="form-control" name="city[]" type="text"
                                                               value="{{$client_delivery_address['city']}}"
                                                               placeholder="City" />
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="form-group ">
                                                        <label class="control-label " for="country">
                                                            Country
                                                        </label>
                                                        <input class="form-control" name="country[]" type="text"
                                                               value="{{$client_delivery_address['country']}}"
                                                               placeholder="Country" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </div>


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
                </form>
            </div>


            <div class="col-4">
                @include ('layouts.basketcard')
            </div>
        </div>

    </div>
    <script src="{{ URL::asset('js/code/addressView.js') }}"></script>
@endsection