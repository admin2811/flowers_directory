@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-0">Detail flower</h1>
    <hr />
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="student_name" class="form-control" placeholder="flower" value="{{ $student->student_name }}" readonly>
            <label class="form-label">Code</label>
            <input type="text" name="student_code" class="form-control" placeholder="flower" value="{{ $student->student_code }}" readonly>
            <br>
            <label class="form-label">Gender</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" value="Male" name="gender" id="gender_male" {{$student->gender === 'male' ? 'checked' : '' }}>
                <label class="form-check-label" for="gender_male">Male</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" value="Female" name="gender" id="gender_female" {{$student->gender === 'female' ? 'checked' : '' }}>
                <label class="form-check-label" for="gender_female">Female</label>
            </div>

            <br>
            <br>
            <label for="form-table">Date of Birth</label>
            <input type="date" name="dob" class="form-control" placeholder="flower" value="{{ $student->dob }}" readonly>
            <br>
            <div class="col-xs-12 col-sm-12 col-md-12 mb-10">
                <div class="form-group mb-10">
                    <strong>Image:</strong>
                    @if(file_exists(public_path('img/' . $student->student_photo)))
                    <img src="{{ asset('img/' . $student->student_photo) }}" width="100" height="100" class="img img-responsive mt-3" alt="hình">
                    @else
                    <img src="{{ asset($student->student_photo) }}" width="100" height="100" class="img img-responsive mt-3" alt="không có hình">
                    @endif
                </div>
            </div>
            <h2 style="margin-top:10px">List of Course:</h2>
            <table class="table table-hover">
                <thead class="table-primary">
                    <tr>
                        <th>#</th>
                        <th>Course Name</th>
                    </tr>
                </thead>
                <tbody>
                    @if($courses->count() > 0)
                    @foreach($courses as $rs)
                    <tr>
                        <td class="align-middle">{{ $rs->id }}</td>
                        <td class="align-middle">{{ $rs->course_name }}</td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="4" class="text-center">No data</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <a href="{{ route('students.index')}}" class="btn btn-warning">Back</a>
        </div>
    </div>
</div>
@endsection