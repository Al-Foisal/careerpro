@extends('frontend.layouts.master')
@section('title', 'Our Article')
@section('css')
@endsection
@section('content')
<!-- Start Page Title Area -->
<div class="page-title-area page-title-style-three item-bg1 jarallax" data-jarallax='{"speed": 0.3}'>
    <div class="container">
        <div class="page-title-content">
            <ul>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li>Article</li>
            </ul>
            <h2>Our Article</h2>
        </div>
    </div>
</div>
<!-- End Page Title Area -->

<!-- Start Blog Area -->
<section class="blog-area ptb-100">
    <div class="container-fluid">
        <div class="row">
            @foreach($blogs as $blog)
                <div class="col-lg-3 col-md-6">
                    <div class="single-blog-post mb-30">
                        <div class="post-image">
                            <a href="{{ route('blogDetails', $blog->slug) }}" class="d-block">
                                <img src="{{ asset($blog->image) }}" alt="image">
                            </a>
                        </div>
    
                        <div class="post-content">
                            <ul class="post-meta">
                                <li class="post-author">
                                    <img src="{{ asset($blog->instructor->image) }}" class="d-inline-block rounded-circle mr-2" alt="image">
                                    By: <a href="{{ route('instructorDetails', $blog->instructor->id) }}" class="d-inline-block">{{ $blog->instructor->name }}</a>
                                </li>
                                <li><a href="#">{{ $blog->created_at->format('l m, Y') }}</a></li>
                            </ul>
                            <h3><a href="{{ route('blogDetails', $blog->slug) }}" class="d-inline-block">{{ $blog->name }}</a></h3>
                            <a href="{{ route('blogDetails', $blog->slug) }}" class="read-more-btn">Read More <i class='bx bx-right-arrow-alt'></i></a>
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="pagination-area text-center">
                    {{ $blogs->links() }}
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Blog Area -->
@endsection