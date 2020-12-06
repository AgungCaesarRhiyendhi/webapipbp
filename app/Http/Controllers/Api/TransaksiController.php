<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Transaksi;

class TransaksiController extends Controller
{
    public function index(){
        $transaksi = Transaksi::all();

        if(count($transaksi) > 0){
            return response([
                'message' => 'Retrieve All Success',
                'data' => $transaksi
            ],200);
        }

        return response([
            'message' => 'Empty',
            'data' => null
        ],404);
    }

    public function show($id){
        $transaksi = Transaksi::find($id);

        if(!is_null($transaksi)){
            return response([
                'message' => 'Retrieve Transaksi Success',
                'data' => $transaksi
            ],200);
        }

        return response([
            'message' => 'Transaksi Not Found',
            'data' => null
        ],404);

    }

    public function store(Request $request){
        $storeData = $request->all();
        $validate = Validator::make($storeData,[
            'namapemesan' => 'required|max:60',
            'nohppemesan' => 'required',
            'metodepembayaran' => 'required',
            'hargakos' => 'required'
        ]);

        if($validate -> fails())
            return response(['message' => $validate ->errors()],400);

        $transaksi = Transaksi::create($storeData);
        return response([
            'message' => 'Add Transaksi Success',
            'data' => $transaksi,
        ],200);
    }

    public function destroy($id){
        $transaksi = Transaksi::find($id);

        if(is_null($transaksi)){
            return response([
                'message' => 'Transaksi Not Found',
                'data' => null
            ],404);
        }

        if($transaksi -> delete()){
            return response([
                'message' => 'Delete transaksi Success',
                'data' => $transaksi,
            ],200);
        }
        return response([
            'message' => 'Delete transaksi Failed',
            'data' => null,
        ],400);


    }

    public function update(Request $request, $id){
        $transaksi = Transaksi::find($id);
        if(is_null($transaksi)){
            return response([
                'message' => 'Transaksi Not Found',
                'data' => null
            ],404);
        }
//MAYBE THIS IS ERROR
        $updateData = $request -> all();
        $validate = Validator::make($updateData,[
            'namapemesan' => 'required|max:60',
            'nohppemesan' => 'required',
            'metodepembayaran' => 'required',
            'hargakos' => 'required'
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()],400);


        $transaksi->namapemesan = $updateData['namapemesan'];
        $transaksi->nohppemesan = $updateData['nohppemesan'];
        $transaksi->metodepembayaran = $updateData['metodepembayaran'];
        $transaksi->hargakos = $updateData['hargakos'];

        if($transaksi->save()){
            return response([
                'message' => 'Update Transaksi Success',
                'data' => $transaksi,
            ],200);
        }

        return response([
            'message' => 'Update Transaksi Failed',
            'data' => null,
        ],400);

    }
}
