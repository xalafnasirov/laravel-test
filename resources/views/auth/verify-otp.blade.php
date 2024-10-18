@extends('layouts.app')

@section('content')
    <div class="contact-area space bg-smoke3 overflow-hidden shape-mockup-wrap">
        <div class="contact-anime-img-1 jump shape-mockup d-none d-xl-block" style="top: 0px; right: 0px;"><img
                src="assets/img/contact/contact-bg-shape.png" alt="img"></div>




        <div class="container login-container">
            <div class="row gx-0">
                <div class="col-xl-5 contact-form-wrap">
                    <div class="title-area mb-40">
                        <h2 class="sec-title">Sizə OTP göndərdik!</h2>
                        <h5 class="sec-title">Email: kha....l.com</h5>
                    </div>
                    <div class="review-form ">
                        <form action="{{ route('otp_verification.verify') }}" method="POST" class="row gx-24">
                            @csrf

                            @if ($errors->any())
                                <p class="form-messages mb-0 mt-3">
                                    <div class="text-danger">
                                    @foreach ($errors->all() as $error)
                                        <li style="list-style: none">{{ $error }}</li>
                                    @endforeach
                                    </div>
                                </p>
                            @endif

                            <div class="form-group style-white2 col-md-12">
                                <input type="number" class="form-control" name="otp" id="otp" placeholder="Kod">
                                <i class="fal fa-lock"></i>
                            </div>




                            <div class="form-btn col-12 mt-10">
                                <button type="button" class="as-btn style3"><i class="fa-light fa-arrow-left"></i>&#160;
                                    GERİ
                                </button>

                                <button type="submit" class=" as-btn style3">Davam et &#160;<i
                                        class="fa-light fa-arrow-right"></i></button>
                            </div>
                        </form>
                    </div>


                </div>
            </div>
        </div>

    </div>
@endsection
