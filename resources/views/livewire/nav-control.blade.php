<div class="col-auto d-none d-lg-block">
    <div class="header-button">
        <button type="button" class="icon-btn bg-none searchBoxToggler"><i class="fa-regular fa-magnifying-glass"></i></button>

        
        <button wire:click="route('services.cart')" type="button" class="icon-btn bg-none sideCartToggler">
            <i class="fa-light fa-cart-shopping"></i>
            <span class="badge">{{$cart_product_count}}</span>
        </button>

        @auth
        <a href="{{route('dashboard.go', ['panel'=>'orders'])}}" class="as-btn d-none d-xxl-block">SİFARİŞLƏRİNİZ</a>
        @else
        <a href="{{route('dashboard.go', ['panel'=>'orders'])}}"" class="as-btn d-none d-xxl-block">SİFARİŞİNİ İZLƏ</a>
        @endauth

    </div>
</div>