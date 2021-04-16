<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dades;
//use Illuminate\Support\Facades\DB;

class Reader extends Controller
{
    public function readBBDD(){
       
        $positiuXdia = "";
        $sendActu = "";
        $pcrXdia = "";

        $covid = Dades::all();
        foreach ($covid as $datos) {
            $fecha = $datos->date;
            $pcrTest = $datos->pcrTestCount;
            $pcrPositiu = $datos->pcrPositiveCount;
            

           
            $positiuXdia .= "{x:'" . $fecha . "', a:'" . $pcrPositiu ."'},";
            $pcrXdia .= "{x:'" . $fecha . "', a:'" . $pcrTest ."'},";
        }

        $actu = Dades::latest()->first();
        $finalPositiu = $actu->pcrPositiveCount;
        $finalPcr = $actu->pcrTestCount;
        $pcrNegatiu = $finalPcr - $finalPositiu;

        
        $sendActu .= "{x:'" . $finalPcr . "', a:'" . $finalPositiu ."'},";
        return view("grafica" , compact(['positiuXdia', 'pcrXdia' , 'finalPositiu', 'pcrNegatiu']));
    }
}
