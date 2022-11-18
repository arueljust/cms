<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

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
            $query = Siswa::with('kelas')->orderBy('id', 'asc'); // function "with('kelas')" ini jika ada table yang berelasi 'kelas' ini adalah nama function di model

            return DataTables::of($query)
                ->addIndexColumn()
                ->editColumn('kelas.kelas', function ($data) {
                    return $data->kelas->kelas;
                })
                ->addColumn('options', function ($query) {
                    $button = '<button type="button"  id=' . $query->id . ' class="edit btn btn-outline-primary btn-sm">Edit</button>';
                    $button .= '   <button type="button" id=' . $query->id . ' class="delete btn btn-outline-danger btn-sm">Hapus</button>';
                    return $button;
                })
                ->rawColumns(['options'])
                ->make(true);
        }
        return view('admin.siswa.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Kelas::all();
        return view('admin.siswa.create', compact('data'));
    }

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
        }

        return response()->json([
            'status'=>400,
            'data' => $data,
            'text' => $data->errors()->all()
        ]);
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

        if($save){
            return response()->json(['text'=>'Update berhasil'],200);
        }else{
            return response()->json(['text'=>'Update gagal'],422);
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
        $id = $request->id;
        $data = Siswa::find($id);
        $data->delete();
        return response()->json(['text' => 'berhasil hapus data'],200);
    }
}
