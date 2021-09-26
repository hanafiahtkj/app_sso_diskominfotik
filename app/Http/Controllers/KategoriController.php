<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use Illuminate\Support\Facades\Validator;
use DB;

class KategoriController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validasi = [
            'urut'       => 'required',
            'nama'       => 'required',
            'keterangan' => 'required',
        ];

        $validator = Validator::make($request->all(), $validasi);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }

        $data = [
            'nama'        => $request->input('nama'),
            'keterangan'  => $request->input('keterangan'),
            'urut'        => $request->input('urut'),
        ];

        if($request->hasFile('foto')) {
            $path = 'logo_kategori/';
            $filename = time().'_'.$request->file('foto')->getClientOriginalName();
            $full_path = $request->file('foto')->storeAs(
                'public/'.$path, $filename
            );

            $data['path'] = $path.$filename;
            $data['file_name'] = $filename;
        }

        if ($id = $request->id) {
            $kategori = Kategori::find($id);
            $kategori->update($data);
        }
        else {
            $kategori = Kategori::create($data);
        }
        
        return response()->json([
            'status' => true,
            'data'   => Kategori::all(),
        ]);
    }

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    public function destroy($id)
    {
        Kategori::find($id)->delete();
        return response()->json([
            'status' => true,
            'data' => Kategori::all(),
        ]);
    }
}
