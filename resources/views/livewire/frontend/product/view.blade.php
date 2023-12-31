<div>
    <div class="py-3 py-md-5">
        <div class="container">
            {{-- @if (session()->has('message'))
                @if (session('message') == 'This Product is Added to Your Wishlist Successfully')
                    <div id="responseMessage" class="alert alert-success"><b>{{ session('message') }}</b></div>
                @else
                    <div id="responseMessage" class="alert alert-danger"><b>{{ session('message') }}</b></div>
                @endif
            @endif --}}
            <div class="row">
                <div class="col-md-5 mt-3">
                    <div class="bg-white border">
                        <img src="{{ asset($product->productImages[0]->image) }}" class="w-100" >
                    </div>
                </div>
  
                <div class="col-md-7 mt-3">
                    <div class="product-view">
                        <h4 class="product-name">
                            <b>{{ $product->name }}</b>
                            <label class="label-stock bg-success">In Stock</label>
                        </h4>
                        <hr>
                        <p class="product-path">
                            <a href="{{ url('/') }}">Home</a> / <a href="{{ url('/collections/'.$category->name) }}">{{$category->name}}</a> / {{$product->name}}
                        </p>
                        <div>
                            <span class="selling-price">{{number_format($product->selling_price, 0, ',', '.')}}</span>
                            <span class="original-price">{{number_format($product->original_price, 0, ',', '.')}}</span>
                        </div>
                        <div>
                            @if ($product->productColors->count() > 0)
                                @if ($product->productColors)
                                    
                                    @foreach ($product->productColors as $colorItem)
                                        {{-- <input type="radio" name="colorSelection" 
                                            value="{{ $colorItem->id }}"/> {{ $colorItem->color->name }} --}}
                                        <label class="colorSelectionLabel" style="background-color: {{ $colorItem->color->code }}"
                                            wire:click="colorSelected({{ $colorItem->id }})">
                                            {{ $colorItem->color->name }}
                                        </label>
                                    @endforeach
                                @endif
                                
                                <div>
                                    @if ($this->prodColorSelectedQuantity == 'outOfStock')
                                        <label class="btn-sm py-1 mt-2 text-white bg-danger"> Out of Stock </label>

                                    @elseif($this->prodColorSelectedQuantity > 0)
                                        <label class="btn-sm py-1 mt-2 text-white bg-success"> In Stock </label>
                                    @endif
                                </div>
                               

                            @else
                                @if ($product->quantity)
                                    <label class="btn-sm py-1 mt-2 text-white bg-success"> In Stock </label>
                                @else
                                    <label class="btn-sm py-1 mt-2 text-white bg-danger"> Out of Stock </label>
                                @endif
                            @endif

                        </div>
                        <div class="mt-2">
                            <div class="input-group">
                                <span class="btn btn1" wire:click="decrementQuantity"><i class="fa fa-minus"></i></span>
                                <input type="text" wire:model="quantityCount" value="{{ $this->quantityCount }}" readonly class="input-quantity" />
                                <span class="btn btn1" wire:click="incrementQuantity"><i class="fa fa-plus"></i></span>
                            </div>
                        </div>
                        <div class="mt-2">
                            <a href="" class="btn btn1"> <i class="fa fa-shopping-cart"></i> Add To Cart</a>
                            <button type="button" wire:click="addToWishList({{ $product->id }})" 
                                class="btn btn1"> 
                                <span wire:loading.remove wire:target="addToWishList">
                                    <i class="fa fa-heart"></i> Add To Wishlist
                                </span>
                                <span wire:loading wire:target ="addToWishList">Adding...</span>    
                            </button>
                        </div>
                        <div class="mt-3">
                            <h5 class="mb-0">Small Description</h5>
                            <p>
                                {{ $product->small_description }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mt-3">
                    <div class="card">
                        <div class="card-header bg-white">
                            <h4>Description</h4>
                        </div>
                        <div class="card-body">
                            <p>
                                {{ $product->description }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

