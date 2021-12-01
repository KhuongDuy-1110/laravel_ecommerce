@extends("layouts.template")
@section("content")
<div class="col-md-8" style="margin: auto; margin-top: 50px;">
        <div style="margin-bottom:5px;">
            <a href="{{ url('/admin/product/create') }}" class="btn btn-primary" style="background-color: #152555;">Add product</a>
        </div>
        <div class="panel panel-primary">
            <div class="panel-heading" style="background-color: #152555; color: white;">All products</div>
            <div class="panel-body">
                <div style="color: red;">{{ isset($message)?$message:'' }}</div>
                <table class="table table-bordered table-hover">
                    <tr>
                        <th style="width: 100px;"></th>
                        <th>name</th>
                        <th>title</th>
                        <th>description</th>
                        <th>price</th>
                        <th>category</th>
                        <th style="width:100px;"></th>
                    </tr>
                    @foreach($data as $rows)
                        @php
                            $categoryName = DB::table("category")->where("id",$rows->category_id)->first();
                        @endphp
                        <tr>
                            <td><img src="{{ asset('images/'.$rows->photo) }}" style="width: 100px; height:70px; object-fit: cover;" alt=""></td>
                            <td>{{ $rows->name }}</td>
                            <td>{{ $rows->title }}</td>
                            <td>{{ $rows->description }}</td>
                            <td>{{ $rows->price }}</td>
                            <td>{{ $categoryName->name }}</td>
                           
                            <td style="text-align:center;">
                                <a href="{{ url('admin/product/'.$rows->id.'/edit') }}" style="color: #152555;">Edit</a>&nbsp;
                                <form method="POST" action="{{ route('product.destroy',$rows->id) }}" >
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
                    {{ $data->links() }}
                </ul>
            </div>
        </div>
    </div>
@endsection