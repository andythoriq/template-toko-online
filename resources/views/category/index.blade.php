@extends('layouts.app')

@section('content')
<div class="card mb-3" style="background: #F1F6F9">
    <div class="card-body">
        <a href="{{route('category.create')}}" class="btn btn-success"><i class="bi bi-plus-square"></i> Add new Category</a>
        <a class=" btn btn-warning "
            href="{{ route('product.index') }}"><i class="bi bi-box"></i> Manage Product</a>
    </div>
</div>
    @if ($categories->count() <= 0)
        <strong class="text-danger"><em>tidak ada category</em></strong>
    @else
   
    <div class="table-responsive">
        <table class="table table-success">
            <thead>
                <tr>
                    <th scope="col">Category</th>
                    <th scope="col">created at</th>
                    <th scope="col">updated at</th>
                    <th colspan="2">edit / delete</th>
                </tr>
            </thead>
            <tbody class="table-light">
                @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->created_at->diffForHumans() }}</td>
                    <td>{{ $category->updated_at->diffForhumans() }}</td>
                    <td>
                        <a href="{{route('category.edit', $category->id)}}" class="btn btn-outline-warning"><i class="bi bi-pencil-fill"></i> Edit</a>
                    </td>
                    <td>
                        <form action="{{route('category.destroy', $category->id)}}" method="POST">
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
