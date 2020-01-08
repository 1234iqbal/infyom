<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\toko;

class tokoApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_toko()
    {
        $toko = factory(toko::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/tokos', $toko
        );

        $this->assertApiResponse($toko);
    }

    /**
     * @test
     */
    public function test_read_toko()
    {
        $toko = factory(toko::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/tokos/'.$toko->id
        );

        $this->assertApiResponse($toko->toArray());
    }

    /**
     * @test
     */
    public function test_update_toko()
    {
        $toko = factory(toko::class)->create();
        $editedtoko = factory(toko::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/tokos/'.$toko->id,
            $editedtoko
        );

        $this->assertApiResponse($editedtoko);
    }

    /**
     * @test
     */
    public function test_delete_toko()
    {
        $toko = factory(toko::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/tokos/'.$toko->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/tokos/'.$toko->id
        );

        $this->response->assertStatus(404);
    }
}
