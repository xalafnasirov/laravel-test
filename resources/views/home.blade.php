@extends('layouts.app')
@section('content')
    <!--==============================
     All CSS File
     ============================== -->


    {{-- Order confirmation --}}
    {{-- <link rel="stylesheet" href="{{ asset('client/assets/css/style.css') }}"> --}}



    <!--==============================
        Preloader
    ==============================-->

    <!--==============================
        Hero Area
    ==============================-->
    <div class="as-hero-wrapper hero-1" id="hero">
        <div class="hero-slider-1 number-dots as-carousel" id="heroSlide1" data-fade="true" data-slide-show="1"
            data-md-slide-show="1" data-dots="true" data-xl-dots="true" data-ml-dots="true" data-lg-dots="true">

            <div class="as-hero-slide">
                <div class="as-hero-bg" data-bg-src="{{ asset('client/assets/img/hero/koreanioniq5.jpg') }}"></div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="hero-style1">
                                <span class="hero-subtitle text-white" data-ani="slideinleft" data-ani-delay="0.1s">
                                    XİDMƏTLƏR
                                </span>
                                <h2 class="hero-title text-white" data-ani="slideinleft" data-ani-delay="0.2s">Koreyadan
                                </h2>
                                <h2 class="hero-title text-white" data-ani="slideinleft" data-ani-delay="0.3s">Avtomobil
                                    sifarişi</h2>
                                <p class="hero-text" data-ani="slideinleft" data-ani-delay="0.3s">80-90 gün ərzində sənədli
                                    şəkildə şəkildə avtmobillərin çatdırılması.
                                    &#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;
                                    &#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;
                                    &#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;
                                    &#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;
                                    &#160;&#160;</p>
                                <div class="btn-group" data-ani="slideinleft" data-ani-delay="0.04s">
                                    <a href="{{route('services.inspection')}}" class="as-btn style3">SİFARİŞ GÖNDƏR</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="as-hero-slide">
                <div class="as-hero-bg" data-bg-src="{{ asset('client/assets/img/hero/koreanioniq5.jpg') }}"></div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="hero-style1">
                                <span class="hero-subtitle text-white" data-ani="slideinleft" data-ani-delay="0.1s">
                                    XİDMƏTLƏR
                                </span>
                                <h2 class="hero-title text-white" data-ani="slideinleft" data-ani-delay="0.2s">Maşın
                                    hissələri</h2>
                                <h2 class="hero-title text-white" data-ani="slideinleft" data-ani-delay="0.2s">sifariş ver
                                </h2>
                                <p class="hero-text" data-ani="slideinleft" data-ani-delay="0.3s">Maşın hissələri həm
                                    Koreyadan sifarişlə gətirilir yaxud birbaşa yerli bazardan online ödənişlə ala
                                    bilərsiniz
                                    &#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;
                                    &#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;
                                    &#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;

                                    &#160;&#160;</p>
                                <div class="btn-group" data-ani="slideinleft" data-ani-delay="0.4s">
                                    <a href="{{route('services.shop')}}" class="as-btn style3">MAŞIN HİSSƏLƏRİ</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="as-hero-slide">
                <div class="as-hero-bg" data-bg-src="{{ asset('client/assets/img/hero/koreanioniq5.jpg') }}"></div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="hero-style1">
                                <span class="hero-subtitle text-white" data-ani="slideinleft" data-ani-delay="0.1s">
                                    XİDMƏTLƏR
                                </span>
                                <h2 class="hero-title text-white" data-ani="slideinleft" data-ani-delay="0.2s">Maşın
                                    yoxlanışı</h2>
                                <h2 class="hero-title text-white" data-ani="slideinleft" data-ani-delay="0.2s">göndər</h2>
                                <p class="hero-text" data-ani="slideinleft" data-ani-delay="0.3s">Maşın yoxlanışı seçdiyiniz
                                    maşın üçün birbaşa olaraq Koreyada nümayəndəmiz tərəfindən həyata keçirilir.

                                    &#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;
                                    &#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;

                                    &#160;&#160;</p>
                                <div class="btn-group" data-ani="slideinleft" data-ani-delay="0.4s">
                                    <a href="{{route('services.inspection')}}" class="as-btn style3">MAŞIN YOXLANIŞI</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- 
            <div class="as-hero-slide">
                <div class="as-hero-bg" data-bg-src="assets/img/hero/hero_bg_1_2.png"></div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="hero-style1">
                                <span class="hero-subtitle" data-ani="slideinleft" data-ani-delay="0.1s">
                                    AUTOMOTIVE CAR REPAIR
                                </span>
                                <h1 class="hero-title text-white" data-ani="slideinleft" data-ani-delay="0.2s">We're
                                    Repair Car
                                    Hustle Free.</h1>
                                <p class="hero-text" data-ani="slideinleft" data-ani-delay="0.3s">Dramatically scale
                                    backward-compatible portals after market positioning deliverables. Assertively
                                    predominate collaborative partnerships rather.</p>
                                <div class="btn-group" data-ani="slideinleft" data-ani-delay="0.4s">
                                    <a href="contact.html" class="as-btn style2">VIEW MORE DETAILS</a>
                                    <a href="service.html" class="as-btn style3">OUR SERVICES</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="as-hero-slide">
                <div class="as-hero-bg" data-bg-src="assets/img/hero/hero_bg_1_3.png"></div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="hero-style1">
                                <span class="hero-subtitle" data-ani="slideinleft" data-ani-delay="0.1s">
                                    AUTOMOTIVE CAR REPAIR
                                </span>
                                <h1 class="hero-title text-white" data-ani="slideinleft" data-ani-delay="0.2s">
                                    Bringing Life Back to Drive</h1>
                                <p class="hero-text" data-ani="slideinleft" data-ani-delay="0.3s">Dramatically scale
                                    backward-compatible portals after market positioning deliverables. Assertively
                                    predominate collaborative partnerships rather.</p>
                                <div class="btn-group" data-ani="slideinleft" data-ani-delay="0.4s">
                                    <a href="contact.html" class="as-btn style2">VIEW MORE DETAILS</a>
                                    <a href="service.html" class="as-btn style3">OUR SERVICES</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
    <!--======== / Hero Section ========-->
    <!--==============================
        Counter Area
    ====
        <==============================
        Why-choose-us Area
    ==============================-->

    <div class="product-area car-reuest-bottom space text-center" data-bg-src="assets/img/product/product_bg.png">
        @livewire('home.home-car-request')
    </div>
    <!--==============================
        Product Area
    ==============================-->
    <div class="product-area mb-5 text-center" data-bg-src="{{('client/assets/img/product/product_bg.png')}}">
        @livewire('home.home-product-slider')
    </div>
    <!--==============================
        Portfolio Area
    ==============================-->
    <section class="portfolio-area services-top" data-overlay="title" data-opacity="9"
        data-bg-src="assets/img/portfolio/portfolio_bg.png">
        <!-- bg animated image -->
        <div class="portfolio-anime-img shape-mockup d-none d-xl-block" data-top="0%" data-left="0"><img
                class="svg-img" src="client/assets/img/product/product_bg.png" alt="img"></div>
        <!-- bg animated image /-->

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-9">
                    <div class="title-area text-center">
                        <h2 class="sec-title text-white mb-0">XİDMƏTLƏRİMİZ</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid p-0">
            <div class="row portfolio-slider-1 as-carousel" id="portfolio-slider1" data-slide-show="5"
                data-ml-slide-show="4" data-lg-slide-show="4" data-md-slide-show="3" data-sm-slide-show="1"
                data-xs-slide-show="1" data-dots="false" data-infinite="true">
                <div class="col-lg-3">
                    <div class="portfolio-box">
                        <img class="portfolio-box_img" src="{{asset('client/assets/img/service/tires-02.jpg')}}" alt="img">
                        <div class="portfolio-box_details">
                            <h3 class="portfolio-box_title h4"><a href="project-details.html">Təkərlər</a>
                            </h3>
                            <span class="portfolio-box_subtitle">Koreya istehsalı təkərlər</span>
                            <a href="project-details.html" class="icon"><i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="portfolio-box">
                        <img class="portfolio-box_img" src="{{asset('client/assets/img/service/car-inspection-01.jpg')}}" alt="img">
                        <div class="portfolio-box_details">
                            <h3 class="portfolio-box_title h4"><a href="project-details.html">Avtomobil yoxlanışı</a>
                            </h3>
                            <span class="portfolio-box_subtitle">Yerindəcə yoxlanış və detallı informasiya</span>
                            <a href="project-details.html" class="icon"><i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="portfolio-box">
                        <img class="portfolio-box_img" src="{{asset('client/assets/img/service/car_parts_01.jpg')}}" alt="img">
                        <div class="portfolio-box_details">
                            <h3 class="portfolio-box_title h4"><a href="project-details.html">Maşın hissələri</a>
                            </h3>
                            <span class="portfolio-box_subtitle">Hər markaya uyğun yeni hissələr</span>
                            <a href="project-details.html" class="icon"><i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="portfolio-box">
                        <img class="portfolio-box_img" src="{{asset('client/assets/img/service/online_payment_01.png')}}" alt="img">
                        <div class="portfolio-box_details">
                            <h3 class="portfolio-box_title h4"><a href="project-details.html">Online alış-veriş və çatdırılma</a>
                            </h3>
                            <span class="portfolio-box_subtitle">Rayonlara çatdırılma</span>
                            <a href="project-details.html" class="icon"><i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="portfolio-box">
                        <img class="portfolio-box_img" src="{{asset('client/assets/img/service/tires-02.jpg')}}" alt="img">
                        <div class="portfolio-box_details">
                            <h3 class="portfolio-box_title h4"><a href="project-details.html">Təkərlər</a>
                            </h3>
                            <span class="portfolio-box_subtitle">Koreya istehsalı təkərlər</span>
                            <a href="project-details.html" class="icon"><i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="portfolio-box">
                        <img class="portfolio-box_img" src="{{asset('client/assets/img/service/car-inspection-01.jpg')}}" alt="img">
                        <div class="portfolio-box_details">
                            <h3 class="portfolio-box_title h4"><a href="project-details.html">Avtomobil yoxlanışı</a>
                            </h3>
                            <span class="portfolio-box_subtitle">Yerindəcə yoxlanış və detallı informasiya</span>
                            <a href="project-details.html" class="icon"><i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="portfolio-box">
                        <img class="portfolio-box_img" src="{{asset('client/assets/img/service/car_parts_01.jpg')}}" alt="img">
                        <div class="portfolio-box_details">
                            <h3 class="portfolio-box_title h4"><a href="project-details.html">Maşın hissələri</a>
                            </h3>
                            <span class="portfolio-box_subtitle">Hər markaya uyğun yeni hissələr</span>
                            <a href="project-details.html" class="icon"><i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="portfolio-box">
                        <img class="portfolio-box_img" src="{{asset('client/assets/img/service/online_payment_01.png')}}" alt="img">
                        <div class="portfolio-box_details">
                            <h3 class="portfolio-box_title h4"><a href="project-details.html">Online alış-veriş və çatdırılma</a>
                            </h3>
                            <span class="portfolio-box_subtitle">Rayonlara çatdırılma</span>
                            <a href="project-details.html" class="icon"><i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
               
                
            </div>
        </div>
    </section>
    <!--==============================
        Testimonial Area 2
    ==============================-->
   
    <!--==============================
        Brand Area
    ==============================-->
    <div class="client-sec1 space-bottom">
        @livewire('home.home-brand-show')
    </div>

    
    
    <!--==============================
            Footer Area
    ==============================-->


    <!--==============================
    Product Lightbox
    ==============================-->
    <div id="QuickView" class="white-popup mfp-hide">
        <div class="container bg-white position-relative">
            <div class="row gx-60">
                <div class="col-lg-6">
                    <div class="product-big-img">
                        <div class="img"><img src="assets/img/product/product_1_1.png" alt="Product Image">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 align-self-center">
                    <div class="product-about">
                        <p class="price">$125.00</p>
                        <h2 class="product-title">Brembo Disc Brake S2</h2>
                        <div class="product-rating">
                            <div class="star-rating" role="img" aria-label="Rated 5.00 out of 5"><span
                                    style="width:100%">Rated <strong class="rating">5.00</strong> out of 5 based on
                                    <span class="rating">1</span> customer rating</span></div>
                            <a href="shop-details.html" class="woocommerce-review-link">(<span class="count">2</span>
                                customer reviews)</a>
                        </div>
                        <p class="text">Syndicate customized growth strategies prospective human capital leverage
                            other's optimal e-markets without transparent catalysts for change. </p>
                        <div class="checklist">
                            <ul>
                                <li><i class="far fa-circle-check"></i> Lifetime structural, one year face finish
                                    warranty</li>
                                <li><i class="far fa-circle-check"></i>Mapped from “Center Caps” under ” tment” tab
                                </li>
                            </ul>
                        </div>
                        <div class="actions">
                            <div class="quantity">
                                <input type="number" class="qty-input" step="1" min="1"
                                    max="100" name="quantity" value="1" title="Qty">
                                <button class="quantity-plus qty-btn"><i class="far fa-chevron-up"></i></button>
                                <button class="quantity-minus qty-btn"><i class="far fa-chevron-down"></i></button>
                            </div>
                            <button class="as-btn">Add to Cart</button>
                        </div>
                        <div class="product_meta">
                            <span class="sku_wrapper">SKU: <span class="sku">wheel-fits-chevy-camaro</span></span>
                            <span class="posted_in">Category: <a href="shop.html" rel="tag">Tires &
                                    Wheels</a></span>
                            <span>Tags: <a href="shop.html">automotive parts</a><a href="shop.html">wheels</a></span>
                        </div>
                    </div>
                    <button title="Close (Esc)" type="button" class="mfp-close">×</button>
                </div>
            </div>
        </div>
    </div>


    <!--==============================
    All Js File
    ============================== -->
@endsection
