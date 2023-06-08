@extends('layouts.app')

@section('content')

    @error('qty')
        <strong class="text-danger text-center"><em>{{ $message }}</em></strong>
    @enderror

    @if ($products->count() <= 0)
        <strong class="text-danger"><em>produk tidak ada</em></strong>
    @else
        @foreach ($products as $product)
            <div class="card col-lg-3 col-md-5 col-8">
                <span class="text-secondary">category : <b>{{$product->category?->name}}</b></span>
                <img class="card-img-top" src="{{ asset('product-image/' . $product->image) }}" alt="gambar-produk" height="200">
                <div class="card-body">
                    <h4 class="card-title">{{ $product->name }}</h4>
                    <p class="card-text"><?= nl2br(htmlspecialchars($product->desc)) ?></p>
                    <div class="row justify-content-between">
                        <span class="col-6 badge bg-info fs-6">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                        <span class="col-5 badge bg-primary fs-6">Stock : {{ $product->stock }}</span>
                    </div>
                    <hr>

                    <form action="{{ route('cart.store', $product->id) }}" method="post"
                        class="row justify-content-center">
                        @csrf
                        <input type="number" name="qty" min="1" class="col-6">
                        <input type="hidden" name="product_stock" value="{{ $product->stock }}">
                        <button type="submit" class="col-6 btn btn-success rounded-0"><i
                                class="bi bi-cart4"></i>Add</button>
                    </form>
                </div>
            </div>
        @endforeach
    @endif

@endsection

@section('searchByCategories')
    <li>
        <form action="{{route('getByCategory')}}" method="post" class="row me-3">
            @csrf
            <select class="col-10" name="id">
                <option value="">search by category</option>
                @foreach ($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
            <button class="col-2 btn btn-info rounded-0" type="submit"><i class="bi bi-check-circle-fill"></i></button>
        </form>
    </li>
@endsection
