<?php
namespace App\Http\Livewire\Frontend\Product;

use Livewire\Component;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Product;

class View extends Component
{
    public $category, $product, $quantityCount=1, $productColorId, $productColorSelectedQuantity;

    public function mount(Product $product)
    {
        $this->product = $product;
    }

    public function addToWishList($productId)
    {
        if (Auth::check()) {
            if (Wishlist::where('user_id', auth()->user()->id)->where('product_id', $productId)->exists()) {
                session()->flash('message', 'Already added to wishlist');
                return false;
            } else {
                $wishlist = Wishlist::create([
                    'user_id' => auth()->user()->id,
                    'product_id' => $productId
                ]);
                session()->flash('message', 'Wishlist added successfully');
            }
        } else {
            session()->flash('message', 'Please Login to continue');
            return false;
        }
    }



    public function incrementQuantity()
    {
        if ($this->quantityCount < 10) {
            $this->quantityCount++;
        }
    }

    public function decrementQuantity()
    {
        if ($this->quantityCount > 1) {
            $this->quantityCount--;
        }
    }

    public function addToCart(int $productId)
    {
        if(Auth::check())
        {
            if($this->product->where('id',$productId)->where('status','1')->exists())
            {
                if($this->product->quantity > 0)
                {
                    if($this->product->quantity > $this->quantityCount)
                    {
                        Cart::create([
                            'user_id' => auth()->user()->id,
                            'product_id' => $productId,
                            'quantity' => $this->quantityCount
                        ]);
                        $this->emit('CartAddedUpdated');
                        $this->dispatchBrowserEvent('message', [
                            'text' => 'Product Added to Cart',
                            'type' => 'success',
                            'status' => 200
                        ]);
                }
                else
                {
                    $this->dispatchBrowserEvent('message', [
                        'text' => 'Only'.$this->product->quantity.'Quantity Available',
                        'type' => 'warning',
                        'status' => 404
                    ]);
                }
            }else
                {
                    $this->dispatchBrowserEvent('message', [
                        'text' => 'Out of Stock',
                        'type' => 'warning',
                        'status' => 404
                    ]);
                }
            }
            else
            {
                $this->dispatchBrowserEvent('message', [
                    'text' => 'Product Does not exists',
                    'type' => 'warning',
                    'status' => 404
                ]);
            }
        }
        else
        {
            $this->dispatchBrowserEvent('message', [
                'text' => 'Please Login to add to cart',
                'type' => 'info',
                'status' => 401
            ]);
        }
    }
        
        public function render()
        {
            return view('livewire.frontend.product.view',[
            'category'=>$this->category,
            'product'=>$this->product
        ]);
        }
        
    }