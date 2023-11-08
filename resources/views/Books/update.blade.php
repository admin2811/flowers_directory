@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add Books</h1>

    <form method="post" action="{{ route('books.update', $book->BookID) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT') 
        <label for="title">Title:</label>
        <input type="text" name="Title" id="name" required class="form-control" value="{{ $book->Title }}">
        <br>
        <label for=" description">Author:</label>
        <input name="Author" id="description" required class="form-control" value="{{ $book->Author }}"></input>
        <br>

        <label for="title">Genre:</label>
        <input type="text" name="Genre" id="name" required class="form-control" value="{{ $book->Genre }}">
        <br>

        <label for="title">Year:</label>
        <input type="number" max="2023" min="1800" step="1" placeholder="Publication Year" name="PublicationYear" class="form-control" value="{{ $book->PublicationYear }}">
        <br>
        <div class="input-group">
            <div class="input-group-text">ISBN</div>
            <select name="ISBN" class="form-control">
                @for ($i=1;$i<=10;$i++) <option value="{{ $i}}" {{ $i == $book->ISBN ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
            </select>
        </div>
        <br>
        <!-- <label for="image_url">Đường dẫn ảnh:</label>
        <input type="file" name="image_url" id="image_url" required class="form-control">
        <br> -->
        <div class="">Cover image URL</div>
        <input type="file" name="CoverImageURL" id="image_url" required class="form-control">
        @if(file_exists(public_path('img/' . $book->CoverImageURL)))
        <img src="{{ asset('img/' . $book->CoverImageURL) }}" width="100" height="100" class="rounded-circle mt-3" alt="hình">
        @else
        <img src="{{ asset($book->CoverImageURL) }}" width="100" height="100" class="rounded-circle mt-3" alt="không có hình">
        @endif
        <br>
        <br>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('books.index')}}" class="btn btn-warning">Back</a>
    </form>

</div>

@endsection