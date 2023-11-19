@extends('layouts.app')

@section('content')

<a href="{{ route('products.create') }}" class="btn btn-primary float-right">Create product</a>
<h3>Menu</h3>
<hr>

@if(count($products) > 0)
<div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
    @foreach($products as $product)
    <div class="col mb-3">
        <div class="card h-100">
            @if($product->image_path)
            <img src="{{ asset($product->image_path) }}" class="card-img-top" alt="{{ $product->name }}" style="max-width: 100%; max-height: 200px;">
            @endif
            <div class="card-body">
                <h5 class="card-title">{{ $product->name }}</h5>
                <h6 class="card-subtitle mb-2 text-muted">Price: ₹ {{ $product->price }}</h6>
                <!-- Include a summary of the description -->
                <p class="card-text">{{ \Illuminate\Support\Str::limit($product->description, 100) }}</p>
            </div>
            <div class="card-footer">
                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">Edit</a>
                {!! Form::open(['route' => ['products.destroy', $product->id], 'method' => 'DELETE', 'class' => 'float-right']) !!}
                    {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    @endforeach
</div>
@else
    <h3>No products</h3>
@endif

@endsection
