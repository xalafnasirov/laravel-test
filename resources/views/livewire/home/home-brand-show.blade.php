<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="title-area text-center">
                <h2 class="client-title mt-5 h4 mb-0"><span class="double-line"></span> PARTNYORLARIMIZ
                    <span class="text-theme"></span>
                </h2>
            </div>
        </div>
    </div>
    <div class="client-box-border">
        <div class="row as-carousel" id="brandSlide1" data-slide-show="5" data-lg-slide-show="4" data-md-slide-show="3"
            data-sm-slide-show="2" data-xs-slide-show="1" data-arrows="false">
            @isset($car_brand)
                @foreach ($car_brand as $single)
                    <div class="col-auto client-box">
                        <img src="{{asset("/storage/{$single->image}")}}" alt="{{ $single->name }}">
                    </div>
                @endforeach
                @foreach ($tire_brand as $single)
                    <div class="col-auto client-box">
                        <img src="{{asset("/storage/{$single->image}")}}" alt="{{ $single->name }}">
                    </div>
                @endforeach

            @endisset

        </div>
    </div>
</div>
