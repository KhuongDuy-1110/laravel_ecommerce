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
                            <form method="POST" action="{{ route('category.destroy',$rows->id) }}" >
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return window.confirm('Are you sure?');" class="btn">Delete</button>
                            </form>
                        </td>
                    </tr>

                    @php
                        $dataSub = DB::table("category")->where("parent_id",$rows->id)->get();
                    @endphp
                        
                    @if (!empty($dataSub))
                        @foreach ($dataSub as $rowsSub)
                        <tr>
                            <td style="padding-left: 60px;">{{ $rowsSub->name }}</td>
                            <td style="text-align:center;">
                                <a href="{{ url('admin/category/'.$rowsSub->id.'/edit') }}" style="color: #152555;">Edit</a>
                                <form method="POST" action="{{ route('category.destroy',$rowsSub->id) }}" >
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return window.confirm('Are you sure?');" class="btn">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    @endif
                @endforeach
            </table>
            <style type="text/css">
                .pagination{padding:0px; margin:0px;}
            </style>
        </div>
    </div>
</div>
@endsection