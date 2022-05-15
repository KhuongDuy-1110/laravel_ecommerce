@extends("layouts.template")
@section("content")
<div class="col-md-12">
        <div style="margin-bottom:5px;">
            <a href="{{ url('/admin/user/create') }}" class="btn btn-primary" style="background-color: #152555;">Add user</a>
        </div>
        <div class="panel panel-primary">
            <div class="panel-heading" style="background-color: #152555; color: white; padding: 10px; border-radius: 5px 5px 0px 0px ;">List persons</div>
            <div class="panel-body">
                <div style="color: red;">{{ isset($message)?$message:'' }}</div>
                <table class="table table-bordered table-hover mb-0" style="border: 1px #152555 solid;">
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
                                <a href="{{ url('admin/user/'.$rows->id.'/edit') }}" style="color: #152555;">Edit</a>&nbsp;
                                <!-- <a href="{{ url('admin/user/delete/'.$rows->id) }}" onclick="return window.confirm('Are you sure?');" style="color: #152555;">Delete</a> -->
                                <form method="POST" action="{{ route('user.destroy',$rows->id) }}" >
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return window.confirm('Are you sure, this action delete include all order of user if there are any?');" class="btn">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>
                <div class="panel-heading mb-3" style="background-color: #152555; color: white; padding: 10px; border-radius: 0px 0px 5px 5px ;"></div>
                <style type="text/css">
                    .pagination {
                        padding: 0px;
                        margin: 0px;
                    }
                </style>
                <ul class="pagination">
                    {{ $data->links() }}
                </ul>
            </div>
        </div>
    </div>
@endsection