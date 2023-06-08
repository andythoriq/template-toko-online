@extends('layouts.app')

@section('content')
    @if ($transactions->count() <= 0)
        <strong class="text-danger"><em>belum ada pemesanan</em></strong>
    @else
    <div class="card col-lg-4 col-md-5 col-11 m-auto mb-3" style="background: #F1F6F9">
      <div class="card-body">
        <h4 class="card-title">{{ $user['name'] }}</h4>
        <p class="card-text">Telephone : <b>{{ $user['telephone_number'] }}</b></p>
        <p class="card-text">Address : <b>{{ $user['address'] }}</b></p>
      </div>
    </div>
        <div class="table-responsive">
            <table class="table table-info">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Image</th>
                        <th scope="col">Price</th>
                        <th scope="col">Qty</th>
                        <th scope="col">Total</th>
                        <th scope="col" class="text-center" colspan="2">Order date</th>
                    </tr>
                </thead>
                <tbody class="table-light">
                    @foreach ($transactions as $transaction)
                    <tr>
                        <td>{{ $transaction->product->name }}</td>
                        <td><img src="{{ asset('product-image/' . $transaction->product->image ) }}" alt="" width="45"></td>
                        <td>Rp <?= nl2br(htmlspecialchars($transaction->product->price)) ?></td>
                        <td>{{ $transaction->qty }}</td>
                        <td>Rp <?= nl2br(htmlspecialchars($transaction->product->price * $transaction->qty)) ?></td>
                        <td>{{ $transaction->updated_at }}</td>
                        <td>{{ $transaction->updated_at->diffForHumans() }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection
