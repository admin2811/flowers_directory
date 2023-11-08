@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Add Student</h1>
    <form method="post" action="{{ route('students.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="name">Student Name:</label>
        <input type="text" name="student_name" id="name" required class="form-control @error('student_name') is-invalid @enderror" value="{{ old('student_name') }}">
        @error('student_name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <br>
    <div class="form-group">
        <label for="student_code">Student Code:</label>
        <input name="student_code" id="student_code" required class="form-control @error('student_code') is-invalid @enderror" value="{{ old('student_code') }}">
        @error('student_code')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <br>
    <div class="form-group">
        <label for="student_photo">Student Photo:</label>
        <input type="file" name="student_photo" id="student_photo" required class="form-control @error('student_photo') is-invalid @enderror">
        @error('student_photo')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <br>
    <div class="form-group">
        <label class="form-check-label mb-1">Gender:</label>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="gender" value="Male" @if(old('gender') == 'Male') checked @endif> Male
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="gender" value="Female" @if(old('gender') == 'Female') checked @endif> Female
        </div>
        @error('gender')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <br>
    <div class="form-group">
        <label for="student_date">Date of Birth</label>
        <input type="date" name="dob" id="dob" required class="form-control @error('dob') is-invalid @enderror" value="{{ old('dob') }}">
        @error('dob')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    <br>
    <div id="courses-container">
        <label for="courses">Courses:</label>
        <select name="courses[]" class="form-select @error('courses') is-invalid @enderror">
            <option value="">Select</option>
            <option value="Toán">Toán</option>
            <option value="Lý">Lý</option>
            <option value="Hóa">Hóa</option>
            <option value="Văn">Văn</option>
            <option value="Sử">Sử</option>
            <option value="Địa">Địa</option>
        </select>
        @error('courses')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <br>
    <div id="courses-container">
        <!-- Các ô select sẽ được thêm vào đây -->
    </div>
    <br>
    <button type="button" id="add-course" class="btn btn-primary">Add the Course for Student</button>
    <br>

    <br>
    <button type="submit" class="btn btn-primary">Lưu</button>
    <a href="{{ route('students.index')}}" class="btn btn-warning">Back</a>
</form>

</div>
<script>
    document.getElementById('add-course').addEventListener('click', function() {
        var coursesContainer = document.getElementById('courses-container');
        var select = document.createElement('select');
        select.name = 'courses[]';
        select.className = 'form-select';
        select.innerHTML = `
            <option value="Toán">Toán</option>
            <option value="Lý">Lý</option>
            <option value="Hóa">Hóa</option>
            <option value="Văn">Văn</option>
            <option value="Sử">Sử</option>
            <option value="Địa">Địa</option>
        `;
        coursesContainer.appendChild(select);
    });
</script>
@endsection