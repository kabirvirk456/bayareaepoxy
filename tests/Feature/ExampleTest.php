<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Bay Area Epoxy Wholesale');
        $response->assertSee('Most Trusted Industrial Flooring');
        $response->assertSee('Solutions For Every Industry');
    }

    public function test_product_slug_is_preserved(): void
    {
        $response = $this->get('/products/crown-polymers-blue-label-epoxy-100-3-gallons-clear');

        $response->assertStatus(200);
        $response->assertSee('Enquire Now');
    }

    public function test_collection_slug_is_preserved(): void
    {
        $response = $this->get('/collections/urethane-cement');

        $response->assertStatus(200);
        $response->assertSee('CrownCrete');
    }

    public function test_cart_redirects_to_contact(): void
    {
        $response = $this->get('/cart');

        $response->assertRedirect('/pages/contact');
    }

    public function test_esd_page_has_system_products(): void
    {
        $response = $this->get('/pages/esd-static-dissipative-conductive');

        $response->assertStatus(200);
        $response->assertSee('ESD Flooring Systems California');
        $response->assertSee('ESD Conductive Mortar System');
        $response->assertSee('ESD Static Dissipative System');
    }
}
