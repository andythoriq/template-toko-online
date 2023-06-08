@extends('layouts.app')

@section('content')
    
    <form action="{{route('category.update', $category->id)}}" method="post" class="col-11 col-lg-6 col-md-6 m-auto">
        @csrf @method('put')

        <div class="mb-3">
            <label class="form-label">Category Name</label>
            @error("name") <div class="text-danger">{{ $message }}</div> @enderror
            <input type="text" class="form-control" name="name" value="{{ old('name', $category->name ?? '') }}">
        </div>

        <button type="submit" class="btn btn-success"><i class="bi bi-download"></i> Update</button>
    </form>

@endsection
