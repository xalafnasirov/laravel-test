<div class="container">
    <div class="title-area text-center mb-35">
        <h2 class="sec-title mb-0">Hissələr & Təkərlər</h2>
        <ul class="product-filter-btn nav">

            {{-- <li class="nav-item">
                    <button class="tab-btn nav-link active" id="pills-1-tab" data-bs-toggle="tab"
                        data-bs-target="#pills-1">HAMISI</button>
                </li> --}}

            @isset($filtered_home_car_part)
                <li class="nav-item">
                    <button class="tab-btn nav-link active" id="pills-2-tab" data-bs-toggle="tab"
                        data-bs-target="#pills-2">HİSSƏLƏR</button>
                </li>
            @endisset


            @isset($filtered_tire)
                <li class="nav-item">
                    <button class="tab-btn nav-link" id="pills-3-tab" data-bs-toggle="tab"
                        data-bs-target="#pills-3">TƏKƏRLƏR</button>
                </li>
            @endisset

        </ul>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="tab-content">
                {{-- <div class="tab-pane fade show active" id="pills-1">
                    <div class="row as-carousel product-slider g-0" data-slide-show="4" data-lg-slide-show="3"
                        data-md-slide-show="2" data-sm-slide-show="2" data-xs-slide-show="1" data-arrows="true"
                        data-xl-arrows="true" data-ml-arrows="true">
                    </div>
                </div> --}}

                @isset($filtered_home_car_part)
                    <div class="tab-pane fade show active" id="pills-2">
                        <div class="row as-carousel product-slider g-0" data-slide-show="4" data-lg-slide-show="3"
                            data-md-slide-show="2" data-sm-slide-show="2" data-xs-slide-show="1" data-arrows="true"
                            data-xl-arrows="true" data-ml-arrows="true">
                            @foreach ($filtered_home_car_part as $single)
                                <div class="col-xl-4 col-sm-6">
                                    <div class="as-product">
                                        <span class="tag">{{ $single->brand }}</span>
                                        <div class="actions">
                                            <a class="icon-btn" href="cart.html"><i class="fa-regular fa-heart"></i></a>
                                            <a class="icon-btn popup-content" href="#QuickView"><i
                                                    class="fa-regular fa-eye"></i></a>
                                        </div>
                                        <a href="{{ route('services.shop_single', ['id' => "$single->id"]) }}">
                                            <div class="product-img">
                                                {{-- <img src="{{ asset('storage/images/brand/26_09_2024_Hi4BsrqIOb.jpeg') }}"
                                                        alt="image not found"> --}}

                                                @isset($product_image[$single->id])
                                                    <img src="{{ asset('/storage/' . $product_image[$single->id]->image) }}"
                                                        alt="product image" loading='lazy'>
                                                @endisset

                                            </div>
                                        </a>


                                        <div class="product-content">
                                            <p class="meta">{{ $single->category }}</p>
                                            <h4 class="product-title h5"><a href="shop-details.html">{{ $single->brand }}
                                                    {{ $single->part_name }}</a></h4>
                                            <span class="price">{{ $single->price }} AZN</span>
                                            <button wire:click='add_to_cart({{ $single->id }})' class="as-btn style3"><i
                                                    class="fa-regular fa-cart-shopping me-2"></i> SİFARİŞ VER</button>
                                        </div>

                                    </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endisset


                @isset($filtered_tire)
                    <div class="tab-pane fade" id="pills-3">
                        <div class="row as-carousel product-slider g-0" data-slide-show="4" data-lg-slide-show="3"
                            data-md-slide-show="2" data-sm-slide-show="2" data-xs-slide-show="1" data-arrows="true"
                            data-xl-arrows="true" data-ml-arrows="true">
                            <div class="col-xl-3 col-lg-4 col-sm-6">
                                <div class="as-product">
                                    <span class="tag">NEW</span>
                                    <div class="actions">
                                        <a class="icon-btn" href="cart.html"><i class="fa-regular fa-heart"></i></a>
                                        <a class="icon-btn popup-content" href="#QuickView"><i
                                                class="fa-regular fa-eye"></i></a>
                                        <span class="icon-btn rating-btn"><i class="fa-regular fa-star"></i><span
                                                class="rating">4.9</span></span>
                                    </div>
                                    <div class="product-img">
                                        <img src="assets/img/product/product_1_2.png" alt="product image">
                                    </div>
                                    <div class="product-content">
                                        <p class="meta">Automotive Brake</p>
                                        <h4 class="product-title h5"><a href="shop-details.html">Brembo Disc
                                                Brake S2</a></h4>
                                        <span class="price">$120.00</span>
                                        <a class="as-btn style3" href="checkout.html"><i
                                                class="fa-regular fa-cart-shopping me-2"></i> ADD TO CART</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-4 col-sm-6">
                                <div class="as-product">
                                    <span class="tag">NEW</span>
                                    <div class="actions">
                                        <a class="icon-btn" href="cart.html"><i class="fa-regular fa-heart"></i></a>
                                        <a class="icon-btn popup-content" href="#QuickView"><i
                                                class="fa-regular fa-eye"></i></a>
                                        <span class="icon-btn rating-btn"><i class="fa-regular fa-star"></i><span
                                                class="rating">4.9</span></span>
                                    </div>
                                    <div class="product-img">
                                        <img src="assets/img/product/product_1_4.png" alt="product image">
                                    </div>
                                    <div class="product-content">
                                        <p class="meta">Car Wheel Rim</p>
                                        <h4 class="product-title h5"><a href="shop-details.html">Lotus Cars
                                                Group Wheel</a></h4>
                                        <span class="price">$133.00</span>
                                        <a class="as-btn style3" href="checkout.html"><i
                                                class="fa-regular fa-cart-shopping me-2"></i> ADD TO CART</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-4 col-sm-6">
                                <div class="as-product">
                                    <span class="tag">NEW</span>
                                    <div class="actions">
                                        <a class="icon-btn" href="cart.html"><i class="fa-regular fa-heart"></i></a>
                                        <a class="icon-btn popup-content" href="#QuickView"><i
                                                class="fa-regular fa-eye"></i></a>
                                        <span class="icon-btn rating-btn"><i class="fa-regular fa-star"></i><span
                                                class="rating">4.9</span></span>
                                    </div>
                                    <div class="product-img">
                                        <img src="assets/img/product/product_1_5.png" alt="product image">
                                    </div>
                                    <div class="product-content">
                                        <p class="meta">Car Bearing </p>
                                        <h4 class="product-title h5"><a href="shop-details.html">Ball bearing
                                                Rolling</a></h4>
                                        <span class="price">$125.00 <del>$175.00</del></span>
                                        <a class="as-btn style3" href="checkout.html"><i
                                                class="fa-regular fa-cart-shopping me-2"></i> ADD TO CART</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-4 col-sm-6">
                                <div class="as-product">
                                    <span class="tag">NEW</span>
                                    <div class="actions">
                                        <a class="icon-btn" href="cart.html"><i class="fa-regular fa-heart"></i></a>
                                        <a class="icon-btn popup-content" href="#QuickView"><i
                                                class="fa-regular fa-eye"></i></a>
                                        <span class="icon-btn rating-btn"><i class="fa-regular fa-star"></i><span
                                                class="rating">4.9</span></span>
                                    </div>
                                    <div class="product-img">
                                        <img src="assets/img/product/product_1_6.png" alt="product image">
                                    </div>
                                    <div class="product-content">
                                        <p class="meta">Oil Filter</p>
                                        <h4 class="product-title h5"><a href="shop-details.html">Toyota Oil
                                                Filter Motor</a></h4>
                                        <span class="price">$125.00</span>
                                        <a class="as-btn style3" href="checkout.html"><i
                                                class="fa-regular fa-cart-shopping me-2"></i> ADD TO CART</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-4 col-sm-6">
                                <div class="as-product">
                                    <span class="tag">NEW</span>
                                    <div class="actions">
                                        <a class="icon-btn" href="cart.html"><i class="fa-regular fa-heart"></i></a>
                                        <a class="icon-btn popup-content" href="#QuickView"><i
                                                class="fa-regular fa-eye"></i></a>
                                        <span class="icon-btn rating-btn"><i class="fa-regular fa-star"></i><span
                                                class="rating">4.9</span></span>
                                    </div>
                                    <div class="product-img">
                                        <img src="assets/img/product/product_1_7.png" alt="product image">
                                    </div>
                                    <div class="product-content">
                                        <p class="meta">Car Wheel & Tire</p>
                                        <h4 class="product-title h5"><a href="shop-details.html">Panda Cars
                                                Wheel & Tire</a></h4>
                                        <span class="price">$125.00 <del>$175.00</del></span>
                                        <a class="as-btn style3" href="checkout.html"><i
                                                class="fa-regular fa-cart-shopping me-2"></i> ADD TO CART</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-4 col-sm-6">
                                <div class="as-product">
                                    <span class="tag">NEW</span>
                                    <div class="actions">
                                        <a class="icon-btn" href="cart.html"><i class="fa-regular fa-heart"></i></a>
                                        <a class="icon-btn popup-content" href="#QuickView"><i
                                                class="fa-regular fa-eye"></i></a>
                                        <span class="icon-btn rating-btn"><i class="fa-regular fa-star"></i><span
                                                class="rating">4.9</span></span>
                                    </div>
                                    <div class="product-img">
                                        <img src="assets/img/product/product_1_8.png" alt="product image">
                                    </div>
                                    <div class="product-content">
                                        <p class="meta">Vehicle Parts</p>
                                        <h4 class="product-title h5"><a href="shop-details.html">Car Vehicle
                                                Automatic</a></h4>
                                        <span class="price">$125.00</span>
                                        <a class="as-btn style3" href="checkout.html"><i
                                                class="fa-regular fa-cart-shopping me-2"></i> ADD TO CART</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endisset

            </div>
        </div>
    </div>
</div>
