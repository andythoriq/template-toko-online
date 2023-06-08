@extends('layouts.app')

@section('content')
    @if ($carts->count() <= 0)
        <strong class="text-danger"><em>keranjang kosong</em></strong>
    @else
        <div class="card m-auto col-lg-3 col-md-5 col-11 mb-3">
            @if (isset($product['image']))
                <img class="card-img-top" src="{{ asset('product-image/' . $product['image']) }}" alt="gambar-product">
            @endif
            <div class="card-body">
                <h4 class="card-title">{{ $product['name'] }}</h4>
                <p class="card-text"><?= nl2br(htmlspecialchars($product['desc'])) ?></p>
                <div class="row justify-content-between">
                    <span class="col-6 m-auto badge bg-info fs-6">Rp
                        {{ number_format($product['price'], 0, ',', '.') }}</span>
                        <span class="col-5 badge bg-primary fs-6">Stock : {{ $product['stock'] }}</span>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-info table-striped-columns">
                <thead>
                    <tr>
                        <th scope="col">NO.</th>
                        <th scope="col">QTY</th>
                        <th scope="col">Price</th>
                        <th scope="col">Total (qty x price)</th>
                        <td>delete</td>
                    </tr>
                </thead>
                <tbody class="table-light">
                    @foreach ($carts as $cart)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $cart->qty }}</td>
                            <td>Rp {{ number_format($cart->product->price, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($cart->product->price * $cart->qty, 0, ',', '.') }}</td>
                            <td>
                                <form method="POST" action="{{ route('cart.destroy', $cart->id) }}">
                                    @csrf @method('delete')
                                    <button type="submit" class="btn btn-outline-dark"><i class="bi bi-trash3"></i> remove</button>
                                </form>
                            </td>
                        </tr>
                        <?php
                        if (empty($totalOfQty) || empty($totalAkhir)) {
                            $totalOfQty = 0;
                            $totalAkhir = 0;
                        }
                        $totalOfQty += $cart->qty;
                        $totalAkhir += $cart->product->price * $cart->qty;
                        ?>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td></td>
                        <td>Total kuantitas : {{ $totalOfQty }}</td>
                        <td></td>
                        <td>Total Harga : Rp {{ number_format($totalAkhir, 0, ',', '.') }}</td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <?php
        if ($totalOfQty <= $product['stock']) {
            $isQtyLowerThanStock = 1;
        } else {
            $isQtyLowerThanStock = 0;
        }
        ?>

        <form action="{{ route('pesan', $isQtyLowerThanStock) }}" method="post">
            @csrf
            <div class="card">
                <div class="card-body">
                        <button type="submit" class="btn btn-success @if ($isQtyLowerThanStock== 'false') disabled @endif">Pesan Produk</button>
                        <input type="hidden" name="totalOfQty" value="{{$totalOfQty}}">
                        <input type="hidden" name="product_stock" value="{{$product['stock']}}">
                        <input type="hidden" name="product_id" value="{{$product['id'] }}">
                    <hr>
                    <p class="card-text">Pastikan kuantitas tidak lebih besar dari stok produk. Remove untuk mengurangi qty</p>
                </div>
            </div>
        </form>
    @endif
@endsection
