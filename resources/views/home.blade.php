@extends('layouts.app')

@section('content')
<div class="container">

@if(auth()->user()->admin == 1) 
<p>Tu eres el admin</p>

<div class="card-deck">
@foreach($todasLasTareas as $tarea )
<div class="card">
    <div class="card-body">
      <h5 class="card-title">{{$tarea->user_id}}</h5>
      <p class="card-text">{{$tarea->description}}</p>
    </div>
    <div class="card-footer">
      <small class="text-muted">Creado el {{ $tarea->created_at->format('d/m/Y')}}</small>
    </div>
  </div>
@endforeach
@else
<p>Tu eres el otro usuario</p>
<my-tasks-component></my-tasks-component>

@endif

    
</div>



@endsection
