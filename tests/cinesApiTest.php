<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class cinesApiTest extends TestCase
{
    use MakecinesTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreatecines()
    {
        $cines = $this->fakecinesData();
        $this->json('POST', '/api/v1/cines', $cines);

        $this->assertApiResponse($cines);
    }

    /**
     * @test
     */
    public function testReadcines()
    {
        $cines = $this->makecines();
        $this->json('GET', '/api/v1/cines/'.$cines->id);

        $this->assertApiResponse($cines->toArray());
    }

    /**
     * @test
     */
    public function testUpdatecines()
    {
        $cines = $this->makecines();
        $editedcines = $this->fakecinesData();

        $this->json('PUT', '/api/v1/cines/'.$cines->id, $editedcines);

        $this->assertApiResponse($editedcines);
    }

    /**
     * @test
     */
    public function testDeletecines()
    {
        $cines = $this->makecines();
        $this->json('DELETE', '/api/v1/cines/'.$cines->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/cines/'.$cines->id);

        $this->assertResponseStatus(404);
    }
}
