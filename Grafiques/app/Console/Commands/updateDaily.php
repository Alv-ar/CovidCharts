<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Dades;

class updateDaily extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'daily:insert';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fa insert de les dades cada dia';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Dades::truncate();
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
            
            $pcrTest = $item->attributes()->pcrTestCount;
            $pcrPositiu = $item->attributes()->pcrPositiveCount;
            
            
            $datos->date = $fechaToSQL;
            $datos->pcrTestCount = $pcrTest;
            $datos->pcrPositiveCount = $pcrPositiu;
            $datos->save();
            print("done");
        }        
    }
}
