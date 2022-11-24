<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Jadwal;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Yajra\DataTables\Facades\DataTables;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $dataKelas = Kelas::all();
        $dataGuru = Guru::all();
        if ($request->ajax()) {
            $query = Jadwal::with('kelas', 'guru')->orderBy('id', 'desc'); // function "with('kelas','guru')" ini jika ada table yang berelasi 'kelas' ini adalah nama function di model

            return DataTables::of($query)
                ->addIndexColumn()
                ->editColumn('kelas.kelas', function ($data) {
                    return $data->kelas->kelas;
                })->editColumn('guru.nama', function ($data) {
                    return $data->guru->nama;
                })
                ->addColumn('options', function ($query) {
                    $button = '<button type="button"  id=' . $query->id . ' class="edit btn btn-outline-primary btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                  </svg></button>';
                    $button .= '   <button type="button" id=' . $query->id . ' class="delete btn btn-outline-danger btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                  </svg></button>';
                    return $button;
                })
                ->addColumn('cek', function ($query) {
                    $cek = "<input type='checkbox' name='checkbox' id='" . $query->id . "'><label></label>";
                    return $cek;
                })->addColumn('absensi', function ($query) {
                    $absensi = '<a href=""></a>';
                    return $absensi;
                })
                ->rawColumns(['options', 'cek', 'absensi'])
                ->make(true);
        }

        return view('admin.jadwal.index', compact('dataKelas', 'dataGuru'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $data = ([
        //     'tanggal' => $request['tanggal'],
        //     'materi' => $request['materi'],
        //     'gurus_id' => $request['gurus_id'],
        //     'kelas_id' => $request['kelas_id'],
        //     'waktu' => $request['waktu'],
        // ]);
        // // cara menyimpan data yang lebih dr satu / multiple data (array) dalam satu colom db
        // $i = 0;
        // foreach ($request['gurus_id'] as $guruId) {
        //     $data = ([
        //         'tanggal' => $request['tanggal'],
        //         'materi' => $request['materi'][$i],
        //         'gurus_id' => $guruId,
        //         'kelas_id' => $request['kelas_id'],
        //         'waktu' => $request['waktu'][$i],
        //     ]);
        //     $i++;
        //     $save = Jadwal::create($data);
        // }
        $data = Jadwal::create($request->validate([
            'tanggal'=>'required',
            'materi'=>'required',
            'gurus_id'=>'required',
            'kelas_id'=>'required',
            'waktu'=>'required',
        ]));
        if ($data) {
            return response()->json([
                'status' => 200,
                'data' => $data,
                'text' => 'data ditambahkan'
            ]);
        } else {
            return response()->json([
                'status' => 400,
                'data' => $data,
                'text' => $data->errors()->all()
            ]);
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $id = $request->id;
        $data = Jadwal::find($id);
        return response()->json([
            'data' => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // try {
        //     $data = ([
        //         'tanggal' => $request['tanggal'],
        //         'materi' => $request['materi'],
        //         'gurus_id' => $request['gurus_id'],
        //         'kelas_id' => $request['kelas_id'],
        //         'waktu' => $request['waktu'],
        //     ]);

        //     Jadwal::where('id', $id)->update($data);

        //     return redirect('admin/jadwal')->with('message', 'Jadwal baru disimpan');
        // } catch (Throwable $e) {
        //     report($e);

        //     return redirect('admin/jadwal')->with('message', 'Jadwal gagal diupdate');
        // }
        $id=$request->id;
        $data = $request->validate([
            'tanggal'=>'required',
            'materi'=>'required',
            'gurus_id'=>'required',
            'kelas_id'=>'required',
            'waktu'=>'required',
        ]);
        $datas=Jadwal::find($id);
        $save=$datas->update($data);
        if ($save) {
            return response()->json([
                'status' => 200,
                'data' => $save,
                'text' => 'data ditambahkan'
            ]);
        } else {
            return response()->json([
                'status' => 400,
                'data' => $save,
                'text' => $save->errors()->all()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if ($request->multi != null) {

            $data = $request->data;

            foreach ($data as $key) {
                $datas = Jadwal::find($key);
                $datas->delete();
            }
            return response()->json(['text' => 'berhasil hapus data'], 200);
        } else {

            $id = $request->id;
            $data = Jadwal::find($id);
            $data->delete();
            return response()->json(['text' => 'berhasil hapus data'], 200);
        }
    }
}
