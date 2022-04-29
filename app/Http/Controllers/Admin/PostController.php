<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Services\PostService;
use App\Http\Requests\PostStoreRequest;

class PostController extends Controller
{
    private $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function index()
    {
        $posts = $this->postService->getAllPosts();
        return view('backend.post.PostRead', ['posts' => $posts]);
    }

    public function create()
    {
        return view('backend.post.PostCreate');
    }

    public function store(PostStoreRequest $request)
    {
        dd($request->all());
    }

    public function show(Post $post)
    {
        //
    }

    public function edit(Post $post)
    {
        dd('ok');
    }

    public function update(Request $request, Post $post)
    {
        //
    }

    public function destroy(Post $post)
    {
        //
    }
}
