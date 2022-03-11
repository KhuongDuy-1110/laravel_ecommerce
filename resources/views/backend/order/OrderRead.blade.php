@extends("layouts.template")
@section("content")
<div class="col-md-12" style="margin: auto; margin-top: 50px;">
        <div class="panel panel-primary">
            <div class="panel-heading" style="background-color: #152555; color: white; padding: 10px; border-radius: 5px 5px 0px 0px ;">Orders</div>
            <div class="panel-body">
                <div style="color: red;">{{ isset($message)?$message:'' }}</div>
                <table class="table table-bordered table-hover">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Order quantity</th>
                        <th>Detail</th>
                        <th>Status</th>
                    </tr>
                    @foreach($users as $user)
                    
                        @if($user->orders_count > 0)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->orders_count }}</td>
                            <td><a href="{{ url('admin/order/detail/'.$user->id) }}" style="color: #E45826">Orders detail</a></td>
                            <td style="text-align:center;">
                                <a href="" style="color: #152555;">Cancel</a>&nbsp;
                                <a href="" style="color: #152555;">Processing</a>&nbsp;
                                <a href="" style="color: #152555;">Arriving</a>&nbsp;
                            </td>
                        </tr>
                        @endif
                    
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