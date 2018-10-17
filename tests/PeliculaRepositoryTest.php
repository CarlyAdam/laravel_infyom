<?php

use App\Models\Pelicula;
use App\Repositories\PeliculaRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PeliculaRepositoryTest extends TestCase
{
    use MakePeliculaTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var PeliculaRepository
     */
    protected $peliculaRepo;

    public function setUp()
    {
        parent::setUp();
        $this->peliculaRepo = App::make(PeliculaRepository::class);
    }

    /**
     * @test create
     */
    public function testCreatePelicula()
    {
        $pelicula = $this->fakePeliculaData();
        $createdPelicula = $this->peliculaRepo->create($pelicula);
        $createdPelicula = $createdPelicula->toArray();
        $this->assertArrayHasKey('id', $createdPelicula);
        $this->assertNotNull($createdPelicula['id'], 'Created Pelicula must have id specified');
        $this->assertNotNull(Pelicula::find($createdPelicula['id']), 'Pelicula with given id must be in DB');
        $this->assertModelData($pelicula, $createdPelicula);
    }

    /**
     * @test read
     */
    public function testReadPelicula()
    {
        $pelicula = $this->makePelicula();
        $dbPelicula = $this->peliculaRepo->find($pelicula->id);
        $dbPelicula = $dbPelicula->toArray();
        $this->assertModelData($pelicula->toArray(), $dbPelicula);
    }

    /**
     * @test update
     */
    public function testUpdatePelicula()
    {
        $pelicula = $this->makePelicula();
        $fakePelicula = $this->fakePeliculaData();
        $updatedPelicula = $this->peliculaRepo->update($fakePelicula, $pelicula->id);
        $this->assertModelData($fakePelicula, $updatedPelicula->toArray());
        $dbPelicula = $this->peliculaRepo->find($pelicula->id);
        $this->assertModelData($fakePelicula, $dbPelicula->toArray());
    }

    /**
     * @test delete
     */
    public function testDeletePelicula()
    {
        $pelicula = $this->makePelicula();
        $resp = $this->peliculaRepo->delete($pelicula->id);
        $this->assertTrue($resp);
        $this->assertNull(Pelicula::find($pelicula->id), 'Pelicula should not exist in DB');
    }
}
