@extends('frontend.layouts.master')
@section('title', 'Help desk')
@section('css')
@endsection
@section('content')
<!-- Start Page Title Area -->
<div class="page-title-area item-bg3 jarallax" data-jarallax='{"speed": 0.3}'>
    <div class="container">
        <div class="page-title-content">
            <ul>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li>Help</li>
            </ul>
            <h2>Help Desk</h2>
        </div>
    </div>
</div>
<!-- End Page Title Area -->

<!-- Start Gallery Area -->
<section class="gallery-area pt-100 pb-70">
    <div class="container">
        <div class="row">
            @foreach($helps as $help)
                <div class="col-md-6 col-sm-6">
                    <div class="single-gallery-item mb-30">
                        <iframe width="530" height="315" src="{{ $help->name }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
<!-- End Gallery Area -->
@endsection