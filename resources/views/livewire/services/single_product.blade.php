    <section class="product-details space arrow-wrap">
        <div class="container">
            <div class="row gx-60">
                <div class="col-lg-6">
                    <div class="product-big-img">
                        @isset($product_image[0])
                            <div class="img"><img id='single_product_image'
                                    src="{{ $product_image[0] ? asset('storage/' . $product_image[0]->image) : '#' }}"
                                    alt="Product Image"></div>
                        @endisset

                    </div>
                </div>
                <div class="col-lg-6">
                    @switch($product_type)
                        @case(1)
                            <div class="product-about">

                                <p class="price">{{ $product->price }} AZN</p>
                                <h2 class="product-title">{{ $product->brand }} | {{ $product->part_name }}</h2>
                                <h4 class="">{{ $product->category }}</h4>
                                <div class="product-rating">
                                    <div class="star-rating" role="img" aria-label="Rated 5.00 out of 5"><span
                                            style="width:100%">Rated <strong class="rating">5.00</strong> out of 5 based on
                                            <span class="rating">1</span> customer rating</span></div>
                                    <a href="shop-details.html" class="woocommerce-review-link">(<span class="count">2</span>
                                        customer reviews)</a>
                                </div>
                                <div class="checklist">
                                    <ul>
                                        <li><i class="far fa-circle-check"></i> 1 illik zəmanət</li>
                                        <li><i class="far fa-circle-check"></i>Ödənişsiz çatdırılma</li>
                                        <li><i class="far fa-circle-check"></i>2 ay müddətində çatıdırlma</li>
                                    </ul>
                                </div>
                                <div class="actions">
                                    <div class="quantity">
                                        <input disabled class="qty-input" step="1" min="1" max="100"
                                            name="quantity" value={{ $order_quantity }} title="Qty">
                                        <button wire:click='increase' class="quantity-plus qty-btn"><i
                                                class="far fa-chevron-up"></i></button>
                                        <button wire:click='decrease' class="quantity-minus qty-btn"><i
                                                class="far fa-chevron-down"></i></button>
                                    </div>
                                    <button wire:click='add_to_cart' class="as-btn style2"><i
                                            class="fa-regular fa-cart-shopping me-2"></i> SİFARİŞ VER</button>
                                </div>
                                <div class="product_meta">
                                    <span class="sku_wrapper">SKU: <span class="sku">wheel-fits-chevy-camaro</span></span>
                                    <span class="posted_in">Kateqoriya: <a href="shop.html"
                                            rel="tag">{{ strtolower($product->category) }}</a></span>
                                    <span>Taglar: <a href="shop.html">{{ strtolower($product->brand) }},
                                            {{ strtolower($product->part_name) }}</a></span>
                                </div>
                            </div>
                        @break

                        @case(2)
                            <div class="product-about">

                                <p class="price">{{ $product->price }} AZN</p>
                                <h2 class="product-title">{{ $product->model }} | {{ $product->type }}</h2>
                                <h4 class="">{{ $product->year }}</h4>
                                <div class="product-rating">
                                    <div class="star-rating" role="img" aria-label="Rated 5.00 out of 5"><span
                                            style="width:100%">Rated <strong class="rating">5.00</strong> out of 5 based on
                                            <span class="rating">1</span> customer rating</span></div>
                                    <a href="shop-details.html" class="woocommerce-review-link">(<span class="count">2</span>
                                        customer reviews)</a>
                                </div>
                                <div class="checklist">
                                    <ul>
                                        <li><i class="far fa-circle-check"></i> {{$product->warranty_mileage}} KM zəmanət</li>
                                        <li><i class="far fa-circle-check"></i>Ödənişsiz çatdırılma</li>
                                        <li><i class="far fa-circle-check"></i>2 ay müddətində çatıdırlma</li>
                                    </ul>
                                </div>
                                <div class="actions">
                                    <div class="quantity">
                                        <input disabled class="qty-input" step="1" min="1" max="100"
                                            name="quantity" value={{ $order_quantity }} title="Qty">
                                        <button wire:click='increase' class="quantity-plus qty-btn"><i
                                                class="far fa-chevron-up"></i></button>
                                        <button wire:click='decrease' class="quantity-minus qty-btn"><i
                                                class="far fa-chevron-down"></i></button>
                                    </div>
                                    <button wire:click='add_to_cart' class="as-btn style2"><i
                                            class="fa-regular fa-cart-shopping me-2"></i> SİFARİŞ VER</button>
                                </div>
                                <div class="product_meta">
                                    <span class="sku_wrapper">SKU: <span class="sku">wheel-fits-chevy-camaro</span></span>
                                    <span class="posted_in">Kateqoriya: <a href="shop.html"
                                            rel="tag">{{ strtolower($product->model) }}</a></span>
                                    <span>Taglar: <a href="shop.html">{{ strtolower($product->brand) }},
                                            {{ strtolower($product->type) }}</a></span>
                                </div>
                            </div>
                        @break

                        @default
                    @endswitch

                </div>
                {{-- </div>
            <ul class="nav product-tab-style1" id="productTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="description-tab" data-bs-toggle="tab" href="#description"
                        role="tab" aria-controls="description" aria-selected="false">description</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="info-tab" data-bs-toggle="tab" href="#add_info" role="tab"
                        aria-controls="add_info" aria-selected="false">Additional Information</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="reviews-tab" data-bs-toggle="tab" href="#reviews" role="tab"
                        aria-controls="reviews" aria-selected="true">reviews (03)</a>
                </li>
            </ul>
            <div class="tab-content" id="productTabContent">
                <div class="tab-pane fade show active" id="description" role="tabpanel"
                    aria-labelledby="description-tab">
                    <p>Credibly negotiate emerging material wherea click-and-mortar intellectual capital. Compellingly
                        whiteboard client-centric source before cross-platform schema. Distinctively develop
                        future-proof outsourcing without multimedia based portals. Progressively coordinate
                        next-generation architecture for collaborative solutions. Professionally restore
                        backward-compatible quality vectors before customer directed metrics. Holisticly restore
                        technically sound internal or "organic" sources before client-centered human capital underwhelm
                        holistic mindshare for prospective innovation.</p>
                    <p class="mb-0">Seamlessly target fully tested infrastructures whereas just in time process
                        improvements. Dynamically exploit team driven functionalities vis a vis global total linkage
                        redibly synthesize just in time technology rather than open-source strategic theme areas.</p>
                </div>
                <div class="tab-pane fade" id="add_info" role="tabpanel">
                    <table class="woocommerce-table">
                        <tbody>
                            <tr>
                                <th>Brand</th>
                                <td>Jakuna</td>
                            </tr>
                            <tr>
                                <th>Color</th>
                                <td>Yellow</td>
                            </tr>
                            <tr>
                                <th>Weight</th>
                                <td>400 gm</td>
                            </tr>
                            <tr>
                                <th>Battery</th>
                                <td>Lithium</td>
                            </tr>
                            <tr>
                                <th>Material</th>
                                <td>Wood</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                    <div class="woocommerce-Reviews">
                        <div class="as-comments-wrap  ">
                            <ul class="comment-list">
                                <li class="review as-comment-item">
                                    <div class="as-post-comment">
                                        <div class="comment-avater">
                                            <img src="assets/img/blog/comment-author-1.jpg" alt="Comment Author">
                                        </div>
                                        <div class="comment-content">
                                            <span class="commented-on"><i class="fal fa-calendar-alt"></i>22 Jan,
                                                2023</span>
                                            <h4 class="name">Mark Jack</h4>
                                            <div class="star-rating" role="img" aria-label="Rated 5.00 out of 5">
                                                <span style="width:100%">Rated <strong class="rating">5.00</strong>
                                                    out of 5 based on <span class="rating">1</span> customer
                                                    rating</span>
                                            </div>
                                            <p class="text">Compellingly recaptiualize cost effective synergy rather
                                                than prospective architectures. Proactively, ullamco laboris nisi ut
                                                aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit
                                                in voluptate velit esse cillum</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="review as-comment-item">
                                    <div class="as-post-comment">
                                        <div class="comment-avater">
                                            <img src="assets/img/blog/comment-author-2.jpg" alt="Comment Author">
                                        </div>
                                        <div class="comment-content">
                                            <span class="commented-on"><i class="fal fa-calendar-alt"></i>20 Jan,
                                                2023</span>
                                            <h4 class="name">Zenelia Lozhe</h4>
                                            <div class="star-rating" role="img" aria-label="Rated 5.00 out of 5">
                                                <span style="width:100%">Rated <strong class="rating">5.00</strong>
                                                    out of 5 based on <span class="rating">1</span> customer
                                                    rating</span>
                                            </div>
                                            <p class="text">The purpose of lorem ipsum is to create a natural looking
                                                block of text. A practice not without controversy, laying out pages with
                                                meaningless filler text can be very useful when the focus is meant to be
                                                on design, not content.</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="review as-comment-item">
                                    <div class="as-post-comment">
                                        <div class="comment-avater">
                                            <img src="assets/img/blog/comment-author-3.jpg" alt="Comment Author">
                                        </div>
                                        <div class="comment-content">
                                            <span class="commented-on"><i class="fal fa-calendar-alt"></i>10 Jan,
                                                2023</span>
                                            <h4 class="name">Daniel Adam</h4>

                                            <div class="star-rating" role="img" aria-label="Rated 5.00 out of 5">
                                                <span style="width:100%">Rated <strong class="rating">5.00</strong>
                                                    out of 5 based on <span class="rating">1</span> customer
                                                    rating</span>
                                            </div>
                                            <p class="text">The passage experienced a surge in popularity during the
                                                1960s when Letraset used it on their. Today it's seen all around the
                                                web; on templates, websites, and stock designs. Use our generator to get
                                                your own, or read on for.</p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div> <!-- Comment Form -->
                        <div class="as-comment-form  ">
                            <div class="form-title">
                                <h3 class="blog-inner-title ">Leave A Reply</h3>
                                <p>Your email address will not be published. Required fields are marked *</p>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group style-white2">
                                    <input type="text" placeholder="Your Name" class="form-control">
                                    <i class="text-title far fa-user"></i>
                                </div>
                                <div class="col-md-6 form-group style-white2">
                                    <input type="text" placeholder="Your Email" class="form-control">
                                    <i class="text-title far fa-envelope"></i>
                                </div>
                                <div class="form-group col-md-12">
                                    <select name="subject" id="subject" class="single-select style-white2"
                                        style="display: none;">
                                        <option value="" disabled="" selected="" hidden="">Select
                                            Service</option>
                                        <option value="Electrical System">Electrical System</option>
                                        <option value="Auto Car Repair">Auto Car Repair</option>
                                        <option value="Engine Diagnostics">Engine Diagnostics</option>
                                        <option value="Car &amp; Engine Clean">Car &amp; Engine Clean</option>
                                    </select>
                                    <div class="nice-select single-select style-white2" tabindex="0"><span
                                            class="current">Select Service</span>
                                        <ul class="list">
                                            <li data-value="" class="option selected disabled">Select Service</li>
                                            <li data-value="Electrical System" class="option">Electrical System</li>
                                            <li data-value="Auto Car Repair" class="option">Auto Car Repair</li>
                                            <li data-value="Engine Diagnostics" class="option">Engine Diagnostics</li>
                                            <li data-value="Car &amp; Engine Clean" class="option">Car &amp; Engine
                                                Clean</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-12 form-group style-white2">
                                    <textarea placeholder="Write a Message" class="form-control"></textarea>
                                    <i class="text-title far fa-pencil-alt"></i>
                                </div>

                                <div class="col-12 form-group">
                                    <input id="reviewcheck" name="reviewcheck" type="checkbox">
                                    <label for="reviewcheck">Save my name, email, and website in this browser for the
                                        next time I comment.<span class="checkmark"></span></label>
                                </div>
                                <div class="col-12 form-group mb-0">
                                    <button class="as-btn style4">Post Review</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}

                <!--==============================
            Related Product
            ==============================-->
                @isset($related_products)
                    <div class="product-area space-top mb-5 text-center"
                        data-bg-src="{{ 'client/assets/img/product/product_bg.png' }}">
                        <div class="container">
                            <div class="title-area text-center mb-35">
                                <h2 class="sec-title mb-0">Oxşar hissələr</h2>
                                ̰
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="tab-content">

                                        <div class="tab-pane fade show active" id="pills-2">
                                            <div class="row as-carousel product-slider g-0" data-slide-show="4"
                                                data-lg-slide-show="3" data-md-slide-show="2" data-sm-slide-show="2"
                                                data-xs-slide-show="1" data-arrows="true" data-xl-arrows="true"
                                                data-ml-arrows="true">
                                                @foreach ($related_products as $single)
                                                    <div class="col-xl-4 col-sm-6">
                                                        <div class="as-product">
                                                            <span class="tag">{{ $single->brand }}</span>
                                                            <div class="actions">
                                                                <a class="icon-btn" href="cart.html"><i
                                                                        class="fa-regular fa-heart"></i></a>
                                                                <a class="icon-btn popup-content" href="#QuickView"><i
                                                                        class="fa-regular fa-eye"></i></a>
                                                            </div>
                                                            <a
                                                                href="{{ route('services.shop_single', ['id' => "$single->id"]) }}">
                                                                <div class="product-img">
                                                                    {{-- <img src="{{ asset('storage/images/brand/26_09_2024_Hi4BsrqIOb.jpeg') }}"
                                                                            alt="image not found"> --}}

                                                                    @isset($related_product_image[$single->id])
                                                                        <img src="{{ asset('/storage/' . $related_product_image[$single->id]->image) }}"
                                                                            alt="product image" loading='lazy'>
                                                                    @endisset

                                                                </div>
                                                            </a>


                                                            <div class="product-content">
                                                                <p class="meta">{{ $single->category }}</p>
                                                                <h4 class="product-title h5"><a
                                                                        href="shop-details.html">{{ $single->brand }}
                                                                        {{ $single->part_name }}</a></h4>
                                                                <span class="price">{{ $single->price }} AZN</span>
                                                                <button wire:click='add_to_cart({{ $single->id }})'
                                                                    class="as-btn style3"><i
                                                                        class="fa-regular fa-cart-shopping me-2"></i>
                                                                    SİFARİŞ VER</button>
                                                            </div>

                                                        </div>
                                                        </a>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        ̰
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                @endisset

            </div>
    </section>
