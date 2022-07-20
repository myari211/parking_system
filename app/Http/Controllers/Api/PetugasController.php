<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use Validator;
use Ramsey\Uuid\Uuid;
use Carbon\Carbon;
use App\parkSystem;

class PetugasController extends Controller
{
    public function details() {
        $user = Auth::user();
        return response()->json([
            "user" => $user,
        ]);
    }

    public function gateIn(Request $request) {
        $validator = Validator::make($request->all(), [
            "no_pol" => "required",
        ]);

        if($validator->fails()) {
            return response()->json([
                "Message" => $validator->messages(),
            ]);
        }

        $gateIn = ParkSystem::create([
            "vehicle_number" => $request->no_pol,
            "gate_in" => Carbon::now(),
            "unique_key" => Uuid::uuid4()->getHex(),
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now(),
            "petugas_id" => Auth::user()->id,
        ]);

        $success = $gateIn->unique_key;


        return response()->json([
            "Message" => "TAP IN COMPLETE",
            "Data" => $success,
            "success" => true,
        ]);
    }

    public function gateOut(Request $request) {
        $validator = Validator::make($request->all(), [
            "unique_key" => "required",
        ]);

        if($validator->fails()) {
            return response()->json([
                "Message" => $validator->messages(),
            ]);
        }

        $gate_result = DB::table('park_systems')
        ->where('unique_key', '=', $request->unique_key)
        ->first();

        $start = Carbon::parse($gate_result->gate_in);
        $diff = $start->diff(Carbon::now())->format('%H') * 3000;

        if($diff == 0) {
            $result = $diff + 3000;
        }
        else {
            $result = $diff;
        }

        $gateOut = DB::table('park_systems')
            ->where('unique_key', '=',$request->unique_key)
            ->update([
                "gate_out" => Carbon::now(),
                "updated_at" => Carbon::now(),
                "price" => $result,
            ]);

        $array = array(
            "TAP IN" => $gate_result->gate_in,
            "TAP OUT" => $gate_result->gate_out,
            "VEHICLE" => $gate_result->vehicle_number,
            "PRICE" => $gate_result->price,
        );

        return response()->json([
            "Message" => "TAP OUT SUCCESS",
            "success" => True,
            "data" => $array,
        ]);
    }

    public function generate(Request $request) {
        $validator = Validator::make($request->all(), [
            "no_pol" => "required",
            "tap_in" => "required",
        ]);

        if($validator->fails()) {
            return response()->json([
                "message" => $validator->messages(),
            ]);
        }

        $start = Carbon::parse($request->tap_in);
        $price = $start->diff(Carbon::now())->format('%H') * 3000;

        if($price == 0) {
            $result = $price + 3000;
        }
        else
        {
            $result = $price;
        }

        $generate = ParkSystem::create([
            "vehicle_number" => $request->no_pol,
            "gate_in" => $request->tap_in,
            "unique_key" => Uuid::uuid4()->getHex(),
            "gate_out" => Carbon::now(),
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now(),
            "petugas_id" => Auth::user()->id,
            "price" => $result,
        ]);

        $data = array(
            "TAP IN" => $generate->gate_in,
            "TAP OUT" => $generate->gate_out,
            "VEHICLE" => $generate->vehicle_number,
            "PRICE" => $generate->price,
        );

        return response()->json([
            "success" => true,
            "Message" => "data complete created",
            "Data" => $data,
        ]);
    }
}
