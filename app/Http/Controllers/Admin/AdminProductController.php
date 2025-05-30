<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductAddRequest;
use App\Models\Category;
use App\Components\Recusive;
use App\Traits\StorageImageTrait;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductImage;
use Storage;
use App\Models\Tag;
use App\Models\ProductTag;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Traits\DeleteModelTrait;



class AdminProductController extends Controller
{
    use StorageImageTrait;
    use DeleteModelTrait;

    private $category;
    private $product;
    private $productImage;
    private $tag;

    private $productTag;


    public function __construct(Category $category, Product $product, ProductImage $productImage, Tag $tag, ProductTag $productTag)
    {
        $this->category = $category;
        $this->product = $product;
        $this->productImage = $productImage;
        $this->tag = $tag;
        $this->productTag = $productTag;
    }
    public function index()
    {
        $products = $this->product->latest()->paginate(5);

        return view('admin.product.index', compact('products'));
    }

    public function create()
    {
        $htmlOption = $this->getCategory($parentId = '');

        return view('admin.product.add', compact('htmlOption'));
    }
    public function getCategory($parentId)
    {
        $data = $this->category->all();
        $recusive = new Recusive($data);
        $htmlOption = $recusive->categoryRecusive($parentId);
        return $htmlOption;
    }
    public function store(ProductAddRequest $request)
    {
        try {
            $dataProductCreate = [
                'name' => $request->name,
                'price' => $request->price,
                'content' => $request->content,
                'user_id' => auth()->id(),
                'category_id' => $request->category_id
            ];
            $dataUploadFeatureImage = $this->storageTraitUpload($request, 'feature_image_path', 'product');
            if (!empty($dataUploadFeatureImage)) {
                $dataProductCreate['feature_image_name'] =  $dataUploadFeatureImage['file_name'];
                $dataProductCreate['feature_image_path'] =  $dataUploadFeatureImage['file_path'];
            }
            $product = $this->product->create($dataProductCreate);
            // insert data to product_image
            if ($request->hasFile('image_path')) {
                foreach ($request->image_path as $fileItem) {
                    $dataProductImageDetail = $this->storageTraitUploadMultiple($fileItem, 'product');
                    $product->images()->create([
                        'image_path' => $dataProductImageDetail['file_path'],
                        'image_name' => $dataProductImageDetail['file_name'],

                    ]);
                }
            }
            // Insert tags for product
            if (!empty($request->tags)) {
                foreach ($request->tags as $tagItem) {
                    // insert to tags
                    $tagInstance = $this->tag->firstOrCreate(['name' => $tagItem]);
                    $tagIds[] = $tagInstance->id;
                }
            }

            if (!empty($tagIds)) {
                $product->tags()->attach($tagIds);
            }
            DB::commit();
            return redirect()->route('product.index');
        } catch (Exception $exception) {
            DB::rollBack();
            Log::error('Message:' . $exception->getMessage() . 'Line : ' . $exception->getLine());
        }
    }

    public function edit($id)
    {
        $product = $this->product->find($id);
        $htmlOption = $this->getCategory($product->category_id);
        return view('admin.product.edit', compact('htmlOption', 'product'));
    }
    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $dataProductUpdate = [
                'name' => $request->name,
                'price' => $request->price,
                'content' => $request->content,
                'user_id' => auth()->id(),
                'category_id' => $request->category_id
            ];
            $dataUploadFeatureImage = $this->storageTraitUpload($request, 'feature_image_path', 'product');
            if (!empty($dataUploadFeatureImage)) {
                $dataProductUpdate['feature_image_name'] =  $dataUploadFeatureImage['file_name'];
                $dataProductUpdate['feature_image_path'] =  $dataUploadFeatureImage['file_path'];
            }
            $this->product->find($id)->update($dataProductUpdate);
            $product = $this->product->find($id);
            // insert data to product_image
            if ($request->hasFile('image_path')) {
                $this->productImage->where('product_id', $id)->delete();
                foreach ($request->image_path as $fileItem) {
                    $dataProductImageDetail = $this->storageTraitUploadMultiple($fileItem, 'product');
                    $product->images()->create([
                        'image_path' => $dataProductImageDetail['file_path'],
                        'image_name' => $dataProductImageDetail['file_name'],

                    ]);
                }
            }
            // Insert tags for product
            if (!empty($request->tags)) {
                foreach ($request->tags as $tagItem) {
                    // insert to tags
                    $tagInstance = $this->tag->firstOrCreate(['name' => $tagItem]);
                    $tagIds[] = $tagInstance->id;
                }
            }


            $product->tags()->sync($tagIds);

            DB::commit();
            return redirect()->route('product.index');
        } catch (Exception $exception) {
            DB::rollBack();
            Log::error('Message:' . $exception->getMessage() . 'Line : ' . $exception->getLine());
        }
    }
    public function delete($id)
    {
        return $this->deleteModelTrait($id, model: $this->product);
    }
    /////
    public function detailsProduct($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all(); // Lấy tất cả categories
        // Hoặc bạn có thể chỉ lấy danh mục cha nếu logic menu của bạn chỉ cần chúng
        // $categories = Category::whereNull('parent_id')->orWhere('parent_id', 0)->get();

        return view('pages.products.details', compact('product', 'categories'));
    }
}
