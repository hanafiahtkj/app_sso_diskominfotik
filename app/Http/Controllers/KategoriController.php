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

        $kategori = Kategori::create([
            'nama'               => $request->input('nama'),
            'keterangan'         => $request->input('keterangan'),
            'urut'               => $request->input('urut'),
        ]);

        return response()->json([
            'status' => true,
            'data'   => $kategori,
        ]);
    }

    // public function update(Request $request, $id)
    // {
    //     $validasi = [
    //         'nama'               => 'required',
    //         'tempat_lahir'       => 'required',
    //         'tgl_lahir'          => 'required',
    //         'alamat'             => 'required',
    //         'id_kecamatan'       => 'required',
    //         'no_hp'              => 'required',
    //         'id_cabang_olahraga' => 'required',
    //         'id_jenis_olahraga'  => 'required',
    //         'tinggi'             => 'required',
    //         'berat'              => 'required',
    //         'spesialis'          => 'required',
    //         'potensial'          => 'required',
    //     ];

    //     $validator = Validator::make($request->all(), $validasi);

    //     if ($validator->fails()) {
    //         return response()->json([
    //             'status' => false,
    //             'errors' => $validator->errors()
    //         ]);
    //     }
        
    //     try{
    //         DB::beginTransaction();

    //         $atlet = Atlet::find($id);
    //         $atlet->update([
    //             'nama'               => $request->input('nama'),
    //             'tempat_lahir'       => $request->input('tempat_lahir'),
    //             'tgl_lahir'          => $request->input('tgl_lahir'),
    //             'alamat'             => $request->input('alamat'),
    //             'id_kecamatan'       => $request->input('id_kecamatan'),
    //             'no_hp'              => $request->input('no_hp'),
    //             'id_cabang_olahraga' => $request->input('id_cabang_olahraga'),
    //             'id_jenis_olahraga'  => $request->input('id_jenis_olahraga'),
    //             'tinggi'             => $request->input('tinggi'),
    //             'berat'              => $request->input('berat'),
    //             'spesialis'          => $request->input('spesialis'),
    //             'potensial'          => $request->input('potensial'),
    //             'jenis'              => $request->input('jenis'),
    //             'id_tim'             => ($request->input('jenis') == 2) ? 
    //                                     $request->input('jenis') : null,
    //         ]);

    //         if ($prestasi = $request->input('prestasi')) 
    //         {
    //             $arr_id = array_filter(array_column($prestasi, 'id'));
    //             AtletPrestasi::whereNotIn('id', $arr_id)
    //                 ->where('id_atlet',$atlet->id)
    //                 ->delete();

    //             foreach ($prestasi as $key => $value) {

    //                 $dataPrestasi = [
    //                     'id_atlet'   => $atlet->id,
    //                     'nama'       => $value['nama'],
    //                     'level'      => $value['level'],
    //                     'tahun'      => $value['tahun'],
    //                     'peringkat'  => $value['peringkat']
    //                 ];

    //                 if($request->hasFile('uploads2_'.$key)) {
    //                     $upload_path = 'public/atlet/'.$atlet->id.'/';
    //                     $filename = time().'_'.$request->file('uploads2_'.$key)->getClientOriginalName();
    //                     $path = $request->file('uploads2_'.$key)->storeAs(
    //                         $upload_path, $filename
    //                     );

    //                     $dataPrestasi['path'] = $path;
    //                     $dataPrestasi['file_name'] = $filename;
    //                 }

    //                 $id_prestasi = $value['id'];
    //                 if ($id_prestasi != '')
    //                 {
    //                     $aPrestasi = AtletPrestasi::find($id_prestasi); 
    //                     $aPrestasi->update($dataPrestasi);
    //                 } 
    //                 else {
    //                     AtletPrestasi::create($dataPrestasi);
    //                 }
    //             }
    //         }

    //         if ($uploads = $request->input('uploads')) 
    //         {
    //             $arr_id = array_filter(array_column($uploads, 'id'));
    //             AtletFiles::whereNotIn('id', $arr_id)
    //                 ->where('id_atlet',$atlet->id)
    //                 ->delete();

    //             foreach ($uploads as $key => $value) {
    //                 if($request->hasFile('uploads_'.$key)) {
    //                     $upload_path = 'public/atlet/'.$atlet->id.'/';
    //                     $filename = time().'_'.$request->file('uploads_'.$key)->getClientOriginalName();
    //                     $path = $request->file('uploads_'.$key)->storeAs(
    //                         $upload_path, $filename
    //                     );
    //                     AtletFiles::create([
    //                         'id_atlet'   => $atlet->id,
    //                         'path'       => $path,
    //                         'file_name'  => $filename,
    //                         'keterangan' => $value['keterangan'],
    //                     ]);
    //                 }
    //             }
    //         }

    //         DB::commit();

    //     }catch(\Exception $e){
    //         DB::rollback();

    //         return response()->json([
    //             'status' => false,
    //             'msg' => $e->getMessage(),
    //         ]);
    //     }

    //     return response()->json([
    //         'status' => true,
    //     ]);
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function destroy($id)
    // {
    //     Atlet::find($id)->delete();
    //     return response()->json([
    //         'status' => true,
    //     ]);
    // }
}
