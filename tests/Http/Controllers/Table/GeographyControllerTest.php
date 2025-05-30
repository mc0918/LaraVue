<?php

namespace Tests\Http\Controllers\Table;

use App\Http\Controllers\Table\GeographyController;
use Tests\TestCase;

class GeographyControllerTest extends TestCase
{
    public function test_index_request_is_successful(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_index_view_renders_successfully(): void
    {
        $expectedData = collect(['foo' => 'bar']);
        $expectedFields = collect(['fizz' => 'buzz']);

        $view = $this->view('index', ['data' => $expectedData, 'fields' => $expectedFields]);

        $view->assertSee($expectedFields->first());
        $view->assertSee($expectedData->first());
    }
}
