<div class="popup-search-box d-none d-lg-block">
    <button class="searchClose"><i class="fal fa-times"></i></button>
    <form action="#">
        <input type="text" placeholder="Nə axtarırsan? (kia, hissələr, təkərlər və s.)">
        <button type="submit"><i class="fal fa-search"></i></button>
    </form>
</div>

<div class="as-menu-wrapper">
    <div class="as-menu-area text-center">
        <button class="as-menu-toggle"><i class="fal fa-times"></i></button>
        <div class="mobile-logo">
            <a href="index.html"><img src="assets/img/logo.svg" alt="Dealaro"></a>
        </div>
        <div class="as-mobile-menu">
            <ul>
                <li>
                    <a href="{{ route('home') }}">ƏSAS SƏHİFƏ</a>
                </li>
                <li>
                    <a href="{{ route('services.shop') }}">MAŞIN HİSSƏLƏRİ</a>
                </li>
                <li>
                    <a href="{{ route('services.tires') }}"><i class="fa-solid fa-envelope"></i>TƏKƏRLƏR</a>
                </li>
                <li>
                    <a href="{{ route('services.inspection') }}">MAŞIN YOXLANIŞI</a>
                </li>

                <li>
                    <a href="{{ route('services.contact') }}">ƏLAQƏ</a>
                </li>
            </ul>
        </div>
    </div>
</div>

<div class="sidemenu-wrapper d-none d-lg-block ">
    <div class="sidemenu-content bg-title">
        <button class="closeButton sideMenuCls"><i class="far fa-times"></i></button>
        <div class="widget footer-widget">
            <div class="as-widget-about">
                <div class="footer-logo">
                    <a href="index.html"><img src="assets/img/logo.svg" alt="Dealaro"></a>
                </div>
                <p class="about-text">Fusce varius, dolor tempor interdum tristiquei bibendum.</p>
                <ul class="footer-info-list">
                    <li class="footer-info"><i class="fa-solid fa-phone"></i><a
                            href="tel:+994702600520">(+994) 70 260 05 20</a></li>
                    <li class="footer-info"><i class="fa-solid fa-envelope"></i><a
                            href="mailto:info@dealaro.com">info@dealaro.com</a></li>
                </ul>
                <div class="as-social pt-25">
                    <a href="https://www.facebook.com/"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="https://www.goggle.com/"><i class="fa-brands fa-google"></i></a>
                    <a href="https://www.twitter.com/"><i class="fa-brands fa-twitter"></i></a>
                    <a href="https://www.pinterest.com/"><i class="fa-brands fa-pinterest-p"></i></a>
                </div>
            </div>
        </div>
        <div class="widget footer-widget">
            <h3 class="widget_title">Popular Posts</h3>
            <div class="recent-post-wrap">
                <div class="recent-post">
                    <div class="media-img">
                        <a href="blog-details.html"><img src="assets/img/widget/footer-recent-post-1.png"
                                alt="Blog Image"></a>
                    </div>
                    <div class="media-body">
                        <div class="recent-post-meta">
                            <a href="blog.html"><i class="fa-regular fa-clock"></i>15th April, 2023</a>
                        </div>
                        <h4 class="post-title"><a class="text-inherit" href="blog-details.html">How To Start Car
                                Engine Here</a></h4>
                    </div>
                </div>
                <div class="recent-post">
                    <div class="media-img">
                        <a href="blog-details.html"><img src="assets/img/widget/footer-recent-post-2.png"
                                alt="Blog Image"></a>
                    </div>
                    <div class="media-body">
                        <div class="recent-post-meta">
                            <a href="blog.html"><i class="fa-regular fa-clock"></i>20th June, 2023</a>
                        </div>
                        <h4 class="post-title"><a class="text-inherit" href="blog-details.html">How To Stop Car
                                Engine Here</a></h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="widget newsletter-widget footer-widget">
            <h3 class="widget_title">Subscribe</h3>
            <p class="footer-text">Get latest updates &amp; offers Now.</p>
            <form class="newsletter-form">
                <input class="form-control" type="email" placeholder="Enter Email Address" required="">
                <button type="submit" class="as-btn"><i class="fa-solid fa-paper-plane"></i></button>
            </form>
            <div class="company-info mt-35">
                <h6 class="info-title"><i class="fa-light fa-clock"></i> Opening Time</h6>
                <span class="info-details"> Mon-Sat : 8:00AM - 5:00PM</span>
            </div>
        </div>
    </div>
</div>


<div class="side-cart-wrapper d-none d-lg-block ">
    <div class="sidemenu-content">
        <button class="closeButton sideCartCls"><i class="far fa-times"></i></button>
        <div class="widget woocommerce widget_shopping_cart">
            <h3 class="widget_title">Shopping cart</h3>
            <div class="widget_shopping_cart_content">
                <ul class="woocommerce-mini-cart cart_list product_list_widget ">
                    <li class="woocommerce-mini-cart-item mini_cart_item">
                        <a href="#" class="remove remove_from_cart_button"><i class="far fa-times"></i></a>
                        <a href="#"><img src="assets/img/widget/footer-recent-post-1.png" alt="Cart Image">Car
                            Engine Plug</a>
                        <span class="quantity">1 ×
                            <span class="woocommerce-Price-amount amount">
                                <span class="woocommerce-Price-currencySymbol">$</span>940.00</span>
                        </span>
                    </li>
                    <li class="woocommerce-mini-cart-item mini_cart_item">
                        <a href="#" class="remove remove_from_cart_button"><i class="far fa-times"></i></a>
                        <a href="#"><img src="assets/img/widget/footer-recent-post-2.png" alt="Cart Image">Car
                            Air Filter</a>
                        <span class="quantity">1 ×
                            <span class="woocommerce-Price-amount amount">
                                <span class="woocommerce-Price-currencySymbol">$</span>899.00</span>
                        </span>
                    </li>
                    <li class="woocommerce-mini-cart-item mini_cart_item">
                        <a href="#" class="remove remove_from_cart_button"><i class="far fa-times"></i></a>
                        <a href="#"><img src="assets/img/blog/recent-post-1-1.png" alt="Cart Image">CSK Red
                            Wheel</a>
                        <span class="quantity">1 ×
                            <span class="woocommerce-Price-amount amount">
                                <span class="woocommerce-Price-currencySymbol">$</span>899.00</span>
                        </span>
                    </li>
                    <li class="woocommerce-mini-cart-item mini_cart_item">
                        <a href="#" class="remove remove_from_cart_button"><i class="far fa-times"></i></a>
                        <a href="#"><img src="assets/img/blog/recent-post-1-3.png" alt="Cart Image">Car Repair
                            Solution</a>
                        <span class="quantity">1 ×
                            <span class="woocommerce-Price-amount amount">
                                <span class="woocommerce-Price-currencySymbol">$</span>899.00</span>
                        </span>
                    </li>
                </ul>
                <p class="woocommerce-mini-cart__total total">
                    <strong>Subtotal:</strong>
                    <span class="woocommerce-Price-amount amount">
                        <span class="woocommerce-Price-currencySymbol">$</span>4398.00</span>
                </p>
                <p class="woocommerce-mini-cart__buttons buttons">
                    <a href="cart.html" class="as-btn wc-forward">View cart</a>
                    <a href="checkout.html" class="as-btn checkout wc-forward">Checkout</a>
                </p>
            </div>
        </div>
    </div>
</div>


<header class="as-header header-layout3">
    <div class="navbar-top">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-6 col-lg-5 text-lg-start text-center">

                    <div class="header-links">

                        <ul>
                            <li> <img width="50" height="auto"
                                    src="{{ asset('storage/images/flags/azerbaijan_flag.png') }}"
                                    alt="image not found">
                            </li>
                            <li> <img width="50" height="auto"
                                    src="{{ asset('storage/images/flags/south-korea_flag.png') }}"
                                    alt="image not found">
                            </li>
                            <li>Koreya-Azərbaycan maşın alqı-satqısı</li>
                        </ul>
                    </div>

                </div>
                <div class="col-xl-6 col-lg-7 align-self-center text-lg-end text-center">
                    <div class="header-links">
                        <ul>
                            <li><i class="far fa-phone"></i><a href="tel:+994702600520">(+994) 70 260 05 20</a></li>
                            <li>
                                @auth
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <a href="{{ route('logout') }}"></a>
                                        <button onclick=ëvent.preventDefault>
                                            Logout
                                        </button>
                                    </form>
                                @else
                                    <i class="far fa-user"></i>
                                    <a href="{{ route('login') }}">Daxil ol</a> 
                                    <span>&#160;/</span>
                                    <a href="{{ route('register.go', ['tab'=>'login-select']) }}">Qeydiyyat</a>
                                @endauth

                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="sticky-wrapper mt-3">
        <!-- Main Menu Area -->
        <div class="container-fluid">
            <div class="menu-wrap-area">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto">
                        <div id='nav_header_logo' class="header-logo">
                            <a href="{{ route('home') }}"><img
                                    src="{{ asset('storage/images/logo/hyunglobal_logo.png') }}"
                                    alt="Hyunglobal"></a>
                        </div>
                    </div>
                    <div class="col-auto me-xl-auto">
                        <div class="menu-area">
                            <nav class="main-menu d-none d-lg-inline-block">
                                <ul>
                                    {{-- <li>
                                        <a href="{{ route('home') }}">ƏSAS SƏHİFƏ</a>
                                    </li> --}}
                                    <li>
                                        <a href="{{ route('services.shop') }}"><i class="fa-solid fa-wrench"></i>  &#160; MAŞIN HİSSƏLƏRİ</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('services.tires') }}"><i class="fa-solid fa-tire"></i> &#160; TƏKƏRLƏR</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('services.inspection') }}"><i class="fa-solid fa-search"></i> &#160; MAŞIN YOXLANIŞI</a>
                                    </li>

                                    <li>
                                        <a href="{{ route('services.contact') }}">ƏLAQƏ</a>
                                    </li>
                                </ul>
                            </nav>
                            <button type="button" class="as-menu-toggle d-inline-block d-lg-none"><i
                                    class="far fa-bars"></i></button>
                        </div>
                    </div>
                    @livewire('nav-control')
                </div>
            </div>
        </div>
    </div>
</header>
