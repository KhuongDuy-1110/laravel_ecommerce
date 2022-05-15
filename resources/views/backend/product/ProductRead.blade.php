@extends("layouts.template")
@section("content")
<div class="col-md-12" style="margin: auto; margin-top: 50px;">
        <div style="margin-bottom:5px;">
            <a href="{{ url('/admin/product/create') }}" class="btn btn-primary" style="background-color: #152555;">Add product</a>
        </div>
        <div class="panel panel-primary">
            <div class="panel-heading" style="background-color: #152555; color: white; padding: 10px; border-radius: 5px 5px 0px 0px ;">All products</div>
            <div class="panel-body">
                <div style="color: red;">{{ isset($message)?$message:'' }}</div>
                <table class="table table-bordered table-hover">
                    <tr>
                        <th style="width: 150px;"></th>
                        <th>name</th>
                        <th>title</th>
                        <th>description</th>
                        <th>price</th>
                        <th>category</th>
                        <th>hot</th>
                        <th style="width:100px;"></th>
                    </tr>
                    @foreach($products as $product)
                        <tr>
                            <td><img src="{{ asset('images/'.$product->photo) }}" style="width: 100px; height:70px; object-fit: cover;" alt=""></td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->title }}</td>
                            <td>{{ stringLimitedHelper($product->description, 150) }}</td>
                            <td>{{ $product->price }}</td>
                            <td>
                                @if($product->category)
                                {{ $product->category->name }}
                                @endif
                            </td>
                            <td>
                                @if($product->hot == 1 )
                                    <i class="fa-solid fa-check"></i>
                                @endif
                            </td>
                           
                            <td style="text-align:center;">
                                <a href="{{ url('admin/product/'.$product->id.'/edit') }}" style="color: #152555;">Edit</a>&nbsp;
                                <form method="POST" action="{{ route('product.destroy',$product->id) }}" >
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
                    {{ $products->links() }}
                </ul>
            </div>
        </div>
    </div>
@endsection