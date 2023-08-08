<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function indexAjax(Request $req)
    {
        $user = User::find($req->id);

        return response()->json([
            'data' => $user,
        ]);
    }

    public function store(Request $req)
    {
        $userData = $req->validate([
            'username' => 'required|unique:users',
            'password' => 'required',
            'name'     => 'required',
            'role'     => 'required',
            'status'   => 'required|boolean',
        ]);

        if($userData) {
            User::create($userData);

            return redirect()->back()->withSuccess('Data Pegawai Baru Berhasil Ditambahkan!');
        } else {
            return redirect()->back()->withError('Data Pegawai Baru Gagal Ditambahkan!');
        }
    }

    public function update(Request $req)
    {
        $userData = $req->validate([
            'name'     => 'required',
            'role'     => 'required',
            'status'   => 'required|boolean',
        ]);

        if($userData) {
            User::where('username', $req->username)->update($userData);
            
            return redirect()->back()->withSuccess('Data Pegawai Berhasil Diupdate!');
        } else {
            return redirect()->back()->withError('Data Pegawai Gagal Diupdate!');
        }
    }

    public function destroy(Request $req)
    {
        User::destroy($req->delete_id);

        return redirect()->back()->withSuccess('Data Pegawai Berhasil Dihapus!');
    }
}
