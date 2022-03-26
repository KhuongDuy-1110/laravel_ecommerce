<?php

namespace App\Repository;

interface ImageRepositoryInterface
{
    public function getImageByType(int $type);
}