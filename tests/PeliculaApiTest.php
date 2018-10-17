<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PeliculaApiTest extends TestCase
{
    use MakePeliculaTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreatePelicula()
    {
        $pelicula = $this->fakePeliculaData();
        $this->json('POST', '/api/v1/peliculas', $pelicula);

        $this->assertApiResponse($pelicula);
    }

    /**
     * @test
     */
    public function testReadPelicula()
    {
        $pelicula = $this->makePelicula();
        $this->json('GET', '/api/v1/peliculas/'.$pelicula->id);

        $this->assertApiResponse($pelicula->toArray());
    }

    /**
     * @test
     */
    public function testUpdatePelicula()
    {
        $pelicula = $this->makePelicula();
        $editedPelicula = $this->fakePeliculaData();

        $this->json('PUT', '/api/v1/peliculas/'.$pelicula->id, $editedPelicula);

        $this->assertApiResponse($editedPelicula);
    }

    /**
     * @test
     */
    public function testDeletePelicula()
    {
        $pelicula = $this->makePelicula();
        $this->json('DELETE', '/api/v1/peliculas/'.$pelicula->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/peliculas/'.$pelicula->id);

        $this->assertResponseStatus(404);
    }
}
