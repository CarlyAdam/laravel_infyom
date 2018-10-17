<?php

use App\Models\Ex;
use App\Repositories\ExRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExRepositoryTest extends TestCase
{
    use MakeExTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var ExRepository
     */
    protected $exRepo;

    public function setUp()
    {
        parent::setUp();
        $this->exRepo = App::make(ExRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateEx()
    {
        $ex = $this->fakeExData();
        $createdEx = $this->exRepo->create($ex);
        $createdEx = $createdEx->toArray();
        $this->assertArrayHasKey('id', $createdEx);
        $this->assertNotNull($createdEx['id'], 'Created Ex must have id specified');
        $this->assertNotNull(Ex::find($createdEx['id']), 'Ex with given id must be in DB');
        $this->assertModelData($ex, $createdEx);
    }

    /**
     * @test read
     */
    public function testReadEx()
    {
        $ex = $this->makeEx();
        $dbEx = $this->exRepo->find($ex->id);
        $dbEx = $dbEx->toArray();
        $this->assertModelData($ex->toArray(), $dbEx);
    }

    /**
     * @test update
     */
    public function testUpdateEx()
    {
        $ex = $this->makeEx();
        $fakeEx = $this->fakeExData();
        $updatedEx = $this->exRepo->update($fakeEx, $ex->id);
        $this->assertModelData($fakeEx, $updatedEx->toArray());
        $dbEx = $this->exRepo->find($ex->id);
        $this->assertModelData($fakeEx, $dbEx->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteEx()
    {
        $ex = $this->makeEx();
        $resp = $this->exRepo->delete($ex->id);
        $this->assertTrue($resp);
        $this->assertNull(Ex::find($ex->id), 'Ex should not exist in DB');
    }
}
