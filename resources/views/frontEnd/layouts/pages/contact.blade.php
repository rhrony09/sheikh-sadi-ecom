@extends('frontEnd.layouts.master')
@section('title', 'Customer Account')
@section('content')

    <section class="comn_sec">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="cmn_menu">
                        <ul>
                            @foreach ($cmnmenu as $key => $value)
                                <li>
                                    <a href="{{ route('page', $value->slug) }}">{{ $value->name }}</a>
                                </li>
                            @endforeach
                            <li>
                                <a href="{{ route('contact') }}">Contact Us</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="contact-section">
        <div class="container">

            <div class="row mt-3">
                <div class="col-sm-6">
                    <div class="cont_item">
                        <a href="tel:{{ $contact->hotline }}">
                            <i data-feather="phone"></i>
                            {{ $contact->hotline }}
                        </a>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="cont_item">
                        <a href="">
                            <i data-feather="mail"></i>
                            {{ $contact->email }}
                        </a>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center mt-3 mb-5">
                <div class="col-sm-12">
                    <div class="contact-form">
                        <h5 class="account-title">Contact Us</h5>
                        <form action="{{ route('home') }}" method="POST" class="row" enctype="multipart/form-data" data-parsley-validate="">
                            @csrf
                            <div class="col-sm-6">
                                <div class="form-group mb-3">
                                    <label for="name">Full Name *</label>
                                    <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- col-end -->
                            <div class="col-sm-6">
                                <div class="form-group mb-3">
                                    <label for="phone">Mobile No *</label>
                                    <input type="number" id="phone" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required>
                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- col-end -->
                            <div class="col-sm-12">
                                <div class="form-group mb-3">
                                    <label for="email">Email *</label>
                                    <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- col-end -->
                            <div class="col-sm-12">
                                <div class="form-group mb-3">
                                    <label for="subject">Subject *</label>
                                    <input type="text" id="subject" class="form-control @error('subject') is-invalid @enderror" name="subject" value="{{ old('subject') }}" required>
                                    @error('subject')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- col-end -->
                            <div class="col-sm-12">
                                <div class="form-group mb-3">
                                    <label for="message">Message *</label>
                                    <textarea type="text" id="message" class="form-control @error('message') is-invalid @enderror" name="message" value="{{ old('message') }}" required></textarea>
                                    @error('message')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- col-end -->
                            <div class="col-sm-12">
                                <div class="form-group mb-3">
                                    <button type="submit" class="submit-btn">Send</button>
                                </div>
                            </div>
                            <!-- col-end -->
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
@push('script')
    <script src="{{ asset('public/frontEnd/') }}/js/parsley.min.js"></script>
    <script src="{{ asset('public/frontEnd/') }}/js/form-validation.init.js"></script>
@endpush
