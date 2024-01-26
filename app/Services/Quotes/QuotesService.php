<?php

namespace App\Services\Quotes;

use Http;

class QuotesService
{

    private static function getRandomCategory(): string
    {
        $categories = [
            'family',
            'beauty',
            'forgiveness',
            'friendship',
            'funny',
            'love',
            'happiness',
            'life',
        ];

        return collect($categories)->random(1)->first();
    }

    public static function getQuote()
    {
        return static::request(static::getRandomCategory());
    }

    public static function request(string $category = "inspire")
    {
        $response = Http::withHeader('X-Api-Key', config('services.quotes.secret'))
            ->get(config('services.quotes.base_url'), [
                'secret' => config('services.quotes.secret'),
            ], [
                'category' => $category,
            ]);


        return $response->json()[0]['quote'];
    }
}
