<?php

namespace App\Http\Controllers;

use OpenAI\Laravel\Facades\OpenAI;

class ImageGenerator extends Controller
{
    public function __invoke()
    {
        $prompt = request('prompt');

        $result = OpenAI::images()->create([
            'prompt' => $prompt,
            'n' => 1,
            'size' => '256x256',
            'response_format' => 'url',
        ]);

        return response()->json([
            'images' => $result,
        ]);
    }
}
