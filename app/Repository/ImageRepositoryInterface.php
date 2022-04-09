<?php

namespace App\Repository;

interface ImageRepositoryInterface
{
    public function getAllImage();

    public function getImageByType(int $type, $active);
}