<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\ClassRoom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\ClassCreateRequest;
use App\Http\Requests\ClassUpdateRequest;

class ClassController extends Controller
{
    public function index()
    {
        //lazzy load
        // $class = ClassRoom::all();
        //eager load
        // $class = ClassRoom::with('students', 'homeroomTeacher')->get();
        // return view('classroom', ['classList' => $class]);

        $class = ClassRoom::get();
        return view('classroom', ['classList' => $class]);
    }

    public function show($id)
    {
        $class = ClassRoom::with('students', 'homeroomTeacher')
            ->FindOrFail($id);
        return view('class-detail', ['class' => $class]);
    }

    public function create()
    {
        $teacher = Teacher::select('id', 'name')->get();
        return view('class-add', ['teacher'=>$teacher]);
    }

    public function store(ClassCreateRequest $request)
    {
        $class = ClassRoom::create($request->all());
        if ($class) {
            Session::flash('status','success');
            Session::flash('message', 'add new class success!');
        }
        return redirect('/class');
    }

    public function edit(Request $request, $id)
    {
        $class = ClassRoom::with('homeroomTeacher')->FindOrFail($id);
        $teacher = Teacher::where('id', '!=', $class->teacher_id)->get(['id', 'name']);
        return view('class-edit', ['class'=>$class, 'teacher'=>$teacher]);
    }

    public function update(ClassUpdateRequest $request, $id)
    {
        $class = ClassRoom::FindOrFail($id);
        $class->update($request->all());
        if ($class) {
            Session::flash('status','success');
            Session::flash('message', 'edit data class success!');
        }
        return redirect('/class');
    }

    public function delete($id)
    {
        $class = ClassRoom::FindOrFail($id);
        return view('class-delete', ['class'=>$class]);
    }

    public function destroy($id)
    {
        $deletedClass = ClassRoom::FindOrFail($id);
        $deletedClass->delete();
        if ($deletedClass) {
            Session::flash('status','success');
            Session::flash('message', 'delete data class success!');
        }
        return redirect('/class');
    }
}
