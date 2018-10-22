@extends('layouts.admin')

@section('content')
  <div class="row">
    <h1 class="page-header">Dashboard</h1>
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Orders
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Customer Name</th>
                                        <th>Date Order</th>
                                        <th>Customer Address</th>
                                        <th>Customer Email</th>
                                        <th>Total Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($order_table as $order)
                                    <tr>
                                        <th>{{$order['customerName']}}</th>
                                        <th>{{$order['order_date_time']}}</th>
                                        <th>{{$order['customerFullAddress']}}</th>
                                        <th>{{$order['email']}}</th>
                                        <th>{{$order['order_total']}} €</th>
                                    </tr>
                                    @endforeach
</tbody>
</table>


</div>
</div>
</div>
</div>

@endsection