<?php

namespace App\Http\Livewire\Frontend\Cart;
use App\Models\Cart;


use Livewire\Component;

class CartShow extends Component
{
    public $cart, $totalPrice = 0;

    public function decrementQuantity(int $cartId){

        $cartData=Cart::where('id', $cartId)->where('user_id',auth()->user()->id)->first();
        if($cartData){
            $cartData->decrement('quantity');
            $this->dispatchBrowserEvent('message', [
                'text'=> 'Quantity Updated',
                'type'=> 'success',
                'status'=>200
            ]);
        }else{
            $cartData->decrement('quantity');
            $this->dispatchBrowserEvent('message', [
                'text'=> 'Something Went Wrong',
                'type'=> 'error',
                'status'=>404
            ]);
        }
    }

    public function incrementQuantity(int $cartId){

        $cartData=Cart::where('id', $cartId)->where('user_id',auth()->user()->id)->first();
        if($cartData){
            $cartData->increment('quantity');
            $this->dispatchBrowserEvent('message', [
                'text'=> 'Quantity Updated',
                'type'=> 'success',
                'status'=>200
            ]);
        }else{
            $cartData->increment('quantity');
            $this->dispatchBrowserEvent('message', [
                'text'=> 'Something Went Wrong',
                'type'=> 'error',
                'status'=>404
            ]);
        }
    }

    public function removeCartItem(int $cartId)
    {
        $cartRemoveData = Cart::find($cartId);
    
        if ($cartRemoveData) {
            $cartRemoveData->delete();
    
            $this->emit('CartAddedUpdated');
            $this->dispatchBrowserEvent('message', [
                'text' => 'Cart Item Removed',
                'type' => 'success',
                'status' => 20
            ]);
        } else {
            $this->dispatchBrowserEvent('message', [
                'text' => 'Something Went Wrong',
                'type' => 'error',
                'status' => 500
            ]);
        }
    }
    
    public function render()
    {

        $this->cart = Cart::where('user_id', auth()->user()->id)->get();
        return view('livewire.frontend.cart.cart-show', [
        'cart' =>$this->cart
    ]);
}
}
