<?php

namespace App\Http\Controllers;

use OpenAI\Laravel\Facades\OpenAI;

class ConversationController extends Controller
{
    public function store()
    {
        $message = request('message');

        $prompt = "The following is a conversation with an AI assistant. The assistant is helpful, creative, clever, and very friendly. The assistant can also use markdown formatting to include code snippets.

        Human: Hello, who are you?
        AI: I am an AI created by Clovon with the help of OpenAI. How can I help you today?
        Human: {$message}.
        AI:";

        $result = OpenAI::completions()->create([
            'model' => 'text-davinci-003',
            'prompt' => $prompt,
            'temperature' => 0.9,
            'max_tokens' => 200,
            'top_p' => 1,
            'frequency_penalty' => 0,
            'presence_penalty' => 0.6,
        ]);

        return response()->json([
            'text' => $result['choices'][0]['text'],
        ]);
    }
}
