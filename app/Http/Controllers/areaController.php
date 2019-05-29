<?php

namespace App\Http\Controllers;
use Response;
use Illuminate\Http\Request;
use App\Area;
use App\Record;
use DB;
class areaController extends Controller
{
    
    public function create()
    {
        return view('area.create');
    }

    public function editArea($id){
        if(!$area=Area::find($id)){
            return redirect('admin/dashboard');
        }
        return view("admin.area")->with(['area'=>$area]);
    }
   
    public function store(Request $request)
    {
        $area=new Area;

        $area->level_id= $request->level_id;
        $area->name=$request->name;

        $area->save();
        
        return ["response"=>"<p class='success--text'>Building was created</p>","data"=>$request->all(),'status'=>1];
    }

    public function delete(Request $request){
        $id=$request->id;

        if (Area::find($id)){
            
            $tables=Area::find($id)->tables();
            $tables->delete();
            
            
            DB::table('areas')->where('id', '=', $id)->delete();
        }
        return ['status'=>1];
            
    }

    public function showAreas(){
        return view('areas.index');
    }

    public function history(){
        return view('admin/area-history');
    }

    public function getHistory($id){

        $records=Record::where('area_id','=',$id)->get();
        $time= [];
        $precentage=[];
        $data=[];
        $area=Area::find($id)->first();
        foreach ($records as $record){
            array_push($time,$record->created_at);
            array_push($precentage,$this->tablePrecentage($record->total_taken_tables,$record->total_tables));

        }
        $data['id']=$id;
        $data['name']=$area->name;
        $data['categories']=$time;
        $data['data']=$precentage;

        return $data;


    }

    public function showTables($id){
        $area_id=$id;
        
        $tables=Area::find($area_id)->tables()->paginate(15);
        return $tables;
    }

    //make one
    public static function totalTables($id){
        $area_id=$id; 
        $count=Area::find($area_id)->tables()->count();
        return $count;
    }
    public static function totalTakenTables( $id){
        $area_id=$id;
        $count=Area::find($area_id)->tables()->where('taken','=',1)->count(); 
        return $count;
    }

    public static function tablePrecentage($totalTakenTables,$totalTables){
        if ($totalTables==0){
            return 0;
        }
        return $totalTakenTables*100/$totalTables;
    }

    public function update($id,Request $request){
        DB::table('areas')
            ->where('id', $id)
            ->update(['name' =>$request->name]);
            return ['status'=>true,'response' => "Area Edited!","data"=>$request->all()];
    }

    public static function makeRecord(){

        $areas=Area::all();
        foreach ($areas as $area){
            $area_id=$area->id;
            $areaTotalNumbOfTables=areaController::totalTables($area_id);
            $areaTotalNumbOfTakenTables=areaController::totalTakenTables($area_id);

            $record= new Record;
            $record->area_name=$area->name;
            $record->area_id=$area_id;
            $record->total_tables=$areaTotalNumbOfTables;
            $record->total_taken_tables=$areaTotalNumbOfTakenTables;
            $record->save();
        }
    }

    public static function downloadRecords(){

        $table = Record::all();
        $filename = "record.csv";
        $handle = fopen($filename, 'w+');
        fputcsv($handle, array('Area ID','Area name', 'Total tables', 'Total taken tables', 'created at'));
    
        foreach($table as $row) {
            fputcsv($handle, array($row['area_id'],$row['area_name'], $row['total_tables'], $row['total_taken_tables'], $row['created_at']));
        }
    
        fclose($handle);
    
        $headers = array(
            'Content-Type' => 'text/csv',
        );
    
        return Response::download($filename, 'records.csv', $headers);
    }


}
