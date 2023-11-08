@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add Books</h1>

    <form method="post" action="{{ route('books.store') }}" enctype="multipart/form-data">
        @csrf
        <label for="title">Title:</label>
        <input type="text" name="Title" id="name" required class="form-control">
        <br>
        <label for="description">Author:</label>
        <input name="Author" id="description" required class="form-control"></input>
        <br>

        <label for="title">Genre:</label>
        <input type="text" name="Genre" id="name" required class="form-control">
        <br>

        <label for="title">Year:</label>
        <input type="number" max="2023" min="1800" step="1" placeholder="Publication Year" name="PublicationYear" class="form-control">
        <br>
        <div class="input-group">
            <div class="input-group-text">ISBN</div>
            <select name="ISBN" class="form-control">
                @for ($i=1;$i<=10;$i++) 
                    <option value="{{ $i}}">{{ $i }}</option>
                    @endfor
            </select>
        </div>
        <br> 
        <!-- <label for="image_url">Đường dẫn ảnh:</label>
        <input type="file" name="image_url" id="image_url" required class="form-control">
        <br> -->
        <div class="input-group">
            <div class="input-group-text">Cover image URL</div>
            <input type="file" name="CoverImageURL" id="image_url" required class="form-control">
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Add</button>
        <a href="{{ route('books.index')}}" class="btn btn-warning">Back</a>
    </form>

</div>

@endsection