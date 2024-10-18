<main class="main-wrapper">
    <div class="main-content">


        @if ($all_order_count == 0)
            <h6 class="mb-0 text-uppercase">SİFARİŞ YOXDUR</h6>
        @else
            <h6 class="mb-0 text-uppercase">SİFARİŞLƏR: {{ $all_order_count }}</h6>
            <hr>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">

                        <div id="example_wrapper" class="dataTables_wrapper dt-bootstrap5">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="example" class="table table-striped table-bordered dataTable"
                                        style="width: 100%;" role="grid" aria-describedby="example_info">
                                        <thead>
                                            <tr role="row">
                                                <th><label>Göstər
                                                        <select wire:model.live="page_limit"
                                                            wire:change='on_page_limit_change' name="example_length"
                                                            aria-controls="example" class="form-select form-select-sm">
                                                            <option value="10">10</option>
                                                            <option value="25">25</option>
                                                            <option value="50">50</option>
                                                            <option value="100">100</option>
                                                        </select> &nbsp; </label>
                                                </th>
                                                <th><label>Ödəniş üsulu
                                                        <select wire:model.live="search_payment_type"
                                                            name="example_length" aria-controls="example"
                                                            class="form-select form-select-sm">
                                                            <option value="">Hamısı</option>
                                                            @foreach ($payment_type as $single)
                                                                <option value="{{ $single->id }}">{{ $single->name }}
                                                                </option>
                                                            @endforeach
                                                        </select> &nbsp; </label>
                                                </th>
                                                <th><label>Status
                                                        <select wire:model.live="search_status" name="example_length"
                                                            aria-controls="example" class="form-select form-select-sm">
                                                            <option value="">Hamısı</option>
                                                            @foreach ($status as $single)
                                                                <option value="{{ $single->id }}">{{ $single->name }}
                                                                </option>
                                                            @endforeach
                                                        </select> &nbsp; </label>
                                                </th>
                                                <th><label>Tarix
                                                        <select wire:model.live="page_limit"
                                                            wire:change='on_page_limit_change' name="example_length"
                                                            aria-controls="example" class="form-select form-select-sm">
                                                            <option value="10">10</option>
                                                            <option value="25">25</option>
                                                            <option value="50">50</option>
                                                            <option value="100">100</option>
                                                        </select> &nbsp; </label>
                                                </th>
                                                <th><label>Telefon:<input type="search" wire:model.live='search_phone'
                                                            class="form-control form-control-sm" placeholder=""
                                                            list="customer_phone" aria-controls="example">
                                                        <datalist id="customer_phone">
                                                            @foreach ($all_order as $single)
                                                                <option value="{{ $single->phone }}"></option>
                                                            @endforeach
                                                        </datalist>
                                                    </label>
                                                </th>
                                                <th><label>Sifariş kodu:<input type="search"
                                                            wire:model.live='search_order_key'
                                                            class="form-control form-control-sm" placeholder=""
                                                            aria-controls="example">
                                                    </label>
                                                </th>
                                                <th><label>Müştəri adı:<input type="search" wire:model.live='search_customer'
                                                            class="form-control form-control-sm" placeholder=""
                                                            list="customer_name" aria-controls="example">
                                                        <datalist id="customer_name">
                                                            @foreach ($all_order as $single)
                                                                <option value="{{ $single->firstname }} {{ $single->lastname }}"></option>
                                                            @endforeach
                                                        </datalist>
                                                    </label>
                                                </th>


                                            </tr>
                                        </thead>

                                    </table>
                                </div>


                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="example" class="table table-striped table-bordered dataTable"
                                        style="width: 100%;" role="grid" aria-describedby="example_info">
                                        <thead>
                                            <tr role="row link-light">
                                                <th class="sorting" tabindex="0" aria-controls="example"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Name: activate to sort column ascending"
                                                    style="width: 50px;">Müştəri</th>
                                                <th class="sorting" tabindex="0" aria-controls="example"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Position: activate to sort column ascending"
                                                    style="width: 0px;">Sifariş kodu</th>
                                                <th class="sorting" tabindex="0" aria-controls="example"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Office: activate to sort column ascending"
                                                    style="width: 86.375px;">Telefon</th>
                                                <th class="sorting_desc" tabindex="0" aria-controls="example"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Age: activate to sort column ascending"
                                                    aria-sort="descending" style="width: 35.375px;">Ödəniş üsulu</th>
                                                <th class="sorting" tabindex="0" aria-controls="example"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Start date: activate to sort column ascending"
                                                    style="width: 10px;">Ödəniş</th>

                                                <th class="sorting" tabindex="0" aria-controls="example"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Salary: activate to sort column ascending"
                                                    style="width: 64.375px;">Status</th>
                                                <th class="sorting" tabindex="0" aria-controls="example"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Salary: activate to sort column ascending"
                                                    style="width: 64.375px;">Ətraflı</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($all_order as $single)
                                                <tr role="row link-light">
                                                    <td class="">{{ $single->firstname }} {{ $single->lastname }}
                                                    </td>
                                                    <td class="">{{ $single->order_key }}</td>
                                                    <td>{{ $single->phone }}</td>
                                                    <td class="sorting_1">{{ $single->payment_type }}</td>
                                                    <td>{{ $single->user_paid_price }} AZN</td>
                                                    <td>
                                                        <select wire:model="edit_status"
                                                            wire:change="on_edit_status_change({{ $single->id }})"
                                                            name="example_length" aria-controls="example"
                                                            class="form-select form-select-sm">
                                                            @foreach ($status as $single_status)
                                                                <option value="{{ $single->id }}"
                                                                    {{ $single_status->id == $single->status_id ? 'selected' : '' }}>
                                                                    {{ $single_status->name }}
                                                                </option>
                                                            @endforeach
                                                        </select> &nbsp;
                                                    </td>
                                                    <td><button><a
                                                                href="{{ route('admin.ecommerce.order.show', ['id' => $single->id]) }}">Daha
                                                                çox</a></button></td>


                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-5">
                                    <div class="dataTables_info" id="example_info" role="status"
                                        aria-live="polite">
                                        {{ $current_page }}/{{ $page_count }}</div>
                                </div>
                                <div class="col-sm-12 col-md-7">
                                    <div class="dataTables_paginate paging_simple_numbers" id="example_paginate">
                                        <ul class="pagination">
                                            <li wire:click="prev_page" class="paginate_button page-item previous"
                                                id="example_previous">
                                                <a href="#" aria-controls="example" data-dt-idx="0"
                                                    tabindex="0" class="page-link">Prev</a>
                                            </li>
                                            @for ($i = 1; $i <= $page_count; $i++)
                                                <li wire:click='set_page({{ $i }})'
                                                    class="paginate_button page-item {{ $current_page == $i ? 'active' : '' }}">
                                                    <a href="#" value='{{ $i }}'
                                                        aria-controls="example" data-dt-idx="{{ $i }}"
                                                        tabindex="0" class="page-link">{{ $i }}</a>
                                                </li>
                                            @endfor
                                            <li wire:click='next_page' class="paginate_button page-item next"
                                                id="example_next"><a href="#" aria-controls="example"
                                                    data-dt-idx="7" tabindex="0" class="page-link">Next</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif


    </div>
</main>
