<?php

namespace App\Services;

use App\Repository\PostRepositoryInterface;

class PostService 
{
    protected $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function getAllPosts()
    {
        return $this->postRepository->read();
    }
}