@extends('layouts.app')

@section('content')
    @if ($orders->count() <= 0)
        <strong class="text-danger"><em>tidak ada yang memesan</em></strong>
    @else
        
    <div class="table-responsive col-11 col-md-10 col-lg-8 m-auto">
        <table class="table table-primary">
            <thead>
                <tr>
                    <th scope="col">Pembeli</th>
                    <th scope="col">Detail</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->user->name }}</td>
                    <td>
                        <a href="{{route('order.show', $order->user->id)}}" class="btn btn-success"><i class="bi bi-three-dots"></i> More Detail</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
@endsection
