<main class="main-wrapper">
    <div class="main-content">

        <div class="row">
            <div class="col-12 col-lg-12">
                <div class="card">


                    <form wire:submit.prevent='submit'>

                        <div class="card-body">

                            <div class="mb-4">
                                <h5 class="mb-3">Kateqoriya seçin</h5>
                                <select wire:model='selected_category' class="form-select mb-3"
                                    aria-label="Kateqoriya seçin">
                                    <option value="">Kateqoriya seçin</option>
                                    @foreach ($all_category as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-4">
                                <h5 class="mb-3">Yeni Alt Kateqoriya Adı</h5>
                                <input type="text" class="form-control" placeholder="Alt kateqoriya adı...."
                                    wire:model='title'>
                                @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- <div class="mb-4">
                                <h5 class="mb-3">Şəkil yüklə</h5>
                                <input wire:model="image" id="fancy-file-upload" type="file" name="files"
                                    accept=".jpg, .png, image/jpeg, image/png" class="ff_fileupload_hidden">
                                @error('image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                                @if ($image)
                                    <div class="mt-2">
                                        <img src="{{ $image->temporaryUrl() }}" alt="Preview"
                                            style="max-width: 100px;" />
                                    </div>
                                @endif
                            </div> --}}

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
            @if ($all_sub_category_count == 0)
                <div class="col-auto">
                    <div class="position-relative">
                        <h5 class="mb-3">Alt kateqoriya yoxdur</h5>
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
                        <h5 class="mb-3">Bütün alt kateqoriyalar: {{ $all_sub_category_count }}</h5>
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
                                    <th>Kateqoriya</th>
                                    <th>Alt kateqoriya</th>
                                    <th>Düzəliş et</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($all_sub_category as $sub_category)
                                    <tr>
                                        <td>{{ $sub_category->category }}</td>
                                        <td>{{ $sub_category->name }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button
                                                    class="btn btn-sm btn-filter dropdown-toggle dropdown-toggle-nocaret"
                                                    type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="bi bi-three-dots"></i>
                                                </button>
                                                <ul class=" dropdown-menu" style="">
                                                    <li><a class="btn btn-sm btn-filter dropdown-item text-danger"
                                                            wire:click="delete({{ $sub_category->id }})">Sil</a>
                                                    </li>
                                                    <li><a class="btn btn-sm btn-filter dropdown-item"
                                                            wire:click="edit({{ $sub_category->id }})">Dəyişdir</a></li>
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
            <div class="modal fade" id="EditSubCategoryModal">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        @if ($edit_item)
                            <div class="modal-header border-bottom-0 py-2 bg-grd-info">
                                <h5 class="modal-title">Markaya düzəliş et: {{ $edit_item->name }}</h5>
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
                                            <input wire:model='edit_title' type="text" class="form-control" id="input1"
                                                value='{{ $edit_item->name }}' placeholder="{{ $edit_item->name }}">
                                        </div>

                                        {{-- <div class="mb-4">
                                            <h5 class="mb-3">Şəkil yüklə</h5>
                                            <input wire:model="temp_edit_image" type="file"
                                                name="files" accept=".jpg, .png, image/jpeg, image/png"
                                                class="ff_fileupload_hidden">


                                            @if ($edit_image)
                                                <div class="mt-2">
                                                    <img src="{{ asset('storage/' . $edit_image->image) }}"
                                                        alt="Preview" style="max-width: 100px;" />
                                                </div>
                                            @endif
                                        </div> --}}

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
