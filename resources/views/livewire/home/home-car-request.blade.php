<div class="container">
    <div class="container space-top pt-xl-0 mt-5 pb-xl-0">

        <div class="booking-form ajax-contact">
            <!-- bg animated image -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </div>
            @endif



            <div class="row">
                @if (!$request_sent)
                    <div class="col-xl-5 align-self-center">
                        <div class="title-area mb-xl-0 text-center text-lg-start">
                            <h2 class="sec-title mb-0">Avtomobil sifarişi <br>yaxud yoxlanışı</h2>
                            <h3 class="h6 content mb-0">Koreya avtomobillərin sifarişi və yerində yoxlanışı</h3>
                        </div>
                    </div>
                    <div class="col-xl-7">
                        <form wire:submit.prevent="submit">
                            <div class="row gy-20">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <select wire:model='selected_brand' name="classes" class="form-select style2">
                                            <option value="" selected="selected">Marka</option>
                                            @foreach ($brand as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <select name="classes" class="form-select style2">
                                            <option value="" disabled="disabled" selected="selected" hidden>İl
                                            </option>
                                            <option value="2017">2017</option>
                                            <option value="2018">2018</option>
                                            <option value="2019">2019</option>
                                            <option value="2020">2020</option>
                                            <option value="2021">2021</option>
                                            <option value="2022">2022</option>
                                            <option value="2023">2023</option>
                                            <option value="2024">2024</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <select name="classes" class="form-select style2">
                                            <option value="" disabled="disabled" selected="selected" hidden>
                                                Yanacaq
                                                növü
                                            </option>
                                            <option value="1">Dizel</option>
                                            <option value="2">Elektrik</option>
                                            <option value="3">Hybrid</option>
                                            <option value="3">Benzin</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <input wire:model='customer_name' name="phone" type="text"
                                            class="form-control" name="service" id="service" placeholder="Adınız">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <input wire:model='customer_phone' type="text" class="form-control"
                                            name="service" id="service" placeholder="Whatsapp nömrəniz">
                                    </div>
                                </div>
                                <div class="col-lg-4 form-btn">

                                    <button class="as-btn disabled">
                                        <div wire:loading>
                                            <div class="loader"></div>
                                        </div>
                                        <div wire:loading.remove>
                                            SİFARİŞİNİ GÖNDƏR
                                        </div>
                                    </button>
                                </div>
                            </div>
                        </form>

                    </div>
                @else
                    <div class="col-xl-12 text-center  align-self-center">
                        <div class="title-area mb-xl-0 text-center text-lg-start">
                            <h2 class="sec-title mb-0 text-success" style="color: green">Sifarişiniz göndərildi!!!</h2>
                            <h3 class="h6 content mb-0">Sizinlə tezliklə əlaqə saxlanılacaq!</h3>
                            <a style="color: white" href="{{ route('login') }}">
                                <button type="buton" class="as-btn">DAXİL
                                    OL</button>
                            </a>

                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
