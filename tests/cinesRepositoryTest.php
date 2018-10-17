<?php

use App\Models\cines;
use App\Repositories\cinesRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class cinesRepositoryTest extends TestCase
{
    use MakecinesTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var cinesRepository
     */
    protected $cinesRepo;

    public function setUp()
    {
        parent::setUp();
        $this->cinesRepo = App::make(cinesRepository::class);
    }

    /**
     * @test create
     */
    public function testCreatecines()
    {
        $cines = $this->fakecinesData();
        $createdcines = $this->cinesRepo->create($cines);
        $createdcines = $createdcines->toArray();
        $this->assertArrayHasKey('id', $createdcines);
        $this->assertNotNull($createdcines['id'], 'Created cines must have id specified');
        $this->assertNotNull(cines::find($createdcines['id']), 'cines with given id must be in DB');
        $this->assertModelData($cines, $createdcines);
    }

    /**
     * @test read
     */
    public function testReadcines()
    {
        $cines = $this->makecines();
        $dbcines = $this->cinesRepo->find($cines->id);
        $dbcines = $dbcines->toArray();
        $this->assertModelData($cines->toArray(), $dbcines);
    }

    /**
     * @test update
     */
    public function testUpdatecines()
    {
        $cines = $this->makecines();
        $fakecines = $this->fakecinesData();
        $updatedcines = $this->cinesRepo->update($fakecines, $cines->id);
        $this->assertModelData($fakecines, $updatedcines->toArray());
        $dbcines = $this->cinesRepo->find($cines->id);
        $this->assertModelData($fakecines, $dbcines->toArray());
    }

    /**
     * @test delete
     */
    public function testDeletecines()
    {
        $cines = $this->makecines();
        $resp = $this->cinesRepo->delete($cines->id);
        $this->assertTrue($resp);
        $this->assertNull(cines::find($cines->id), 'cines should not exist in DB');
    }
}
