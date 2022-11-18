<?php

namespace App\Http\Controllers;

use App\Models\Info;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class InfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Info::all();

        return view('admin.info.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Info::all();
        $dataKelas = Kelas::all();
        return view('admin.info.create', compact('data', 'dataKelas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'tanggal' => 'required',
            'judul' => 'required',
            'waktu' => 'required',
            'kelas_id' => 'required',
            'deskripsi' => 'required',
        ]);
        $validateData['status'] = $request->status == true ? '1' : '0';
        $validateData['user_id']= Auth::user()->id;
        Info::create($validateData);

        return redirect('admin/info')->with('message', 'Pengumuman Ditambahkan');
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
        $data = Info::findOrFail($id);
        $dataKelas = Kelas::all();
        return view('admin.info.edit', compact('data', 'dataKelas'));
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
        $validateData = $request->validate([
            'tanggal' => 'required',
            'judul' => 'required',
            'waktu' => 'required',
            'kelas_id' => 'required',
            'deskripsi' => 'required',
        ]);
        $validateData['status'] = $request->status == true ? '1' : '0';
        Info::where('id', $id)->update($validateData);

        return redirect('admin/info')->with('message', 'Pengumuman diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Info::findOrFail($id)->delete();

        return redirect('admin/info')->with('message', 'Pengumuman Dihapus');
    }
}
