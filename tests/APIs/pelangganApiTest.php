<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\pelanggan;

class pelangganApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_pelanggan()
    {
        $pelanggan = factory(pelanggan::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/pelanggans', $pelanggan
        );

        $this->assertApiResponse($pelanggan);
    }

    /**
     * @test
     */
    public function test_read_pelanggan()
    {
        $pelanggan = factory(pelanggan::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/pelanggans/'.$pelanggan->id
        );

        $this->assertApiResponse($pelanggan->toArray());
    }

    /**
     * @test
     */
    public function test_update_pelanggan()
    {
        $pelanggan = factory(pelanggan::class)->create();
        $editedpelanggan = factory(pelanggan::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/pelanggans/'.$pelanggan->id,
            $editedpelanggan
        );

        $this->assertApiResponse($editedpelanggan);
    }

    /**
     * @test
     */
    public function test_delete_pelanggan()
    {
        $pelanggan = factory(pelanggan::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/pelanggans/'.$pelanggan->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/pelanggans/'.$pelanggan->id
        );

        $this->response->assertStatus(404);
    }
}
