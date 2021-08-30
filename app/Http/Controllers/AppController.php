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
        return view('pages.app.app', [
            'app' => Aplikasi::class
        ]);
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
        return view('pages.app.app-form', $data);
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
            'foto'               => 'required|mimes:jpg,bmp,png',
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
        return view('pages.app.app-form', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validasi = [
            'nama'               => 'required',
            'id_kategori'        => 'required',
            'keterangan'         => 'required',
            'base_url'           => 'required',
            'base_url_sso'       => 'required',
            'foto'               => 'mimes:jpg,bmp,png',
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

        $aplikasi = Aplikasi::find($id);
        $aplikasi->update($app);

        return response()->json([
            'status' => true,
        ]);
    }

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
