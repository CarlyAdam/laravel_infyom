<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class pelisApiTest extends TestCase
{
    use MakepelisTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreatepelis()
    {
        $pelis = $this->fakepelisData();
        $this->json('POST', '/api/v1/pelis', $pelis);

        $this->assertApiResponse($pelis);
    }

    /**
     * @test
     */
    public function testReadpelis()
    {
        $pelis = $this->makepelis();
        $this->json('GET', '/api/v1/pelis/'.$pelis->id);

        $this->assertApiResponse($pelis->toArray());
    }

    /**
     * @test
     */
    public function testUpdatepelis()
    {
        $pelis = $this->makepelis();
        $editedpelis = $this->fakepelisData();

        $this->json('PUT', '/api/v1/pelis/'.$pelis->id, $editedpelis);

        $this->assertApiResponse($editedpelis);
    }

    /**
     * @test
     */
    public function testDeletepelis()
    {
        $pelis = $this->makepelis();
        $this->json('DELETE', '/api/v1/pelis/'.$pelis->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/pelis/'.$pelis->id);

        $this->assertResponseStatus(404);
    }
}
