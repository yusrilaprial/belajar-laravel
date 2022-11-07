<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Extracurricular;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\ExtracurricularCreateRequest;

class ExtracurricularController extends Controller
{
    public function index()
    {
        // $ekskul = Extracurricular::with('students')->get();
        // return view('extracurricular', ['ekskulList' => $ekskul]);

        $ekskul = Extracurricular::get();
        return view('extracurricular', ['ekskulList' => $ekskul]);
    }

    public function show($id)
    {
        $ekskul = Extracurricular::with('students')
            ->FindOrFail($id);
        return view('extracurricular-detail', ['ekskul' => $ekskul]);
    }

    public function create()
    {
        return view('extracurricular-add');
    }

    public function store(ExtracurricularCreateRequest $request)
    {
        $ekskul = Extracurricular::create($request->all());
        if ($ekskul) {
            Session::flash('status','success');
            Session::flash('message', 'add new class success!');
        }
        return redirect('/extracurricular');
    }

    public function edit($id)
    {
        $ekskul = Extracurricular::FindOrFail($id);
        return view('extracurricular-edit', ['ekskul'=>$ekskul]);
    }

    public function update(ExtracurricularCreateRequest $request, $id)
    {
        $ekskul = Extracurricular::FindOrFail($id);
        $ekskul->update($request->all());
        if ($ekskul) {
            Session::flash('status','success');
            Session::flash('message', 'edit data extracurricula success!');
        }
        return redirect('/extracurricular');
    }

    public function delete($id)
    {
        $ekskul = Extracurricular::FindOrFail($id);
        return view('extracurricular-delete', ['ekskul'=>$ekskul]);
    }

    public function destroy($id)
    {
        $deletedExtracurricular = Extracurricular::FindOrFail($id);
        $deletedExtracurricular->delete();
        if ($deletedExtracurricular) {
            Session::flash('status','success');
            Session::flash('message', 'delete data extracurricular success!');
        }
        return redirect('/extracurricular');
    }
}
