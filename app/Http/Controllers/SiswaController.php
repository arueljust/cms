<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\Html\Button;

class SiswaController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Kelas::all();
        if ($request->ajax()) {
            $query = Siswa::with('kelas')->orderBy('id', 'desc'); // function "with('kelas')" ini jika ada table yang berelasi 'kelas' ini adalah nama function di model

            return DataTables::of($query)
                ->addIndexColumn()
                ->editColumn('kelas.kelas', function ($data) {
                    return $data->kelas->kelas;
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
                    $cek = "<input type='checkbox' class='ceks' id='" . $query->id . "'>";
                    return $cek;
                })
                ->rawColumns(['options', 'cek'])
                ->make(true);
        }

        return view('admin.siswa.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     $data = Kelas::all();
    //     return view('admin.siswa.create', compact('data'));
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = Siswa::create($request->validate([
            'nama' => 'required|string|max:255|unique:siswas,nama',
            'alamat' => 'required|string|max:255',
            'ttl' => 'required|string',
            'no_telp' => 'required|string|min:10|max:13|unique:siswas,no_telp',
            'nama_ortu' => 'required|string',
            'kelas_id' => 'required',
            'jenis_kelamin' => 'required|string',
            'foto' => 'max:2048',
        ]));

        if ($request->hasFile('foto')) {
            $request->file('foto')->move('fotosiswa/', $request->file('foto')->getClientOriginalName());
            $data->foto = $request->file('foto')->getClientOriginalName();
            $data->save();
        }

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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Siswa::where('id', $id)->first();
        return view('admin.siswa.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $request->id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $id = $request->id;
        $data = Siswa::find($id);
        return response()->json(['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $id = $request->id;
        $datas = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'ttl' => 'required|string',
            'no_telp' => 'required|string|min:10|max:13',
            'nama_ortu' => 'required|string',
            'kelas_id' => 'required',
            'jenis_kelamin' => 'required|string',
            // 'foto' => 'mimes:jpg,png,jpeg|image|max:2048',
        ]);
        if ($request->hasFile('foto')) {
            $request->file('foto')->move(
                'fotosiswa/',
                $request->file('foto')->getClientOriginalName()
            );
            $data['foto'] = $request->file('foto')->getClientOriginalName();
        }
        $data = Siswa::find($id);
        $save = $data->update($datas);

        if ($save) {
            return response()->json(['text' => 'Update berhasil'], 200);
        } else {
            return response()->json(['text' => 'Update gagal'], 422);
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $request->id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if ($request->multi != null) {

            $data = $request->data;

            foreach ($data as $key) {
                $datas = Siswa::find($key);
                $datas->delete();
            }
            return response()->json(['text' => 'berhasil hapus data'], 200);
        } else {

            $id = $request->id;
            $data = Siswa::find($id);
            $data->delete();
            return response()->json(['text' => 'berhasil hapus data'], 200);
        }
    }
}
