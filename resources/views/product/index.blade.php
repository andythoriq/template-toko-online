@extends('layouts.app')

@section('content')
<div class="card mb-3" style="background: #F1F6F9">
    <div class="card-body">
        <a href="{{route('product.create')}}" class="btn btn-success"><i class="bi bi-plus-square"></i> Add new Product</a>
        <a class=" btn btn-info "
            href="{{ route('category.index') }}"><i class="bi bi-box"></i> Manage Category</a>
    </div>
</div>
    @if ($products->count() <= 0)
        <strong class="text-danger"><em>tidak ada produk</em></strong>
    @else
   
    <div class="table-responsive">
        <table class="table table-primary">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">image</th>
                    <th scope="col">description</th>
                    <th scope="col">price</th>
                    <th scope="col">stock</th>
                    <th scope="col">category</th>
                    <th scope="col">created at</th>
                    <th scope="col">updated at</th>
                    <th colspan="2">edit / delete</th>
                </tr>
            </thead>
            <tbody class="table-light">
                @foreach ($products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td><img src="{{ asset('product-image/' . $product->image) }}" alt="gambar-produk" width="45"></td>
                    <td>{{ $product->desc }}</td>
                    <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>{{ $product->category->name ?? '' }}</td>
                    <td>{{ $product->created_at->diffForHumans() }}</td>
                    <td>{{ $product->updated_at->diffForhumans() }}</td>
                    <td>
                        <a href="{{route('product.edit', $product->id)}}" class="btn btn-outline-warning"><i class="bi bi-pencil-fill"></i> Edit</a>
                    </td>
                    <td>
                        <form action="{{route('product.destroy', $product->id)}}" method="POST">
                            @csrf @method('delete')
                            <button type="submit" class="btn btn-outline-dark"><i class="bi bi-trash3"></i> delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    

    @endif
@endsection
