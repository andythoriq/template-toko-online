@extends('layouts.app')

@section('content')
    @if ($carts->count() <= 0)
        <strong class="text-danger"><em>keranjang kosong</em></strong>
    @else
        <div class="table-responsive">
            <table class="table table-info">
                <thead>
                    <tr>
                        <th scope="col">Nama Produk</th>
                        <th scope="col">Harga Produk</th>
                        <th scope="col">Gambar Produk</th>
                        <th> - </th>
                    </tr>
                </thead>
                <tbody class="table-light">
                    @foreach ($carts as $cart)
                        <tr>
                            <td>{{ $cart->product->name }}</td>
                            <td>{{ $cart->product->price }}</td>
                            <td><img src="{{ asset('product-image/' . $cart->product->image) }}" alt="gambar-produk"
                                    width="45">
                            </td>
                            <td>
                                <a class="btn btn-success" href="{{ route('cart.show', $cart->product->id) }}"><i
                                        class="bi bi-three-dots"></i>
                                    More</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection
