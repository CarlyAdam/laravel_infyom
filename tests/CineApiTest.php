<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CineApiTest extends TestCase
{
    use MakeCineTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateCine()
    {
        $cine = $this->fakeCineData();
        $this->json('POST', '/api/v1/cines', $cine);

        $this->assertApiResponse($cine);
    }

    /**
     * @test
     */
    public function testReadCine()
    {
        $cine = $this->makeCine();
        $this->json('GET', '/api/v1/cines/'.$cine->id);

        $this->assertApiResponse($cine->toArray());
    }

    /**
     * @test
     */
    public function testUpdateCine()
    {
        $cine = $this->makeCine();
        $editedCine = $this->fakeCineData();

        $this->json('PUT', '/api/v1/cines/'.$cine->id, $editedCine);

        $this->assertApiResponse($editedCine);
    }

    /**
     * @test
     */
    public function testDeleteCine()
    {
        $cine = $this->makeCine();
        $this->json('DELETE', '/api/v1/cines/'.$cine->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/cines/'.$cine->id);

        $this->assertResponseStatus(404);
    }
}
