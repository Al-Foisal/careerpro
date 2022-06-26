@extends('frontend.layouts.__user_master')
@section('title', 'Update your profile')

@section('content')
    <div class="page-title-area item-bg1 jarallax" data-jarallax='{"speed": 0.3}'>
        <div class="container">
            <div class="page-title-content">
                <ul>
                    <li>
                        <a href="{{ route('home') }}">Home</a>
                    </li>
                    <li>My Account</li>
                </ul>
                <h2>Update Profile</h2>
            </div>
        </div>
    </div>
    <!-- Start Login Area -->
    <section class="login-area">
        <div class="row m-0">
            <div class="myAccount-navigation pt-100" style="text-align: center;">
                @include('frontend.layouts.partials._user_dashboard_menu')
            </div>
            <div class="col-lg-12 col-md-12 pb-100 pt-100">
                <h3 class="text-center">Hello, <b style="color: red">{{ $user->name }}</b>! You may update your profile
                    from here.</h3>
                <div class="login-content">
                    <div class="d-table">
                        <div class="d-table-cell">
                            <div class="login-form">
                                <form action="{{ route('user.profile.update', $user->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <input type="text" name="name" id="name" placeholder="Your name"
                                            class="form-control" required value="{{ $user->name }}">
                                    </div>

                                    <div class="form-group">
                                        <input type="text" name="phone" id="phone" placeholder="Your phone"
                                            class="form-control" value="{{ $user->phone }}">
                                    </div>

                                    <div class="form-group">
                                        <select name="member_ship_package_id" class="form-control">
                                            <option value="">Select package</option>
                                            @foreach ($package as $pack)
                                                <option value="{{ $pack->id }}"
                                                    @if ($user->member_ship_package_id == $pack->id) selected @endif>{{ $pack->name }}(TK: {{ $pack->amount }}/=)
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <textarea type="text" name="bio" id="bio" placeholder="Your biography" rows="4" class="form-control">{{ $user->bio }}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <input type="file" name="image" id="image" placeholder="Your image"
                                            class="form-control">
                                    </div>
                                    <img src="{{ asset($user->image) }}" alt="">

                                    <button type="submit">Update Profile</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Login Area -->
@endsection
