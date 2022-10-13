<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kampus;
use App\Models\User;
use App\Models\Mengikuti;
use App\Models\Jurusan;
use Auth;


class KampusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kampus = Kampus::all();
        // $kampus = User::all();

        return response()->json($kampus, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function cari($nama){
        $id_user= Auth::User()->id;

        $kampus = Kampus::where("nama", "like", "%".$nama."%")->get(['id','nama','logo','alamat','akreditasi','status_kampus']);
        
        $status_mengikuti = Mengikuti::where("id_user", $id_user)->where("nama_kampus", "like", "%".$nama."%")->get(['status_mengikuti']);

        return response()->json([$kampus,$status_mengikuti], 200);

    }

    public function daftar_ikut_kampus(){
        $id_user= Auth::User()->id;

        return Mengikuti::where("id_user", $id_user)->where("status_mengikuti", "mengikuti")->get();
    }

    public function mengikuti_kampus($id_kampus){
        $id_user= Auth::User()->id;

        // try{
            if(isset($id_kampus)){
                $status_mengikuti = Mengikuti::where("id_kampus", $id_kampus)
                    ->where("id_user", $id_user)->get(['nama_kampus','status_mengikuti']);
                
                if($status_mengikuti->isEmpty()){
                    $nama_kampus = Kampus::where("id", $id_kampus)->first()->nama;
                    $arr=['id_kampus' => $id_kampus,
                        'nama_kampus' => $nama_kampus,
                        'status_mengikuti'=> "mengikuti",
                        'id_user'=> $id_user]; 
                    $mengikuti = Mengikuti::create($arr);
                   
                    return $mengikuti;
                }
                else if($status_mengikuti[0]->status_mengikuti=="mengikuti"){
                    return $status_mengikuti;
                }
                else if($status_mengikuti[0]->status_mengikuti=="belum"){
                    $id_mengikuti = Mengikuti::where("id_kampus", $id_kampus)
                            ->where("id_user", $id_user)->first()->id;
                    $mengikuti = Mengikuti::find($id_mengikuti);
                    $mengikuti->status_mengikuti="mengikuti";

                    $mengikuti->save();
                    return $mengikuti;   
                }

            }
        // }
        // catch(\Throwable $tb){
            else{
                return "isi id kampus";
            }
        // }

    }

    public function daftar_jurusan($id_kampus){
        $jurusan = Jurusan::where("id_kampus", $id_kampus)->get(['jurusan', 'fakultas']); 

        return $jurusan; 

    }

}
