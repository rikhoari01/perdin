<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function indexAjax(Request $req)
    {
        $city = City::find($req->id);

        return response()->json([
            'data' => $city,
        ]);
    }

    public function store(Request $req)
    {
        $cityData = $req->validate([
            'city'          => 'required',
            'province'      => 'required',
            'island'        => 'required',
            'is_overseas'   => 'required|boolean',
            'latitude'      => 'required',
            'longtitude'    => 'required',
        ]);
        
        if($cityData) {
            City::create($cityData);

            return redirect()->back()->withSuccess('Data Kota Baru Berhasil Ditambahkan!');
        } else {
            return redirect()->back()->withError('Data Kota Baru Gagal Ditambahkan!');
        }
    }

    public function update(Request $req)
    {
        $cityData = $req->validate([
            'city'          => 'required',
            'province'      => 'required',
            'island'        => 'required',
            'is_overseas'   => 'required|boolean',
            'latitude'      => 'required',
            'longtitude'    => 'required',
        ]);

        if($cityData) {
            City::where('id', $req->id)->update($cityData);
            
            return redirect()->back()->withSuccess('Data Kota Berhasil Diupdate!');
        } else {
            return redirect()->back()->withError('Data Kota Gagal Diupdate!');
        }
    }

    public function destroy(Request $req)
    {
        City::destroy($req->delete_id);

        return redirect()->back()->withSuccess('Data Kota Berhasil Dihapus!');
    }
}
