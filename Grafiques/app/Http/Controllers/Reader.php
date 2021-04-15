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

        $covid = Dades::all();
        foreach ($covid as $datos) {
            $fecha = $datos->date;
            $pcrTest = $datos->pcrTestCount;
            $pcrPositiu = $datos->pcrPositiveCount;
            

           
            $positiuXdia .= "{x:'" . $fecha . "', a:'" . $pcrPositiu ."', b:'" . $pcrTest ."'},";
        }

        $actu = Dades::latest()->first();
        $finalPositiu = $actu->pcrPositiveCount;
        $finalPcr = $actu->pcrTestCount;
        $pcrNegatiu = $finalPcr - $finalPositiu;

        
        $sendActu .= "{x:'" . $finalPcr . "', a:'" . $finalPositiu ."'},";
        return view("grafica" , compact(['positiuXdia', 'finalPositiu', 'pcrNegatiu']));
    }


    /*  Aquest codi ja no l'utilitzo aqui ja que nomes s'executaria un cop s'entra a la web.
        Per arreglarho he creat un command que s'executara cada minut
    public function readXML(){
        $url = 'https://opendata.euskadi.eus/contenidos/ds_informes_estudios/covid_19_2020/opendata/generated/covid19-epidemic-status.xml';
        $xml = simplexml_load_file($url) or die("Error: xml died");
        

        $filter = $xml->xpath("//byDate/byDateItem");
        
        foreach ($filter as $item) {
            $datos = new Dades();

            $fecha = $item->attributes()->date;

            $fechaBien = explode("T" ,$fecha);
            $YYMMDD = $fechaBien[0];
            $fechaBienFormato = explode("-", $YYMMDD);
            $year = $fechaBienFormato[0];
            $month = $fechaBienFormato[1];
            $day = $fechaBienFormato[2];

            $fechaToSQL = $year . '/' . $month . '/' . $day;

            echo $fechaToSQL;
        
            $pcrTest = $item->attributes()->pcrTestCount;
            $pcrPositiu = $item->attributes()->pcrPositiveCount;
            
            DB::table('Dades')-insert([
                'date' => $fechaToSQL,
                'pcrTestCount' => $pcrTest,
                'pcrPositiveCount' => $pcrPositiu
            ]);
            
            
            $datos->date = $fechaToSQL;
            $datos->pcrTestCount = $pcrTest;
            $datos->pcrPositiveCount = $pcrPositiu;
            $datos->save();
            

            echo 'Fecha: '. $fecha . ' Pcr Tests: ' . $pcrTest . ' Pcr Positius: ' . $pcrPositiu . "<br>";
        }     
         
    }
    */
}
