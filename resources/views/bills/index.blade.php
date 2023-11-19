@extends('layouts.app')

@section('content')


<a href="/bills/create" class="btn btn-primary float-right">Create Bill</a>
<h3>Bills</h3>
<hr class="text-white">

@if(count($bills) > 0)
	<div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
		@foreach($bills as $bill)
			<div class="col mb-3">
				<div class="card h-100">
					<div class="card-body">
						<h5 class="card-title">
							Table: {{ $bill->table->name ?? 'DELETED' }}
							<span class="badge bg-{{ $bill->is_paid == 0 ? 'danger' : 'success' }} text-white float-end">
								{{ $bill->is_paid == 0 ? 'Not Paid' : 'Paid' }}
							</span>
						</h5>
						<h6 class="card-subtitle mb-2 text-muted">Total: ₹{{ $bill->total }}</h6>
						<p class="card-text">
							<a href="/bills/{{ $bill->id }}" class="btn btn-info">View Bill</a>
						</p>
					</div>
					<div class="card-footer">
						<a href="/bills/{{ $bill->id }}/edit" class="btn btn-warning">Edit</a>
						{!! Form::open(['action' => ['App\Http\Controllers\BillsController@destroy', $bill->id], 'method' => 'POST', 'class' => 'float-right']) !!}
							{{ Form::hidden('_method', 'DELETE') }}
							{{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		@endforeach
	</div>
@else
    <h3>No Bills</h3>
@endif

@endsection
