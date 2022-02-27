@extends("layouts.template")
@section("content")
<div class="col-md-8" style="margin: auto; margin-top: 50px;">
    <div class="panel panel-primary">
        <div class="panel-heading" style="background-color: #152555; color: white;">User Infomation</div>
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
            </table>
        </div>
    </div>

    <div class="panel panel-primary">
        <div class="panel-body">
            <table class="table table-bordered table-hover mt-5">
                <tr>
                    <th colspan="7" style="background-color: #152555; color: white;">User's Orders</th>
                </tr>
                <tr>
                    <th>Number</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Order at</th>
                    <th>Products detail</th>
                </tr>
                @foreach($user->orders as $order)
                @php
                $orderDetail = json_decode($order->orderDetail);

                @endphp
                <tr>
                    <td></td>
                    <td>{{ $orderDetail->totalQuantity }}</td>
                    <td>{{ $orderDetail->totalPrice }}</td>
                    <td>{{ $order->client_phone }}</td>
                    <td>{{ $order->client_address }}</td>
                    <td>{{ $order->created_at }}</td>
                    <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalProducts">
                            See detail
                        </button></td>
                    <!-- Modal -->

                    <div class="modal fade" id="modalProducts" tabindex="-1" role="dialog" aria-labelledby="modalProductsLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalProductsLabel">All Products In Order</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- <table>
                                        <tr>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td><img src="" width="145px" height="98px" style="object-fit: cover;" alt=""></td>
                                            <td style="vertical-align: middle;"></td>
                                            <td style="vertical-align: middle;"></td>
                                            <td style="vertical-align: middle;"></td>
                                            <td style="vertical-align: middle;"></td>
                                        </tr>
                                    </table> -->
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- EndModal -->
                </tr>
                @endforeach
            </table>
            <style type="text/css">
                .pagination {
                    padding: 0px;
                    margin: 0px;
                }
            </style>
            <ul class="pagination">

            </ul>
        </div>
    </div>
</div>
@endsection