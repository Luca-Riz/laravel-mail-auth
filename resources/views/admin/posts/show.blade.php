@extends('layouts.app')

@section('content')
    <div class="container">
      <h2>Dettagli del prodotto</h2>

      {{-- parte tags --}}
      <div class="my-2">
        <span class="badge badge-secondary">Category:</span>
        @if (isset($post->category->name))
          <span class="badge badge-warning"> {{$post->category->name}} </span>
        @else
          <span>{{'Non si sono tag per questo post'}}</span>
        @endif
      </div>
      {{-- fine parte tags --}}

      <div class="card">
        <div class="card-header">
          {{$post->title}}
        </div>
        <div class="card-body">
          <h5 class="card-title">{{$post->slug}}</h5>
          <p class="card-text">{{$post->content}}</p>
        </div>
      </div>

      {{-- parte tags --}}
      <div class="mt-2">
        <span class="badge badge-secondary">Tags:</span>
        @forelse ($post->tags as $tag)
        <span class="badge badge-warning"> {{$tag->name}} </span>
        @empty
        <span>{{'Non si sono tag per questo post'}}</span>
        @endforelse
      </div>
      {{-- fine parte tags --}}

      <div class="mt-2">
        <a href="{{route('admin.posts.index')}}" class="btn btn-primary">Torna indietro</a>
      </div>

    </div>
@endsection