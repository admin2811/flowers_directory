@extends('layouts.app')
@section('title','Student')
@section('content')
<div class="container">
<div class="d-flex align-items-center justify-content-between">
    <h1 class="mb-0">List Student</h1>
    <a href="{{ route('students.create') }}" class="btn btn-primary">Add Student</a>
</div>
<hr />
<table class="table table-hover">
    <thead class="table-primary">
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Code</th>
            <th>Gender</th>
            <th>Date</th>
            <th>Photo</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @if($student->count() > 0)
        @foreach($student as $rs)
        <tr>
            <td class="align-middle">{{ $rs->id }}</td>
            <td class="align-middle">{{ $rs->student_name }}</td>
            <td class="align-middle">{{ $rs->student_code }}</td>
            <td class="align-middle">{{ $rs->gender}}</td>
            <td class="align-middle">{{ $rs->dob}}</td>
            <td class="align-middle">
                @if(file_exists(public_path('img/' . $rs->student_photo)))
                <img src="{{ asset('img/' . $rs->student_photo) }}" width="50" height="50" class="rounded-circle" alt="hình">
                @else
                <img src="{{ asset($rs->student_photo) }}" width="50" height="50" class="rounded-circle" alt="không có hình">
                @endif
            </td>
            <td class="align-middle">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <a href="{{ route('students.show',$rs->id) }}" type="button" class="btn btn-secondary"><i class="fa-solid fa-eye"></i></a>
                    <a href="{{ route('students.edit',$rs->id) }}" type=""button" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $rs->id }}"><i class="fa-solid fa-trash"></i></button>
                        <div class="modal fade" id="deleteModal-{{ $rs->id }}" tabindex="- 1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Delete Confirmation</h5> <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body"> Are you sure you want to delete this student? </div>
                                    <div class="modal-footer"> <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <form action="{{ route('students.destroy',$rs->id) }}" method="POST"> 
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
            <td class="text-center" colspan="5">Student not found</td>
        </tr>
        @endif
    </tbody>
</table>
<div class="d-flex">
    {!! $student->links() !!}
</div>
</div>
@endsection
<!--  -->