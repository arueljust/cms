<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = User::orderBy('id', 'desc');
            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('options', function ($query) {
                    if ($query->status !== 1) {
                        $button = '<button type="button"  id=' . $query->id . ' class="edit btn btn-outline-primary btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                  </svg></button>';
                        $button .= '   <button type="button" id=' . $query->id . ' class="delete btn btn-outline-danger btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                  </svg></button>';
                        return $button;
                    }
                })
                ->addColumn('cek', function ($query) {
                    if ($query->status !== 1) {
                        $cek = "<input type='checkbox' name='checkbox' id='" . $query->id . "'><label></label>";
                        return $cek;
                    }
                })
                ->editColumn('created_at', function (User $user) {
                    return \Carbon\Carbon::parse($user->created_at)->isoFormat('DD-MM-YYYY');
                })
                ->editColumn('role', function ($data) {
                    if ($data->role == 1) {
                        return "Admin";
                    } else {
                        return "User";
                    }
                })
                ->editColumn('status', function ($data) {
                    if ($data->status == 0) {
                        return "Offline";
                    } else {
                        return "Online";
                    }
                })
                ->rawColumns(['options', 'cek'])
                ->make(true);
        }
        return view('admin.user.index');
    }


    public function edit(Request $request)
    {
        $id = $request->id;
        $data = User::find($id);
        return response()->json([
            'data' => $data
        ]);
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => "required|email|unique:users,email,$id",
            'role' => 'required',
        ]);

        $data = User::find($id);
        $save = $data->update($validatedData);
        if ($save) {
            return response()->json([
                'data' => $data,
                'msg' => 'data diupdate',
            ]);
        } else {
            return response()->json([
                'data' => $data,
                'msg' => $data->errors()->all()
            ]);
        }
    }

    public function destroy(Request $request)
    {
        if ($request->multi != null) {

            $data = $request->data;

            foreach ($data as $key) {
                $datas = User::find($key);
                $datas->delete();
            }
            return response()->json(['text' => 'berhasil hapus data'], 200);
        } else {

            $id = $request->id;
            $data = User::find($id);
            $data->delete();
            return response()->json(['text' => 'berhasil hapus data'], 200);
        }
    }
}
