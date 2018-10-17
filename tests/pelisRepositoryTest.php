<?php

use App\Models\Pelis;
use App\Repositories\pelisRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class pelisRepositoryTest extends TestCase
{
    use MakepelisTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var pelisRepository
     */
    protected $pelisRepo;

    public function setUp()
    {
        parent::setUp();
        $this->pelisRepo = App::make(pelisRepository::class);
    }

    /**
     * @test create
     */
    public function testCreatepelis()
    {
        $pelis = $this->fakepelisData();
        $createdpelis = $this->pelisRepo->create($pelis);
        $createdpelis = $createdpelis->toArray();
        $this->assertArrayHasKey('id', $createdpelis);
        $this->assertNotNull($createdpelis['id'], 'Created pelis must have id specified');
        $this->assertNotNull(pelis::find($createdpelis['id']), 'pelis with given id must be in DB');
        $this->assertModelData($pelis, $createdpelis);
    }

    /**
     * @test read
     */
    public function testReadpelis()
    {
        $pelis = $this->makepelis();
        $dbpelis = $this->pelisRepo->find($pelis->id);
        $dbpelis = $dbpelis->toArray();
        $this->assertModelData($pelis->toArray(), $dbpelis);
    }

    /**
     * @test update
     */
    public function testUpdatepelis()
    {
        $pelis = $this->makepelis();
        $fakepelis = $this->fakepelisData();
        $updatedpelis = $this->pelisRepo->update($fakepelis, $pelis->id);
        $this->assertModelData($fakepelis, $updatedpelis->toArray());
        $dbpelis = $this->pelisRepo->find($pelis->id);
        $this->assertModelData($fakepelis, $dbpelis->toArray());
    }

    /**
     * @test delete
     */
    public function testDeletepelis()
    {
        $pelis = $this->makepelis();
        $resp = $this->pelisRepo->delete($pelis->id);
        $this->assertTrue($resp);
        $this->assertNull(pelis::find($pelis->id), 'pelis should not exist in DB');
    }
}
