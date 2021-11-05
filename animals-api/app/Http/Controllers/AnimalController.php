<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnimalController extends Controller
{
    //

    private $data;

    public function __construct(){

        $this->data = array(1 => "Jerapah", 2 => "Belalang", 3 => "Singa", 4 => "Anjing", 5 => "Babi");

    }

    function index(){

        return collect($this->data);

    }

    function getId($id){

      return $this->data[$id];

    }

    function create(Request $request){

    	$namaHewan = $request->nama;
        array_push($this->data, $namaHewan);
        return $this->data;

    }

    function update(Request $request, $id){

     $UpdateNama = $request->nama;
     $replaceData = array($id => $UpdateNama);
     $this->data = array_replace($this->data, $replaceData);
     return $this->data;


    }

    function destroy($id){

      unset($this->data[$id]);
      return $this->data;

    }

}