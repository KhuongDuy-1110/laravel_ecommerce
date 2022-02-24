@extends("layouts.template")
@section("content")
<div class="col-md-8" style="margin: auto; margin-top: 50px;">
        <div class="panel panel-primary">
            <div class="panel-heading" style="background-color: #152555; color: white;">Orders</div>
            <div class="panel-body">
                <div style="color: red;">{{ isset($message)?$message:'' }}</div>
                <table class="table table-bordered table-hover">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Detail</th>
                        <th style="width:100px;"></th>
                    </tr>
                    @foreach($orders as $order)
                        <tr>
                            <td>{{ $order->user->name }}</td>
                            <td>{{ $order->user->email }}</td>
                            <td>{{ $order->client_address }}</td>
                            <td><a href="">Order detail</a></td>
                            <td style="text-align:center;">
                                <a href="" style="color: #152555;">Edit</a>&nbsp;
                                <form method="POST" action="" >
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return window.confirm('Are you sure?');" class="btn">Delete</button>
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
                </style>
                <ul class="pagination">
                    {{ $orders->links() }}
                </ul>
            </div>
        </div>
    </div>
@endsection