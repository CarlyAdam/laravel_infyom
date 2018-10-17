<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExApiTest extends TestCase
{
    use MakeExTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateEx()
    {
        $ex = $this->fakeExData();
        $this->json('POST', '/api/v1/exes', $ex);

        $this->assertApiResponse($ex);
    }

    /**
     * @test
     */
    public function testReadEx()
    {
        $ex = $this->makeEx();
        $this->json('GET', '/api/v1/exes/'.$ex->id);

        $this->assertApiResponse($ex->toArray());
    }

    /**
     * @test
     */
    public function testUpdateEx()
    {
        $ex = $this->makeEx();
        $editedEx = $this->fakeExData();

        $this->json('PUT', '/api/v1/exes/'.$ex->id, $editedEx);

        $this->assertApiResponse($editedEx);
    }

    /**
     * @test
     */
    public function testDeleteEx()
    {
        $ex = $this->makeEx();
        $this->json('DELETE', '/api/v1/exes/'.$ex->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/exes/'.$ex->id);

        $this->assertResponseStatus(404);
    }
}
