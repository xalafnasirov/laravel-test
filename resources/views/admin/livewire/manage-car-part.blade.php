<main class="main-wrapper">
    <div class="main-content">

        <div class="row">
            <div class="col-12 col-lg-12">
                <div class="card">


                    <form wire:submit.prevent='submit'>

                        <div class="card-body">

                            @isset($all_brand)
                                <div class="mb-4">
                                    <h5 class="mb-3">Marka seçin</h5>
                                    <select wire:model='selected_brand' class="form-select mb-3" aria-label="Marka seçin">
                                        <option value="">Marka seçin</option>
                                        @foreach ($all_brand as $brand)
                                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>∆
                                        @endforeach
                                    </select>
                                </div>
                            @endisset


                            @isset($all_category)
                                <div class="mb-4">
                                    <h5 class="mb-3">Kateqoriya seçin</h5>
                                    <select wire:change='get_sub_category' wire:model='selected_category'
                                        class="form-select mb-3" aria-label="Kateqoriya seçin">
                                        <option value="">Kateqoriya seçin</option>
                                        @foreach ($all_category as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endisset

                            <div class="mb-4">
                                <h5 class="mb-3">Alt kateqoriya seçin</h5>
                                <select wire:model='selected_sub_category' class="form-select mb-3"
                                    aria-label="Alt kateqoriya seçin">
                                    <option value="">Alt kateqoriya seçin</option>
                                    @isset($all_sub_category)
                                        @foreach ($all_sub_category as $sub_category)
                                            <option value="{{ $sub_category->id }}">{{ $sub_category->name }}</option>
                                        @endforeach
                                    @endisset

                                </select>
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

                            <input type="file" wire:model='photo' accept=".jpg, .png, image/jpeg, image/png"
                                multiple>
                            @error('photo')
                                {{ $message }}
                            @enderror

                            @isset($temp_image)
                                @foreach ($temp_image as $index => $single)
                                    <button type="button" wire:click='remove_temp_photo({{ $index }})'>
                                        <img width="50" height=50 src="{{ $single->temporaryUrl() }}" alt="">
                                    </button>
                                @endforeach
                            @endisset

                        </div>

                        <div class="card-body">
                            <div class="d-flex align-items-center gap-3">
                                <button type="submit" class="btn btn-outline-primary flex-fill"><i
                                        class="bi bi-send me-2"></i>Əlavə et</button>
                                <button wire:click="cancel" type="button" class="btn btn-outline-danger flex-fill"><i
                                        class="bi bi-x-circle me-2"></i>Ləğv et</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="row g-3">
            @if ($all_car_part_count == 0)

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
                        <h5 class="mb-3">Bütün maşın hissələri: {{ $all_car_part_count }}</h5>
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
                                    <th>Kateqoriya</th>
                                    <th>Alt kateqoriya</th>
                                    <th>Qiymət</th>
                                    <th>Aktivlik</th>
                                    <th>Düzəliş et</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($all_car_part as $car_part)
                                    <tr class=' {{ $car_part->condition == 0 ? 'bg-warning bg-gradient' : '' }}''>
                                        <td>{{ $car_part->id }}</td>

                                        <td>{{ $car_part->brand }}</td>
                                        <td>{{ $car_part->category }}</td>
                                        <td>{{ $car_part->sub_category }}</td>
                                        <td>{{ $car_part->price }} AZN</td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input
                                                    wire:change='on_edit_condition({{ $car_part->id }}, {{ $car_part->condition }})'
                                                    class="form-check-input" type="checkbox" id="flexSwitchCheckChecked"
                                                    {{ $car_part->condition == 0 ? '' : 'checked' }}>
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
                                                            wire:click="delete({{ $car_part->id }})">Sil</a>
                                                    </li>
                                                    <li><a class="btn btn-sm btn-filter dropdown-item"
                                                            wire:click="edit({{ $car_part->id }})">Dəyişdir</a></li>
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
                                        <div class="col-md-6">
                                            <label for="input1" class="form-label">Marka</label>
                                            <select wire:model='edit_brand' class="form-select mb-3"
                                                aria-label="Marka seçin">
                                                @foreach ($all_brand as $brand)
                                                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="mb-4">
                                            <h5 class="mb-3">Qiymət (AZN)</h5>
                                            <input type="number" class="form-control" placeholder="Qiymət."
                                                wire:model='edit_price' step="0.01" required>
                                            @error('title')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="mb-4">
                                            <input type="file" wire:model='edit_image'
                                                accept=".jpg, .png, image/jpeg, image/png" multiple>
                                            @error('photo')
                                                {{ $message }}
                                            @enderror

                                            @isset($product_image)
                                                @foreach ($product_image as $index => $single)
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

    {{-- <div class="card-body">
        <div class="">
            <!-- Modal -->
            <div class="modal" id="EditCarPartModal">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                       
                    </div>

                </div>
            </div>
        </div>
    </div> --}}

</main>
