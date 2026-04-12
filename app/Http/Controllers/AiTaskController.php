<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AiTaskController extends Controller
{
    public function suggest(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'goal' => ['required', 'string', 'max:2000'],
        ]);

        $apiKey = env('OPENAI_API_KEY');
        $model = env('OPENAI_MODEL', 'gpt-5.4-mini');

        if (!$apiKey) {
            return response()->json([
                'error' => 'OpenAI API key is missing from the .env file.',
            ], 500);
        }

        $goal = trim($validated['goal']);

        $schema = [
            'type' => 'object',
            'additionalProperties' => false,
            'properties' => [
                'title' => [
                    'type' => 'string',
                    'description' => 'A short actionable task title.',
                ],
                'description' => [
                    'type' => 'string',
                    'description' => 'A concise task description.',
                ],
                'priority' => [
                    'type' => 'integer',
                    'enum' => [0, 1, 2, 3, 4, 5],
                    'description' => 'Priority from 0 to 5.',
                ],
            ],
            'required' => ['title', 'description', 'priority'],
        ];

        try {
            $response = Http::withToken($apiKey)
                ->timeout(30)
                ->acceptJson()
                ->post('https://api.openai.com/v1/responses', [
                    'model' => $model,
                    'input' => [
                        [
                            'role' => 'system',
                            'content' => [
                                [
                                    'type' => 'input_text',
                                    'text' => 'You help users create tasks. Return one useful task suggestion based on the user goal.',
                                ],
                            ],
                        ],
                        [
                            'role' => 'user',
                            'content' => [
                                [
                                    'type' => 'input_text',
                                    'text' => "User goal: {$goal}",
                                ],
                            ],
                        ],
                    ],
                    'text' => [
                        'format' => [
                            'type' => 'json_schema',
                            'name' => 'task_suggestion',
                            'schema' => $schema,
                            'strict' => true,
                        ],
                    ],
                    'store' => false,
                ]);

            if ($response->failed()) {
                Log::error('OpenAI API error', [
                    'status' => $response->status(),
                    'body' => $response->json(),
                ]);

                return response()->json([
                    'error' => 'AI request failed.',
                    'details' => $response->json(),
                ], 500);
            }

            $data = $response->json();

            $jsonText = data_get($data, 'output.0.content.0.text');

            if (!$jsonText) {
                return response()->json([
                    'error' => 'AI returned an unexpected response format.',
                    'raw' => $data,
                ], 500);
            }

            $suggestion = json_decode($jsonText, true);

            if (!is_array($suggestion)) {
                return response()->json([
                    'error' => 'Could not parse AI response as JSON.',
                    'raw_text' => $jsonText,
                ], 500);
            }

            return response()->json([
                'title' => $suggestion['title'] ?? '',
                'description' => $suggestion['description'] ?? '',
                'priority' => $suggestion['priority'] ?? 0,
            ]);
        } catch (\Throwable $e) {
            Log::error('OpenAI integration exception', [
                'message' => $e->getMessage(),
            ]);

            return response()->json([
                'error' => 'Something went wrong while contacting the AI service.',
            ], 500);
        }
    }
}