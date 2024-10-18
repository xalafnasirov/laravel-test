<div class="as-checkout-wrapper space-top space-extra-bottom">
    <div class="container">
        @isset($cart)
            <form wire:submit.prevent='submit'>
                <div class="row">
                    <div class="col-lg-6">

                        {{-- Customer informations --}}
                        <div>
                            <h2 class="pt-lg-2">Çatdırılma məlumatlarınız<h2>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <input name='firstname' value="{{ old('firstname') }}" autofocus wire:model.live='firstname'
                                    type="text" @class([
                                        'error-input-style' => $errors->has('firstname'),
                                        'success-input-style' => !$errors->has('firstname') && $firstname,
                                    ]) placeholder="Ad *">
                            </div>

                            <div class="col-md-6 form-group">
                                <input name='lastname' value="{{ old('lastname') }}" wire:model.live='lastname'
                                    type="text" @class([
                                        'error-input-style' => $errors->has('lastname'),
                                        'success-input-style' => !$errors->has('lastname') && $lastname,
                                    ]) placeholder="Soyad *">
                            </div>


                            <div class="col-12 form-group">
                                <select  wire:model.live='selected_region' @class([
                                    'error-input-style' => $errors->has('selected_region'),
                                    'success-input-style' =>
                                        !$errors->has('selected_region') && $selected_region,
                                ]) >
                                    <option value=''>Rayon seçin *</option>
                                    @isset($all_region)
                                        @foreach ($all_region as $single)
                                            <option value={{ $single->id }}>{{ $single->name }}</option>
                                        @endforeach
                                    @endisset
                                </select>
                            </div>



                            <div class="col-12 form-group">
                                <input name='email' value="{{ old('email') }}" wire:model.live='email'
                                    @class([
                                        'error-input-style' => $errors->has('email'),
                                        'success-input-style' => !$errors->has('email') && $email,
                                    ]) type="email" placeholder="Email *">
                            </div>

                            <div class="col-12 form-group">
                                @if ($errors->has('phone') || !isset($phone))
                                    <span>Nümunə: 501234567</span>
                                @endif

                                <input name='phone' value="{{ old('phone') }}" wire:model.live='phone'
                                    @class([
                                        'error-input-style' => $errors->has('phone'),
                                        'success-input-style' => !$errors->has('phone') && $phone,
                                    ]) minlength='9' maxlength='9' type="text"
                                    placeholder="Telefon *">
                            </div>
                        </div>

                        {{-- Order list --}}

                        <div>
                            <h2 class="pt-lg-2">Sifarişiniz<h2>
                        </div>
                        <div class="woocommerce-cart-form">
                            <table class="cart_table mb-20">
                                <thead>
                                    <tr>
                                        <th class="cart-col-productname">Məhsul adı</th>
                                        <th class="cart-col-price">Tək qiyməti</th>
                                        <th class="cart-col-quantity">Say</th>
                                        <th class="cart-col-total">Ümumi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @dd($cart) --}}
                                    @foreach ($cart as $single)
                                        {{-- @dd($single) --}}
                                        <tr class="cart_item">
                                            <td>{{ $single->brand }} | {{ $single->sub_category }} </td>
                                            <td>{{ $single->single_price }}</td>
                                            <td>{{ $single->quantity }}</td>
                                            <td><b>{{ $single->price }}</b></td>
                                        </tr>
                                    @endforeach

                                </tbody>
                                <tfoot class="checkout-ordertable">

                                    <tr class="order-total">
                                        <th>
                                            <h3>Ümumi</h3>
                                        </th>
                                        <td data-title="Total" colspan="4"><strong><span
                                                    class="woocommerce-Price-amount amount">
                                                    <h3>{{ $total_price }} AZN</h3>
                                                </span></strong>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>


                    </div>


                    <div class="col-lg-6">
                        {{-- Billling information --}}
                        <div @class([
                            'mt-lg-3 mb-30',
                            'error-input-style' => $errors->has('selected_payment_type'),
                            'success-input-style' =>
                                !$errors->has('selected_payment_type') && $selected_payment_type,
                        ])>
                            <div class="woocommerce-checkout-payment">
                                <h4 class=" pt-lg-2">ÖDƏNİŞ METODU SEÇİN</h4>

                                <ul class="wc_payment_methods payment_methods methods">

                                    {{-- <li class="wc_payment_method payment_method_cod">
                                        <input wire:model='selected_payment_type' value='{{ $payment_type[0]->id }}'
                                            id="payment_method_epoint" type="radio" class="input-radio"
                                            name="payment_method">
                                        <label for="payment_method_epoint"></label>
                                        <img width="90" height="auto"
                                            src="{{ asset('storage/images/logo/epoint.png') }}" alt="image">
                                    </li> --}}

                                    <li class="wc_payment_method payment_method_cod">
                                        <input wire:model='selected_payment_type' value='{{ $payment_type[1]->id }}'
                                            id="payment_method_kapital" type="radio" class="input-radio"
                                            name="payment_method">
                                        <label for="payment_method_kapital"></label>
                                        <img width="150" height="auto"
                                            src="{{ asset('storage/images/logo/kapital.png') }}" alt="image">
                                    </li>
                                    <h4 class=" pt-lg-2">YAXUD</h4>

                                    <li class="wc_payment_method payment_method_bacs">
                                        <input wire:model='selected_payment_type' value='{{ $payment_type[2]->id }}'
                                            id="payment_method_bacs" type="radio" class="input-radio"
                                            name="payment_method" value="bacs" checked="checked">
                                        <label for="payment_method_bacs">Yerində ödəniş et</label>
                                    </li>
                                </ul>
                                <div class="form-row place-order">
                                    <button type="submit" class="as-btn -border col-12">Tamamla!</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        @else
            <h3>Məhsul seçməmisiniz!</h3>
            <a style="color: white" href="{{ route('services.shop') }}"><button class='as-btn style1'>Mağaza</button></a>
        @endisset
    </div>

</div>
