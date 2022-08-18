<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datadosen = Dosen::all(['id','nipy','nama_dosen'])->toArray();
        return Inertia::render('Dosen',
        ['dosen'=>$datadosen]
    );
    }

    public function dosen(){
        $datadosen = Dosen::all(['id', 'nipy', 'nama_dosen'])->toArray();
        return $datadosen;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Dosen/Add');
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
            'nipy' => 'required|max:12|string|unique:tbl_dosen,nipy',
            'nama_dosen' => 'required|string|max:50',
        ],[
            'nipy.unique'=>'NIPY sudah digunakan'
        ]);
        $dosenmodel = new Dosen;
        $dosenmodel->nipy = $request->nipy;
        $dosenmodel->nama_dosen = $request->nama_dosen;
        $dosenmodel->save();
        return redirect()->route('dosen');
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
        $datadosen = Dosen::where('id', $id)->get();
        return Inertia::render('Dosen/Edit',['dosen'=>$datadosen,'id'=>$id]);
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
        $request->validate([
            'nipy' => 'required|max:12|string|unique:tbl_dosen,nipy',
            'nama_dosen' => 'required|string|max:50',
        ], [
            'nipy.unique' => 'NIPY sudah digunakan'
        ]);
        $dosenmodel = Dosen::find($id);
        $dosenmodel->nipy = $request->nipy;
        $dosenmodel->nama_dosen = $request->nama_dosen;
        $dosenmodel->save();
        return redirect()->route('dosen');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Dosen::destroy($id);
    }
}