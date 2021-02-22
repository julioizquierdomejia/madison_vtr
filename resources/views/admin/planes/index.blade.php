@extends('admin.layouts.app', ['title' => 'Planes'])
@section('content')

<h1>Planes</h1>
<div class="row row-cols-1 row-cols-md-4">

  @foreach($planes as $plan)
    <div class="col mb-4">
    <div class="card border-secondary mb-3" style="max-width: 18rem;">
      
      <div class="card-body text-secondary">
        <h5 class="card-title">{{$plan->name}}</h5>
        <div class="card-text">{!! $plan->description !!}</div>
      </div>
    </div>
  </div>
  @endforeach


@endsection
