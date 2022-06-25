<!-- Start Footer Area -->
<footer class="footer-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="single-footer-widget mb-30">
                    <h3>Contact Us</h3>
                    <ul class="contact-us-link">
                        <li>
                            <i class="bx bx-map"></i>
                            <a href="#">{{ $company->address }}</a>
                        </li>
                        @if ($company->phone_one)
                            <li>
                                <i class="bx bx-phone-call"></i>
                                <a href="tel:{{ $company->phone_one }}">{{ $company->phone_one }}</a>
                            </li>
                        @endif
                        @if ($company->phone_two)
                            <li>
                                <i class="bx bx-phone-call"></i>
                                <a href="tel:{{ $company->phone_two }}">{{ $company->phone_two }}</a>
                            </li>
                        @endif
                        @if ($company->phone_three)
                            <li>
                                <i class="bx bx-phone-call"></i>
                                <a href="tel:{{ $company->phone_three }}">{{ $company->phone_three }}</a>
                            </li>
                        @endif
                        <li>
                            <i class="bx bx-envelope"></i>
                            <a href="mailto:{{ $company->email }}">
                                <span class="__cf_email__"
                                    data-cfemail="026a676e6e6d4270637377672c616d6f">{{ $company->email }}</span>
                            </a>
                        </li>
                    </ul>
                    <ul class="social-link">
                        @if ($company->facebook)
                            <li>
                                <a href="{{ $company->facebook }}" class="d-block" target="_blank">
                                    <i class="bx bxl-facebook"></i>
                                </a>
                            </li>
                        @endif
                        @if ($company->twitter)
                            <li>
                                <a href="{{ $company->twitter }}" class="d-block" target="_blank">
                                    <i class="bx bxl-twitter"></i>
                                </a>
                            </li>
                        @endif
                        @if ($company->linkedin)
                            <li>
                                <a href="{{ $company->linkedin }}" class="d-block" target="_blank">
                                    <i class="bx bxl-linkedin"></i>
                                </a>
                            </li>
                        @endif
                        @if ($company->instagram)
                            <li>
                                <a href="{{ $company->instagram }}" class="d-block" target="_blank">
                                    <i class="bx bxl-instagram"></i>
                                </a>
                            </li>
                        @endif
                        @if ($company->pinterest)
                            <li>
                                <a href="{{ $company->pinterest }}" class="d-block" target="_blank">
                                    <i class="bx bxl-pinterest"></i>
                                </a>
                            </li>
                        @endif
                        @if ($company->youtube)
                            <li>
                                <a href="{{ $company->youtube }}" class="d-block" target="_blank">
                                    <i class="bx bxl-youtube"></i>
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
            <div class="col-lg-2 col-md-6 col-sm-6">
                <div class="single-footer-widget mb-30">
                    <h3>Useful Link</h3>
                    <ul class="support-link">
                        @foreach($categories->take(7) as $category)
                        <li>
                            <a href="{{ route('categoryCourses', $category->slug) }}">{{ $category->name }}</a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="single-footer-widget mb-30">
                    <h3>{{ config('app.name') }}</h3>
                    <ul class="useful-link">
                        <li>
                            <a href="{{ route('user.dashboard') }}">My Account</a>
                        </li>
                        <li>
                            <a href="{{ route('faq') }}">FAQ</a>
                        </li>
                        
                        <li>
                            <a href="{{ route('offer') }}">Offer</a>
                        </li>
                        <li>
                            <a href="{{ route('contact') }}">Contact Us</a>
                        </li>
                        <li>
                            <a href="{{ route('job') }}">Job</a>
                        </li>
                        
                        <li>
                            <a href="{{ route('instructor') }}">Resource Person</a>
                        </li>
                        <li>
                            <a href="{{ route('home') }}">Home</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="single-footer-widget mb-30">
                    <h3>Our Criteria</h3>
                    <ul class="useful-link">
                        @foreach ($pages as $page)
                            <li>
                                <a href="{{ route('page', $page->slug) }}">{{ $page->title }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom-area">
        <div class="container" style="border-top: 1px solid;padding-top: 30px;">
            <p>
                Copyright <i class="bx bx-copyright"></i> {{ date('Y') }} {{ config('app.name') }}, All Right Reserved | Design & Developed By <a href="https://quicktech-ltd.com/" style="color: red">QuickTech IT</a>
            </p>
        </div>
    </div>
</footer>
<!-- End Footer Area -->
