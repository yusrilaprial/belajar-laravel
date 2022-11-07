<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\TeacherCreateRequest;

class TeacherController extends Controller
{
    public function index()
    {
        $teacher = Teacher::all();
        return view('teacher', ['teacherList' => $teacher]);
    }

    public function show($id)
    {
        $teacher = Teacher::with('class.students')
            ->FindOrFail($id);
        return view('teacher-detail', ['teacher' => $teacher]);
    }

    public function create()
    {
        return view('teacher-add');
    }

    public function store(TeacherCreateRequest $request)
    {
        $teacher = Teacher::create($request->all());
        if ($teacher) {
            Session::flash('status','success');
            Session::flash('message', 'add new teacher success!');
        }
        return redirect('/teacher');
    }

    public function edit($id)
    {
        $teacher = Teacher::FindOrFail($id);
        return view('teacher-edit', ['teacher'=>$teacher]);
    }

    public function update(TeacherCreateRequest $request, $id)
    {
        $teacher = Teacher::FindOrFail($id);
        $teacher->update($request->all());
        if ($teacher) {
            Session::flash('status','success');
            Session::flash('message', 'edit data teacher success!');
        }
        return redirect('/teacher');
    }

    public function delete($id)
    {
        $teacher = Teacher::FindOrFail($id);
        return view('teacher-delete', ['teacher'=>$teacher]);
    }

    public function destroy($id)
    {
        $deletedTeacher = Teacher::FindOrFail($id);
        $deletedTeacher->delete();
        if ($deletedTeacher) {
            Session::flash('status','success');
            Session::flash('message', 'delete data teacher success!');
        }
        return redirect('/teacher');
    }
}
