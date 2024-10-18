<div class="contact-area space bg-smoke3 overflow-hidden shape-mockup-wrap">
    <div class="contact-anime-img-1 jump shape-mockup d-none d-xl-block" style="top: 0px; right: 0px;"><img
            src="{{asset('client/assets/img/contact/contact-bg-shape.png')}}" alt="img"></div>


    @if (!$selected_login_type)
        <div class="container login-container">
            <div class="row gx-0">
                <div class="col-xl-5 contact-form-wrap">
                    <div class="title-area">
                        <h2 class="sec-title">Giriş metodunu seçin</h2>
                    </div>
                    ̰ <div class="row">
                        <div class="form-btn col-12">
                            <button style="color: black" wire:click="on_login_type_select('email')" class="col-12 as-btn style3 mt-10"><i class="fal fa-envelope"></i>&#160; Email</button>
                        </div>
                        <div class="form-btn col-12 mt-10">
                            <button style="background-color: #25D366; color: white" wire:click="on_login_type_select('whatsapp')"
                                class="col-12 as-btn style3 mt-10"><i class="fa-brands fa-whatsapp"></i>&#160; Whatsapp</button>
                        </div>
                        <div class="form-btn col-12 mt-10">
                            <button style="background-color: #4285F4; color: white" wire:click="on_login_type_select('google')" class="col-12 as-btn style3 mt-10"><i class="fa-brands fa-google"></i>&#160; Google</button>
                        </div>
                        <div style="display: flex; align-items: center; justify-content: center; margin-top: 20px;">
                            <hr style="flex-grow: 1; border: 1px solid black;">
                            <span style="padding: 0 10px;">Yaxud</span>
                            <hr style="flex-grow: 1; border: 1px solid black;">
                        </div>

                        <div class="form-btn col-12 mt-10">
                            <button style="color: black" wire:click="to_register" class="col-12 mt-3 as-btn style3"> QEYDİYYATDAN
                                keç</button>
                        </div>

                    </div>
                    <p class="form-messages mb-0 mt-3"></p>
                </div>
            </div>
        </div>
    @else
        @switch($selected_login_type)
            @case('email')
                <div class="container login-container">
                    <div class="row gx-0">
                        <div class="col-xl-5 contact-form-wrap">
                            <div class="title-area mb-40">
                                <h2 class="sec-title">Email ilə daxil ol</h2>
                            </div>
                            <form  action="{{route('login')}}" method="POST"
                                class="review-form ajax-contact">
                                @csrf
                                <div class="row gx-24">
                                    <div class="form-group style-white2 col-md-12">
                                        <input type="email" class="form-control" name="email" id="email"
                                            placeholder="Email Address">
                                        <i class="fal fa-envelope"></i>
                                    </div>

                                    <div class="form-group style-white2 col-md-12">
                                        <input type="password" class="form-control" name="password" id="password"
                                            placeholder="Şifrə">
                                        <i class="fal fa-lock"></i>
                                    </div>

                                    <div class="form-btn col-12 mt-10">
                                        <button type="button" wire:click="to_select_login_type" class="as-btn style3"><i class="fa-light fa-arrow-left"></i>&#160; GERİ
                                        </button>
                                        <button type="submit" class=" as-btn style3">Davam et &#160;<i
                                                class="fa-light fa-arrow-right"></i></button>
                                    </div>
                                </div>
                                <p class="form-messages mb-0 mt-3"></p>
                            </form>
                        </div>
                    </div>
                </div>
            @break

            @case('whatsapp')
            @break

            @case('google')
            @break

            @default
        @endswitch
    @endif


</div>
