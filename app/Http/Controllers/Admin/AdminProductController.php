<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductAddRequest;
use App\Models\Category;
use App\Components\Recusive;
use App\Models\Colors;
use App\Traits\StorageImageTrait;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductImage;
use Storage;
use App\Models\ProductVariant;
use App\Models\Sizes;
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
    private $colors;
    private $sizes;
    private $productVariant;

    public function __construct(Category $category, Product $product, ProductImage $productImage, Colors $colors, Sizes $sizes, ProductVariant $productVariant)
    {
        $this->category = $category;
        $this->product = $product;
        $this->productImage = $productImage;
        $this->colors = $colors;
        $this->sizes = $sizes;
        $this->productVariant = $productVariant;
    }

    public function index()
    {
        $products = $this->product->latest()->paginate(5);

        return view('admin.product.index', compact('products'));
    }

    public function create()
    {
        $htmlOption = $this->getCategory($parentId = '');
        $colors= $this->colors->get();
        $sizes = $this->sizes->get();

        return view('admin.product.add', compact('htmlOption', 'colors', 'sizes'));
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
                'discount' => $request->discount,
                'content' => $request->content,
                'user_id' => auth()->id(),
                'category_id' => $request->category_id,
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
            if($request->product_variant) {
                foreach($request->product_variant as $variant) {
                    $this->productVariant->create([
                        'product_id' => $product->id,
                        'color_id' => $variant['color_id'],
                        'size_id' => $variant['size_id'],
                        'stock' => $variant['stock']
                    ]);
                }
            }

            DB::commit();
            return redirect()->route('product.index');
        } catch (Exception $exception) {
            dd($exception);
            DB::rollBack();
            Log::error('Message:' . $exception->getMessage() . 'Line : ' . $exception->getLine());
        }
    }

    public function edit($id)
    {
        $product = $this->product->find($id);
        $htmlOption = $this->getCategory($product->category_id);
        $product_variants = $this->productVariant->where('product_id', $product->id)->get();
        $colors = $this->colors->get();
        $sizes = $this->sizes->get();
        return view('admin.product.edit', compact('htmlOption', 'product', 'product_variants', 'colors', 'sizes'));
    }
    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $dataProductUpdate = [
                'name' => $request->name,
                'price' => $request->price,
                'discount' => $request->discount,
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
            
            //Insert product variant
            if($request->product_variant) {
                $this->productVariant->where('product_id', $id)->delete();
                foreach($request->product_variant as $variant) {
                    $this->productVariant->create([
                        'product_id' => $id,
                        'color_id' => $variant['color_id'],
                        'size_id' => $variant['size_id'],
                        'stock' => $variant['stock']
                    ]);
                }
            }

            DB::commit();
            return redirect()->route('product.index');
        } catch (Exception $exception) {
            DB::rollBack();
            Log::error('Message:' . $exception->getMessage() . 'Line : ' . $exception->getLine());
        }
    }
    public function delete($id)
    {
        $this->productVariant->where('product_id', $id)->delete();
        
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
