@extends("layouts.template")
@section("content")
<div class="col-md-12">
    <div style="margin-bottom:5px;">
        <a href="{{ url('admin/category/create') }}" class="btn btn-primary" style="background-color: #152555;">Add category</a>
    </div>
    <div class="panel panel-primary">
        <div class="panel-heading" style="background-color: #152555; color: white; padding: 10px; border-radius: 5px 5px 0px 0px ;">Categories</div>
        <div class="panel-body">
            <table class="table table-bordered table-hover mb-0">
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
                            <button type="submit" onclick="return window.confirm('Are you sure, delete this category will delete all products inside it?');" class="btn">Delete</button>
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
            <ul class="pagination" >
                {{ $data->links() }}
            </ul>
        </div>
    </div>
</div>
@endsection