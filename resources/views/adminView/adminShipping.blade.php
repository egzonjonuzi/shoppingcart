@extends('layouts.admin')

@section('content')
    <link rel="stylesheet" href="{{ URL::asset('css/admin_shipping_payment.css') }}">
    <div class="row">
        <h1 class="page-header">Shipping</h1>
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="col-12">

                        Shipping details


                        <div class="pull-right"> <a href="" data-toggle="modal" data-target="#shippingModal"><i class="fa fa-plus"></i></a></div>
                    </div>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">

                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#customer" aria-controls="customer" role="tab" data-toggle="tab">Customer</a></li>
                        <li role="presentation"><a href="#company" aria-controls="company" role="tab" data-toggle="tab">Company</a></li>

                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="customer">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                <tr>
                                    <th>Shipping fee method name</th>
                                    <th>Description</th>
                                    <th>Customer Type</th>
                                    <th>Price</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($shipping_fee_customer as $fee)
                                    <tr>
                                        <th>{{$fee['shippingMethodName']}}</th>
                                        <th>{{$fee['shippingMethodDescription']}}</th>
                                        <th>{{$fee['customerTypeName']}}</th>
                                        <th>{{$fee['price']}} €</th>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="company">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                <tr>
                                    <th>Shipping fee method name</th>
                                    <th>Description</th>
                                    <th>Customer Type</th>
                                    <th>Price</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($shipping_fee_company as $fee)
                                    <tr>
                                        <th>{{$fee['shippingMethodName']}}</th>
                                        <th>{{$fee['shippingMethodDescription']}}</th>
                                        <th>{{$fee['customerTypeName']}}</th>
                                        <th>{{$fee['price']}} €</th>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>


                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
  <div class="modal fade" id="shippingModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add Shipping</h4>
        </div>
        <div class="modal-body">
            <form method="post" action="{{route('admin_shipping')}}">
                  {{csrf_field()}}
     <div class="form-group">
      <label class="control-label " for="name">
       Shipping fee method name
      </label>
      <div class="row">
      <div class="col-lg-10">
     <select class="select form-control" id="shipping_method_id" name="shipping_method_id">
       @foreach($shipping_methods as $shipping_method)
       <option value="{{$shipping_method['shipping_method_id']}}">{{$shipping_method['shipping_method_name']}} </option>

       @endforeach
      </select>
  </div>
<div class="col-lg-2">
      <button class="form-control btn btn-default btn_shipping_method_add" type="button"><i class="fa fa-plus"></i></button>
  </div>
  </div>
     </div>

     <div class=" shipping_method_panel hide_panel">
        <div class="col-md-8 col-md-offset-2 card"> 
            <div class="form-group ">
      <label class="control-label " for="name">
       Shipping method name
      </label>
      <input class="form-control" id="shipping_method_name"  type="text"/>
     </div>
        <div class="form-group ">
      <label class="control-label " for="name">
       Description
      </label>
      <input class="form-control" id="shipping_method_description"  type="text"/>
     </div>
     <button class="btn btn-success btn_add_shipping_method_submit">Add shipping Method</button>
     </div>
     
 </div>
      
        <div class="form-group ">
      <label class="control-label " for="name">
       Customer type
      </label>
    <select class="select form-control" id="customer_type_id" name="customer_type_id" >
       @foreach($customer_type as $customer)
       <option value="{{$customer['customer_type_id']}}">{{$customer['customer_type_name']}} </option>

       @endforeach
      </select>
     </div>
        <div class="form-group ">
      <label class="control-label " for="name">
       Price
      </label>
      <input class="form-control" id="price" name="price" type="text"/>
     </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success" >Save</button>
        </div>
      </div>
       </form>
    </div>
  </div>
   <script src="{{ URL::asset('js/code/shippingAdmin.js') }}"></script>

@endsection