<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Perdin;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PerdinController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function indexAjax(Request $req)
    {
        $perdin = Perdin::find($req->id);
        $city1  = City::find($perdin->city_from);
        $city2  = City::find($perdin->city_to);
        $data = [
            'name'      => User::find($perdin->user_id)->name,
            'city_from' => $city1->city,
            'city_to'   => $city2->city,
            'date_from' => Carbon::parse($perdin->date_from)->format('d F Y'),
            'date_to'   => Carbon::parse($perdin->date_to)->format('d F Y'),
            'info'      => $perdin->information,
            'day'       => $perdin->total_day,
            'dist'      => $perdin->total_distance,
            'fee'       => $perdin->total_fee,
            'province'  => ($city1->province == $city2->province) ? 1 : 0,
            'island'    => ($city1->island == $city2->island) ? 1 : 0,
            'overseas'  => ($city1->is_overseas || $city2->is_overseas) ? 1 : 0,
        ];

        return response()->json([
            'data' => $data,
        ]);
    }

    public function store(Request $req)
    {
        $perdinData = $req->validate([
            'city_from'   => 'required',
            'city_to'     => 'required',
            'date_from'   => 'required|date',
            'date_to'     => 'required|date',
            'information' => 'required|max:255',
            'total_day'   => 'required',
        ]);

        $input = $req->input();
        $result = $this->calculateFee($input);
        $total_dist = $result['distance'];
        $total_fee = $req->total_day * $result['fee'];

        $perdinData['user_id']        = Auth::user()->id;
        $perdinData['date_from']      = Carbon::createFromFormat('Y-m-d', $input['date_from']);
        $perdinData['date_to']        = Carbon::createFromFormat('Y-m-d', $input['date_to']);
        $perdinData['status']         = "pending";
        $perdinData['total_distance'] = $total_dist;
        $perdinData['total_fee']      = $total_fee;

        if($perdinData) {
            Perdin::create($perdinData);

            return redirect()->back()->withSuccess('Data Perdin Baru Berhasil Ditambahkan!');
        } else {
            return redirect()->back()->withError('Data Perdin Baru Gagal Ditambahkan!');
        }
    }

    public function approve(Request $req)
    {
        if(Auth::user()->role == 'sdm' && isset($req->approve_id)) {
            Perdin::where('id', $req->approve_id)->update(["status" => "approved"]);

            return redirect()->back()->withSuccess("Perdin Diapprove!");
        }
    }

    public function reject(Request $req)
    {
        if(Auth::user()->role == 'sdm' && isset($req->reject_id)) {
            Perdin::where('id', $req->reject_id)->update(["status" => "rejected"]);

            return redirect()->back()->withSuccess("Perdin Ditolak!");
        }
    }

    private function calculateFee($input)
    {
        $city = City::select('province', 'island', 'is_overseas', 'latitude', 'longtitude')->whereIn('id', [$input['city_from'], $input['city_to']])->get();
        
        $lat1 = $city[0]->latitude;
        $lat2 = $city[1]->latitude;
        $lon1 = $city[0]->longtitude;
        $lon2 = $city[1]->longtitude;
        
        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $dist = $dist * 60 * 1.1515;
        $dist = round($dist * 1.609344);

        if ($dist <= 60 && $city[0]->is_overseas == 0 && $city[1]->is_overseas == 0) {
            $fee = 0;
            $cur = 'IDR';
        } elseif ($dist > 60 && $city[0]->province == $city[1]->province && $city[0]->is_overseas == 0 && $city[1]->is_overseas == 0) {
            $fee = 200000;
            $cur = 'IDR';
        } elseif ($dist > 60 && $city[0]->province != $city[1]->province && $city[0]->island == $city[1]->island && $city[0]->is_overseas == 0 && $city[1]->is_overseas == 0) {
            $fee = 250000;
            $cur = 'IDR';
        } elseif ($dist > 60 && $city[0]->province != $city[1]->province && $city[0]->island != $city[1]->island && $city[0]->is_overseas == 0 && $city[1]->is_overseas == 0) {
            $fee = 300000;
            $cur = 'IDR';
        } elseif ($city[0]->is_overseas == 1 || $city[1]->is_overseas == 1) {
            $fee = 50;
            $cur = 'USD';
        }

        return [
            'distance' => $dist,
            'fee'      => $fee,
            'cur'      => $cur,
        ];
    }
}
