<?php

use App\Models\Cine;
use App\Repositories\CineRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CineRepositoryTest extends TestCase
{
    use MakeCineTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var CineRepository
     */
    protected $cineRepo;

    public function setUp()
    {
        parent::setUp();
        $this->cineRepo = App::make(CineRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateCine()
    {
        $cine = $this->fakeCineData();
        $createdCine = $this->cineRepo->create($cine);
        $createdCine = $createdCine->toArray();
        $this->assertArrayHasKey('id', $createdCine);
        $this->assertNotNull($createdCine['id'], 'Created Cine must have id specified');
        $this->assertNotNull(Cine::find($createdCine['id']), 'Cine with given id must be in DB');
        $this->assertModelData($cine, $createdCine);
    }

    /**
     * @test read
     */
    public function testReadCine()
    {
        $cine = $this->makeCine();
        $dbCine = $this->cineRepo->find($cine->id);
        $dbCine = $dbCine->toArray();
        $this->assertModelData($cine->toArray(), $dbCine);
    }

    /**
     * @test update
     */
    public function testUpdateCine()
    {
        $cine = $this->makeCine();
        $fakeCine = $this->fakeCineData();
        $updatedCine = $this->cineRepo->update($fakeCine, $cine->id);
        $this->assertModelData($fakeCine, $updatedCine->toArray());
        $dbCine = $this->cineRepo->find($cine->id);
        $this->assertModelData($fakeCine, $dbCine->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteCine()
    {
        $cine = $this->makeCine();
        $resp = $this->cineRepo->delete($cine->id);
        $this->assertTrue($resp);
        $this->assertNull(Cine::find($cine->id), 'Cine should not exist in DB');
    }
}
