@extends('layouts.app')

@section('content')
  <div class="container-fluid">
    <div>

      {{-- messaggio se il post é stato modificato --}}
      @if(session('updated'))
      <div class="alert alert-success">
        {{session('updated')}}
      </div>
      @endif

    </div>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">Codice</th>
          <th scope="col">Titolo</th>
          <th scope="col">Categoria</th>
          <th scope="col">Azioni</th>
        </tr>
      </thead>
      <tbody>

        @foreach ($posts as $post)
          <tr>
            <th scope="row">{{ $post->id }}</th>
            <td>{{ $post->title }}</td>

            <td>
              @if ($post->category_id)
                {{ $post->category->name }}
              @else
                {{'non c\'é niente'}}
              @endif
            </td>

            <td>
              <a href="{{route('admin.posts.show', $post->slug)}}" class="btn btn-primary">Show</a>
              <a href="{{route('admin.posts.edit', $post->id)}}" class="btn btn-secondary">Edit</a>
              
              {{-- delete --}}
              <form action="{{route('admin.posts.destroy', $post->id)}}" method="post" class="d-inline-block delete-post-form">
                @csrf
                @method('DELETE')
                <input type="submit" value="Delete" class="btn btn-danger">
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>

    <h2>Post per categorie</h2>
    @foreach($categories as $category)

        <h3>{{$category->name}}</h3>

        @forelse($category->post as $post)
            <h4><a href="{{route('admin.posts.show', $post->slug)}} ">{{$post->title}}</a></h4>
        @empty
            <p>Non ci sono post per questa categoria</p>
        @endforelse
    @endforeach

  </div>
@endsection