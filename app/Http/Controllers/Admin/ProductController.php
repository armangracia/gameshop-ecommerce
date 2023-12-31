<?php

namespace App\Http\Controllers\Admin;


use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\File;
use App\DataTables\ProductsDataTable;
use App\Http\Requests\ProductFormRequest;
use Illuminate\Validation\Rules\ImageFile;

class ProductController extends Controller
{
    public function index(ProductsDataTable $dataTable)
    {
        $products = Product::all();
        return $dataTable->render('admin.products.index');
        //view('admin.products.index',compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
       
        return view('admin.products.create', compact('categories'));
    }

    public function store(ProductFormRequest $request)
    {
        $validatedData = $request->validated();

        $category = Category::findOrFail($validatedData['category_id']);
        $product =  $category -> products()->create
        (
            [
                    'category_id' => $validatedData['category_id'],
                    'name' => $validatedData['name'],
                    'slug' => Str::slug($validatedData['slug']),
                    'small_description' => $validatedData['small_description'],
                    'description' => $validatedData['description'],
                    'original_price' => $validatedData['original_price'],
                    'selling_price' => $validatedData['selling_price'],
                    'quantity' => $validatedData['quantity'],
                    'trending' => $request -> trending == true ? '1':'0',
                    'status' => $request -> status == true ? '1':'0',
                    'meta_title' => $validatedData['meta_title'],
                    'meta_keyword' => $validatedData['meta_keyword'],
                    'meta_description' => $validatedData['meta_description'],
            ]);

     if($request->hasFile('image'))
        {
            $uploadPath = 'uploads/products/';
            $i = 1;
            foreach($request->file('image') as $imageFile)
            {
                $extention = $imageFile->getClientOriginalExtension();
                $filename = time().$i++.'.'.$extention;
                $imageFile->move($uploadPath, $filename);
                $finalImagePathName = $uploadPath.'-'.$filename;
        
                $product->productImages()->create([
                    'product_id' => $product->id,
                    'image' => $finalImagePathName,   
                ]);
            }
            // foreach ($request->file('image') as $imageFile) {{
            //     $extension = $imageFile->getClientOriginalExtension();
            //     $filename = time() . '.' . $extension;
            //     $imageFile->move($uploadPath, $filename);
            //     $finalImagePathName = $uploadPath . '/' . $filename;
            
            //     $product->productImages()->create([
            //         'product_id' => $product->id,
            //         'image' => $finalImagePathName,
            //     ]);
            // }}
            
        }
         
        return  redirect('/admin/products')->with('mesage', 'Product Added Sucessfully');
    }
    public function edit(int $product_id)
    {
        $categories = Category::all();
        $product = Product::findOrFail($product_id); 
        return view('admin.products.edit',compact('categories','product'));
    }

    public function update(ProductFormRequest $request,int $product_id)
    {
        $validatedData = $request->validated();

        $product = Category::findOrFail($validatedData['category_id'])
                        ->products()->where('id',$product_id)->first();
                if ($product) {
                   $product->update([
                               'category_id' => $validatedData['category_id'],
                               'name' => $validatedData['name'],
                               'slug' => Str::slug($validatedData['slug']),
                              
                               'small_description' => $validatedData['small_description'],
                               'description' => $validatedData['description'],
                               'original_price' => $validatedData['original_price'],
                               'selling_price' => $validatedData['selling_price'],
                               'quantity' => $validatedData['quantity'],
                               'trending' => $request -> trending == true ? '1':'0',
                               'status' => $request -> status == true ? '1':'0',
                               'meta_title' => $validatedData['meta_title'],
                               'meta_keyword' => $validatedData['meta_keyword'],
                               'meta_description' => $validatedData['meta_description'],
                       ]);

                       if($request->hasFile('image'))
                       {
                           $uploadPath = 'uploads/products/';
                           $i = 1;
                           foreach($request->file('image') as $imageFile)
                           {
                               $extention = $imageFile->getClientOriginalExtension();
                               $filename = time().$i++.'.'.$extention;
                               $imageFile->move($uploadPath, $filename);
                               $finalImagePathName = $uploadPath.'-'.$filename;
                       
                               $product->productImages()->create([
                                   'product_id' => $product->id,
                                   'image' => $finalImagePathName,   
                               ]);
                           }
                       }
                        
                       return  redirect('/admin/products')->with('mesage', 'Product Updated Sucessfully');

                } else {
                    return redirect('admin/products')->with('message','No Such Product ID found');
                }
                        
    }

    public function destroyImage(Int $product_image_id)
    {
        $productImage= ProductImage::findOrFail($product_image_id);
            if(File::exists($productImage->image)){
                File::delete($productImage->image);
            }

                $productImage->delete();
                return redirect()->back()->with('message','Product Image Deleted');
    }

    public function destroy(int $product_id)
    {
            $product = Product::findOrFail($product_id);
            if($product->productImages){
                    foreach($product->productImages as $image){
                        if(File::exists($image->image)){
                            File::delete($image->image);
                        }
                    }
            }
            $product->delete();
            return redirect()->back()->with('message','Product Deleted with all its image');
     }
}
