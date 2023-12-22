<?php

namespace App\Http\Controllers;

use OpenAI\Laravel\Facades\OpenAI;

class CodeExplainer extends Controller
{
    public function __invoke()
    {
        $code = request('code');
        $question = 'Can you provide a step-by-step breakdown of how this code works, using Markdown formatting?';

        $result = OpenAI::completions()->create([
            'model' => "text-davinci-003",
            "prompt" => $code . $question,
            'temperature' => 0,
            'max_tokens' => 1024,
            'top_p' => 1,
            'frequency_penalty' => 0,
            'presence_penalty' => 0,
        ]);

        return response()->json([
            'text' => $result['choices'][0]['text'],
        ]);
    }
}
