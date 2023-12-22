<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;

class PagesResponseTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_render_welcome_component()
    {
        $this->get('/')
            ->assertInertia(fn (Assert $assert) => $assert
            ->component('Welcome')
        );
    }

    public function test_it_can_render_chatbot_component()
    {
        $this->actingAs(User::factory()->create())
            ->get('/chatbot')
            ->assertInertia(fn (Assert $assert) => $assert
            ->component('Chatbot')
        );
    }

    public function test_it_can_render_ai_image_generator_component()
    {
        $this->actingAs(User::factory()->create())
            ->get('/image-generator')
            ->assertInertia(fn (Assert $assert) => $assert
            ->component('ImageGenerator')
        );
    }

    public function test_it_can_render_the_code_explainer_component()
    {
        $this->actingAs(User::factory()->create())
            ->get('/code-explainer')
            ->assertInertia(fn (Assert $assert) => $assert
            ->component('CodeExplainer')
        );
    }
}
