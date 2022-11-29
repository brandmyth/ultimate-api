<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Section;
use App\Models\Category;
use App\Models\Product;
use App\Models\Brand;
use App\Imports\ProductsImport;
use App\Models\ProductCollection;
use App\Models\Attribute;
use App\Models\Order;
use App\Models\Tax;
use App\Models\ProductsImage;
use Maatwebsite\Excel\Facades\Excel;
use Auth;
use Image;
// use PhpParser\Node\Attribute;

class ProductController extends Controller
{
    public $attr;
    public $inputs = [];
    public $attribute_attr = [];
    public $attributes_values;


    public function products()
    {
        //check if current loggedin admin is vendor or not  
        if (Auth::guard('admin')->user()->type == "vendor") {
            //get current loggedin vendor id
            $vendor_id = Auth::guard('admin')->user()->vendor_id;
            $products = Product::where('vendor_id', $vendor_id)->with(['section' => function ($query) {
                $query->select('id', 'name');
            }, 'category' => function ($query) {
                $query->select('id', 'category_name');
            }])->get()->toArray();
        } else {
            $products = Product::with(['section' => function ($query) {
                $query->select('id', 'name');
            }, 'category' => function ($query) {
                $query->select('id', 'category_name');
            }])->get()->toArray();
        }
        //dd($products);
        return view('admin.products.products')->with(compact('products'));
    }
    public function addEditProduct(Request $request, $id = null)
    {
        if ($id == "") {
            $title = "Add Product";
            $product = new Product;
            $message = "Product added Successfully!";
        } else {
            $title = "Edit Product";
            $product = Product::with('images')->find($id);
            $message = "Product updated Successfully!";
        }
        if ($request->isMethod('post')) {
            $data = $request->all();
            $rules = [
                'category_id' => 'required',
                'product_name' => 'required',
                // 'product_code' => 'required',
                'product_price' => 'required|numeric',
                // 'stock' => 'nullable|numeric',
                'product_discount' => 'nullable|max:100',
            ];
            $customMessages = [
                'category_id.required' => 'Category is required!',
                'product_name.required' => 'Product is required!',
                // 'product_code.required' => 'Product Code is required!',
                'product_price.required' => 'Product Price is required!',
                'product_price.numeric' => 'Valid Price is required!',
                // 'stock.numeric' => 'Stock should be numeric!',
                'product_discount.max' => 'Product Discount Cannot Be More Than 100!',
            ];
            $this->validate($request, $rules, $customMessages);
            // dd($data);
            //Save Product Details
            $categoryDetails = Category::find($data['category_id']);
            $product->section_id = $categoryDetails['section_id'];
            $product->category_id = $data['category_id'];
            $product->brand_id = $data['brand_id'];
            $product->product_collection_id = $data['product_collection_id'];

            $adminType = Auth::guard('admin')->user()->type;
            $admin_id = Auth::guard('admin')->user()->id;

            $product->admin_type = $adminType;
            $product->admin_id = $admin_id;

            if (empty($data['product_discount'])) {
                $data['product_discount'] = 0;
            }
            if (empty($data['product_weight'])) {
                $data['product_weight'] = 0;
            }
            $product->product_name = $data['product_name'];

            $product->product_price = $data['product_price'];
            $product->product_discount = $data['product_discount'];

            $product->short_description = $data['short_description'];
            $product->description = $data['description'];
            $product->meta_title = $data['meta_title'];
            $product->meta_description = $data['meta_description'];
            $product->meta_keywords = $data['meta_keywords'];
            if (!empty($data['is_popular'])) {
                $product->is_popular = $data['is_popular'];
            } else {
                $product->is_popular = "No";
            }
            if (!empty($data['is_featured'])) {
                $product->is_featured = $data['is_featured'];
            } else {
                $product->is_featured = "No";
            }
            if (!empty($data['is_bestseller'])) {
                $product->is_bestseller = $data['is_bestseller'];
            } else {
                $product->is_bestseller = "No";
            }
            if (!empty($data['is_dealsday'])) {
                $product->is_dealsday = $data['is_dealsday'];
            } else {
                $product->is_dealsday = "No";
            }
            $product->status = 1;

            //Attributs
            if (!empty($data['attribute_name'])) {
                $attributes = array();
                for ($i = 0; $i < count($data['attribute_name']); $i++) {
                    $value = [
                        'id' => ($i + 1),
                        'attribute_name' => $data['attribute_name'][$i],
                        'attribute_value' => $data['attribute_value'][$i],
                        'attribute_price' => $data['attribute_price'][$i],
                        'stock' => $data['stock'][$i],
                        'product_sku' => $data['product_sku'][$i]
                    ];
                    array_push($attributes, $value);
                }
                $product->attributes = json_encode($attributes);
            }


            //Upload Product Image after Resize small: 250*250 mduium: 500*500 large: 1000*1000
            if ($request->hasFile('product_image')) {
                $image_tmp = $request->file('product_image');
                if ($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $imgName = rand(111, 99999) . '.' . $extension;
                    $largeImagePath = 'frontend/images/product_images/large/' . $imgName;
                    $mediumImagePath = 'frontend/images/product_images/medium/' . $imgName;
                    $smallImagePath = 'frontend/images/product_images/small/' . $imgName;
                    Image::make($image_tmp)->resize(1000, 1000)->save($largeImagePath);
                    Image::make($image_tmp)->resize(500, 500)->save($mediumImagePath);
                    Image::make($image_tmp)->resize(250, 250)->save($smallImagePath);
                    $product->product_image = $imgName;
                }
            }

            if ($request->hasFile('product_video')) {
                $video_tmp = $request->file('product_video');
                if ($video_tmp->isValid()) {
                    $extension = $video_tmp->getClientOriginalExtension();
                    $videoName = rand(111, 99999) . '.' . $extension;
                    $videoPath = 'frontend/videos/product_videos/';
                    $video_tmp->move($videoPath, $videoName);

                    $product->product_video = $videoName;
                }
            }

            $product->product_tags = $data['product_tags'];
            $product->tax_id = $data['tax_id'];
            if (!empty($data['product_code'])) {
                $product->product_code = $data['product_code'];
                $product->product_weight = $data['product_weight'];
                $product->stock = $data['stock'];
                $product->product_color = $data['product_color'];
                $product->product_size = $data['product_size'];
            }
            $product->product_slug = strtolower(preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '', $data['product_name'])));
            $product->save();

            if ($request->hasFile('product_images')) {
                foreach ($request->product_images as $image) {
                    $product_images = new ProductsImage();
                    $product_images->product_id = $product->id;

                    $image_tmp = $image;
                    // dd($image_tmp);
                    if ($image_tmp->isValid()) {

                        $image_tmp = Image::make($image);
                        $extension = $image->getClientOriginalExtension();
                        $imgName = $product->product_slug . rand(111, 99999) . '.' . $extension;
                        $largeImagePath = 'frontend/images/product_images/large/' . $imgName;
                        $mediumImagePath = 'frontend/images/product_images/medium/' . $imgName;
                        $smallImagePath = 'frontend/images/product_images/small/' . $imgName;
                        Image::make($image_tmp)->resize(1000, 1000)->save($largeImagePath);
                        Image::make($image_tmp)->resize(500, 500)->save($mediumImagePath);
                        Image::make($image_tmp)->resize(250, 250)->save($smallImagePath);

                        $product_images->image = $imgName;
                    }
                    $product_images->status = 1;
                    $product_images->save();
                }
            }

            return redirect('admin/products')->with('success_message', $message);
        }
        //get all Sections with Categories & Sub Categories
        $categories = Section::with('categories')->get()->toArray();
        //get all Brands
        $brands = Brand::get()->toArray();

        $taxes = Tax::get()->toArray();

        $attributes = Attribute::get()->toArray();

        $productCollection = ProductCollection::get()->toArray();

        $inputs = [];


        return view('admin.products.add_edit_product')->with(compact('title', 'categories', 'brands', 'taxes', 'product', 'attributes', 'productCollection', 'inputs'));
    }
    ////////////Bulk addddddddddd
    public function addBulkProducts(Request $request, $download = null)
    {
        $title = "Bulk Product Upload";
        $message = "Product updated Successfully!";

        if ($download == 'download') {
            $template = public_path("admin/excel_template/UltimateEcommerceBulkUpload.xlsx");
            return response()->download($template);
        }
        if ($request->isMethod('post')) {
            $data = $request->all();
            $rules = [
                'category_id' => 'required',
                'excelFile' => 'required|mimes:xlsx|max:50000'
            ];
            $customMessages = [
                'category_id.required' => 'Category is required!',
                'excelFile.required' => 'Excel File Required',
                'excelFile.mimes' => 'The file must be a file of type: xlsx'
            ];
            $this->validate($request, $rules, $customMessages);
            $path = $request->file('excelFile');

            $excelData  = Excel::toArray(new ProductsImport(), $path);

            for ($i = 1; $i < count($excelData[0]); $i++) {
                // dd($excelData[0][$i]);

                $product = new Product();
                $categoryDetails = Category::find($data['category_id']);
                $product->section_id = $categoryDetails['section_id'];
                $product->category_id = $data['category_id'];
                $product->brand_id = $data['brand_id'];

                $adminType = Auth::guard('admin')->user()->type;
                $admin_id = Auth::guard('admin')->user()->id;

                $product->admin_type = $adminType;
                $product->admin_id = $admin_id;

                $product->product_name = $excelData[0][$i][0];
                $product->product_code = $excelData[0][$i][1];
                $product->product_price = $excelData[0][$i][2];
                $product->product_discount = $excelData[0][$i][3];
                $product->product_weight = $excelData[0][$i][4];
                $product->short_description = $excelData[0][$i][5];
                $product->description = $excelData[0][$i][6];
                $product->meta_title = $excelData[0][$i][7];
                $product->meta_description = $excelData[0][$i][8];
                $product->meta_keywords = $excelData[0][$i][9];
                $product->is_featured = $excelData[0][$i][10];
                $product->is_bestseller = $excelData[0][$i][11];
                $product->product_image = $excelData[0][$i][12];
                $product->product_video = $excelData[0][$i][13];
                $product->stock = $excelData[0][$i][14];
                $product->status = 1;
                // dd($product);
                $product->product_slug = strtolower(preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '', $excelData[0][$i][0])));
                $product->save();
            }


            return redirect('admin/products')->with('success_message', $message);
        }
        //get all Sections with Categories & Sub Categories
        $categories = Section::with('categories')->get()->toArray();
        //get all Brands
        $brands = Brand::get()->toArray();

        return view('admin.products.add_bulk_products')->with(compact('title', 'categories', 'brands'));
    }

    public function updateProductStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == "Active") {
                $status = 0;
            } else {
                $status = 1;
            }
            Product::where('id', $data['product_id'])->update(['status' => $status]);

            return response()->json(['status' => $status, 'product_id' => $data['product_id']]);
        }
    }
    public function deleteProduct($id)
    {
        Product::where('id', $id)->delete();
        $message = "Product has been deleted successfully!";
        return redirect()->back()->with('success_message', $message);
    }

    public function deleteProductImage($id)
    {
        //Get Product Image
        $product_image = Product::select('product_image')->where('id', $id)->first();

        //Get Image Path
        $small_image_path = 'frontend/images/product_images/small/';
        $medium_image_path = 'frontend/images/product_images/medium/';
        $large_image_path = 'frontend/images/product_images/large/';

        //Delete Small Image if exists
        if (file_exists($small_image_path . $product_image->product_image)) {
            unlink($small_image_path . $product_image->product_image);
        }
        //Delete Medium Image if exists
        if (file_exists($medium_image_path . $product_image->product_image)) {
            unlink($medium_image_path . $product_image->product_image);
        }
        //Delete Small Image if exists
        if (file_exists($large_image_path . $product_image->product_image)) {
            unlink($large_image_path . $product_image->product_image);
        }
        //Delete Image from Product
        Product::where('id', $id)->update(['product_image' => '']);

        $message = "Product Image has been deleted successfully!";
        return redirect()->back()->with('success_message', $message);
    }
    public function deleteProductVideo($id)
    {
        //Get Video
        $product_video = Product::select('product_video')->where('id', $id)->first();

        //Get Video Path
        $video_path = 'frontend/videos/product_videos/';

        //Delete Video if exists
        if (file_exists($video_path . $product_video->product_video)) {
            unlink($video_path . $product_video->product_video);
        }

        //Delete Video from Product
        Product::where('id', $id)->update(['product_video' => '']);

        $message = "Product video has been deleted successfully!";
        return redirect()->back()->with('success_message', $message);
    }

    public function addImages($id, Request $request)
    {
        $product = Product::select('id', 'product_name', 'product_code', 'product_price', 'product_image')->with('images')->find($id);
        if ($request->isMethod('post')) {
            $data = $request->all();
            if ($request->hasFile('images')) {
                $images = $request->file('images');

                foreach ($images as $key => $image) {
                    $image_tmp = Image::make($image);
                    $image_name = $image->getClientOriginalName();
                    $extension = $image->getClientOriginalExtension();
                    $imgName = $image_name . rand(111, 99999) . '.' . $extension;
                    $largeImagePath = 'frontend/images/product_images/large/' . $imgName;
                    $mediumImagePath = 'frontend/images/product_images/medium/' . $imgName;
                    $smallImagePath = 'frontend/images/product_images/small/' . $imgName;
                    Image::make($image_tmp)->resize(1000, 1000)->save($largeImagePath);
                    Image::make($image_tmp)->resize(500, 500)->save($mediumImagePath);
                    Image::make($image_tmp)->resize(250, 250)->save($smallImagePath);

                    $image = new ProductsImage;
                    $image->image = $imgName;
                    $image->product_id = $id;
                    $image->status = 1;
                    $image->save();
                }
            }
            $message = "Product Image has been added successfully!";
            return redirect('admin/add-edit-product/' . $id)->with('success_message', $message);
        }

        return view('admin.images.add_images')->with(compact('product'));
    }
    public function updateImageStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == "Active") {
                $status = 0;
            } else {
                $status = 1;
            }
            ProductsImage::where('id', $data['image_id'])->update(['status' => $status]);

            return response()->json(['status' => $status, 'image_id' => $data['image_id']]);
        }
    }
    public function deleteImage($id)
    {
        $product_id=0;
        //Get Product Image
        $product_image = ProductsImage::select('product_id','image')->where('id', $id)->first();
        $product_id = $product_image->product_id;
        //Get Image Path
        $small_image_path = 'frontend/images/product_images/small/';
        $medium_image_path = 'frontend/images/product_images/medium/';
        $large_image_path = 'frontend/images/product_images/large/';

        //Delete Small Image if exists
        if (file_exists($small_image_path . $product_image->image)) {
            unlink($small_image_path . $product_image->image);
        }
        //Delete Medium Image if exists
        if (file_exists($medium_image_path . $product_image->image)) {
            unlink($medium_image_path . $product_image->image);
        }
        //Delete Small Image if exists
        if (file_exists($large_image_path . $product_image->image)) {
            unlink($large_image_path . $product_image->image);
        }
        //Delete Image from ProductsImage
        ProductsImage::where('id', $id)->delete();

        $message = "Product Image has been deleted successfully!";
        return redirect('admin/add-edit-product/' . $product_id)->with('success_message', $message);
    }

    public function addAttrVal()
    {

        if (!in_array($this->attr, $this->attribute_attr)) {
            array_push($this->inputs, $this->attr);
            array_push($this->attribute_attr, $this->attr);
        }
        return redirect()->back();
    }

    public function setAttributes(Request $request)
    {
        if ($request->ajax()) {
            $attributes = Attribute::all();

            return response()->json(['attributes' => $attributes]);
        }

        if ($request->isMethod('get')) {
            $attributes = Attribute::all();
            return view('admin.attributes.set_show_attributes')->with(compact('attributes'));
        }

        if ($request->isMethod('post')) {
            $data = $request->all();
            $rules = [
                'name' => 'required',
            ];
            $customMessages = [
                'name.required' => 'Name is required!',
            ];
            $this->validate($request, $rules, $customMessages);
            $attribute = new Attribute();
            $attribute->name = $data['name'];
            $message = "Attribute Added Successfully!";
            $attribute->save();
            return redirect('admin/set-attributes')->with('success_message', $message);
        }
    }

    public function delete_attribute($id)
    {
        $attributes = Attribute::findOrFail($id);
        $attributes->delete();
        $message = "Attribute Delete Successfully!";
        return redirect('admin/set-attributes')->with('success_message', $message);
    }


    // Product Collection

    public function productCollection()
    {
        $productCollection = ProductCollection::get()->toArray();
        return view('admin.product_collection.productCollection')->with(compact('productCollection'));
    }

    public function addEditproductCollection(Request $request, $id = null)
    {
        if ($id == "") {
            $title = "Add Product Collection";
            $productCollection = new ProductCollection;
            $message = "Product Collection Added Successfully!";
        } else {
            $title = "Edit Product Collection";
            $productCollection = ProductCollection::find($id);
            $message = "Product Collection Updated Successfully!";
        }
        if ($request->isMethod('post')) {
            $data = $request->all();
            $rules = [
                'name' => 'required',
            ];
            $customMessages = [
                'name.required' => 'name is required!',
            ];
            $this->validate($request, $rules, $customMessages);


            $productCollection->name = $data['name'];
            $productCollection->start_date = $data['start_date'];
            $productCollection->end_date = $data['end_date'];
            $productCollection->discount_amount = $data['discount_amount'];

            if ($data['discount_type'] == "amount") {
                $productCollection->discount_type = $data['discount_type'];
            } else if ($data['discount_type'] == "percentage") {
                $productCollection->discount_type = $data['discount_type'];
            } else {
                $productCollection->discount_type = $data['discount_type'];
            }
            $productCollection->description = 1;
            $productCollection->url = 1;
            $productCollection->meta_title = 1;
            $productCollection->meta_description = 1;
            $productCollection->meta_keywords = 1;
            $productCollection->status = 1;
            $productCollection->save();
            return redirect('admin/product-collection')->with('success_message', $message);
        }
        return view('admin.product_collection.add_edit_product_collection')->with(compact('title', 'productCollection'));
    }
    public function deleteProductCollection($id)
    {
        ProductCollection::where('id', $id)->delete();
        $message = "Banner has been deleted successfully!";
        return redirect()->back()->with('success_message', $message);
    }
}
