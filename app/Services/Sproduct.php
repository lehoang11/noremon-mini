<?php
namespace App\Services;
use Auth;
use DB;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductPhoto;

class Sproduct
{
    public function getAllCategoryByParent($parent_id, $type = CATEGORY_PRODUCT_TYPE, $get = null)
    {
        return Category::where('parent_id', $parent_id)
			        ->where('type', $type)
                    ->orderBy('sort_order','ASC')
                    ->get($get)->toArray();
    }

    public function getAllCategoryByParentAndPublic($parent_id, $type = CATEGORY_PRODUCT_TYPE,
												    $get = null)
    {
        return Category::where('parent_id', $parent_id)
			        ->where('type', $type)
                    ->where('status', STATUS_PUBLIC)
                    ->orderBy('sort_order','ASC')
                    ->get($get)->toArray();
    }

    public function getAllCategoryAndPublic($type = CATEGORY_PRODUCT_TYPE, $get = null)
    {
        return Category::where('type', $type)
			        ->where('status', STATUS_PUBLIC)
                    ->orderBy('id','DESC')
                    ->get($get)->toArray();
    }

    public function getAllProduct($where = null, $get = null)
    {
    	if ($where['key'] and $where['value']) {
    		return Product::where($where['key'], $where['value'])
                    ->orderBy('id','DESC')
                    ->get($get);
    	}
        return Product::where('status','<>',99)->get();
    }

    // get category by keyword
    public function getCateByKyword($q)
    {
        $slug = convertToSlug($q);
        $category = Category::where('name','like','%'.$q.'%')
                            ->orWhere('slug','like','%'.$slug.'%')
                            ->where( 'type',CATEGORY_PRODUCT_TYPE)
                            ->where('status', STATUS_PUBLIC)
                            ->get();
        return $category;
    }

    public function getCateProByParent($parent_id)
    {
        return Category::where('parent_id', $parent_id)
                        ->where('type', CATEGORY_PRODUCT_TYPE)
                        ->where('status', STATUS_PUBLIC)
                        ->get();
    }

    // get category by keyword
    public function getProductByKeyword($q)
    {
        $slug = convertToSlug($q);
        $product = Product::where('name','like','%'.$q.'%')
                            ->orWhere('slug','like','%'.$slug.'%')
                            ->where('status', STATUS_PUBLIC)
                            ->orderBy('id','DESC')
                            ->paginate(20);
        return $product;
    }
    public function getProductByCateId($cate_id)
    {
        return Product::where('category_id',$cate_id)
                        ->where('status', STATUS_PUBLIC)
                        ->orderBy('id','DESC')
                        ->paginate(20);
    }

    public function globalProCategory()
    {
        $globalProCate = $this->getCateProByParent(0);
        foreach ($globalProCate as $k => $item) {
            $globalProCate[$k]['child'] = $this->getCateProByParent($item->id);
            if ($globalProCate[$k]['child']) {
                foreach ($globalProCate[$k]['child'] as $kmin => $value) {
                    $globalProCate[$k]['child'][$kmin]['min'] = $this->getCateProByParent($value->id);
                }
            }
        }
        return $globalProCate;

    }
}