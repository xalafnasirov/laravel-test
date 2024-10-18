<div>
    <h2>Yeni sifariş!</h2>
    <h4>Sifariş kodu: <b>{{$order->order_key}}</b></h4>
    <h4>Müştəri telefon: <b>{{$order->phone}}</b></h4>
    <h4>Müştəri email: {{$order->email}}</h4>
    <h4>Ödəniş: {{$order->user_paid_price}} AZN</h4>
    <h4>Ödəniş tipi: {{$order->payment_type}}</h4>
    <h4>Tarix: {{$order->created_at}}</h4>
    <h3><button><a href="http://localhost:8000/admin/order/{{$order->id}}">Sifarişə bax</a></button></h3>
</div>