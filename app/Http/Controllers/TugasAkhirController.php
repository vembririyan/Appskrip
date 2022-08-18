<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\PivotTugasAkhir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class TugasAkhirController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
{
        $selectdosbing1= '(select tbl_mahasiswa.judul_tugas_akhir as judul_tugas_akhir,tbl_mahasiswa.id as id,nim,nama_mahasiswa,nama_dosen as dosen_pembimbing_1 from tbl_mahasiswa  inner join tbl_pivot_tugas_akhir on tbl_pivot_tugas_akhir.mahasiswa_id = tbl_mahasiswa.id inner join tbl_dosen on tbl_dosen.id = tbl_pivot_tugas_akhir.dosbing1_id) as dsb1';
        $selectdosbing2= '(select nim,nama_mahasiswa,nama_dosen as dosen_pembimbing_2 from tbl_mahasiswa  inner join tbl_pivot_tugas_akhir on tbl_pivot_tugas_akhir.mahasiswa_id = tbl_mahasiswa.id join tbl_dosen on tbl_dosen.id = tbl_pivot_tugas_akhir.dosbing2_id) as dsb2';
        $datamahasiswa = DB::select(DB::raw('select dsb1.judul_tugas_akhir,dsb1.id,dsb1.nim,dsb1.nama_mahasiswa,dsb1.dosen_pembimbing_1,dsb2.dosen_pembimbing_2 from '.$selectdosbing1.' join '.$selectdosbing2.' group by dsb1.nim order by dsb1.nim asc' ));


        // dd($datamahasiswa);
        return Inertia::render('TugasAkhir',['tugasakhirmahasiswa'=>$datamahasiswa]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $datamahasiswa = DB::table('tbl_mahasiswa')->select(['id'])->selectRaw(DB::raw("CONCAT(nim,'-',nama_mahasiswa) as label"))->orderByRaw('nim ASC')->get();
        $datadosen = Dosen::select(['id','nama_dosen as label'])->orderBy('nama_dosen')->get()->toArray();
        return Inertia::render('TugasAkhir/Add',['mahasiswa'=>$datamahasiswa,'dosen'=>$datadosen]);
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
            'mahasiswa_id' => 'required|numeric|unique:tbl_pivot_tugas_akhir,mahasiswa_id'],[
                'unique' => 'Mahasiswa sudah terdaftar dalam Tugas Akhir'
            ]
        );
        $pivottugasakhirmodel= new PivotTugasAkhir();
        $pivottugasakhirmodel->mahasiswa_id = $request->mahasiswa_id;
        $pivottugasakhirmodel->dosbing1_id = $request->dosbing1_id;
        $pivottugasakhirmodel->dosbing2_id = $request->dosbing2_id;
        $pivottugasakhirmodel->save();

        $mahasiswa = Mahasiswa::find($request->mahasiswa_id);
        $mahasiswa->judul_tugas_akhir = $request->judul_tugas_akhir;
        $mahasiswa->save();

        return redirect()->route('tugas_akhir');
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
        $datamahasiswa = DB::table('tbl_mahasiswa')->select(['id'])->selectRaw(DB::raw("CONCAT(nim,'-',nama_mahasiswa) as label"))->orderByRaw('nim ASC')->get();
        $datadosen = Dosen::select(['id', 'nama_dosen as label'])->orderBy('nama_dosen')->get()->toArray();
        $mahasiswaedit = PivotTugasAkhir::select(['nim','judul_tugas_akhir','nama_mahasiswa','tbl_mahasiswa.id as mahasiswa_id','dosbing1_id','dosbing2_id'])->where('mahasiswa_id',$id)->join('tbl_mahasiswa','tbl_pivot_tugas_akhir.mahasiswa_id','=','tbl_mahasiswa.id')->get();
        return Inertia::render('TugasAkhir/Edit',['mahasiswaedit'=>$mahasiswaedit,'mahasiswa'=>$datamahasiswa,'dosen'=>$datadosen,'id'=>$id]);
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
        if($id != $request->mahasiswa_id){
            $request->validate(
                [
                    'mahasiswa_id' => 'required|numeric|unique:tbl_pivot_tugas_akhir,mahasiswa_id'
                ],
                [
                    'unique' => 'Mahasiswa sudah terdaftar dalam Tugas Akhir'
                ]
            );
        }
        if($id != $request->mahasiswa_id){
            $pivottugasakhirmodel = new PivotTugasAkhir();
            $pivottugasakhirmodel->mahasiswa_id = $request->mahasiswa_id;
            $pivottugasakhirmodel->dosbing1_id = $request->dosbing1_id;
            $pivottugasakhirmodel->dosbing2_id = $request->dosbing2_id;
            $pivottugasakhirmodel->save();

            PivotTugasAkhir::where('mahasiswa_id',$id)->delete();
        }else{
            $data = [
                'dosbing1_id'=>$request->dosbing1_id,
                'dosbing2_id'=>$request->dosbing2_id,
            ];
            $pivottugasakhirmodel = PivotTugasAkhir::where('mahasiswa_id',$id)->update($data);
        }

        if ($id != $request->mahasiswa_id) {
            //Jika mengganti mahasiswa
            $mahasiswa = Mahasiswa::find($request->mahasiswa_id);
            $mahasiswa->judul_tugas_akhir = $request->judul_tugas_akhir;
            $mahasiswa->save();

            $mahasiswa = Mahasiswa::find($id);
            $mahasiswa->judul_tugas_akhir = '';
            $mahasiswa->save();
        }else{
            //Jika mahasiswa tetap sama
            $mahasiswa = Mahasiswa::find($id);
            $mahasiswa->judul_tugas_akhir = $request->judul_tugas_akhir;
            $mahasiswa->save();
        }
        return redirect()->route('tugas_akhir');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        PivotTugasAkhir::where('mahasiswa_id',$id)->delete();
    }
}