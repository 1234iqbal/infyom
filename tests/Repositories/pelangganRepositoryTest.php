<?php namespace Tests\Repositories;

use App\Models\pelanggan;
use App\Repositories\pelangganRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class pelangganRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var pelangganRepository
     */
    protected $pelangganRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->pelangganRepo = \App::make(pelangganRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_pelanggan()
    {
        $pelanggan = factory(pelanggan::class)->make()->toArray();

        $createdpelanggan = $this->pelangganRepo->create($pelanggan);

        $createdpelanggan = $createdpelanggan->toArray();
        $this->assertArrayHasKey('id', $createdpelanggan);
        $this->assertNotNull($createdpelanggan['id'], 'Created pelanggan must have id specified');
        $this->assertNotNull(pelanggan::find($createdpelanggan['id']), 'pelanggan with given id must be in DB');
        $this->assertModelData($pelanggan, $createdpelanggan);
    }

    /**
     * @test read
     */
    public function test_read_pelanggan()
    {
        $pelanggan = factory(pelanggan::class)->create();

        $dbpelanggan = $this->pelangganRepo->find($pelanggan->id);

        $dbpelanggan = $dbpelanggan->toArray();
        $this->assertModelData($pelanggan->toArray(), $dbpelanggan);
    }

    /**
     * @test update
     */
    public function test_update_pelanggan()
    {
        $pelanggan = factory(pelanggan::class)->create();
        $fakepelanggan = factory(pelanggan::class)->make()->toArray();

        $updatedpelanggan = $this->pelangganRepo->update($fakepelanggan, $pelanggan->id);

        $this->assertModelData($fakepelanggan, $updatedpelanggan->toArray());
        $dbpelanggan = $this->pelangganRepo->find($pelanggan->id);
        $this->assertModelData($fakepelanggan, $dbpelanggan->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_pelanggan()
    {
        $pelanggan = factory(pelanggan::class)->create();

        $resp = $this->pelangganRepo->delete($pelanggan->id);

        $this->assertTrue($resp);
        $this->assertNull(pelanggan::find($pelanggan->id), 'pelanggan should not exist in DB');
    }
}
