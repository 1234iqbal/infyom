<?php namespace Tests\Repositories;

use App\Models\toko;
use App\Repositories\tokoRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class tokoRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var tokoRepository
     */
    protected $tokoRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->tokoRepo = \App::make(tokoRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_toko()
    {
        $toko = factory(toko::class)->make()->toArray();

        $createdtoko = $this->tokoRepo->create($toko);

        $createdtoko = $createdtoko->toArray();
        $this->assertArrayHasKey('id', $createdtoko);
        $this->assertNotNull($createdtoko['id'], 'Created toko must have id specified');
        $this->assertNotNull(toko::find($createdtoko['id']), 'toko with given id must be in DB');
        $this->assertModelData($toko, $createdtoko);
    }

    /**
     * @test read
     */
    public function test_read_toko()
    {
        $toko = factory(toko::class)->create();

        $dbtoko = $this->tokoRepo->find($toko->id);

        $dbtoko = $dbtoko->toArray();
        $this->assertModelData($toko->toArray(), $dbtoko);
    }

    /**
     * @test update
     */
    public function test_update_toko()
    {
        $toko = factory(toko::class)->create();
        $faketoko = factory(toko::class)->make()->toArray();

        $updatedtoko = $this->tokoRepo->update($faketoko, $toko->id);

        $this->assertModelData($faketoko, $updatedtoko->toArray());
        $dbtoko = $this->tokoRepo->find($toko->id);
        $this->assertModelData($faketoko, $dbtoko->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_toko()
    {
        $toko = factory(toko::class)->create();

        $resp = $this->tokoRepo->delete($toko->id);

        $this->assertTrue($resp);
        $this->assertNull(toko::find($toko->id), 'toko should not exist in DB');
    }
}
