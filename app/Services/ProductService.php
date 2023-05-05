<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Manufacturer;
use Illuminate\Http\Request;
use App\Models\ProductImage;
use App\Repositories\ProductRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductService
{
    protected $repository;
    protected $productImage;
    protected $category;
    protected $manufacturer;

    public function __construct(
        ProductRepository $repository,
        ProductImage      $productImage,
        Category          $category,
        Manufacturer      $manufacturer
    )
    {
        $this->manufacturer = $manufacturer;
        $this->productImage = $productImage;
        $this->repository = $repository;
        $this->category = $category;
    }

    public function getAll()
    {
        return $this->repository->getAll();
    }

    public function getAllCategory()
    {
        return $this->category->all();
    }

    public function getAllManufacturer()
    {
        return $this->manufacturer->all();
    }

    public function getProductImages($id){
        return $this->productImage->where('product_id', $id)->get();
    }

    public function getById($id)
    {
        return $this->repository->getById($id);
    }

    public function create($item)
    {
        $data = [
            'name' => $item->name,
            'price' => $item->price,
            'category_id' => $item->category_id,
            'manufacturer_id' => $item->manufacturer_id,
            'description' => $item->description
        ];
        $imagePath = $this->setImageName($item);
        $data['image_path'] = $imagePath->getBasename();
        return $this->repository->create($data);
    }

    public function update($id, $item)
    {
        $this->changeImageSlide($item, $id);
        $data = [
            'name' => $item->name,
            'price' => $item->price,
            'category_id' => $item->category_id,
            'manufacturer_id' => $item->manufacturer_id,
            'description' => $item->description
        ];
        if (!empty($item->image_path)) {
            $this->removeImage($id);
            $imagePath = $this->setImageName($item);
            $data['image_path'] = $imagePath->getBasename();
        }
        return $this->repository->update($id, $data);
    }

    public function removeImage($id){
        $product = $this->getById($id);
        $imagePath = public_path('images/' . $product->image_path);
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
    }

    public function removeImagesSlide($id){
        $productImages = $this->getProductImages($id);
        foreach ($productImages as $image) {
            $imagePath = public_path('images/' . $image->path);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

    }

    public function pagination(Request $request){

        $querySearch = $request->input('query');

        $filterCategory = $request->input('category_id');
        $filterManufacturer = $request->input('manufacturer_id');

        $perPage = 12;
        $products = $this->getAll();
        if ($querySearch){
            $products = $this->search($querySearch);
        }
        if ($filterCategory) {
            $products = $this->getByCategoryId($filterCategory);
        }
        if ($filterManufacturer) {
            $products = $this->getByManufacturerId($filterManufacturer);
        }
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentPageItems = $products->slice(($currentPage - 1) * $perPage, $perPage);
        $pagination = new LengthAwarePaginator($currentPageItems, count($products), $perPage);
        $pagination->setPath(request()->url());
        return $pagination;
    }
    public function setImageName(Request $item) {
        $file = $item->file('image_path');
        $extension = $file->getClientOriginalExtension();
        $imageName = time().'.'.$extension;
        $imagePath = $file->move(public_path('images'), $imageName);
        return $imagePath;
    }
    public function changeImageSlide(Request $items, $id){
        if (isset($items->imageSlide)){
            $idImgs = $items->idImgSlider;
            $images = $items->imageSlide;
            foreach ($images as $key => $value) {
                $idImg = $idImgs[$key];

                if ($idImg){
                    $file = $value;
                    $extension = $file->getClientOriginalExtension();
                    $imageName =  rand(100000, 999999). time() . '.' . $extension;
                    $imagePath = $file->move(public_path('images'), $imageName);
                    $data['path'] = $imagePath->getBasename();

                    //xóa ảnh cũ trong thư mục images
                    $imgOld = $this->productImage->findOrFail($idImg);
                    $deleteImage = public_path('images/' . $imgOld->path);
                    unlink($deleteImage);

                    $productImage = $this->productImage->findOrFail($idImg);
                    $productImage->update($data);
                } else {
                    $file = $value;
                    $extension = $file->getClientOriginalExtension();
                    $imageName =  rand(100000, 999999). time() . '.' . $extension;
                    $imagePath = $file->move(public_path('images'), $imageName);
                    $data['path'] = $imagePath->getBasename();
                    $data['product_id'] = $id;
                    $this->productImage->create($data);
                }

            }
        }

        if (isset($items->idImageDelete)) {
            foreach ($items->idImageDelete as $itemDelete) {
                if ($itemDelete) {

                    $imgOld = $this->productImage->findOrFail($itemDelete);
                    $deleteImage = public_path('images/' . $imgOld->path);
                    unlink($deleteImage);

                    $this->productImage->destroy($itemDelete);

                }
            }
        }
    }

    public function delete($id)
    {
        $this->removeImage($id);
        $this->removeImagesSlide($id);
        return $this->repository->delete($id);
    }

    public function getByManufacturerId($manufacturerId)
    {
        return $this->repository->getByManufacturerId($manufacturerId);
    }

    public function getByCategoryId($categoryId)
    {
        return $this->repository->getByCategoryId($categoryId);
    }
     public function getRecommendedProducts($id){
         $data = $this->getById($id);
         $recommendedProducts = $this->getByCategoryId($data->category_id)->whereNotIn('id', explode(',', $id))->take(3);
         if ($recommendedProducts->isEmpty()){
             $recommendedProducts = $this->getByManufacturerId($data->manufacturer_id)->whereNotIn('id', explode(',', $id))->take(3);
         }
         return $recommendedProducts;
     }

    public function search($request)
    {
        return $this->repository->search($request);
    }
}
