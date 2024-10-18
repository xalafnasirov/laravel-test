<section class="theme-blue space2">
    <div class="container">
        <div class='top-brand-show mb-4'>
            @isset($car_brand)
                @foreach ($car_brand as $single)
                    <div wire:click="on_search_brand('{{$single->name}}')" class="tag-brand-single" >
                        <img width="100px" src="{{ asset("/storage/{$single->image}") }}" alt="{{ $single->name }}">
                    </div>
                @endforeach
            @endisset
        </div>
        <div class="row flex-row-reverse">

            <div class="col-xl-9 col-lg-8">

                <div class="as-sort-bar">
                    <div class="row g-sm-0 gy-20 justify-content-between align-items-center">
                        <div class="col-md d-flex justify-content-between align-items-center">
                            <div class="tagcloud d-flex flex-wrap mb-2">

                                @isset($search_brand)
                                    <a wire:click="remove_search_tag('search_brand')">
                                        <i wire:click="remove_search_tag('search_brand')"
                                            class="fa-solid fa-close"></i>&nbsp;{{ $search_brand }}
                                    </a>
                                @endisset
                                @isset($search_category)
                                    <a wire:click="remove_search_tag('search_category')">
                                        <i wire:click="remove_search_tag('search_category')"
                                            class="fa-solid fa-close"></i>&nbsp;{{ $search_category }}
                                    </a>
                                @endisset
                                @isset($search_part_name)
                                    <a wire:click="remove_search_tag('search_part_name')">
                                        <i wire:click="remove_search_tag('search_part_name')"
                                            class="fa-solid fa-close"></i>&nbsp;{{ $search_part_name }}
                                    </a>
                                @endisset
                                @isset($search_min_price)
                                    @empty(!$search_min_price)
                                        <a wire:click="remove_search_tag('search_min_price')">
                                            <i wire:click="remove_search_tag('search_min_price')"
                                                class="fa-solid fa-close"></i>&nbsp; min:{{ $search_min_price }}
                                        </a>
                                    @endempty
                                @endisset
                                @isset($search_max_price)
                                    @empty(!$search_max_price)
                                        <a wire:click="remove_search_tag('search_max_price')">
                                            <i wire:click="remove_search_tag('search_max_price')"
                                                class="fa-solid fa-close"></i>&nbsp; max:{{ $search_max_price }}
                                        </a>
                                    @endempty
                                @endisset


                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-content" id="nav-tabContent">


                    <div class="tab-pane fade active show" id="tab-list" role="tabpanel"
                        aria-labelledby="tab-shop-list">


                        <div class="widget widget_search">

                            <div class="search-form">

                                <input wire:model.live='search_key' type="search" placeholder="Axtar">



                                <button type="submit"><i class="fas fa-search"></i></button>
                            </div>
                        </div>

                        @if ($filtered_product_count === 0)
                            <p>Axtardığınız hissə tapılmadı</p>
                        @endif


                        @isset($filtered_product)
                            <div class="row gy-25">
                                @foreach ($filtered_product as $single)
                                    <div class="col-xl-4 col-sm-6">
                                        <div wire:click="open_product({{ $single->id }})" class="as-product">


                                            <span class="tag">{{ $single->brand }}</span>
                                            <div class="actions">
                                                <a class="icon-btn" href="cart.html"><i class="fa-regular fa-heart"></i></a>
                                                <a class="icon-btn popup-content" href="#QuickView"><i
                                                        class="fa-regular fa-eye"></i></a>
                                            </div>
                                            <a href="{{ route('services.shop_single', ['id' => "$single->id"]) }}">
                                                <div class="product-img">

                                                    @isset($product_image[$single->id])
                                                        <img src="{{ asset('/storage/' . $product_image[$single->id]->image) }}"
                                                            alt="product image" loading='lazy'>
                                                    @endisset

                                                </div>
                                            </a>


                                            <div class="product-content">
                                                <p class="meta">{{ $single->category }}</p>
                                                <h4 class="product-title h5"><a
                                                        href="{{ route('services.shop_single', ['id' => "$single->id"]) }}">{{ $single->brand }}
                                                        {{ $single->part_name }}</a></h4>
                                                <span class="price">{{ $single->price }} AZN</span>
                                                <button wire:click='add_to_cart({{ $single->id }})'
                                                    onclick="event.stopPropagation();" class="as-btn style3"><i
                                                        class="fa-regular fa-cart-shopping me-2"></i>
                                                    SİFARİŞ VER</button>
                                            </div>

                                        </div>
                                        </a>
                                    </div>
                                @endforeach


                            </div>
                        @endisset

                    </div>
                </div>

            </div>
            <div class="col-xl-3 col-lg-4">
                <aside class="sidebar-area">


                    <div class="widget widget_categories">

                        <h3 id="toggle-brands" class="widget_title">Markalar &#160; <i class="fal fa-angle-down"></i>
                        </h3>

                        <ul id="brand-list" class="filter-drop-down hidden">
                            <li>
                                <a wire:click="on_search_brand('bmw')">BMW</a>
                            </li>
                            <li>
                                <a wire:click="on_search_brand('kia')">Kia</a>
                            </li>
                            <li>
                                <a wire:click="on_search_brand('hyundai')">Hyundai</a>
                            </li>
                            <li>
                                <a wire:click="on_search_brand('mercedes')">Mercedes</a>
                            </li>
                        </ul>

                    </div>

                    <div class="widget widget_price_filter  ">
                        <h4 class="">Qiymət aralığı (AZN)</h4>
                        <div class="price-inputs">
                            <input wire:model.live='search_min_price' type="number" placeholder="Minimum">
                            <input wire:model.live='search_max_price' type="number" placeholder="Maksimum">
                        </div>

                    </div>

                    @isset($category)

                        <div class="widget widget_categories">

                            <h3 id="toggle-category" class="widget_title">Kateqoriyalar &#160; <i
                                    class="fal fa-angle-down"></i>
                            </h3>

                            <ul id="category-list" class="filter-drop-down hidden">

                                @foreach ($category as $single)
                                    <li>
                                        <a wire:click="on_search_category('{{ $single->name }}')">{{ $single->name }}</a>
                                    </li>
                                @endforeach
                            </ul>

                        </div>



                    @endisset

                    @isset($part_name)

                        <div class="widget widget_categories">

                            <h3 id="toggle-part" class="widget_title">Hissə adları &#160; <i
                                    class="fal fa-angle-down"></i>
                            </h3>

                            <ul id="part-list" class="filter-drop-down hidden">

                                @foreach ($part_name as $single)
                                    <li>
                                        <a wire:click="on_search_part('{{ $single->name }}')">{{ $single->name }}</a>
                                    </li>
                                @endforeach
                            </ul>

                        </div>


                    @endisset
                </aside>
            </div>
        </div>

    </div>
</section>
