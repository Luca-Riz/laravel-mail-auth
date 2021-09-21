@extends('layouts.app')

@section('content')
  <div class="container">
    {{-- @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
              <li>{{$error}}</li>
          @endforeach
        </ul>
      </div>
        
    @endif --}}

    <div class="container">
      <form action="{{route('admin.posts.update', $post->id)}}" method="post"> {{-- method non é indispensabile --}}
        @csrf
        @method('PATCH')
        <div class="mb-3">
          <label for="titolo" class="form-label">Titolo</label>
          <input type="text" class="form-control
          {{-- punto esclamativo su campo errore --}}
          @error('title')
          is-invalid 
          @enderror"
          id="titolo" name='title' value="{{ old('title', $post->title)}}">
          {{-- errore sotto al campo con errore --}}
          @error('title')
        <div class="alert alert-danger">{{ $message }}</div>
      @enderror
        </div>

      {{-- selezione categoria --}}
      <div class="mb-3">
        <label for="cate" class="form-label">Categoria</label>
        <select name="category_id" id="cate" class="form-control">
          <option value="">--- Selezionare una categoria ---</option>
          @foreach ($categories as $category)
            <option value="{{ $category->id }}"
              @if ( old('category_id',$post->category_id) == $category->id)
                  selected
              @endif 
            >{{ $category->name }}</option>
          @endforeach
        </select>
      </div>
  
        <div class="mb-3">
          <label for="desc" class="form-label">Descrizione</label>
          <textarea class="form-control
          @error ('content')
          is-invalid 
          @enderror"
          name="content" id="desc" cols="30" rows="10">{{old('content', $post->content)}}</textarea>
          @error('content')
            <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </div>

        {{-- inizio selezione tags --}}
        <div class="mb-3">

          @foreach ($tags as $tag)
            <span class="px-2">
              <input type="checkbox" id="{{$tag->id}}" name="tags[]" value="{{$tag->id}}"

                @if( !$errors->any() && $post->tags->contains($tag->id))
                  checked 
                @elseif (in_array($tag->id, old('tags', [])))
                  checked 
                @endif>
              <label  for="{{$tag->id}}"> {{$tag->name}} </label>
            </span>
          @endforeach

        </div>
        {{-- fine selezione tags --}}
        
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>


  </div>
    
@endsection