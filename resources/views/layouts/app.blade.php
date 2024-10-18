<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('client/assets/img/favicons/apple-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('client/assets/img/favicons/apple-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('client/assets/img/favicons/apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('client/assets/img/favicons/apple-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114"
        href="{{ asset('client/assets/img/favicons/apple-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120"
        href="{{ asset('client/assets/img/favicons/apple-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144"
        href="{{ asset('client/assets/img/favicons/apple-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152"
        href="{{ asset('client/assets/img/favicons/apple-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180"
        href="{{ asset('client/assets/img/favicons/apple-icon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="192x192"
        href="{{ asset('client/assets/img/favicons/android-icon-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="32x32"
        href="{{ asset('client/assets/img/favicons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="96x96"
        href="{{ asset('client/assets/img/favicons/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="16x16"
        href="{{ asset('client/assets/img/favicons/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('client/assets/img/favicons/manifest.json') }}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ asset('client/assets/img/favicons/ms-icon-144x144.png') }}">
    <meta name="theme-color" content="#ffffff">

    <!--==============================
 Google Fonts
 ============================== -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700;800&family=Roboto:wght@400;500;700;900&display=swap"
        rel="stylesheet">

    <!--==============================
 All CSS File
 ============================== -->
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('client/assets/css/bootstrap.min.css') }}">
    <!-- Fontawesome Icon -->
    <link rel="stylesheet" href="{{ asset('client/assets/css/fontawesome.min.css') }}">
    <!-- Magnific Popup -->
    <link rel="stylesheet" href="{{ asset('client/assets/css/magnific-popup.min.css') }}">
    <!-- Slick Slider -->
    <link rel="stylesheet" href="{{ asset('client/assets/css/slick.min.css') }}">
    <!-- Theme Custom CSS -->
    <link rel="stylesheet" href="{{ asset('client/assets/css/style.css') }}">



    {{-- Order confirmation --}}
    @if (Route::is('order.confirmation'))
        <link rel="stylesheet" href="{{ asset('client/assets/css/order_success.css') }}">
    @endif




    <!-- Scripts -->
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    @livewireStyles
</head>

<body class="theme-blue">
    @include('layouts.navigation')

    @yield('content')

    <!-- Scroll To Top -->

    <div class="scroll-top">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"
                style="transition: stroke-dashoffset 10ms linear 0s; stroke-dasharray: 307.919, 307.919; stroke-dashoffset: 307.919;">
            </path>
        </svg>

    </div>




    @include('layouts.footer')

    <!-- fraimwork - jquery include -->
    <!-- Jquery -->
    <script src="{{ asset('client/assets/js/jquery-3.7.1.min.js') }}"></script>
    <!-- Slick Slider -->
    <script src="{{ asset('client/assets/js/slick.min.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('client/assets/js/bootstrap.min.js') }}"></script>
    <!-- Magnific Popup -->
    <script src="{{ asset('client/assets/js/jquery.magnific-popup.min.js') }}"></script>
    <!-- Counter Up -->
    <script src="{{ asset('client/assets/js/jquery.counterup.min.js') }}"></script>
    <!-- Range Slider -->
    <script src="{{ asset('client/assets/js/jquery-ui.min.js') }}"></script>
    <!-- Isotope Filter -->
    <script src="{{ asset('client/assets/js/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('client/assets/js/isotope.pkgd.min.js') }}"></script>
    <!-- Nice Select File -->
    <script src="{{ asset('client/assets/js/nice-select.min.js') }}"></script>
    <!-- Main Js File -->
    <script src="{{ asset('client/assets/js/theme.js') }}"></script>

    @livewireScripts

    <script>
        document.addEventListener('print', function(e) {
            console.log(e.detail)
        });

        document.addEventListener('show_success', () => {
            $('#order_success_modal').modal('show');
        })

        window.addEventListener('tab-changed', event => {
            const base_url = event.detail[0].base_url;
            const close_tab = event.detail[0].close_tab;
            const open_tab = event.detail[0].open_tab;
            $(`#${close_tab}`).fadeOut(1);
            $(`#${open_tab}`).fadeIn(50);


            // const new_url = window.location.origin + '/' + base_url;
            // window.history.pushState(null, '', `${new_url}/${open_tab}`);
        });

        // window.addEventListener("popstate", function(event) {
        //     // Update the content based on the state object
        //     const path = window.location.pathname;
        //     updateContent(path);
        // });
    </script>

    <!--==============================
Product Lightbox
==============================-->
    <div id="QuickView" class="white-popup mfp-hide">
        <div class="container bg-white position-relative">
            <div class="row gx-60">
                <div class="col-lg-6">
                    <div class="product-big-img">
                        <div class="img"><img src="assets/img/product/product_1_1.png" alt="Product Image"></div>
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
                            <a href="shop-details.html" class="woocommerce-review-link">(<span
                                    class="count">2</span>
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

</body>

</html>
