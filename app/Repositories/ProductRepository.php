<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository implements ProductRepositoryInterface
{
    protected $model;

    public function __construct(Product $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
//        return $this->model->all();
        return $this->model->orderBy('created_at', 'desc')->get();
    }

    public function getById($id)
    {
        return $this->model->find($id);
    }

    public function create($data)
    {
        return $this->model->create($data);
    }

    public function update($id, $data)
    {
        $model = $this->model->findOrFail($id);
        $model->update($data);
        return $model;
    }

    public function delete($id)
    {
        $product  = $this->model->findOrFail($id);
//        dd($product->images());
        $product->images()->delete();
//        dd(1);
        return $product->delete();
//        return $this->model->destroy($id);
    }

    public function getByManufacturerId($manufacturerId)
    {
        return $this->model->where('manufacturer_id', $manufacturerId)->get();
    }

    public function getByCategoryId($categoryId)
    {
        return $this->model->where('category_id', $categoryId)->get();
    }

//    public function getByCategoryId($categoryId, $id)
//    {
//        return $this->model->where('category_id', $categoryId)->whereNotIn('id', explode(',', $id))->get();
//    }

    public function search($request)
    {
        $query = $request;

        $products = $this->model->where('name', 'LIKE', "%$query%")
            ->orWhere('description', 'LIKE', "%$query%")
            ->get();
        return $products;
    }


}
