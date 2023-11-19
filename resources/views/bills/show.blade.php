@extends('layouts.app')

@section('content')

<a href="/bills" class="btn btn-accent"> Go back </a>

<br>
<br>
<div class="card text-center" style="max-width: 25rem; margin: 0 auto; background-color: #f4f4f4;">
  <div class="card-header bg-primary text-white">
    <h3>Bill for Table {{ $bill->table->name ?? 'DELETED' }}</h3>
    <p>{{ $bill->is_paid == 1 ? 'Paid' : 'Not Paid' }}</p>
  </div>
  <div class="card-body">
    <h5 class="card-title">{{ $bill->user->restaurant_name }}</h5>

    <table class="table table-striped mb-3 text-white">
      <thead>
        <tr>
          <th scope="col">Product</th>
          <th scope="col">Quantity</th>
          <th scope="col">Price</th>
        </tr>
      </thead>
      <tbody>
        @foreach($bill->products as $product)
        <tr>
          <td>{{$product->name}}</td>
          <td>{{$product->pivot->quantity}}</td>
          <td>₹ {{$product->price * $product->pivot->quantity}}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
    <p class="card-text">Total: ₹ {{ $bill->total }}</p>
  </div>
</div>

<div class="text-center">
  <a href="/bills/{{ $bill->id }}/edit" class="btn btn-info">Edit</a>

  @if($bill->is_paid == 0)
    {!! Form::open(['action' => ['App\Http\Controllers\BillsController@mark_as_paid', $bill->id], 'method' => 'POST', 'style' => 'display: inline-block']) !!}
    {{ Form::submit('Mark as Paid', ['class' => 'btn btn-success']) }}
    {!! Form::close() !!}
  @endif

  {!! Form::open(['action' => ['App\Http\Controllers\BillsController@destroy', $bill->id], 'method' => 'POST', 'style' => 'display: inline-block']) !!}
  {{ Form::hidden('_method', 'DELETE') }}
  {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
  {!! Form::close() !!}
</div>

@endsection
