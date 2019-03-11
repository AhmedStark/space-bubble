<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CreateMap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:map';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return mixed
     */
    public function handle()
    {   
        $checkMapID = true;
        $mapID=$this->ask("What is the maps id ?");
        $this->registerComponent($mapID);
        
        if($checkMapID){
            $compenet = fopen(base_path("resources/js/components/")."map-".$mapID.".vue", "w"); 
            fwrite($compenet, 
"<template>\n<area-map v>\n    <div slot=\"map\">\n\n         <!--put your svg code here-->\n\n    </div>\n</area-map></template>");
            fclose($compenet);
        }
    }
    public function registerComponent($mapID){
        $appJsBath=base_path("resources/js/app.js");
        $txt=file_get_contents($appJsBath);
        $spliter="//--------------------";
        $arr =explode($spliter,$txt);        
    
        $appJsWrite = fopen($appJsBath,"w");
        $newAppJsFileContent = $arr[0]."\nVue.component('map-".$mapID."', require('./components/map-".$mapID.".vue').default);\n".$spliter.$arr[1];
        fwrite($appJsWrite,$newAppJsFileContent);
        fclose($appJsWrite);
    }
}
