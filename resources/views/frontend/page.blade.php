@extends('frontend.layouts.master')
@section('title', $page->title)

@section('content')
    <!-- Start Page Title Area -->
    <div class="page-title-area page-title-style-three item-bg4 jarallax" data-jarallax='{"speed": 0.3}'>
        <div class="container">
            <div class="page-title-content">
                <ul>
                    <li>
                        <a href="{{ route('home') }}">Home</a>
                    </li>
                    <li>{{ $page->title }}</li>
                </ul>
                <h2>{{ $page->title }}</h2>
            </div>
        </div>
    </div>
    <!-- End Page Title Area -->
    <!-- Start FAQ Area -->
    <section class="faq-area ptb-100">
        <div class="container">
            <div class="tab faq-accordion-tab">
                <div class="tab-content">
                    <div class="tabs-item">
                        <div class="faq-accordion">
                            <ul class="accordion">
                                <li class="accordion-item">
                                    <h2 style="padding: 20px;font-weight: 700;">
                                        {{ $page->title }}
                                    </h2>
                                    <div class="accordion-content show" style="padding-top: 20px;color:black;">
                                        {!! $page->details !!}
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End FAQ Area -->

@endsection
