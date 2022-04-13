@extends("layouts.template")
@section("content")
<div class="col-md-12">
    <div style="margin-bottom:5px;">
        <a href="{{ route('image.create', ['type' => $type]) }}" class="btn btn-primary" style="background-color: #152555;">Add image</a>
    </div>
    @if(count($data))
    <div class="panel panel-primary">
        <div class="panel-heading" style="background-color: #152555; color: white; padding: 10px; border-radius: 5px 5px 0px 0px ;">{{ isset($nameOfImages)?$nameOfImages:'Unknown' }}</div>
        <div class="panel-body">
            <table class="table table-bordered table-hover mb-0">
                <tr>
                    <th class="col-md-2">Image</th>
                    <th>Status</th>
                    <th style="width:100px;"></th>
                </tr>
                @foreach($data as $rows)
                <tr>
                    <td><img src="{{ asset('images/'.$rows->path) }}" style="width: 100px; height:70px; object-fit: cover;" alt=""></td>
                    <td>
                        <div class="mt-3"> </div>
                        <form method="post" action="{{ route('image.update', [$rows->id, 'type' => $type]) }}">
                            @method('PUT')
                            @csrf
                            @if($rows->status === 0)
                                <button type="submit" name="sta" value="1" class="btn btn-warning">Un-active</button>   
                            @else
                                <button type="submit" name="sta" value="0" class="btn btn-success">Active</button>
                            @endif
                        </form>
                    </td>
                    <td style="text-align:center;">
                        <form method="POST" action="{{ route('image.destroy',[$rows->id, 'type' => $type]) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return window.confirm('Are you sure?');" class="btn">Delete</button>
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
    @else
        <div>No record found !</div>
    @endif
</div>
@endsection