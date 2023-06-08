@extends('layouts.app')

@section('content')
<h1 class="text-center display-4">Terimakasih telah membeli produk kami <i class="bi bi-bag-check-fill"></i></h1>
<hr>
<div class="card col-12">
    <div class="card-body">
        <h4 class="card-title">Kepada : {{ $user['name'] }}</h4>
        <hr />
        <p class="card-text">{{ $user['telephone_number'] }}</p>
        <p class="card-text">{{ $user['address'] }}</p>
        <p class="card-text">dengan total pembelian : {{ $jumlah_pesan }}</p>
    </div>
</div>
<hr>
<div class="card m-auto col-lg-3 col-md-5 col-11 mb-3">
    <img class="card-img-top" src="{{asset('product-image/'. $product['image'])}}" alt="Title">
    <div class="card-body">
        <h4 class="card-title">{{$product['name']}}</h4>
        <p class="card-text">{{$product['desc']}}</p>
    </div>
</div>
@endsection
