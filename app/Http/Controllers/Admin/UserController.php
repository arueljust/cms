<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {

        $data = User::all();
        return view('admin.user.index', compact('data'));
    }


    public function edit($id)
    {
        $data = User::where('id', $id)->first();
        if ($data['status'] === 0) {
            return view('admin.user.edit', compact('data'));
        }else{
            return redirect('admin/user')->with('message','Tidak bisa edit user yang online');
        }

    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => "required|email|unique:users,email,$id",
            'role' => 'required',
        ]);
        User::where('id', $id)->update($validatedData);

        return redirect('admin/user')->with('message', 'Data User berhasil diupdate!');
    }

    public function destroy($id)
    {
        $data = User::findOrFail($id);
        if ($data['status'] === 0) {

            $data->delete($id);
            return redirect('admin/user')->with('message', 'Data Berhasil Dihapus');

        } else {
            return redirect('admin/user')->with('message', 'tidak bisa hapus user yang login');


        }
    }
}
