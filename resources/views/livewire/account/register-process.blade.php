<div class="contact-area space bg-smoke3 overflow-hidden shape-mockup-wrap">
    <div class="contact-anime-img-1 jump shape-mockup d-none d-xl-block" style="top: 0px; right: 0px;"><img
            src="{{ asset('client/assets/img/contact/contact-bg-shape.png') }}" alt="img">
    </div>


    <div class="tab-content">


        @auth
        <div class="tab-pane fade @if ($tab === $tabs['email-verify']) active show @endif" id={{$tabs['email-verify']}}>
            @if ($tab === $tabs['email-verify'])

                <div class="container login-container">
                    <div class="row gx-0">
                        <div class="col-xl-5 contact-form-wrap">
                            <div class="title-area mb-40">
                                <h2 class="sec-title"><i style="color: #25D366" class="fal fa-envelope"></i> &#160; Emailinizi təsdiqləyin!</h2>
                            </div>

                            <h4><b>{{$verification_email}}</b> <br> poçtunuza təsdiqlənmə linki göndərdik!</h4>
                            <p>Qeydiyyat prosesini tamamlamaq üçün zəhmət olmasa hesabınızı təsdiqləyin, əgər məktub gəlmədisə <b>spam</b> bölməsini yoxladığınızdan əmin olun!</p>
                            <p>Hələdə mesaj gəlmədisə təkrar göndərin</p>

                            <form wire:submit.prevent="send_verification_email" class="review-form">
                                @csrf
                                <div class="row gx-24">

                                    <div class="form-btn col-12 mt-10">
                                        <button type="submit" class=" as-btn style3">
                                            <div wire:loading>
                                                <div class="loader"></div>
                                            </div>
                                            <div wire:loading.remove>
                                                YENİDƏN GÖNDƏR &#160;<i class="fa-light fa-send"></i>
                                            </div>
                                        </button>
                                    </div>
                                </div>
                                <p class="form-messages mb-0 mt-3">
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </div>
                                    @endif
                                </p>
                            </form>
                        </div>
                    </div>
            @endif
        </div>
        @else
        <div class="tab-pane fade @if ($tab === $tabs['select']) active show @endif" id={{$tabs['select']}}>
            @if ($tab === $tabs['select'])
                <div class="container login-container">
                    <div class="row gx-0">
                        <div class="col-xl-5 contact-form-wrap">
                            <div class="title-area">
                                <h2 class="sec-title">Qeydiyyat</h2>
                            </div>
                            ̰ <div class="row">
                                <div class="form-btn col-12">
                                    <button style="color: black" wire:click="open_tab('{{$tabs['email']}}')"
                                        class="col-12 as-btn style3 mt-10"><i class="fal fa-envelope"></i>&#160;
                                        Email</button>
                                </div>
                                <div class="form-btn col-12 mt-10">
                                    <button style="background-color: #25D366; color: white"
                                        wire:click="open_tab('{{$tabs['whatsapp']}}')" class="col-12 as-btn style3 mt-10"><i
                                            class="fa-brands fa-whatsapp"></i>&#160;
                                        Whatsapp</button>
                                </div>
                                <div class="form-btn col-12 mt-10">
                                    <button style="background-color: #4285F4; color: white"
                                        wire:click="open_tab('{{$tabs['google']}}')"
                                        class="col-12 as-btn style3 mt-10"><i class="fa-brands fa-google"></i>&#160;
                                        Google</button>
                                </div>
                                <div
                                    style="display: flex; align-items: center; justify-content: center; margin-top: 20px;">
                                    <hr style="flex-grow: 1; border: 1px solid black;">
                                    <span style="padding: 0 10px;">Yaxud</span>
                                    <hr style="flex-grow: 1; border: 1px solid black;">
                                </div>

                                <div class="form-btn col-12 mt-10">
                                    <button style="color: black" wire:click="to_login"
                                        class="col-12 mt-3 as-btn style3">
                                        Artıq
                                        hesabım var</button>
                                </div>

                            </div>
                            <p class="form-messages mb-0 mt-3"></p>
                        </div>
                    </div>
                </div>
            @endif

        </div>
        <div class="tab-pane fade @if ($tab === $tabs['email']) active show @endif" id={{$tabs['email']}}>
            @if ($tab === $tabs['email'])

                <div class="container login-container">
                    <div class="row gx-0">
                        <div class="col-xl-5 contact-form-wrap">
                            <div class="title-area mb-40">
                                <h2 class="sec-title">Email ilə qeydiyyatdan keç</h2>
                            </div>
                            <form wire:submit.prevent="email_register" class="review-form">
                                @csrf
                                <div class="row gx-24">
                                    <div class="form-group style-white2 col-md-6">
                                        <input wire:model="firstname" type="text" class="form-control" name="firstname" id="firstname"
                                            placeholder="Adınız">
                                        <i class="fal fa-user"></i>
                                    </div>
                                    <div class="form-group style-white2 col-md-6">
                                        <input wire:model="lastname" type="text" class="form-control" name="lastname" id="lastname"
                                            placeholder="Soyadınız">
                                        <i class="fal fa-user"></i>
                                    </div>
                                    <div class="form-group style-white2 col-md-12">
                                        <input wire:model="email"  type="email" class="form-control" name="email" id="email"
                                            placeholder="Email Address">
                                        <i class="fal fa-envelope"></i>
                                    </div>

                                    <div class="form-group style-white2 col-md-12">
                                        <input wire:model="password"  type="password" class="form-control" name="password" id="password"
                                            placeholder="Şifrə">
                                        <i class="fal fa-lock"></i>
                                    </div>
                                    <div class="form-group style-white2 col-md-12">
                                        <input wire:model="password_verification"  type="password" class="form-control" name="password-verify"
                                            id="password-verify" placeholder="Şifrəni təkrar yazın">
                                        <i class="fal fa-lock"></i>
                                    </div>

                                    <div class="form-btn col-12 mt-10">
                                        <button type="button"  wire:click="open_tab('{{$tabs['email-verify']}}')"
                                            class="as-btn style3"><i class="fa-light fa-arrow-left"></i>&#160; GERİ
                                        </button>
                                        <button type="submit" class=" as-btn style3">
                                            <div wire:loading>
                                                <div class="loader"></div>
                                            </div>
                                            <div wire:loading.remove>
                                                Davam et &#160;<i class="fa-light fa-arrow-right"></i>
                                            </div>
                                        </button>
                                    </div>
                                </div>
                                <p class="form-messages mb-0 mt-3">
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </div>
                                    @endif
                                </p>
                            </form>
                        </div>
                    </div>
            @endif
        </div>
        @endauth

       

    </div>
{{-- 
    <div class="tab-pane fade @if ($tab === 'login-whatsapp') active show @endif" id="login-whatsapp">
        @if ($tab === 'login-whatsapp')
            // whatsapp content
        @endif
    </div>

    <div class="tab-pane fade @if ($tab === 'login-google') active show @endif" id="login-google">
        @if ($tab === 'login-google')
            // whatsapp content
        @endif
    </div> --}}





</div>
