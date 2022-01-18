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

    public function view()
    {
        return $this->categoryRepository->getParent("parent_id",0);
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
        $this->categoryRepository->update($id,$data);
    }

    public function delete($id)
    {
        $this->categoryRepository->delete($id);
    }

}