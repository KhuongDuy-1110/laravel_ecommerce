@extends("layouts.template")
@section("content")
<div class="col-md-12" style="margin: auto; margin-top: 50px;">
    <div class="panel panel-primary">
        <div class="panel-heading" style="background-color: #152555; color: white; padding: 10px; border-radius: 5px 5px 0px 0px ;">User Infomation</div>
        <div class="panel-body">
            <div style="color: red;">{{ isset($message)?$message:'' }}</div>
            <table class="table table-bordered table-hover">
                <tr>
                    <td style="width: 200px;">Name</td>
                    <td>{{ $user->name }}</td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>{{ $user->email }}</td>
                </tr>
                <tr>
                    <td>Phone number</td>
                    <td>{{ $user->phone }}</td>
                </tr>
                <tr>
                    <td>Address</td>
                    <td>{{ $user->address }}</td>
                </tr>
            </table>
        </div>
    </div>

    <div class="panel panel-primary">
        <div class="panel-body">
            <table class="table table-bordered table-hover mt-5">
                <tr>
                    <td colspan="7" style="background-color: #152555; color: white; border-radius: 5px 5px 0px 0px;">User's Orders</td>
                </tr>
                <tr>
                    <th>Number</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Order at</th>
                    <th>Status</th>
                    <th>Products detail</th>
                </tr>
                @foreach($user->orders as $num => $order)

                @php
                    $orderDetail = json_decode($order->orderDetail);
                @endphp

                <tr>
                    <td>{{ $num+=1 }}</td>
                    <td>{{ $orderDetail->totalQuantity }}</td>
                    <td>{{ $orderDetail->totalPrice }}</td>
                    <td>{{ $order->created_at }}</td>
                    <td>
                        @if($order->status === 0)
                            <button type="button" class="btn btn-secondary">Processing</button>
                        @elseif($order->status === 1)
                            <button type="button" class="btn btn-warning">Transfering</button>
                        @elseif($order->status === 2)
                            <button type="button" class="btn btn-success">Finish</button>
                        @else
                            <button type="button" class="btn btn-danger">Cancel</button>
                        @endif
                    </td>
                    <td>
                        <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="{{ '#collapseExample'.$num }}" aria-expanded="false" aria-controls="collapseExample">See detail</button>
                    </td>
                </tr>

                @foreach($orderDetail->products as $product)
                <tr class="collapse" id="{{ 'collapseExample'.$num }}">
                    <td colspan="6">
                        <div>
                            <div class="card card-body">
                                <div style="display: flex;">
                                    <img src="{{ asset('images/'.$product->productInfo->photo) }}" style="width: 100px; height:70px; object-fit: cover;" alt="">
                                    <div class="product"><b>Name: </b>{{ $product->productInfo->name .' '. $product->productInfo->title }}</div>
                                    <div class="product"><b>Price: </b>${{ $product->productInfo->price }}</div>
                                    <div class="product"><b>Quantity: {{ $product->quantity }}</b></div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach

                <tr class="collapse" id="{{ 'collapseExample'.$num }}">
                    <td colspan="6">
                        <b>Update order status number {{ $num }}: </b>
                        <div class="mt-3"> </div>
                        <form method="post" action="{{ url('admin/order/status/'.$order->id) }}">
                            @csrf
                            <button type="submit" name="sta" value="0" class="btn btn-secondary">Processing</button>
                            <button type="submit" name="sta" value="1" class="btn btn-warning">Transfering</button>
                            <button type="submit" name="sta" value="2" class="btn btn-success">Finish</button>
                            <button type="submit" name="sta" value="3" class="btn btn-danger">Cancel</button>
                        </form>
                    </td>
                    
                </tr>
                @endforeach
            </table>
            
            <style type="text/css">
                .pagination {
                    padding: 0px;
                    margin: 0px;
                }
                .product {
                    margin-left: 50px;
                    margin-top: 25px;
                }
            </style>
            <ul class="pagination">

            </ul>
        </div>
    </div>
</div>
@endsection