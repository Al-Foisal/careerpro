<!-- Start Header Area -->
<header class="header-area p-relative">
    <div class="top-header top-header-style-three">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8 col-md-8">
                    <ul class="top-header-contact-info">
                        <li>
                            Call:
                            <a href="tel:502464674">{{ $company->phone_one }}</a>
                        </li>
                    </ul>
                    <div class="top-header-social">
                        <span>Follow us:</span>
                        @if ($company->facebook)
                            <a href="{{ $company->facebook }}" target="_blank">
                                <i class="bx bxl-facebook"></i>
                            </a>
                        @endif
                        @if ($company->twitter)
                            <a href="{{ $company->twitter }}" target="_blank">
                                <i class="bx bxl-twitter"></i>
                            </a>
                        @endif
                        @if ($company->linkedin)
                            <a href="{{ $company->linkedin }}" target="_blank">
                                <i class="bx bxl-linkedin"></i>
                            </a>
                        @endif
                        @if ($company->instagram)
                            <a href="{{ $company->instagram }}" target="_blank">
                                <i class="bx bxl-instagram"></i>
                            </a>
                        @endif
                        @if ($company->pinterest)
                            <a href="{{ $company->pinterest }}" target="_blank">
                                <i class="bx bxl-pinterest"></i>
                            </a>
                        @endif
                        @if ($company->youtube)
                            <a href="{{ $company->youtube }}" target="_blank">
                                <i class="bx bxl-youtube"></i>
                            </a>
                        @endif
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <ul class="top-header-login-register">
                        @auth

                            <li>
                                <a href="{{ route('user.dashboard') }}">
                                    <i class="bx bxs-dashboard"></i>
                                    Dashboard
                                </a>
                            </li>
                            <li>
                                <form action="{{ route('logout') }}" method="post">
                                    @csrf
                                    <button type="submit" style="border:none;color:white;text-decoration: none;"
                                    class="myAccount-logout btn btn-link"><i class="bx bx-log-in-circle"></i>Logout</button>
                                </form>
                            </li>
                        @else
                            <li>
                                <a href="{{ route('login') }}">
                                    <i class="bx bx-log-in"></i>
                                    Login
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('register') }}">
                                    <i class="bx bx-log-in-circle"></i>
                                    Register
                                </a>
                            </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Start Navbar Area -->
    <div class="navbar-area navbar-style-three">
        <div class="raque-responsive-nav">
            <div class="container">
                <div class="raque-responsive-menu">
                    <div class="logo">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset($company->logo) }}" class="black-logo"
                                style="width:104px;height: 45px;" alt="logo">
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="raque-nav">
            <div class="container">
                <nav class="navbar navbar-expand-md navbar-light">
                    <a class="navbar-brand" href="{{ route('home') }}">
                        <img src="{{ asset($company->logo) }}" class="black-logo"
                            style="width:104px;height: 45px;" alt="logo">
                    </a>
                    <div class="collapse navbar-collapse mean-menu">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a href="{{ route('home') }}" class="nav-link">
                                    Home
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('about') }}" class="nav-link">
                                    About Us
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    Courses
                                    <i class="bx bx-chevron-down"></i>
                                </a>
                                <ul class="dropdown-menu">
                                    @foreach ($categories as $category)
                                        <li class="nav-item">
                                            <a href="{{ route('categoryCourses', $category->slug) }}"
                                                class="nav-link">
                                                {{ $category->name }}
                                                @if ($category->subcategories->where('status', 1)->where('on_front', 0)->count() > 0)
                                                    <i class="bx bx-chevron-right"></i>
                                                @endif
                                            </a>
                                            @if ($category->subcategories->where('status', 1)->where('on_front', 0)->count() > 0)
                                                <ul class="dropdown-menu">
                                                    @foreach ($category->subcategories->where('status', 1) as $sub)
                                                        <li class="nav-item">
                                                            <a href="{{ route('categoryCourses', [$category->slug, $sub->slug]) }}"
                                                                class="nav-link">{{ $sub->name }}</a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                            {{-- @foreach ($frontCategories as $fc)
                                <li class="nav-item">
                                    <a href="{{ route('categoryCourses', $fc->slug) }}"
                                        class="nav-link">{{ $fc->name }}</a>
                                </li>
                            @endforeach
                            @foreach ($frontSubcategories as $fs)
                                <li class="nav-item">
                                    <a href="{{ route('categoryCourses', [$fs->category->slug, $fs->slug]) }}"
                                        class="nav-link">{{ $fs->name }}</a>
                                </li>
                            @endforeach --}}
                            <li class="nav-item">
                                <a href="{{ route('service') }}" class="nav-link">
                                    Our Services
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    Job Portal
                                    <i class="bx bx-chevron-down"></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item">
                                        <a href="{{ route('job') }}"
                                            class="nav-link">
                                            Job Circular
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('walkInInterviewJob') }}"
                                            class="nav-link">
                                            Walk In Interview
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    Others
                                    <i class="bx bx-chevron-down"></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item">
                                        <a href="{{ route('blog') }}"
                                            class="nav-link">
                                            Blog
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('faq') }}"
                                            class="nav-link">
                                            FAQ
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('help') }}"
                                            class="nav-link">
                                            Help
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('offer') }}"
                                            class="nav-link">
                                            Offers
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('contact') }}"
                                            class="nav-link">
                                            Contact
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('instructor.register') }}"
                                            class="nav-link">
                                            Be a Resource Person
                                        </a>
                                    </li>
                                    @auth
                                        <li class="nav-item">
                                            <a href="{{ route('user.dashboard') }}"
                                                class="nav-link">
                                                My Account
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <form action="{{ route('logout') }}" method="post">
                                                @csrf
                                                <button type="submit" style="border:none;"
                                                class="myAccount-logout">Logout</button>
                                            </form>
                                        </li>
                                    @else
                                        <li class="nav-item">
                                            <a href="{{ route('login') }}"
                                                class="nav-link">
                                                Login
                                            </a>
                                        </li>
                                    @endauth
                                </ul>
                            </li>
                        </ul>
                        <div class="others-option">
                            <a href="{{ route('cart') }}" class="cart-wrapper-btn d-inline-block">
                                <i class='bx bx-cart-alt'></i>
                                <span class="total_cart_items">{{ Cart::count() }}</span>
                            </a>
                            <div class="search-box d-inline-block">
                                <i class="bx bx-search"></i>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <!-- End Navbar Area -->
    <!-- Start Sticky Navbar Area -->
    <div class="navbar-area navbar-style-three header-sticky">
        <div class="raque-nav">
            <div class="container">
                <nav class="navbar navbar-expand-md navbar-light">
                    <a class="navbar-brand" href="{{ route('home') }}">
                        <img src="{{ asset($company->logo) }}" class="black-logo"
                            style="width:104px;height: 45px;" alt="logo">
                    </a>
                    <div class="collapse navbar-collapse">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a href="{{ route('home') }}" class="nav-link">
                                    Home
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('about') }}" class="nav-link">
                                    About US
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    Courses
                                    <i class="bx bx-chevron-down"></i>
                                </a>
                                <ul class="dropdown-menu">
                                    @foreach ($categories as $category)
                                        <li class="nav-item">
                                            <a href="{{ route('categoryCourses', $category->slug) }}"
                                                class="nav-link">
                                                {{ $category->name }}
                                                @if ($category->subcategories->where('status', 1)->where('on_front', 0)->count() > 0)
                                                    <i class="bx bx-chevron-right"></i>
                                                @endif
                                            </a>
                                            @if ($category->subcategories->where('status', 1)->where('on_front', 0)->count() > 0)
                                                <ul class="dropdown-menu">
                                                    @foreach ($category->subcategories->where('status', 1) as $sub)
                                                        <li class="nav-item">
                                                            <a href="{{ route('categoryCourses', [$category->slug, $sub->slug]) }}"
                                                                class="nav-link">{{ $sub->name }}</a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                            {{-- @foreach ($frontCategories as $fc)
                                <li class="nav-item">
                                    <a href="{{ route('categoryCourses', $fc->slug) }}"
                                        class="nav-link">{{ $fc->name }}</a>
                                </li>
                            @endforeach
                            @foreach ($frontSubcategories as $fs)
                                <li class="nav-item">
                                    <a href="{{ route('categoryCourses', [$fs->category->slug, $fs->slug]) }}"
                                        class="nav-link">{{ $fs->name }}</a>
                                </li>
                            @endforeach --}}
                            <li class="nav-item">
                                <a href="{{ route('service') }}" class="nav-link">
                                    Our Services
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    Job Portal
                                    <i class="bx bx-chevron-down"></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item">
                                        <a href="{{ route('job') }}"
                                            class="nav-link">
                                            Job Circular
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('walkInInterviewJob') }}"
                                            class="nav-link">
                                            Walk In Interview
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    Others
                                    <i class="bx bx-chevron-down"></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item">
                                        <a href="{{ route('blog') }}"
                                            class="nav-link">
                                            Blog
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('faq') }}"
                                            class="nav-link">
                                            FAQ
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('help') }}"
                                            class="nav-link">
                                            Help
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('offer') }}"
                                            class="nav-link">
                                            Offers
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('contact') }}"
                                            class="nav-link">
                                            Contact
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('instructor.register') }}"
                                            class="nav-link">
                                            Be a Resource Person
                                        </a>
                                    </li>
                                    @auth
                                        <li class="nav-item">
                                            <a href="{{ route('user.dashboard') }}"
                                                class="nav-link">
                                                My Account
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <form action="{{ route('logout') }}" method="post">
                                                @csrf
                                                <button type="submit" style="border:none;"
                                                class="myAccount-logout">Logout</button>
                                            </form>
                                        </li>
                                    @else
                                        <li class="nav-item">
                                            <a href="{{ route('login') }}"
                                                class="nav-link">
                                                Login
                                            </a>
                                        </li>
                                    @endauth
                                </ul>
                            </li>
                        </ul>
                        <div class="others-option">
                            <a href="{{ route('cart') }}" class="cart-wrapper-btn d-inline-block">
                                <i class='bx bx-cart-alt'></i>
                                <span class="total_cart_items">{{ Cart::count() }}</span>
                            </a>
                            <div class="search-box d-inline-block">
                                <i class="bx bx-search"></i>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <!-- End Sticky Navbar Area -->
</header>
<!-- End Header Area -->
<!-- Search Box Layout -->
<div class="search-overlay">
    <div class="d-table">
        <div class="d-table-cell">
            <div class="search-overlay-layer"></div>
            <div class="search-overlay-layer"></div>
            <div class="search-overlay-layer"></div>
            <div class="search-overlay-close">
                <span class="search-overlay-close-line"></span>
                <span class="search-overlay-close-line"></span>
            </div>
            <div class="search-overlay-form">
                <form action="{{ route('search') }}">
                    <input name="search" type="text" class="input-search" placeholder="Search here...">
                    <button type="submit">
                        <i class="bx bx-search-alt"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Search Box Layout -->
