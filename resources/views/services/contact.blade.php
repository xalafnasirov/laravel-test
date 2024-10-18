@extends('layouts.app')

@section('content')

<div class="map-sec">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3644.7310056272386!2d89.2286059153658!3d24.00527418490799!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39fe9b97badc6151%3A0x30b048c9fb2129bc!2sthemeholy!5e0!3m2!1sen!2sbd!4v1651028958211!5m2!1sen!2sbd" allowfullscreen="" loading="lazy"></iframe>
</div>

<section class="space">
    <div class="container">
        <div class="row gy-30 justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="contact-box">
                    <div class="contact-box_icon">
                        <i style="color: white" class="fa fa-location-dot"></i>
                    </div>
                    <div class="contact-box_info">
                        <h4 class="contact-box_title">Ünvan</h4>
                        <p class="contact-box_text">Çinar plaza, 17-ci mərtəbə, Xətai, Bakı</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="contact-box">
                    <div class="contact-box_icon">
                        <i style="color: white" class="fa fa-phone"></i>
                    </div>
                    <div class="contact-box_info">
                        <h4 class="contact-box_title">7/24 Müştəri xidməti</h4>
                        <a href="mailto:help24/7@gmail.com" class="contact-box_link">info@hyunglobal.com</a>
                        <a href="tel:(+163)-1202-0088" class="contact-box_link">(+994) 70 260 05 20</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="contact-box">
                    <div class="contact-box_icon">
                        <i style="color: white" class="fa fa-clock"></i>
                    </div>
                    <div class="contact-box_info">
                        <h4 class="contact-box_title">İş vaxtlarımız</h4>
                        <p class="contact-box_text">9:00am - 10:00pm ( Baz. ert. - Bazar )</p>
                        {{-- <p class="contact-box_text">Saturday &amp; Sunday Closed</p> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
    
@endsection
