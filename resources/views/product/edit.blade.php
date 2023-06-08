@extends('layouts.app')

@section('content')
    
    <form action="{{route('product.update', $product->id)}}" method="post" class="col-11 col-lg-6 col-md-6 m-auto" enctype="multipart/form-data">
        @csrf @method('put')

        <div class="mb-3">
            <label class="form-label">Name</label> @error("name") <div class="text-danger">{{ $message }}</div> @enderror
            <input type="text" class="form-control" name="name" value="{{ old('name', $product->name ?? '') }}">
        </div>
        <div class="mb-3">
            @if ($product->image)
                <img src="{{asset('product-image/'. $product->image)}}" width="200" height="200">
                <hr />
            @endif
            <label class="form-label">Image</label>  @error("image") <div class="text-danger">{{ $message }}</div> @enderror
            <input type="file" class="form-control" name="image" value="{{ old('image', $product->image ?? '') }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Description</label> @error("desc") <div class="text-danger">{{ $message }}</div> @enderror
            <textarea name="desc" class="form-control" cols="30" rows="10">{{ old('desc', $product->desc ?? '') }}</textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Price</label> @error("price") <div class="text-danger">{{ $message }}</div> @enderror
            <input type="number" class="form-control" name="price" value="{{ old('price', $product->price ?? '') }}">
        </div>
        <div class="mb-3"> @error("stock") <div class="text-danger">{{ $message }}</div> @enderror
            <label class="form-label">Stock</label>
            <input type="number" class="form-control" name="stock" value="{{ old('stock', $product->stock ?? '') }}">
        </div>

            <div class="mb-3"> 
                <label for="" class="form-label">Category</label> @error("category_id") <div class="text-danger">{{ $message }}</div> @enderror
                <select class="form-select" name="category_id">
                    <option value="">Select one</option>
                    @foreach ($categories as $category)
                    <option @selected(old('category_id', $product->category_id ?? '')) value="{{$category->id}}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

        <button type="submit" class="btn btn-success"><i class="bi bi-download"></i> Save (update)</button>
    </form>

@endsection
