@extends('layouts.app')

@section('content')



    @isset($order)

        <div class="container mt-5 mb-5">
            <div class="row d-flex justify-content-center">
                <div class="col-md-8">
                    <div class="card mt-5">

                        <div class="invoice p-5">
                            <h5>Sifarişiniz təsqiqləndi!</h5> <span class="font-weight-bold d-block mt-4">{{ $order->firstname }}
                                {{ $order->lastname }},</span>
                            <span>Növbəti günlərdə sifarişiniz haqqında məlumat əldə edəcəksiniz!</span>
                            <div class="payment border-top mt-3 mb-3 border-bottom table-responsive">
                                <table class="table table-borderless">
                                    <tbody>
                                        
                                        <tr>
                                            <td>
                                                <div class="py-2"> <span class="d-block text-muted">Tarix</span>
                                                    <span>{{ $order->created_at }}</span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="py-2"> <span class="d-block text-muted">Sifariş nömrəsi</span>
                                                    <span><b>{{ $order->order_key }}</b></span>
                                                    <button>Copy</button>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="py-2"> <span class="d-block text-muted">Ödəniş</span>
                                                    <span>{{ $order->payment_type }}</span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="py-2"> <span class="d-block text-muted">Ünvan</span>
                                                    <span>{{ $order->region }}</span>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="product border-bottom table-responsive">
                                <table class="table table-borderless">
                                    <tbody>
                                        @foreach ($order_detail as $single)
                                            <tr>
                                               
                                                <td width="60%"> <span class="font-weight-bold">{{$single->brand}}</span>
                                                    <div class="product-qty"> <span class="d-block">{{$single->part_name}}</span>
                                                        <span>{{$single->category}}</span>
                                                    </div>
                                                </td>
                                                <td width="20%">
                                                    <div class="text-right"> <span class="font-weight-bold">{{$single->price * $single->quantity}} AZN</span> </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="row d-flex justify-content-end">
                                <div class="col-md-5">
                                    <table class="table table-borderless">
                                        <tbody class="totals">
                                            <tr>
                                                <td>
                                                    <div class="text-left"> <span class="text-muted">Məhsullar</span> </div>
                                                </td>
                                                <td>
                                                    <div class="text-right"> <span>{{$order->subtotal}} AZN</span> </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="text-left"> <span class="text-muted">Daşınma</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="text-right"> <span>{{$order->shipping_fee}} AZN</span> </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="text-left"> <span class="text-muted">Endirim</span> </div>
                                                </td>
                                                <td>
                                                    <div class="text-right"> <span class="text-success">{{$order->discount}} %</span>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr class="border-top border-bottom">
                                                <td>
                                                    <div class="text-left"> <span class="font-weight-bold">Ümumi</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="text-right"> <span class="font-weight-bold">{{$order->user_paid_price}} AZN</span>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <p>Sifarişinizin hər mərhələsi ilə bağlı sizə email və telefon üzərindən məlumat göndərəcəyik!</p>

                            <p class="font-weight-bold mb-0">Bizdən alış-veriş etdiyiniz üçün təşəkkür edirik!</p>
                            <div class="mt-2">
                                <span class=" mt-2"><img width="150" height="auto"
                                        src="{{ asset('storage/images/logo/hyunglobal_logo.png') }}" alt="Dealaro"></span>
                            </div>

                        </div>
                        <div class="d-flex justify-content-between footer p-3"> <span>Köməyə ehtiyacın var? Bizimlə <a
                                    href="{{ route('services.contact') }}">
                                    əlaqə saxla</a></span> </div>
                    </div>
                </div>
            </div>
        </div> ̰


        

        
    @else
        <div class="mt-5">
            <h5>Sifarişiniz tapılmadı</h5>
        </div>

        
    @endisset

@endsection


