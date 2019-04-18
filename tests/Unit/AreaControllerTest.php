<?php



namespace Tests\Unit;
use WithoutMiddleware;
use App\Area;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use DB;
use Illuminate\Support\Facades\Log;

class AreaControllerTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    
    private $ID;
    public function testCreateArea()
    {
        $this->withoutMiddleware();
        $data = [
            'level_id' => 1,
            'name' => 'area 1',
        ];
        
        $area = factory(Area::class)->create();
        $response = $this->json('POST', '/areas/create',$data);
        $response->assertStatus(200);
        $response->assertJson(['status' => true]);
        $response->assertJson(['data' => $data]);
       
        $this->ID=DB::table('areas')->orderBy('id','desc')->first()->id;

        $this->assertTrue(true);
    }

    
    public function testTotalTables(){
        $this->withoutMiddleware();
        $this->ID=DB::table('areas')->orderBy('id','desc')->first()->id;

        $request = [
            'id' => $this->ID,
        ];
        $response = $this->json('POST', '/count',$request);
        
        $count=Area::find($this->ID)->tables()->count();
        $this->assertJson($count=='count');

    }

    public function testTotalTakenTables(){
        $this->withoutMiddleware();
        $this->ID=DB::table('areas')->orderBy('id','desc')->first()->id;

        $request = [
            'id' => $this->ID,
        ];
        $response = $this->json('POST', '/countTaken',$request);
        
        $count=Area::find($this->ID)->tables()->where('taken','=',1)->count();
        $this->assertJson($count=='count');

    }

    public function testDeleteArea(){
        $this->withoutMiddleware();
        $this->ID=DB::table('areas')->orderBy('id','desc')->first()->id;

        $request = [
            'id' => $this->ID,
        ];
        $area = factory(Area::class)->create();
        $response = $this->json('POST', '/deleteArea',$request);
        $checkArea=DB::table('areas')->where('id', '=', $request['id'])->count();
        $this->assertTrue($checkArea==0);
        $response->assertStatus(200);
        $response->assertJson(['status' => true]);
        
    }
    


}
