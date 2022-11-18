<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=Guru::all();
        return view('admin.guru.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.guru.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = Guru::create($request->validate([
            'nama' => 'required|string|max:255|unique:gurus,nama',
            'alamat' => 'required|string|max:255',
            'ttl' => 'required|string',
            'no_telp' => 'required|string|min:10|max:13|unique:gurus,no_telp',
            'jenis_kelamin' => 'required|string',
            'foto' => 'mimes:jpg,png,jpeg|image|max:2048',
            'sertifikat' => 'mimes:jpg,png,jpeg|image|max:2048',
        ]));
        if ($request->hasFile('foto')) {
            $request->file('foto')->move('fotoguru/', $request->file('foto')->getClientOriginalName());
            $data->foto = $request->file('foto')->getClientOriginalName();
            $data->save();
        }

        if ($request->hasFile('sertifikat')) {
            $request->file('sertifikat')->move('sertifikatguru/', $request->file('sertifikat')->getClientOriginalName());
            $data->sertifikat = $request->file('sertifikat')->getClientOriginalName();
            $data->save();
        }

        return redirect('admin/guru')->with('message', 'Data guru berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Guru::where('id', $id)->first();
        return view('admin.guru.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Guru::findOrFail($id);
        return view('admin.guru.edit', compact('data'));
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
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'ttl' => 'required|string',
            'no_telp' => 'required|string|min:10|max:13',
            'jenis_kelamin' => 'required|string',
            'foto' => 'mimes:jpg,png,jpeg|image|max:2048',
            'sertifikat' => 'mimes:jpg,png,jpeg|image|max:2048',
        ]);
        if ($request->hasFile('foto')) {
            $request->file('foto')->move('fotoguru/', $request->file('foto')->getClientOriginalName());
            $data['foto'] = $request->file('foto')->getClientOriginalName();

        }

        else if ($request->hasFile('sertifikat')) {
            $request->file('sertifikat')->move('sertifikatguru/', $request->file('sertifikat')->getClientOriginalName());
            $data['sertifikat'] = $request->file('sertifikat')->getClientOriginalName();

        }
        Guru::where('id',$id)->update($data);

        return redirect('admin/guru')->with('message', 'Data guru berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data=Guru::where('id',$id)->delete();

        return redirect('/admin/guru')->with('message','Data guru berhasil dihapus');
    }
}
