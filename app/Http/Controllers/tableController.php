<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use App\Table;
use App\Area;
class tableController extends Controller
{
    public static  $TOKEN_LENGTH = 25;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request){
        $id=$request->id;
        DB::table('tables')->where('id', '=', $id)->delete();
    }
    
    public function create()
    {
        return view('table.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $table=new Table;
        $state = true;
        $table->area_id= $request->area_id;
        while($state){
            $token=str_random(self::$TOKEN_LENGTH);
            if(Table::where("token",'=',$token)->count()>0){
                $token=str_random(self::$TOKEN_LENGTH);
                continue;
            }else{
                $table->token=$token;
                $state=false;
                break;
            }
            
        }
        
        $table->taken=0;

        $table->save();
        return ['status'=>true,'message' => "Product Created!","data"=>$request->all()];
    }

    public function moveTo(Request $request){
        
        if(Area::where('id', '=', $request->area_id)->count() == 0){
            return 'Error area does not exist';
        }else{
            $area=Area::find($request->area_id)->first();
            DB::table('tables')
            ->where('id', $request->table_id)
            ->update(['area_id' =>$request->area_id]);
            return 'update was successful';
        }
    }
   
   
    public function statusUpdate(Request $request){
        
        DB::table('tables')
            ->where('token', $request->token)
            ->update(['taken' => $request->status]);
     
    }

    function refresh_area($id){
        echo'hello';
    }

}
