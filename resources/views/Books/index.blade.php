@extends('layouts.app')
@section('title','Book')
@section('content')
<div class="container">
<div class="d-flex align-items-center justify-content-between">
    <h1 class="mb-0">List Book</h1>
    <a href="{{ route('books.create')}}" class="btn btn-primary">Add Book</a>
</div>
<hr />
<table class="table table-hover">
    <thead class="table-primary">
        <tr>
            <th>#</th>
            <th>Title</th>
            <th>Author</th>
            <th>Genre</th>
            <th>Year</th>
            <th>ISBN</th>
            <th>Image</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @if($book->count() > 0)
        @foreach($book as $rs)
        <tr>
            <td class="align-middle">{{ $rs->BookID }}</td>
            <td class="align-middle">{{ $rs->Title }}</td>
            <td class="align-middle">{{ $rs->Author }}</td>
            <td class="align-middle">{{ $rs->Genre}}</td>
            <td class="align-middle">{{ $rs->PublicationYear }}</td>
            <td class="align-middle">{{ $rs->ISBN}}</td>
            <td class="align-middle">
                @if(file_exists(public_path('img/' . $rs->CoverImageURL)))
                <img src="{{ asset('img/' . $rs->CoverImageURL) }}" width="50" height="50" class="rounded-circle" alt="hình">
                @else
                <img src="{{ asset($rs->CoverImageURL) }}" width="50" height="50" class="rounded-circle" alt="không có hình">
                @endif
            </td>
            <td class="align-middle">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <a href="{{ route('books.show', $rs->BookID)}}" type="button" class="btn btn-secondary"><i class="fa-solid fa-eye"></i></a>
                    <a href="{{ route('books.edit', $rs->BookID)}}" type="button" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $rs->BookID }}"><i class="fa-solid fa-trash"></i></button>
                        <div class="modal fade" id="deleteModal-{{ $rs->BookID }}" tabindex="- 1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Delete Confirmation</h5> <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body"> Are you sure you want to delete this flowers? </div>
                                    <div class="modal-footer"> <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <form action="{{route('books.destroy',$rs->BookID)}}" method="POST"> 
                                            @csrf 
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </td>
        </tr>
        @endforeach
        @else
        <tr>
            <td class="text-center" colspan="5">$book not found</td>
        </tr>
        @endif
    </tbody>
</table>
<div class="d-flex">
    {!! $book->links() !!}
</div>
</div>
@endsection
<!--  -->