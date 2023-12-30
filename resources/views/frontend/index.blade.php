@extends('layouts.app')
@section('title', 'Lara Ecommerce')

@section('content')

<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3200">
    
    <div class="carousel-inner">

        @foreach ($sliders as $key => $slider)
        <div class="carousel-item {{ $key == 0 ? 'active' :'' }}">
            @if ($slider->image)
                <img src="{{ asset($slider->image) }}" class="d-block w-100" style="height: 450px; object-fit: cover;">
            @endif
            <div class="carousel-caption d-flex align-items-center justify-content-center">
                <div class="custom-carousel-content">
                    <div>
                        <a href="#" class="btn btn-slider">
                            Get Now
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        @endforeach

    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
</div>

@endsection