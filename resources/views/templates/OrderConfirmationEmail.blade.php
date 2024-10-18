
    <div>
        <h5>Sifarişiniz təsqiqləndi!</h5> <span>{{ $order->firstname }} {{ $order->lastname }},</span><br>
        <span>Növbəti günlərdə sifarişiniz haqqında məlumat əldə edəcəksiniz!</span>
        <div>
            <table>
                <tbody>
                    <tr>
                        <td>
                            <div> <span>Tarix</span>
                                <span>{{ $order->created_at }}</span>
                            </div>
                        </td>
                        <br>
                        <td>
                            <div> <span>Sifariş nömrəsi</span>
                                <span><b>{{ $order->order_key }}</b></span>
                            </div>
                        </td>
                        <br>

                        <td>
                            <div> <span>Ödəniş</span>
                                <span>{{ $order->payment_type }}</span>
                            </div>
                        </td>
                        <br>

                        <td>
                            <div> <span>Ünvan</span>
                                <span>{{ $order->region }}</span>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div>
            <table>
                <tbody>
                    @foreach ($order_detail as $single)
                        <tr>
                            <td width="60%"> <span>{{$single->brand}}</span>
                                <div> <span>{{$single->part_name}}</span>
                                    <span>{{$single->category}}</span>
                                </div>
                            </td>
                            <td width="20%">
                                <div> <span>{{$single->price * $single->quantity}} AZN</span> </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div>
            <div>
                <table>
                    <tbody>
                        <tr>
                            <td>
                                <div> <span>Məhsullar</span> </div>
                            </td>
                            <td>
                                <div> <span>{{$order->subtotal}} AZN</span> </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div> <span>Daşınma</span>
                                </div>
                            </td>
                            <td>
                                <div> <span>{{$order->shipping_fee}} AZN</span> </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div> <span>Endirim</span> </div>
                            </td>
                            <td>
                                <div> <span>{{$order->discount}} %</span>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div> <span>Ümumi</span>
                                </div>
                            </td>
                            <td>
                                <div> <span>{{$order->user_paid_price}} AZN</span>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <p>Sifarişinizin hər mərhələsi ilə bağlı sizə email və telefon üzərindən məlumat göndərəcəyik!</p>
    
        <p>Bizdən alış-veriş etdiyiniz üçün təşəkkür edirik!</p>
        <div>
            Hyunglobal LTD
        </div>
    
    </div>
