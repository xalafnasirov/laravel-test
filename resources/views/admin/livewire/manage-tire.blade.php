<main class="main-wrapper">
    <div class="main-content">

        <div class="row">
            <div class="col-12 col-lg-12">
                <div class="card">


                    <form wire:submit.prevent='submit'>

                        <div class="card-body">

                            @isset($all_brand)
                                <div class="">
                                    <h5 class="mb-3">Marka</h5>
                                    <select wire:model='selected_brand' class="form-select mb-3" aria-label="Marka seçin">
                                        <option value="">Marka</option>
                                        @foreach ($all_brand as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>∆
                                        @endforeach
                                    </select>
                                </div>
                            @endisset


                            <div class="">
                                <h5 class="mb-3">Mövsüm</h5>
                                <select wire:model='selected_season' class="form-select mb-3" aria-label="">
                                    <option value="">Mövsüm</option>
                                    @isset($all_season)
                                        @foreach ($all_season as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    @endisset

                                </select>
                            </div>

                            <div class="mb-4">
                                <h5 class="mb-3">Model adı </h5>
                                <input type="text" class="form-control" placeholder="Model adı" wire:model='model'
                                    required>
                                @error('model')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <h5 class="mb-3">Tipi</h5>
                                <input type="text" class="form-control" placeholder="Tipi" wire:model='type'
                                    required>
                                @error('type')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <h5 class="mb-3">İli </h5>
                                <input type="number" class="form-control" placeholder="İli" wire:model='year' required>
                                @error('year')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <h5 class="mb-3">Zəmanət (KM)</h5>
                                <input type="text" class="form-control" placeholder="Zəmanət (KM)"
                                    wire:model='warranty_mileage' required>
                                @error('warranty_mileage')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <h5 class="mb-3">Sürət indeksi</h5>
                                <input type="text" class="form-control" placeholder="Sürət indeksi"
                                    wire:model='speed_index' required>
                                @error('speed_index')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <h5 class="mb-3">Yükləmə indeksi</h5>
                                <input type="text" class="form-control" placeholder="Yükləmə indeksi"
                                    wire:model='load_index' required>
                                @error('load_index')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="mb-4">
                                <h5 class="mb-3">Qiymət (AZN)</h5>
                                <input type="number" class="form-control" placeholder="Qiymət." wire:model='price'
                                    step="0.01" required>
                                @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="mb-4">
                                <div class="form-check form-switch">
                                    <input wire:model='condition' class="form-check-input" type="checkbox"
                                        id="flexSwitchCheckChecked" checked>
                                    <label class="form-check-label" for="flexSwitchCheckChecked">Aktiv</label>
                                </div>
                            </div>

                            <div class="mb-4">

                                <h3>Şəkil</h3>
                                <input id='photo' name='photo' type="file" wire:model='photo'
                                    accept=".jpg, .png, image/jpeg, image/png" multiple>

                                @error('photo')
                                    {{ $message }}
                                @enderror

                                @isset($temp_image)
                                    @foreach ($temp_image as $index => $single)
                                        <button type="button" wire:click='remove_temp_photo({{ $index }})'>
                                            <img width="50" height=50 src="{{ $single->temporaryUrl() }}"
                                                alt="">
                                        </button>
                                    @endforeach
                                @endisset
                            </div>

                        </div>

                        <div class="card-body">
                            <div class="d-flex align-items-center gap-3">
                                <button type="submit" class="btn btn-outline-primary flex-fill"><i
                                        class="bi bi-send me-2"></i>Əlavə et</button>
                                <button wire:click="cancel" type="button" class="btn btn-outline-danger flex-fill"><i
                                        class="bi bi-x-circle me-2"></i>Ləğv
                                    et</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="row g-3">
            @if ($all_tire_count == 0)

                <div class="col-auto">
                    <div class="position-relative">
                        <input wire:model.live='search_key' class="form-control px-5" type="search"
                            placeholder="Axtar">
                        <span
                            class="material-icons-outlined position-absolute ms-3 translate-middle-y start-0 top-50 fs-5">search</span>
                    </div>
                </div>

                <div class="col-auto">
                    <div class="position-relative">
                        <h5 class="mb-3">Maşın hissəsi yoxdur</h5>
                    </div>
                </div>
            @else
                <div class="col-auto">
                    <div class="position-relative">
                        <input wire:model.live='search_key' class="form-control px-5" type="search"
                            placeholder="Axtar">
                        <span
                            class="material-icons-outlined position-absolute ms-3 translate-middle-y start-0 top-50 fs-5">search</span>
                    </div>
                </div>

                <div class="col-auto">
                    <div class="position-relative">
                        <h5 class="mb-3">Bütün maşın hissələri: {{ $all_tire_count }}</h5>
                    </div>
                </div>
        </div>
        <div class="card mt-4">
            <div class="card-body">
                <div class="product-table">
                    <div class="table-responsive white-space-nowrap">
                        <table class="table align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Marka</th>
                                    <th>Ölkə</th>
                                    <th>Mövsüm</th>
                                    <th>Model</th>
                                    <th>Tip</th>
                                    <th>Zəmanət</th>
                                    <th>Sürət indeksi</th>
                                    <th>Yük indeksi</th>
                                    <th>Qiymət</th>
                                    <th>Aktivlik</th>
                                    <th>Düzəliş et</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($all_tire as $item)
                                    <tr class=' {{ $item->condition == 0 ? 'bg-warning bg-gradient' : '' }}''>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->brand }}</td>
                                        <td>{{ $item->country }}</td>
                                        <td>{{ $item->season }}</td>
                                        <td>{{ $item->model }}</td>
                                        <td>{{ $item->type }}</td>
                                        <td>{{ $item->warranty_mileage }}</td>
                                        <td>{{ $item->speed_index }}</td>
                                        <td>{{ $item->load_index }}</td>
                                        <td>{{ $item->price }} AZN</td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input
                                                    wire:change='on_edit_condition({{ $item->id }}, {{ $item->condition }})'
                                                    class="form-check-input" type="checkbox"
                                                    id="flexSwitchCheckChecked"
                                                    {{ $item->condition == 0 ? '' : 'checked' }}>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button
                                                    class="btn btn-sm btn-filter dropdown-toggle dropdown-toggle-nocaret"
                                                    type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="bi bi-three-dots"></i>
                                                </button>
                                                <ul class=" dropdown-menu" style="">
                                                    <li><a class="btn btn-sm btn-filter dropdown-item text-danger"
                                                            wire:click="delete({{ $item->id }})">Sil</a>
                                                    </li>
                                                    <li><a class="btn btn-sm btn-filter dropdown-item"
                                                            wire:click="edit({{ $item->id }})">Dəyişdir</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @endif

    </div>
    <div class="card-body">
        <div class="">
            <div class="modal" id="EditCarPartModal">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header border-bottom-0 py-2 bg-grd-info">
                            <h5 class="modal-title">Düzəliş et:</h5>
                            <a wire:click='edit_reset' href="javascript:;" class="primaery-menu-close"
                                data-bs-dismiss="modal">
                                <i class="material-icons-outlined">close</i>
                            </a>
                        </div>
                        <div class="modal-body">
                            @isset($edit_item)
                                <form wire:submit.prevent='edit_submit({{ $edit_item->id }})'>
                                    <div class="row g-3">


                                        @isset($all_brand)
                                            <div class="">
                                                <h5 class="">Marka</h5>
                                                <select wire:model='edit_brand' class="form-select mb-3"
                                                    aria-label="Marka">
                                                    @foreach ($all_brand as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>∆
                                                    @endforeach
                                                </select>
                                            </div>
                                        @endisset


                                        <div class="">
                                            <h5 class="">Mövsüm</h5>
                                            <select wire:model='edit_season' class="form-select mb-3" aria-label="">
                                                @isset($all_season)
                                                    @foreach ($all_season as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                @endisset

                                            </select>
                                        </div>

                                        <div class="">
                                            <h5 class="mb-3">Model adı </h5>
                                            <input type="text" class="form-control" placeholder="Model adı"
                                                wire:model='edit_model' required >
                                            @error('model')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="">
                                            <h5 class="mb-3">Tipi</h5>
                                            <input type="text" class="form-control" placeholder="Tipi"
                                                wire:model='edit_type' required>
                                            @error('type')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="">
                                            <h5 class="mb-3">İli </h5>
                                            <input type="number" class="form-control" placeholder="İli"
                                                wire:model='edit_year' required>
                                            @error('year')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="">
                                            <h5 class="mb-3">Zəmanət (KM)</h5>
                                            <input type="text" class="form-control" placeholder="Zəmanət (KM)"
                                                wire:model='edit_warranty_mileage' required>
                                            @error('warranty_mileage')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="">
                                            <h5 class="mb-3">Sürət indeksi</h5>
                                            <input type="text" class="form-control" placeholder="Sürət indeksi"
                                                wire:model='edit_speed_index' required>
                                            @error('speed_index')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="">
                                            <h5 class="mb-3">Yükləmə indeksi</h5>
                                            <input type="text" class="form-control" placeholder="Yükləmə indeksi"
                                                wire:model='edit_load_index' required>
                                            @error('load_index')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>


                                        <div class="">
                                            <h5 class="mb-3">Qiymət (AZN)</h5>
                                            <input type="number" class="form-control" placeholder="Qiymət."
                                                wire:model='edit_price' step="0.01" required>
                                            @error('title')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>



                                        <div class="">
                                            <input type="file" wire:model='edit_image'
                                                accept=".jpg, .png, image/jpeg, image/png" multiple>
                                            @error('photo')
                                                {{ $message }}
                                            @enderror

                                            @isset($edit_product_image)
                                                @foreach ($edit_product_image as $index => $single)
                                                    <img wire:click='remove_product_photo({{ $index }})'
                                                        width="50" height=50
                                                        src="{{ asset('/storage/' . $single->image) }}" alt="">
                                                @endforeach
                                            @endisset

                                            @isset($edit_temp_image)
                                                @foreach ($edit_temp_image as $index => $single)
                                                    <img wire:click='remove_edit_temp_photo({{ $index }})'
                                                        width="50" height=50 src="{{ $single->temporaryUrl() }}"
                                                        alt="">
                                                @endforeach
                                            @endisset

                                        </div> 

                                        <div class="col-md-12">
                                            <div class="d-md-flex d-grid align-items-center gap-3">
                                                <button type="button" wire:click='edit_reset'
                                                    class="btn btn-grd-danger px-4" href="javascript:;"
                                                    class="primaery-menu-close" data-bs-dismiss="modal">Ləğv
                                                    et</button>
                                                <button type="submit" class="btn btn-grd-info px-4" href="javascript:;"
                                                    class="primaery-menu-close" data-bs-dismiss="modal">Dəyişdir</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            @endisset

                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>

</main>
