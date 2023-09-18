<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CategoryDataTable;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\CategoryFormRequest;

class CategoryController extends Controller
{
    public function index(CategoryDataTable $dataTable)
    {
        // return view('admin.category.index');
        return $dataTable->render('admin.category.index');
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(CategoryFormRequest $request)
    {
        $validatedData = $request->validated();

        $category = new Category();
        $category->name = $validatedData['name'];
        $category->slug = Str::slug($validatedData['slug']);
        $category->description = $validatedData['description'];
       
        $uploadPath = 'uploads/category/';
       if($request->hasFile('image')){
        $file = $request->file('image');
        $ext = $file->getClientOriginalExtension();
        $filename = time().'.'.$ext;

        $file->move('uploads/category/',$filename);
        $category->image = $uploadPath.$filename;
       }
        $category->meta_title = $validatedData['meta_title'];
        $category->meta_keyword = $validatedData['meta_keyword'];
        $category->meta_description = $validatedData['meta_description'];

        $category->status = $request->status == true ? '1':'0';
        $category->save();

        return redirect('admin/category')->with('message','Category Added Succesfully');

    }

    public function edit (Category $category) 
    {
        return view('admin.category.edit', compact('category'));
    } 

    public function update (CategoryFormRequest $request, $category)
    {
        $validatedData = $request->validated();
        $category = Category::findOrFail($category);

        $category->name = $validatedData['name'];
        $category->slug = Str::slug($validatedData['slug']);
        $category->description = $validatedData['description'];

        $uploadPath = 'uploads/category/';
       
       if($request->hasFile('image')){

        $path = 'uploads/category/'.$category->image;
        if(File::exists($path)){
            File::delete($path);
        }
        $file = $request->file('image');
        $ext = $file->getClientOriginalExtension();
        $filename = time().'.'.$ext;

        $file->move('uploads/category/',$filename);
        $category->image = $uploadPath.$filename;
       }
        $category->meta_title = $validatedData['meta_title'];
        $category->meta_keyword = $validatedData['meta_keyword'];
        $category->meta_description = $validatedData['meta_description'];

        $category->status = $request->status == true ? '1':'0';
        $category->update();

        return redirect('admin/category')->with('message','Category Updated Succesfully');
    }

    public function destroy(Category $category)
    {
        // Delete the category
        $category->delete();

        // Redirect or return a response
        return redirect()->back()->with('success', 'Category deleted successfully');
    }
}