<?php

namespace App\Services;

use App\Repository\PostRepositoryInterface;
use Illuminate\Support\Facades\Storage;

class PostService 
{
    protected $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function getAllPosts($paginate = null)
    {
        return $this->postRepository->getPosts($paginate);
    }

    public function create($request, $authorId)
    {
        if($request->hasFile('image')){
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $path = $request->file('image')->storeAs('images',$fileNameToStore);
        }
        else
        {
            $fileNameToStore = 'noimage'.time().'.jpg';
        }
        $data = [
            'postable_id' => $authorId,
            'image' => $fileNameToStore,
            'title' => $request->title,
            'description' => $request->description,
            'content' => $request->content,
            'is_recommend' => isset($request->recommend)?1:0,
            'is_pin' => isset($request->pin)?1:0,
        ];
        return $this->postRepository->create($data);
    }

    public function find($id)
    {
        return $this->postRepository->find($id);
    }

    public function update($request, $id)
    {
        $post = self::find($id);
        if($request->hasFile('image')){
            Storage::delete('images/'.$post->image);
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $path = $request->file('image')->storeAs('images',$fileNameToStore);
        } else {
            $fileNameToStore = $post->image;
        }
        $data = [
            'image' => $fileNameToStore,
            'title' => $request->title,
            'description' => $request->description,
            'content' => $request->content,
            'is_recommend' => isset($request->recommend)?1:0,
            'is_pin' => isset($request->pin)?1:0,
        ];
        return $this->postRepository->update($id,$data);
    }

    public function delete($id)
    {
        $post = self::find($id);
        $this->postRepository->delete($id);
        Storage::delete('images/'.$post->photo);
    }

    public function getLastestPost()
    {
        return $this->postRepository->getLastest();
    }
}