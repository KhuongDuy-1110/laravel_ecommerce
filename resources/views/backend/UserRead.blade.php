@extends("layouts.template")
@section("content")
<div class="col-md-8" style="margin: auto; margin-top: 50px;">
        <div style="margin-bottom:5px;">
            <a href="{{ url('/admin/user/create') }}" class="btn btn-primary" style="background-color: #152555;">Add user</a>
        </div>
        <div class="panel panel-primary">
            <div class="panel-heading" style="background-color: #152555;">All users</div>
            <div class="panel-body">
                <div style="color: red;">{{ isset($message)?$message:'' }}</div>
                <table class="table table-bordered table-hover">
                    <tr>
                        <th>name</th>
                        <th>email</th>
                        <th style="width:100px;"></th>
                    </tr>
                    @foreach($data as $rows)
                        <tr>
                            <td>{{ $rows->name }}</td>
                            <td>{{ $rows->email }}</td>
                           
                            <td style="text-align:center;">
                                <a href="{{ url('admin/user/update/'.$rows->id) }}" style="color: #152555;">Edit</a>&nbsp;
                                <a href="{{ url('admin/user/delete/'.$rows->id) }}" onclick="return window.confirm('Are you sure?');" style="color: #152555;">Delete</a>
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
                    {{ $data->links() }}
                </ul>
                <a href="{{ url('/logout') }}">Logout</a>
            </div>
        </div>
    </div>
@endsection