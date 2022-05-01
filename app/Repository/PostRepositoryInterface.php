<?php

namespace App\Repository;

interface PostRepositoryInterface
{
    public function getRecommendedPosts();

    public function getPosts($n = null);

    public function getLastest();
}