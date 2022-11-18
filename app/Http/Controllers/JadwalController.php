<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Jadwal;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $dataJadwal = Jadwal::all();


        return view('admin.jadwal.index', compact('dataJadwal'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dataJadwal = Jadwal::all();
        $dataGuru = Guru::all();
        $dataKelas = Kelas::all();


        return view('admin.jadwal.create', compact('dataJadwal', 'dataGuru', 'dataKelas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = ([
            'tanggal' => $request['tanggal'],
            'materi' => $request['materi'],
            'gurus_id' => $request['gurus_id'],
            'kelas_id' => $request['siswas_id'],
            'waktu' => $request['waktu'],
        ]);
        // cara menyimpan data yang lebih dr satu / multiple data (array) dalam satu colom db
        $i = 0;
        foreach ($request['gurus_id'] as $guruId) {
            $data = ([
                'tanggal' => $request['tanggal'],
                'materi' => $request['materi'][$i],
                'gurus_id' => $guruId,
                'kelas_id' => $request['kelas_id'],
                'waktu' => $request['waktu'][$i],
            ]);
            $i++;
            Jadwal::create($data);
        }


        return redirect('admin/jadwal')->with('message', 'Jadwal baru disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        // $dataJadwal=Jadwal::where('id',$id)->first();
        $todayDate = Carbon::now()->format('Y-m-d');
        $dataSiswa = Siswa::when(
            // $request->date != null,
            // function ($q) use ($request) {
            //     return $q->whereDate('created_at', $request->date);
            // }
        )->when($request->kelas_id != null, function ($q) use ($request) {
            return $q->where('kelas_id', $request->kelas_id);
        })->paginate(10);

        return view('admin.jadwal.show', compact('dataSiswa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dataJadwal = Jadwal::findOrFail($id);
        $dataGuru = Guru::all();
        $dataKelas = Kelas::all();

        return view('admin.jadwal.edit', compact('dataJadwal', 'dataGuru', 'dataKelas'));
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

        try {
            $data = ([
                'tanggal' => $request['tanggal'],
                'materi' => $request['materi'],
                'gurus_id' => $request['gurus_id'],
                'kelas_id' => $request['kelas_id'],
                'waktu' => $request['waktu'],
            ]);

            Jadwal::where('id', $id)->update($data);

            return redirect('admin/jadwal')->with('message', 'Jadwal baru disimpan');
        } catch (Throwable $e) {
            report($e);

            return redirect('admin/jadwal')->with('message', 'Jadwal gagal diupdate');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Jadwal::findOrFail($id)->delete();

        return redirect('admin/jadwal')->with('message', 'Data berhasil dihapus');
    }
}
