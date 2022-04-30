<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Services\PostService;
use App\Http\Requests\PostStoreRequest;
use Illuminate\Support\Facades\Auth;

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
        $authorId = Auth::guard('admin')->id();
        $this->postService->create($request, $authorId);
        return redirect()->route('post.index')->with('success', 'Post was created successfully');
    }

    public function show(Post $post)
    {
        //
    }

    public function edit(Post $post)
    {
        $post = $this->postService->find($post->id);
        return view('backend.post.PostUpdate',['record' => $post]);
    }

    public function update(Request $request, Post $post)
    {
        $this->postService->update($request, $post->id);
        return redirect()->route('post.index')->with('success', 'Your post has been updated');
    }

    public function destroy(Post $post)
    {
        $this->postService->delete($post->id);
        return redirect()->route('post.index')->with('success', 'Your post has been deleted');
    }
}
