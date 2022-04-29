@extends("layouts.template")
@section("content")
<div class="col-md-12" style="margin: auto; margin-top: 50px;">
        <div style="margin-bottom:5px;">
            <a href="{{ route('post.create') }}" class="btn btn-primary" style="background-color: #152555;">Add post</a>
        </div>
        <div class="panel panel-primary">
            <div class="panel-heading" style="background-color: #152555; color: white; padding: 10px; border-radius: 5px 5px 0px 0px ;">All posts</div>
            <div class="panel-body">
                <div style="color: red;">{{ isset($message)?$message:'' }}</div>
                <table class="table table-bordered table-hover">
                    <tr>
                        <th style="width: 150px;"></th>
                        <th>title</th>
                        <th>description</th>
                        <th>content</th>
                        <th>is recommended</th>
                        <th>is pined</th>
                        <th>author</th>
                        <th style="width:100px;"></th>
                    </tr>
                    @foreach($posts as $post)
                        <tr>
                            <td><img src="{{ asset('images/'.$post->image) }}" style="width: 100px; height:70px; object-fit: cover;" alt=""></td>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->description }}</td>
                            <td>{{ $post->content }}</td>
                            <td>
                                {{ $post->is_recommend ? true : false }}
                            </td>
                            <td>
                                {{ $post->is_recommend ? true : false }}
                            </td>
                            <td>
                                {{ $post->author }}
                            </td>
                           
                            <td style="text-align:center;">
                                <a href="{{ route('post.edit', $post->id) }}" style="color: #152555;">Edit</a>&nbsp;
                                <form method="POST" action="{{ route('post.destroy',$post->id) }}" >
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
                    {{ $posts->links() }}
                </ul>
            </div>
        </div>
    </div>
@endsection