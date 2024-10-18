<main>

    <div class="as-cart-wrapper  space-top space-extra-bottom">
        <div class="container">

            @isset($cart)

                <table class="cart_table">
                    <thead>
                        <tr>
                            <th>Məhsul adı</th>
                            <th>Qiymət</th>
                            <th>Say</th>
                            <th>Ümumi qiymət</th>
                            <th>Sil</th>
                        </tr>
                    </thead>
                    <tfoot class="checkout-ordertable">

                        <tr class="order-total">
                            <th>
                            </th>
                            <td data-title="Total" colspan="4"><strong><span class="woocommerce-Price-amount amount">
                                        <h3>Ümumi: {{ $cart_price }} AZN</h3>
                                    </span></strong>
                            </td>
                        </tr>


                    </tfoot>
                    <tbody>
                        {{-- @dd($cart) --}}
                        @foreach ($cart as $single)
                            <tr class="cart_item">
                                <td data-title="Name">
                                    {{ $single['brand'] }} | {{ $single['sub_category'] }}
                                </td>
                                <td data-title="Price">
                                    <span class="amount">{{ $single['single_price'] }} AZN</span>
                                </td>
                                <td data-title="Quantity">
                                    <div class="quantity">
                                        <button wire:click="change_quantity({{ $single['id'] }}, 0)""
                                            class="quantity-minus qty-btn"><i class="far fa-minus"></i></button>
                                        <p class="qty-input">{{ $single['quantity'] }} </p>
                                        <button wire:click="change_quantity({{ $single['id'] }}, 1)""
                                            class="quantity-plus qty-btn"><i class="far fa-plus"></i></button>
                                    </div>
                                </td>
                                <td data-title="Total">
                                    <span class="amount"><b>{{ $single['price'] }} AZN</b></span>
                                </td>
                                <td data-title="Remove">
                                    <a wire:click="remove_cart_item({{ $single['id'] }})" class="remove"><i
                                            class="fal fa-trash-alt"></i></a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>


                </table>
                <div class="wc-proceed-to-checkout mb-30">
                    <a href="{{ route('services.checkout') }}" class="as-btn style1 btn-fw"><i
                            class="fas fa-credit-card"></i>&nbsp;&nbsp; ÖDƏNİŞƏ KEÇ</a>
                </div>



            @else

            <h3>Məhsul seçməmisiniz</h3>
            <button class="as-btn">Maşın hissələri</button>
            <button class="as-btn">Təkərlər</button>

            @endisset

        </div>
    </div>




</main>
