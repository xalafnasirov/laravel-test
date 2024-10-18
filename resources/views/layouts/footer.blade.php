<footer class="footer-wrapper footer-layout1" data-bg-src="assets/img/bg/footer_bg_1.png">
    <div class="widget-area space2-bottom">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-md-6 col-xxl-4 col-xl-3">
                    <div class="widget footer-widget">
                        <div class="as-widget-about">
                            <div class="footer-logo">
                                <a href="{{route('home')}}"><img src="{{asset('storage/images/logo/hyunglobal_logo_white.png')}}" alt="Hyunglobal"></a>
                            </div>
                            <p class="about-text">Hyunglobal Koreyadan Azərbaycana avtomobil, təkərlər, hissələr idxal edən şirkətdir. Saytımızdan birbaşa olaraq maşın sifarişi verə bilərsiz, yaxud online şəkildə maşın hissələri ala bilərsiniz.</p>
                            <ul class="footer-info-list">
                                <li class="footer-info"><i class="fa-solid fa-location-dot"></i>Çinar plaza, 17-ci mərtəbə, Xətai rayonu</li>
                                <li class="footer-info"><i class="fa-solid fa-phone"></i><a
                                        href="tel:+994702600520">(+994) 70 260 05 20</a></li>
                                <li class="footer-info"><i class="fa-solid fa-envelope"></i><a
                                        href="mailto:info@hyunglobal.com">info@hyunglobal.com</a></li>
                            </ul>

                            <div class="as-social pt-2 mt-3">
                                <a style="background-color: #0091ff"href="https://www.facebook.com/"><i class="fa-brands fa-facebook-f"></i></a>
                                <a style="background-color: #25D366" href="https://www.whatsapp.com/"><i class="fa-brands fa-whatsapp"></i></a>
                                <a style="background-color: #ff0090" href="https://www.instagram.com/"><i class="fa-brands fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-auto">
                    <div class="widget widget_nav_menu footer-widget">
                        <h3 class="widget_title">HESABIM</h3>
                        <div class="menu-all-pages-container">
                            <ul class="menu">
                                <li><a href="{{route('dashboard.go', ['panel'=>'orders'])}}">Sifarişlərim</a></li>
                                <li><a href="{{route('dashboard.go', ['panel'=>'requests'])}}">Avtomobil sifarişlərim</a></li>
                                <li><a href="{{route('dashboard.go', ['panel'=>'user-info'])}}">Məlumatlarım</a></li>
                                <li><a href="{{route('dashboard.go', ['panel'=>'account'])}}">Hesab ayarları</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-xl-auto">
                    <div class="widget widget_nav_menu footer-widget">
                        <h3 class="widget_title">SƏHİFƏLƏR</h3>
                        <div class="menu-all-pages-container">
                            <ul class="menu">
                                <li><a href="{{route('services.shop')}}">Mağaza</a></li>
                                <li><a href="{{route('services.shop')}}">Hissələr</a></li>
                                <li><a href="{{route('services.tires')}}">Təkərlər</a></li>
                                <li><a href="{{route('services.contact')}}">Əlaqə</a></li>
                                <li><a class='searchBoxToggler'>Axtar</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-xl-auto">
                    <div class="widget widget_nav_menu footer-widget">
                        <h3 class="widget_title">XİDMƏTLƏRİMİZ</h3>
                        <div class="menu-all-pages-container">
                            <ul class="menu">
                                <li><a href="{{route('services.inspection')}}">Avtomobil sifarişi</a></li>
                                <li><a href="{{route('services.inspection')}}">Avtomobil yoxlanışı</a></li>
                                <li><a href="{{route('services.shop')}}">Online alış-veriş</a></li>
                                <li><a href="{{route('services.contact')}}">7/24 Xidmət</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-xl-auto">
                    <div class="widget footer-widget">
                        <h3 class="widget_title">İş vaxtlarımız</h3>
                        <div class="company-info-wrap">
                            <ul class="company-info-list">
                                <li class="company-info"><strong>Bazar-ertəsi:</strong>8AM - 10PM</li>
                                <li class="company-info"><strong>Çərş. Axşamı:</strong>8AM - 10PM</li>
                                <li class="company-info"><strong>Çərşənbə:</strong>8AM - 10PM</li>
                                <li class="company-info"><strong>Cümə axşamı:</strong>9AM - 7PM</li>
                                <li class="company-info"><strong>Cümə:</strong>9AM - 7PM</li>
                                <li class="company-info"><strong>Şənbə:</strong>9AM - 6PM</li>
                                <li class="company-info"><strong>Bazar:</strong>Closed</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright-wrap">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <p class="copyright-text"><i class="fal fa-copyright me-1"></i>2024 Hyunglobal | Bütün hüquqlar qorunur.</p>
                </div>
                {{-- <div class="col-lg-6 text-end d-none d-lg-block">
                    <div class="footer-links">
                        <ul>
                            <li><a href="about.html">Terms of use</a></li>
                            <li><a href="about.html">Privacy Environmental</a></li>
                            <li><a href="about.html">Policy</a></li>
                        </ul>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
</footer>