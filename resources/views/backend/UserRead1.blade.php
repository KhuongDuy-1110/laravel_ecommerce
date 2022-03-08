<div class="col-md-12">
    <div style="margin-bottom:5px;">
        <a href="{{ url("admin/category/create") }}" class="btn btn-primary" style="background-color: #152555;">Add category</a>
    </div>
    <div class="panel panel-primary">
        <div class="panel-heading" style="background-color: #152555;">List categories</div>
        <div class="panel-body">
            <table class="table table-bordered table-hover">
                <tr>
                    <th>name</th>
                    <th style="width:100px;"></th>
                </tr>
                @foreach($data as $rows)
                <tr>
                    <td>{{ $rows->name }}</td>
                    <td style="text-align:center;">
                        <a href="{{ url("admin/category/update/{$rows->id}") }}" style="color: #152555;">Edit</a>&nbsp;
                        <a href="{{ url("admin/category/delete/{$rows->id}") }}" onclick="return window.confirm('Are you sure?');" style="color: #152555;">Delete</a>
                    </td>
                </tr>

                <?php
                    $dataSub =DB::table("categories")->where("parent_id","=",$rows->id)->get();
                ?>
                @if (!empty($dataSub))
                    @foreach ($dataSub as $rowsSub)
                    <tr>
                        <td style="padding-left: 30px;"><?php echo $rowsSub->name; ?></td>
                        <td style="text-align:center;">
                            <a href="{{ url("admin/category/update/{$rowsSub->id}") }}" style="color: #152555;">Edit</a>
                            <a href="{{ url("admin/category/delete/{$rowsSub->id}") }}" onclick="return window.confirm('Are you sure?');" style="color: #152555;">Delete</a>
                        </td>
                    </tr>
                    @endforeach
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
                {{ $data->links('vendor.pagination.custom') }}
            </ul>
        </div>
    </div>
</div>