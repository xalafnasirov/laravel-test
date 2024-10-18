<div class="product-area space text-center background-image arrow-wrap"
    style="background-image: url(&quot;assets/img/product/product_bg.png&quot;);">
    <div class="container">
        <div class="title-area text-center mb-35">
            <h2 class="sec-title mb-0">{{$title}}</h2>
            <ul class="product-filter-btn nav">
                <li class="nav-item">
                    <button wire:click="to_page('user-info')" class="tab-btn nav-link {{ $panel == 'user-info' ? 'active' : '' }}" id="pills-1-tab"
                        data-bs-toggle="tab" data-bs-target="#pills-1">MƏLUMATLAR</button>
                </li>
                <li class="nav-item">
                    <button wire:click="to_page('orders')" class="tab-btn nav-link {{ $panel == 'orders' ? 'active' : '' }}" id="pills-2-tab"
                        data-bs-toggle="tab" data-bs-target="#pills-2">HİSSƏ SİFARİŞLƏRİ</button>
                </li>
                <li class="nav-item">
                    <button wire:click="to_page('requests')" class="tab-btn nav-link {{ $panel == 'requests' ? 'active' : '' }}" id="pills-3-tab"
                        data-bs-toggle="tab" data-bs-target="#pills-3">AVTOMOBİL SİFARİŞLƏRİ</button>
                </li>
                <li class="nav-item">
                    <button wire:click="to_page('account')" class="tab-btn nav-link {{ $panel == 'account' ? 'active' : '' }}" id="pills-4-tab"
                        data-bs-toggle="tab" data-bs-target="#pills-4">HESAB</button>
                </li>
            </ul>
        </div>

        <div class="tab-content">
            @switch($panel)
                @case('user-info')
                    <div class="tab-pane fade {{ $panel == 'user-info' ? 'active show' : '' }}" id="pills-1">
                        <div class="row">
                            @isset($user)
                                <div class="col-lg-6">
                                    <div class="row">

                                        <div class="form-group style-white2 col-md-6">
                                            <input wire:model.live="firstname" type="text" @class(['form-control', 'success-input-style' => $firstname])
                                                name="name" id="name" value='{{ $firstname }}' placeholder="Adınız">
                                            <i class="fal fa-user"></i>
                                        </div>
                                        <div class="form-group style-white2 col-md-6">
                                            <input wire:model.live="lastname" type="text" name="name" id="name"
                                                @class(['form-control', 'success-input-style' => $lastname]) value='{{ $lastname }}' placeholder="Soyadınız">
                                            <i class="fal fa-user"></i>
                                        </div>
                                        {{-- <div>
                                        <i class="fal fa-check"></i> Verified
                                    </div> --}}
                                        <div class="form-group style-white2 col-md-12">

                                            <input wire:model.live="email" type="email" name="email" id="email"
                                                @class(['form-control', 'success-input-style' => $email]) value='{{ $email }}'
                                                placeholder="Email Address">
                                            <i class="fal fa-envelope"></i>
                                        </div>

                                        <div class="form-group style-white2 col-md-12">
                                            <input wire:model.live="phone" type="phone" name="phone" id="phone"
                                                @class(['form-control', 'success-input-style' => $phone]) value='{{ $phone }}' placeholder="Telefon">
                                            <i class="fal fa-phone"></i>
                                        </div>

                                        <div class="form-group style-white2 col-md-12">
                                            <input disabled type="text" @class(['form-control', 'success-input-style' => $user->id])
                                                value='ID: {{ $user->id }}' placeholder="ID: ">
                                            <i class="fa-solid fa-id-card"></i>

                                        </div>


                                    </div>
                                </div>
                            @endisset

                            <div class="col-lg-6">
                                <div class="row">

                                    <div wire:model.live="region_id" class="col-12 form-group"> <i class="fal fa-city"></i>
                                        <select @class([
                                            'success-input-style' => $region_id,
                                        ])>
                                            <option value=''>Rayon seçin * </option>
                                            @isset($all_region)
                                                @foreach ($all_region as $single)
                                                    @if ($single->id === $address->region_id)
                                                        <option selected value={{ $single->id }}>{{ $single->name }}</option>
                                                        @continue
                                                    @endif
                                                    <option value={{ $single->id }}>{{ $single->name }}</option>
                                                @endforeach
                                            @endisset
                                        </select>
                                    </div>
                                    <div wire:model.live="street" class="form-group style-white2 col-md-12">
                                        <input type="text" @class(['form-control', 'success-input-style' => $street]) value='{{ $street }}'
                                            name="street" id="street" placeholder="Küçə adı">
                                        <i class="fal fa-road"></i>
                                    </div>
                                    <div class="form-group style-white2 col-md-12">
                                        <input wire:model.live="zipcode" type="text" @class(['form-control', 'success-input-style' => $zipcode])
                                            value='{{ $zipcode }}' name="zipcode" id="zipcode" placeholder="Zip kodu">
                                        <i class="fa-solid fa-map-pin"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @break

                @case('orders')
                    <div class="tab-pane fade {{ $panel == 'orders' ? 'active show' : '' }}" id="pills-2">
                        // hisse sifarisleri
                    </div>
                @break

                @case('requests')
                    <div class="tab-pane fade {{ $panel == 'user-info' ? 'active show' : '' }}" id="pills-3">
                        // avtomboil sifarisleri
                    </div>
                @break

                @case('account')
                    <div class="tab-pane fade {{ $panel == 'user-info' ? 'active show' : '' }}" id="pills-4">
                        // hesab
                    </div>
                @break

                @default
            @endswitch
        </div>
    </div>
</div>
