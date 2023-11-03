@extends('layouts.app')
@section('title','flowers')
@section('content')
<div class="container">
<div class="d-flex align-items-center justify-content-between">
    <h1 class="mb-0">List flowers</h1>
    <a href="{{ route('flowers.create')}}" class="btn btn-primary">Add Flower</a>
</div>
<hr />
<table class="table table-hover">
    <thead class="table-primary">
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Description</th>
            <th>Image</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @if($flowers->count() > 0)
        @foreach($flowers as $rs)
        <tr>
            <td class="align-middle">{{ $rs->id }}</td>
            <td class="align-middle">{{ $rs->name }}</td>
            <td class="align-middle">{{ $rs->description }}</td>
            <td class="align-middle">
                @if(file_exists(public_path('img/' . $rs->image_url)))
                <img src="{{ asset('img/' . $rs->image_url) }}" width="50" height="50" class="rounded-circle" alt="hình">
                @else
                <img src="{{ asset($rs->image_url) }}" width="50" height="50" class="rounded-circle" alt="không có hình">
                @endif
            </td>
            <td class="align-middle">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <a href="{{ route('flowers.show', $rs->id)}}" type="button" class="btn btn-secondary"><i class="fa-solid fa-eye"></i></a>
                    <a href="{{ route('flowers.edit', $rs->id)}}" type="button" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $rs->id }}"><i class="fa-solid fa-trash"></i></button>
                        <div class="modal fade" id="deleteModal-{{ $rs->id }}" tabindex="- 1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Delete Confirmation</h5> <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body"> Are you sure you want to delete this flowers? </div>
                                    <div class="modal-footer"> <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <form action="{{route('flowers.destroy',$rs->id)}}" method="POST"> 
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
            <td class="text-center" colspan="5">flowers not found</td>
        </tr>
        @endif
    </tbody>
</table>
<div class="d-flex">
    {!! $flowers->links() !!}
</div>
</div>
@endsection
<!--  -->