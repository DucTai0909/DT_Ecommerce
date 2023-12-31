<?php

namespace App\Livewire\Frontend\Product;

use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\On; 


class View extends Component
{
    public $category, $product, $prodColorSelectedQuantity, $quantityCount =1;

    public function colorSelected($productColorId){
        $productColor =$this->product->productColors()->where('id', $productColorId)->first();
        $this->prodColorSelectedQuantity = $productColor->quantity;

        if($this->prodColorSelectedQuantity == 0){
            $this->prodColorSelectedQuantity = 'outOfStock';
        }
    }

    public function mount($category, $product){
        $this->category = $category;
        $this->product = $product;
    }
    public function render()
    {
        return view('livewire.frontend.product.view', [
            'category' => $this->category,
            'product' => $this->product,
        ]);
    }

    public function addToWishList($productId){
        if(Auth::check()){
            if(Wishlist::where('user_id', auth()->user()->id)->where('product_id', $productId)->exists()){
                $this->dispatch('message', 
                        message: 'This Product is Already Added to Your Wishlist',
                        type:'error');
                return false;
            }else{
                $wishlist = Wishlist::create([
                    'user_id' => auth()->user()->id,
                    'product_id' => $productId
                ]);

                $this->dispatch('wishlistAddedUpdated');
                $this->dispatch('message', 
                        message: 'Added to Your Wishlist Successfully',
                        type:'success');
            }
        }else{
            // session()->flash('message', 'Please Login To Continue');
            $this->dispatch('message', 
                    message: 'Please Login To Continue',
                    type:'error');
            return false;
        }
    }

    public function decrementQuantity(){
        if($this->quantityCount > 0){
            $this->quantityCount--;
        }
    }

    public function incrementQuantity(){
        $this->quantityCount++;
    }
}