<?php

namespace App\Http\Livewire\Admin\Category;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\File;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    
    public $category_id;

    public function deleteCategory($category_id)
    {
        $this->category_id = $category_id;
        $this->dispatchBrowserEvent('open-delete-modal');
    }

    // public function destroyCategory()
    // {
    //     $category = Category::find($this->category_id);
    //     if (!$category) {
    //         session()->flash('message', 'Category not found');
    //         return;
    //     }
    //     $path = 'uploads/category/'.$category->image;
    //     if(File::exists($path)){
    //         File::delete($path);
    //     }
    //     $category->delete();
    //     session()->flash('message','Category Deleted');
    //     $this->dispatchBrowserEvent('close-delete-modal');
    // }
    
    public function destroyCategory(){
    $category = Category::find($this->category_id);
    if (!$category) {
        session()->flash('message', 'Category not found');
        return;
    }
    $path = 'uploads/category/'.optional($category)->image;
    if (File::exists($path)) {
        File::delete($path);
    }
    if (optional(($category))->delete()){
        session()->flash('message', 'Category deleted');
    } else {
        session()->flash('message', 'Failed to delete category');
    }
    $this->dispatchBrowserEvent('close-modal');
}


    // public function destroyCategory()
    // {
    //     $category = Category::find($this->category_id);
    //     $path = 'uploads/category/'.optional($category)->image;
    //     if(File::exists($path)){
    //         File::delete($path);
    //     }
    //     optional($category)->delete();
    //     session()->flash('message','Category Deleted');
    //     $this->dispatchBrowserEvent('close-modal');
    // }

    // public function destroyCategory()
    // {
    //     $category = Category::find($this->category_id);
    //     $path = 'uploads/category/'.$category->image;
    //     if(File::exists($path)){
    //         File::delete($path);
    //     }
    //     $category->delete();
    //     session()->flash('message','Category Deleted');
    //     $this->dispatchBrowserEvent('close-modal');
    // }
    public function render()
    {
        $categories = Category::orderBy('id','DESC')->paginate(10);
        return view('livewire.admin.category.index', ['categories' => $categories]);
    }
}