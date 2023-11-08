@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Student</h1>

    <form method="post" action="{{ route('students.update', $student->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT') <!-- Sử dụng HTTP method PUT cho việc cập nhật -->
        <label for="name">Student Name:</label>
        <input type="text" name="student_name" id="name" class="form-control" value="{{ $student->student_name }}" required>

        <label for="code">Student Code: </label>
        <input type="text" name="student_code" id="name" class="form-control  @error('student_code') is-invalid @enderror" value="{{ old('student_code', $student->student_code) }}" required>
        @error('student_code')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
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
        <input type="date" name="dob" class="form-control" value="{{ $student->dob }}">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Image:</strong>
                <input type="file" name="student_photo" class="form-control" placeholder="image">
                @if(file_exists(public_path('img/' . $student->student_photo)))
                <img src="{{ asset('img/' . $student->student_photo) }}" width="100" height="100" class="rounded-circle mt-3" alt="hình">
                @else
                <img src="{{ asset($student->student_photo) }}" width="100" height="100" class="rounded-circle mt-3" alt="không có hình">
                @endif
            </div>
        </div>
        <label for="courses">Courses:</label>
        @foreach($student->courses as $course)
            <div class="d-flex">
                <select name="courses[]" id="courses" class="form-select d-flex">
                    <option value="{{ $course->id }}">
                        {{ $course->course_name }}
                    </option>
                    <option value="Toán">Toán</option>
                    <option value="Lý">Lý</option>
                    <option value="Hóa">Hóa</option>
                    <option value="Văn">Văn</option>
                    <option value="Sử">Sử</option>
                    <option value="Địa">Địa</option>
                </select>              
                <button class="delete-course-btn" style="background: white; border: none" onclick="deleteCourse(this)">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <br>
        @endforeach
        <div id="courses-container" class="d-flex">
        <!-- Các ô select sẽ được thêm vào đây -->
       </div>
       <br>
        <button type="button" id="add-course" class="btn btn-primary">Add Course</button>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('students.index')}}" class="btn btn-warning">Back</a>
    </form>
</div>
<script>
    function addCourse() {
        var coursesContainer = document.getElementById('courses-container');
        var courseRow = document.createElement('div');
        courseRow.className = 'course-row d-flex';
        
        var select = document.createElement('select');
        select.name = 'courses[]';
        select.className = 'form-select d-flex';
        select.innerHTML = `
            <option value="Toán">Toán</option>
            <option value="Lý">Lý</option>
            <option value="Hóa">Hóa</option>
            <option value="Văn">Văn</option>
            <option value="Sử">Sử</option>
            <option value="Địa">Địa</option>
        `;

        var removeButton = document.createElement('button');
        removeButton.type = 'button';
        removeButton.innerHTML = '<i class="fas fa-times"></i>';
        removeButton.addEventListener('click', function() {
            coursesContainer.removeChild(courseRow);
        });

        courseRow.appendChild(select);
        courseRow.appendChild(removeButton);
        coursesContainer.appendChild(courseRow);
    }

    function deleteCourse(button) {
        var courseRow = button.parentElement;
        var coursesContainer = courseRow.parentElement;
        coursesContainer.removeChild(courseRow);
    }

    document.getElementById('add-course').addEventListener('click', addCourse);
</script>

@endsection
