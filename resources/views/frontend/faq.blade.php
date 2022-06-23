@extends('frontend.layouts.master')
@section('title', 'FAQ Area')
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
                <li>FAQ</li>
            </ul>
            <h2>FAQ</h2>
        </div>
    </div>
</div>
<!-- End Page Title Area -->
<!-- Start FAQ Area -->
<section class="faq-area ptb-100">
    <div class="container">
        <h1 class="text-center mb-30">What's in your mind!</h1>
        <div class="tab faq-accordion-tab">
            <div class="tab-content">
                <div class="tabs-item">
                    <div class="faq-accordion">
                        <ul class="accordion">
                            @foreach($faqs as $key=>$faq)
                                <li class="accordion-item">
                                    <a class="accordion-title @if($key === 0) active @endif" href="javascript:void(0)">
                                        <i class="bx bx-chevron-down"></i>
                                        {{ $faq->name }}
                                    </a>
                                    <div class="accordion-content @if($key === 0) show @endif">
                                        <p>{{ $faq->details }}</p>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End FAQ Area -->
@endsection