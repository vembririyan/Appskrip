<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datamahasiswa = Mahasiswa::all(['id','nim','nama_mahasiswa'])->toArray();
        return Inertia::render('Mahasiswa',['mahasiswa'=>$datamahasiswa]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dosenpembimbing = Dosen::all(['nama_dosen as label','id'])->toArray();
        return Inertia::render('Mahasiswa/Add', ['dosenpembimbing' => $dosenpembimbing]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nim' => 'required|digits:8|numeric|unique:tbl_mahasiswa,nim',
            'nama_mahasiswa' => 'required|string|max:50',
        ]);
        
        $mahasiswamodel = new Mahasiswa();
        $mahasiswamodel->nim = $request->nim;
        $mahasiswamodel->nama_mahasiswa = $request->nama_mahasiswa;
        $mahasiswamodel->judul_tugas_akhir = '';
        $mahasiswamodel->save();

        return redirect()->route('mahasiswa');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $datamahasiswa = Mahasiswa::where('id',$id)->get();
        return Inertia::render('Mahasiswa/Edit',['mahasiswa'=>$datamahasiswa,'id'=>$id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validationnim='';
        if($request->old_nim!=$request->nim){
            $validationnim = '|unique:tbl_mahasiswa,nim';
        }
        $request->validate([
            'nim' => 'required|digits:8|string'.$validationnim,
            'nama_mahasiswa' => 'required|string|max:50',
        ]);
        $mahasiswamodel = Mahasiswa::find($id);
        if ($request->old_nim != $request->nim) {
            $mahasiswamodel->nim = $request->nim;
        }
        $mahasiswamodel->nama_mahasiswa = $request->nama_mahasiswa;
        $mahasiswamodel->save();
        return redirect()->route('mahasiswa');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Mahasiswa::destroy($id);
    }
}