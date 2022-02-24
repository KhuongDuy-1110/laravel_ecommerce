<?php

namespace App\Services;

use App\Repository\CategoryRepositoryInterface;
use App\Models\Category;
use App\Http\Requests\CategoryRequest;

class CategoryService
{
    private $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;       
    }

    public function getCategories($paginate = null)
    {
        return $this->categoryRepository->getCategoriesByKey("parent_id",0,$paginate);
    }

    public function create(CategoryRequest $request)
    {
        $data = $request->all();
        $this->categoryRepository->create($data);
    }

    public function edit($id)
    {
        return $this->categoryRepository->find($id);
    }

    public function update(CategoryRequest $request,$id)
    {
        $data = $request->all();
        return $this->categoryRepository->update($id,$data);
    }

    public function delete($id)
    {
        $this->categoryRepository->delete($id);
    }

}