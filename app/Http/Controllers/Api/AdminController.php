<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function details() {
        $user = Auth::user();
        return response()->json([
            "user" => $user,
        ]);
    }

    public function report(Request $request) {

        if($request->has('start_date') && $request->has('end_date')) {
            $report = DB::table('park_systems')
                ->whereDate('gate_in', '>=', $request->start_date)
                ->whereDate('gate_in', '<=', $request->end_date)
                ->orderBy('created_at', 'ASC')
                ->select('id', 'vehicle_number', 'gate_in', 'gate_out', 'petugas_id', 'unique_key', 'price')
                ->get();
        }
        else
        {
            $report = DB::table('park_systems')
                ->orderBy('created_at', 'ASC')
                ->select('id', 'vehicle_number', 'gate_in', 'gate_out', 'petugas_id', 'unique_key', 'price')
                ->get();
        }


        return response()->json([
            "success" => true,
            "message" => "Collect Data",
            "data" => $report,
        ]);
    }
}
