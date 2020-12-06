<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Kos;


class KosController extends Controller
{
    public function index(){
        $kos = Kos::all();

        if(count($kos) > 0){
            return response([
                'message' => 'Retrieve All Success',
                'data' => $kos
            ],200);
        }

        return response([
            'message' => 'Empty',
            'data' => null
        ],404);
    }

    public function show($id){
        $kos = Kos::find($id);

        if(!is_null($kos)){
            return response([
                'message' => 'Retrieve Kos Success',
                'data' => $kos
            ],200);
        }

        return response([
            'message' => 'kos Not Found',
            'data' => null
        ],404);

    }

    public function store(Request $request){
        $storeData = $request->all();
        $validate = Validator::make($storeData,[
            'namakos' => 'required|max:60',
            'alamatkos' => 'required',
            'hargakos' => 'required',
            'nohpkos' => 'required',
            'imageID' => 'required',
            'latitude' => 'required',
            'longitude' => 'required'
        ]);

        if($validate -> fails())
            return response(['message' => $validate ->errors()],400);

        $kos = Kos::create($storeData);
        return response([
            'message' => 'Add kos Success',
            'data' => $kos,
        ],200);
    }

    public function destroy($id){
        $kos = Kos::find($id);

        if(is_null($kos)){
            return response([
                'message' => 'kos Not Found',
                'data' => null
            ],404);
        }

        if($kos -> delete()){
            return response([
                'message' => 'Delete kos Success',
                'data' => $kos,
            ],200);
        }
        return response([
            'message' => 'Delete kos Failed',
            'data' => null,
        ],400);


    }

    public function update(Request $request, $id){
        $kos = Kos::find($id);
        if(is_null($kos)){
            return response([
                'message' => 'Kos Not Found',
                'data' => null
            ],404);
        }
//MAYBE THIS IS ERROR
        $updateData = $request -> all();
        $validate = Validator::make($updateData,[
            'namakos' => 'required|max:60',
            'alamatkos' => 'required',
            'hargakos' => 'required',
            'nohpkos' => 'required',
            'imageID' => 'required',
            'latitude' => 'required',
            'longitude' => 'required'
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()],400);


        $kos->namakos = $updateData['namakos'];
        $kos->alamatkos = $updateData['alamatkos'];
        $kos->hargakos = $updateData['hargakos'];
        $kos->nohpkos = $updateData['nohpkos'];
        $kos->imageID = $updateData['imageID'];
        $kos->latitude = $updateData['latitude'];
        $kos->longitude = $updateData['longitude'];

        if($kos->save()){
            return response([
                'message' => 'Update Kos Success',
                'data' => $kos,
            ],200);
        }

        return response([
            'message' => 'Update Kos Failed',
            'data' => null,
        ],400);

    }
}
