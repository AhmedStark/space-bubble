<?php

namespace Tests\Unit;
use DB;
use App\Http\Controllers\areaController;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AreaHistoryCommandTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testAreaHistoryCommand()
    {
        
        $this->withoutMiddleware();
        $data = [
            'level_id' => 1,
            'name' => 'area test',
        ];
        
        
        $createArea = $this->json('POST', '/areas/create',$data);
        
        $area=DB::table('areas')->orderBy('id','desc')->first();
        
        $tableData = [
            'area_id' => $area->id,
            'taken' => 0,
            ];
        for($i=0;$i<10;$i++){
            $createTable = $this->json('POST', '/table',$tableData);
        }
        $this->artisan('make:area-record')->assertExitCode(0);
        
        $record=DB::table('records')->where('area_id','=',$area->id)->first();
        
        $this->assertTrue($record!==null);
        $this->assertTrue($record->area_id==$area->id);
        $this->assertTrue($record->area_name==$area->name);
        $this->assertTrue($record->total_taken_tables==areaController::totalTakenTables($area->id));
        $this->assertTrue($record->total_tables==areaController::totalTables($area->id));    
    }
    
}
