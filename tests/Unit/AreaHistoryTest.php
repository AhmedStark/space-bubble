<?php

namespace Tests\Unit;
use DB;
use Tests\TestCase;
use App\Http\Controllers\areaController;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AreaHistoryTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testSaveHistory()
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
        
        $response=areaController::makeRecord();

        $record=DB::table('records')->where('area_id','=',$area->id)->first();
        $this->assertTrue($record);
        $this->assertTrue($record->area_id==$area->id);
        $this->assertTrue($record->area_name==$area->name);
        $this->assertTrue($record->total_taken_tables==Area::totalTakenTables($area->id));
        $this->assertTrue($record->total_tables==Area::totalTables($area->id));
        
    }
}
