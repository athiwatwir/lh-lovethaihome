<?php

namespace App\Http\Controllers;

use App\Services\LoveThaiHome\Exceptions\LoveThaiHomeApiException;
use App\Services\LoveThaiHome\LoveThaiHomeService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class SitemapController extends Controller
{
    public function index(LoveThaiHomeService $api): Response
    {
        $urls = Cache::remember('lovethaihome.sitemap.urls', 3600, function () use ($api) {
            return $this->buildUrls($api);
        });

        return response()
            ->view('sitemap', ['urls' => $urls])
            ->header('Content-Type', 'application/xml');
    }

    /**
     * @return list<array{loc: string, lastmod?: string, changefreq?: string, priority?: string}>
     */
    private function buildUrls(LoveThaiHomeService $api): array
    {
        $urls = [
            ['loc' => route('home'), 'changefreq' => 'daily', 'priority' => '1.0'],
            ['loc' => route('properties.index', ['zone_id' => 'all']), 'changefreq' => 'daily', 'priority' => '0.9'],
            ['loc' => route('sellers.index'), 'changefreq' => 'weekly', 'priority' => '0.7'],
            ['loc' => route('services.index'), 'changefreq' => 'monthly', 'priority' => '0.6'],
            ['loc' => route('contact.index'), 'changefreq' => 'monthly', 'priority' => '0.5'],
        ];

        try {
            $page = 1;
            $lastPage = 1;

            do {
                $response = $api->properties([
                    'page' => $page,
                    'per_page' => 100,
                    'zone_id' => null,
                ]);

                foreach ($response->data as $item) {
                    if (! isset($item['id'])) {
                        continue;
                    }

                    $urls[] = array_filter([
                        'loc' => route('properties.show', $item['id']),
                        'lastmod' => isset($item['updated_at']) ? substr((string) $item['updated_at'], 0, 10) : null,
                        'changefreq' => 'weekly',
                        'priority' => '0.8',
                    ]);
                }

                $lastPage = (int) ($response->meta['last_page'] ?? $page);
                $page++;
            } while ($page <= $lastPage);
        } catch (LoveThaiHomeApiException $exception) {
            Log::warning('Failed to build property URLs for sitemap.', [
                'message' => $exception->getMessage(),
                'status' => $exception->statusCode,
            ]);
        }

        return $urls;
    }
}
