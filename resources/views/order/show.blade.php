@extends('layouts.app')

@section('content')
    @if ($orders->count() <= 0)
        <strong class="text-danger"><em>tidak ada yang memesan</em></strong>
    @else
        <div class="card mb-3">
            <div class="card-body">
                <h4 class="card-title">{{ $user['name'] }}</h4>
                <p class="card-text">Telephone : <b>{{ $user['telephone_number'] }}</b></p>
                <p class="card-text">Address : <b>{{ $user['address'] }}</b></p>
            </div>
        </div>
    <div class="table-responsive">
        <table class="table table-primary col-11 col-md-6 col-lg-5 m-auto">
            <thead>
                <tr>
                    <th scope="col">nama produk</th>
                    <th scope="col">qty</th>
                    <th scope="col" colspan="2">dipesan pada</th>
                </tr>
            </thead>
            <tbody class="table-light">
                @foreach ($orders as $order)
                <tr>
                   
                    <td>{{ $order->product->name }}</td>
                    <td>
                        {{$order->qty}}
                    </td>
                    <td>{{$order->updated_at}}</td>
                    <td>{{$order->updated_at->diffForHumans()}}</td>
                   
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    

    @endif
@endsection
