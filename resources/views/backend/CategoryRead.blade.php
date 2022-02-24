@extends("layouts.template")
@section("content")
<div class="col-md-8 m-auto ">
    <div style="margin-bottom:5px;">
        <a href="{{ url('admin/category/create') }}" class="btn btn-primary">Add category</a>
    </div>
    <div class="panel panel-primary">
        <div class="panel-heading">List Categories</div>
        <div class="panel-body">
            <table class="table table-bordered table-hover">
                <tr>
                    <th>Name</th>
                    <th style="width:100px;"></th>
                </tr>
                @foreach($data as $rows)
                <tr>
                    <td>{{ $rows->name }}</td>
                    <td style="text-align:center;">
                        <a href="{{ url('admin/category/'.$rows->id.'/edit') }}">Edit</a>&nbsp;
                        <!-- <a href="{{ url('admin/categories/delete/'.$rows->id) }}" onclick="return window.confirm('Are you sure?');">Delete</a> -->
                        <form method="POST" action="{{ route('category.destroy',$rows->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return window.confirm('Are you sure?');" class="btn">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </table>
            <ul class="pagination">
                {{ $data->links() }}
            </ul>
            <style type="text/css">
                .pagination {
                    padding: 0px;
                    margin: 0px;
                }
            </style>
        </div>
    </div>
</div>
@endsection