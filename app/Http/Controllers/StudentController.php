<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\ClassRoom;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\StudentCreateRequest;
use App\Http\Requests\StudentUpdateRequest;

use function PHPSTORM_META\map;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $student = Student::with('class')
            ->where('name', 'LIKE', '%' . $search . '%')
            ->orWhere('gender', $search)
            ->orWhere('nis', 'LIKE', '%' . $search . '%')
            ->orWhereHas('class', function ($query) use ($search) {
                $query->where('name', 'LIKE', '%' . $search . '%');
            })
            ->paginate(15);
        return view('student', ['studentList' => $student]);

        // $student = Student::with(['class.homeroomTeacher', 'extracurriculars'])->get();
        // return view('student', ['studentList' => $student]);

        // $nilai = [1,3,2,10,5,7,3,8,9,9,10,3,6,7,3,2,1,8];

        //kita akan mencari tahu hasil dari nilai dikali 2 dari data yang ada diarray $nilai
        // $nilaiklaiDua = [];
        // foreach ($nilai as $value) {
        //     array_push($nilaiklaiDua, $value * 2);
        // }
        // dd($nilaiklaiDua);

        //map
        // $aaa = collect($nilai)->map(function ($value) {
        //     return $value * 2;
        // })->all();
        // dd($aaa);

        //filter
        // $cek = collect($nilai)->filter(function($value){
        //     return $value > 7;
        // })->all();

        // dd($cek);

        //php biasa hitung nilai rata-rata
        // $countNilai = count($nilai);
        // $totalNilai = array_sum($nilai);
        // $averageNilai = $totalNilai / $countNilai;

        //collection hitung ni;ai rata-rata
        // $averageNilai = collect($nilai)->avg();

        // dd($averageNilai);

        //contains = cek apakah arrray memiliki sesuatu
        // $cek = collect($nilai)->contains(function ($value) {
        //     return $value <6;
        // });

        // dd($cek);

        //diff = cek sesuatu yg tidak ada dari array satu ke arrray lain
        // $restaurantA = ["burger", "siomay", "pizza", "spaghetti", "makaroni", "martabak", "bakso"];
        // $restaurantB = ["pizza", "fried chicken", "martabak", "sayur asem", "pecel lele", "bakso"];

        // $menuRestoA = collect($restaurantA)->diff($restaurantB);
        // $menuRestoB = collect($restaurantB)->diff($restaurantA);

        // dd($menuRestoB);

        //pluck
        // $biodata = [
        //     ['nama' => 'budi', 'umur' => 17],
        //     ['nama' => 'ani', 'umur' => 16],
        //     ['nama' => 'siti', 'umur' => 17],
        //     ['nama' => 'rudi', 'umur' => 20]
        // ];
        // $cek = collect($biodata)->pluck('umur')->all();
        // dd($cek);

        //query builder
        // $student = DB::table('students')->get();
        // DB::table('students')->insert([
        //     'name' => 'query builder',
        //     'gender' => 'L',
        //     'nis' => '0202021',
        //     'class_id' => 1
        // ]);
        // DB::table('students')->where('id', 26)->update([
        //     'name' => 'query builder 2',
        //     'class_id' => 3
        // ]);
        // DB::table('students')->where('id', 26)->delete();

        //eloquent
        // $student = Student::all();
        // Student::create([
        //     'name' => 'eloquent',
        //     'gender' => 'P',
        //     'nis' => '0202033',
        //     'class_id' => 2
        // ]);
        // Student::find(27)->update([
        //     'name' => 'eloquent 2',
        //     'class_id' => 1
        // ]);
        // Student::find(27)->delete();

        // dd($student);
    }

    public function show($slug)
    {
        $student = Student::with(['class.homeroomTeacher', 'extracurriculars'])
            ->where('slug', $slug)->first();
        return view('student-detail', ['student' => $student]);
    }

    public function create()
    {
        $class = ClassRoom::select('id', 'name')->get();
        return view('student-add', ['class' => $class]);
    }

    public function store(StudentCreateRequest $request)
    {
        // $validated = $request->validate([
        //     'nis' => 'unique:students|max:8|required',
        //     'name' => 'max:50|required',
        //     'gender' => 'required',
        //     'class_id' => 'required'
        // ]);

        //validasi stop

        // $student = new Student;
        // $student->name = $request->name;
        // $student->gender = $request->gender;
        // $student->nis = $request->nis;
        // $student->class_id = $request->class_id;
        // $student->save();

        $newName = '';

        if ($request->file('photo')) {
            $extension = $request->file('photo')->getClientOriginalExtension();
            $newName = $request->name . '-' . now()->timestamp . '.' . $extension;
            $request->file('photo')->storeAs('photo', $newName);
        }

        $request['image'] = $newName;
        //manual slug
        // $request['slug'] = Str::slug($request->name, '-');
        $student = Student::create($request->all());

        if ($student) {
            Session::flash('status','success');
            Session::flash('message', 'add new student success!');
        }

        return redirect('/students');
    }

    public function edit(Request $request, $slug)
    {
        $student = Student::with('class')->where('slug', $slug)->first();
        $class = ClassRoom::where('id', '!=', $student->class_id)->get(['id', 'name']);
        return view('student-edit', ['student' => $student, 'class' => $class]);
    }

    public function update(StudentUpdateRequest $request, $id)
    {
        if ($request->file('photo')) {
            $extension = $request->file('photo')->getClientOriginalExtension();
            $newName = $request->name . '-' . now()->timestamp . '.' . $extension;
            $request->file('photo')->storeAs('photo', $newName);
            $request['image'] = $newName;
        }

        $student = Student::FindOrFail($id);
        // $student->name = $request->name;
        // $student->gender = $request->gender;
        // $student->nis = $request->nis;
        // $student->class_id = $request->class_id;
        // $student->save();

        //manual slug
        // $request['slug'] = Str::slug($request->name, '-');
        $student->update($request->all());
        if ($student) {
            Session::flash('status', 'success');
            Session::flash('message', 'edit data student success!');
        }
        return redirect('/students');
    }

    public function delete($slug)
    {
        $student = Student::where('slug', $slug)->first();
        return view('student-delete', ['student' => $student]);
    }

    public function destroy($id)
    {
        // $deleteStudent = DB::table('students')->where('id', $id)->delete();
        $deletedStudent = Student::FindOrFail($id);
        $deletedStudent->delete();
        if ($deletedStudent) {
            Session::flash('status', 'success');
            Session::flash('message', 'delete data student success!');
        }
        return redirect('/students');
    }

    public function deletedStudent()
    {
        $deletedStudent = Student::onlyTrashed()->get();
        return view('student-deleted-list', ['deletedStudent' => $deletedStudent]);
    }

    public function restore($id)
    {
        $deletedStudent = Student::withTrashed()->where('id', $id)->restore();
        if ($deletedStudent) {
            Session::flash('status', 'success');
            Session::flash('message', 'restore data student success!');
        }
        return redirect('/students');
    }

    // public function massupdate()
    // {
    //     $student = Student::whereNull('slug')->get();
    //     collect($student)->map(function($item) {
    //         $item->slug = Str::slug($item->name, '-');
    //         $item->save();
    //     });
    // }
}
