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
        
        $response=areaController::record($area);

        $areaHistory=DB::table('areasHistory')->where('area_id','=',$area->id)->first();
        $this->assertTrue($areaHistory);
        $this->assertTrue($areaHistory->area_id==$area->id);
        $this->assertTrue($areaHistory->name==$area->name);
        $this->assertTrue($areaHistory->taken==Area::totalTakenTables($area->id));
        $this->assertTrue($areaHistory->total==Area::totalTables($area->id));
        
    }
}
