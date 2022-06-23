@extends('frontend.layouts.master')
@section('title', $blog->name)
@section('css')
@endsection
@section('content')

<!-- Start Page Title Area -->
<div class="page-title-area page-title-style-three item-bg1 jarallax" data-jarallax='{"speed": 0.3}'>
    <div class="container">
        <div class="page-title-content">
            <ul>
                <li>
                    <a href="{{ route('home') }}">Home</a>
                </li>
                <li>Blog</li>
            </ul>
            <h2>{{ $blog->name }}</h2>
        </div>
    </div>
</div>
<!-- End Page Title Area -->
<!-- Start Blog Details Area -->
<section class="blog-details-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="blog-details-desc">
                    <div class="article-image">
                        <img src="{{ asset($blog->image) }}" alt="image">
                    </div>
                    <div class="article-content">
                        <div class="entry-meta">
                            <ul>
                                <li>
                                    <i class="bx bx-group"></i>
                                    <span>Author</span>
                                    <a href="{{ route('instructorDetails',$blog->instructor->id) }}">{{ $blog->instructor->name }}</a>
                                </li>
                                <li>
                                    <i class="bx bx-calendar"></i>
                                    <span>Last Updated</span>
                                    <a href="#">{{ $blog->updated_at->format('d/m/Y') }}</a>
                                </li>
                            </ul>
                        </div>
                        <h3>{{ $blog->name }}</h3>
                        {!! $blog->details !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Blog Details Area -->

@endsection