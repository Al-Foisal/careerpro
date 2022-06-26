@extends('frontend.layouts.master')
@section('title', $book->name)
@section('css')
@endsection
@section('content')
<!-- Start Page Title Area -->
<div class="page-title-area page-title-style-three item-bg4 jarallax" data-jarallax='{"speed": 0.3}'>
    <div class="container">
        <div class="page-title-content">
            <ul>
                <li>
                    <a href="{{ route('home') }}">Home</a>
                </li>
                <li>
                    <a href="{{ route('book') }}">Our Books</a>
                </li>
                <li>{{ $book->name }}</li>
            </ul>
        </div>
    </div>
</div>
<!-- End Page Title Area -->
<!-- Start FAQ Area -->
<section class="faq-area ptb-100">
    <div class="container">
        <h1 class="text-center mb-30">{{ $book->name }}</h1>
        <div class="row align-items-center">
            <div class="col-lg-5 col-md-12">
                <div class="products-details-image">
                    <ul class="slickslide">
                        <li><img src="{{ asset($book->image) }}" style="width:451px;height:480px;"></li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-7 col-md-12">
                <div class="product-details-desc">

                    {!! $book->details !!}
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End FAQ Area -->
@endsection