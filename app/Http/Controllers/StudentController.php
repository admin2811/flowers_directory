<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Student;
use Illuminate\Http\Request;
use Yoeunes\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $student = Student::latest()->paginate(8);
        return view('students.index', compact('student'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('students.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'student_name' => 'required|string',
            'student_code' => 'required|numeric',
            'student_photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'gender' => 'required|in:Male,Female',
            'dob' => 'required|date',
            'courses' => 'required|array|min:1', // Ensure at least one course is selected
            'courses.*' => 'in:Toán,Lý,Hóa,Văn,Sử,Địa', // Validate each course selection
        ]);

        if ($validator->fails()) {
            return redirect()->route('students.create')
                ->withErrors($validator)
                ->withInput();
        }
        $studentCode = $request->input('student_code');

        // Kiểm tra xem giá trị student_code đã tồn tại trong cơ sở dữ liệu chưa
        if (Student::where('student_code', $studentCode)->exists()) {
            // Nếu tồn tại, hiển thị thông báo lỗi và quay trở lại form
            return redirect()->route('students.create')
                ->withErrors(['student_code' => 'Mã sinh viên đã tồn tại.'])
                ->withInput();
        }
        
        if ($request->hasFile('student_photo')) {
            $image = $request->file('student_photo');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/img');
            $image->move($destinationPath, $name);
        }
        $student = Student::create([
            'student_name' => $request->input('student_name'),
            'student_code' => $request->input('student_code'),
            'student_photo' => $name,
            'gender' => $request->input('gender'),
            'dob' => $request->input('dob'),
        ]);
        if ($student) {
            foreach ($request->input('courses') as $course) {
                $newCourse = new Course([
                    'course_name' => $course,
                ]);
                $student->courses()->save($newCourse);
            }
            Toastr::success('Add Success');
            return redirect()->route('students.index');
        } else {
            Toastr::error('Fail to Add');
            return redirect()->route('students.create');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        $student = Student::findOrFail($student->id);
        $courses = $student->courses;
        return view('students.show', compact('student', 'courses'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {   
        return view('students.edit', compact('student'));
    }    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        // Kiểm tra dữ liệu đầu vào từ biểu mẫu
        $request->validate([
            'student_name' => 'required|string',
            'student_code' => 'required|string',
            'gender' => 'required|in:Male,Female',
            'dob' => 'required|date',
            'courses' => 'array', // Đảm bảo rằng 'courses' là một mảng
        ]);
        $studentCode = $request->input('student_code');

        // Kiểm tra xem giá trị student_code đã tồn tại trong cơ sở dữ liệu chưa
        if (Student::where('student_code', $studentCode)->exists()) {
            // Nếu tồn tại, hiển thị thông báo lỗi và quay trở lại form
            return redirect()->route('students.edit',$student->id)
                ->withErrors(['student_code' => 'Mã sinh viên đã tồn tại.'])
                ->withInput();
        }
        // Cập nhật thông tin sinh viên
        $student->update([
            'student_name' => $request->input('student_name'),
            'student_code' => $request->input('student_code'),
            'gender' => $request->input('gender'),
            'dob' => $request->input('dob'),
        ]);
    
        // Cập nhật ảnh nếu được tải lên
        if ($request->hasFile('student_photo')) {
            $imagePath = $request->file('student_photo')->store('img', 'public');
            $student->update(['student_photo' => $imagePath]);
        }
    
        // Xóa tất cả các khóa học đã liên kết trước đó
        if ($request->has('courses')) {
            $courseIds = $request->input('courses');
            // Xóa tất cả các khóa học đã liên kết trước đó
            $student->courses()->delete();
            // Liên kết sinh viên với các khóa học đã chọn
            foreach ($courseIds as $courseId) {
                $course = new Course([
                    'course_name'=>$courseId,~
                    'course_id' => $courseId,
                ]);
                $student->courses()->save($course);
            }
        }
        Toastr::success('Update Successfully');
        // Chuyển hướng đến trang danh sách sinh viên sau khi cập nhật
        return redirect()->route('students.show',$student->id);
    }
    
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        $student->delete();
        Toastr::success('Xóa loài hoa thành công!', 'Success');
        return redirect()->route('students.index');
    }
}
