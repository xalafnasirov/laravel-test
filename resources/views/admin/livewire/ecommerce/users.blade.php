<main class="main-wrapper">
    <div class="main-content">


        @if ($all_user_count == 0)
            <h6 class="mb-0 text-uppercase">İstifadəçi yoxdur</h6>
        @else
            <h6 class="mb-0 text-uppercase">İSTİFADƏÇİLƏR: {{ $all_user_count }}</h6>
            <hr>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">

                        <div id="example_wrapper" class="dataTables_wrapper dt-bootstrap5">
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="dataTables_length" id="example_length"><label>Show 
                                        <select wire:model.live="page_limit" wire:change='on_page_limit_change'
                                                name="example_length" aria-controls="example"
                                                class="form-select form-select-sm">
                                                <option value="10">10</option>
                                                <option value="25">25</option>
                                                <option value="50">50</option>
                                                <option value="100">100</option>
                                            </select> &nbsp; </label></div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div id="example_filter" class="dataTables_filter"><label>Axtar:<input
                                                type="search" class="form-control form-control-sm" placeholder=""
                                                aria-controls="example"></label></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="example" class="table table-striped table-bordered dataTable"
                                        style="width: 100%;" role="grid" aria-describedby="example_info">
                                        <thead>
                                            <tr role="row">
                                                <th class="sorting" tabindex="0" aria-controls="example"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Name: activate to sort column ascending"
                                                    style="width: 50px;">ID</th>
                                                <th class="sorting" tabindex="0" aria-controls="example"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Position: activate to sort column ascending"
                                                    style="width: 100px;">Adı</th>
                                                <th class="sorting" tabindex="0" aria-controls="example"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Office: activate to sort column ascending"
                                                    style="width: 86.375px;">Nömrə</th>
                                                <th class="sorting_desc" tabindex="0" aria-controls="example"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Age: activate to sort column ascending"
                                                    aria-sort="descending" style="width: 35.375px;">Email</th>
                                                <th class="sorting" tabindex="0" aria-controls="example"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Start date: activate to sort column ascending"
                                                    style="width: 10px;">Təsdiqlənməsi</th>
                                                <th class="sorting" tabindex="0" aria-controls="example"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Salary: activate to sort column ascending"
                                                    style="width: 20px;">Yaradılıb</th>
                                                <th class="sorting" tabindex="0" aria-controls="example"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Salary: activate to sort column ascending"
                                                    style="width: 64.375px;">Sifarişləri</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($all_user as $user)
                                                <tr role="row">
                                                    <td class="">{{$user->id}}</td>
                                                    <td class="">{{$user->firstname}} {{$user->lastname}}</td>
                                                    <td>{{$user->phone}}</td>
                                                    <td class="sorting_1">{{$user->email}}</td>
                                                    <td>{{($user->email_verified_at == null) ? 'Xeyr':$user->email_verified_at}}</td>
                                                    <td>{{$user->created_at}}</td>
                                                    <td>
                                                        {!! ($user->order_count != 0) ? '<a href="">'.$user->order_count . ' sifariş </a>' : 'Yoxdur' !!}
                                                     </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-5">
                                    <div class="dataTables_info" id="example_info" role="status" aria-live="polite">
                                        {{$current_page}}/{{$page_count}}</div>
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
                                                
                                            <li wire:click='set_page({{$i}})' class="paginate_button page-item {{($current_page == $i) ? 'active' : ''}}"><a href="#"
                                                   value='{{$i}}' aria-controls="example" data-dt-idx="{{$i}}" tabindex="0"
                                                    class="page-link">{{$i}}</a></li>
                                            @endfor
                                            <li wire:click='next_page' class="paginate_button page-item next" id="example_next"><a
                                                    href="#" aria-controls="example" data-dt-idx="7"
                                                    tabindex="0" class="page-link">Next</a></li>
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
