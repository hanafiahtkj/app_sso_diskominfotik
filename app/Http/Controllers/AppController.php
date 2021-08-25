<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aplikasi;
use App\Models\Kategori;
use Illuminate\Support\Facades\Validator;
use DB;

class AppController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        return view('app', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'app' => null,
            'kategori' => Kategori::all(),
        ];
        return view('app-form', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validasi = [
            'nama'               => 'required',
            'id_kategori'        => 'required',
            'keterangan'         => 'required',
            'base_url'           => 'required',
            'base_url_sso'       => 'required',
            'foto'               => 'required',
        ];

        $validator = Validator::make($request->all(), $validasi);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }

        $app = [
            'nama'               => $request->input('nama'),
            'id_kategori'        => $request->input('id_kategori'),
            'keterangan'         => $request->input('keterangan'),
            'base_url'           => $request->input('base_url'),
            'base_url_sso'       => $request->input('base_url_sso'),
        ];

        if($request->hasFile('foto')) {
            $path = 'logo_app/';
            $filename = time().'_'.$request->file('foto')->getClientOriginalName();
            $full_path = $request->file('foto')->storeAs(
                'public/'.$path, $filename
            );
            $app['path'] = $path.$filename;
            $app['file_name'] = $filename;
        }

        $app = Aplikasi::create($app);

        return response()->json([
            'status' => true,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [
            'app' => Aplikasi::find($id),
            'kategori' => Kategori::all(),
        ];
        return view('app-form', $data);
    }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
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

    // public function getDataTables(Request $request)
    // {
    //     $atlet = Atlet::orderBy('id','DESC');
    //     return Datatables::of($atlet)
    //         ->make(true);
    // }
}
