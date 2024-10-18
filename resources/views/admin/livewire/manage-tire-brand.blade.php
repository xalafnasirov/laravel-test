<main class="main-wrapper">
    <div class="main-content">

        <div class="row">
            <div class="col-12 col-lg-12">
                <div class="card">
                    <form wire:submit.prevent='submit'>

                        <div class="card-body">
                            <div class="mb-4">
                                <h5 class="mb-3">Yeni Təkər Markası Adı</h5>
                                <input type="text" class="form-control" placeholder="Marka adı...."
                                    wire:model='title'>
                                @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            @isset($all_country)
                                <div class="mb-4">
                                    <h5 class="mb-3">Ölkə</h5>
                                    <select wire:model='selected_country' class="form-select mb-3" aria-label="">
                                        <option value="">Ölkə</option>
                                        @foreach ($all_country as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endisset

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
            @if ($all_brand_count == 0)
                <div class="col-auto">
                    <div class="position-relative">
                        <h5 class="mb-3">Marka yoxdur</h5>
                    </div>
                </div>
            @else
                <div class="col-auto">
                    <div class="position-relative">
                        <input class="form-control px-5" type="search" placeholder="Axtar">
                        <span
                            class="material-icons-outlined position-absolute ms-3 translate-middle-y start-0 top-50 fs-5">search</span>
                    </div>
                </div>

                <div class="col-auto">
                    <div class="position-relative">
                        <h5 class="mb-3">Bütün markalar: {{ $all_brand_count }}</h5>
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
                                    <th>Marka</th>
                                    <th>Düzəliş et</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($all_brand as $brand)
                                    <tr>
                                        <td>{{ $brand->name }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button
                                                    class="btn btn-sm btn-filter dropdown-toggle dropdown-toggle-nocaret"
                                                    type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="bi bi-three-dots"></i>
                                                </button>
                                                <ul class=" dropdown-menu" style="">
                                                    <li><a class="btn btn-sm btn-filter dropdown-item text-danger"
                                                            wire:click="delete({{ $brand->id }})">Sil</a>
                                                    </li>
                                                    <li><a class="btn btn-sm btn-filter dropdown-item"
                                                            wire:click="edit({{ $brand->id }})">Dəyişdir</a></li>

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
            <!-- Modal -->
            <div class="modal" id="EditBrandModal">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        @if ($edit_item)
                            <div class="modal-header border-bottom-0 py-2 bg-grd-info">
                                <h5 class="modal-title">Düzəliş et: {{ $edit_item->name }}</h5>
                                <a wire:click='edit_reset' href="javascript:;" class="primaery-menu-close"
                                    data-bs-dismiss="modal">
                                    <i class="material-icons-outlined">close</i>
                                </a>
                            </div>
                            <div class="modal-body">
                                <div class="form-body">
                                    <form class="row g-3">
                                        <div class="col-md-6">
                                            <label for="input1" class="form-label">Adı</label>
                                            <input wire:model='edit_title' type="text" class="form-control"
                                                id="input1">
                                        </div>

                                        @isset($all_country)
                                            <div class="mb-4">
                                                <h5 class="mb-3">Ölkə</h5>
                                                <select wire:model='edit_country' class="form-select mb-3"
                                                    aria-label="">
                                                    @foreach ($all_country as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        @endisset

                                        {{-- Edit images --}}
                                        <div class="mb-4">
                                            <input type="file" wire:model='edit_image'
                                                accept=".jpg, .png, image/jpeg, image/png" multiple>
                                            @error('photo')
                                                {{ $message }}
                                            @enderror

                                            @isset($product_image)
                                                @foreach ($product_image as $single)
                                                    @if ($single->image !== null)
                                                        <img wire:click='remove_product_photo({{ $single->id }})'
                                                            width="50" height=50
                                                            src="{{ asset('/storage/' . $single->image) }}"
                                                            alt="">
                                                    @endif
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
                                                <button type="button" wire:click='edit_submit({{ $edit_item->id }})'
                                                    class="btn btn-grd-info px-4" href="javascript:;"
                                                    class="primaery-menu-close"
                                                    data-bs-dismiss="modal">Dəyişdir</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
</main>
