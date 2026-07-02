<?php

namespace App\Http\Controllers;

use App\Data\LoveThaiHome\ArticleCategoryData;
use App\Data\LoveThaiHome\ArticleData;
use App\Data\LoveThaiHome\ArticlesPaginatedResponse;
use App\Services\LoveThaiHome\Exceptions\LoveThaiHomeApiException;
use App\Services\LoveThaiHome\LoveThaiHomeService;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ArticleController extends Controller
{
    public function index(Request $request, LoveThaiHomeService $api, ?string $categoryId = null): View
    {
        $page = max(1, (int) $request->query('page', 1));
        $perPage = min(max((int) $request->query('per_page', 20), 1), 100);

        $articles = collect();
        $categories = collect();
        $paginator = null;
        $apiError = null;
        $categoryName = 'บทความ';

        try {
            $response = $this->loadArticles($api, $categoryId, $page, $perPage);
            $categories = collect($response->categories);
            $activeCategoryId = $this->resolveCategoryId($categoryId, $categories);

            if ($activeCategoryId !== $categoryId) {
                $response = $this->loadArticles($api, $activeCategoryId, $page, $perPage);

                if ($response->categories !== []) {
                    $categories = collect($response->categories);
                }
            }

            $categoryId = $activeCategoryId;

            $articles = collect($response->data)
                ->map(fn (array $item) => ArticleData::fromArray($item));

            $total = (int) ($response->meta['total'] ?? $articles->count());
            $currentPage = (int) ($response->meta['current_page'] ?? $page);

            $paginator = new LengthAwarePaginator(
                $articles,
                $total,
                $perPage,
                $currentPage,
                ['path' => $request->url(), 'query' => $request->query()],
            );

            $categoryName = $this->resolveCategoryName($categoryId, $categories, $articles);
        } catch (LoveThaiHomeApiException $exception) {
            Log::warning('Failed to load articles from API.', [
                'message' => $exception->getMessage(),
                'status' => $exception->statusCode,
                'category_id' => $categoryId,
            ]);

            $apiError = 'ไม่สามารถโหลดบทความได้ในขณะนี้';
        }

        $title = $categoryName;
        SEOMeta::setTitle($title);
        SEOMeta::setDescription($title.' จาก Love Thai Home');
        OpenGraph::setTitle($title);
        OpenGraph::setDescription($title.' จาก Love Thai Home');

        return view('pages.articles.index', [
            'articles' => $articles,
            'categories' => $categories,
            'paginator' => $paginator,
            'categoryId' => $categoryId,
            'categoryName' => $categoryName,
            'apiError' => $apiError,
        ]);
    }

    public function show(string $article, LoveThaiHomeService $api): View
    {
        try {
            $detail = $api->article($article);
        } catch (LoveThaiHomeApiException $exception) {
            Log::warning('Failed to load article detail from API.', [
                'message' => $exception->getMessage(),
                'status' => $exception->statusCode,
                'article_id' => $article,
            ]);

            if ($exception->statusCode === 404) {
                throw new NotFoundHttpException('ไม่พบบทความที่ต้องการ');
            }

            abort(503, 'ไม่สามารถโหลดบทความได้ในขณะนี้');
        }

        SEOMeta::setTitle($detail->name);
        SEOMeta::setDescription($detail->name);
        SEOMeta::setCanonical(route('articles.show', $detail->id));
        OpenGraph::setTitle($detail->name);
        OpenGraph::setDescription($detail->name);
        OpenGraph::setUrl(route('articles.show', $detail->id));

        $relatedArticles = collect();

        if ($categoryId = $detail->category['id'] ?? null) {
            try {
                $response = $api->articles([
                    'category_id' => $categoryId,
                    'per_page' => 20,
                ]);

                $relatedArticles = collect($response->data)
                    ->map(fn (array $item) => ArticleData::fromArray($item))
                    ->reject(fn (ArticleData $item) => $item->id === $detail->id)
                    ->sortBy('seq')
                    ->values();
            } catch (LoveThaiHomeApiException $exception) {
                Log::warning('Failed to load related articles from API.', [
                    'message' => $exception->getMessage(),
                    'status' => $exception->statusCode,
                    'category_id' => $categoryId,
                    'article_id' => $detail->id,
                ]);
            }
        }

        return view('pages.articles.show', [
            'article' => $detail,
            'relatedArticles' => $relatedArticles,
        ]);
    }

    private function loadArticles(
        LoveThaiHomeService $api,
        ?string $categoryId,
        int $page,
        int $perPage,
    ): ArticlesPaginatedResponse {
        return $api->articles(array_filter([
            'category_id' => $categoryId,
            'page' => $page,
            'per_page' => $perPage,
        ], fn ($value) => $value !== null && $value !== ''));
    }

    /**
     * @param  Collection<int, ArticleCategoryData>  $categories
     */
    private function resolveCategoryId(?string $categoryId, Collection $categories): ?string
    {
        if ($categoryId !== null) {
            return $categoryId;
        }

        if ($categories->isEmpty()) {
            return config('lovethaihome_articles.knowledge_category_id');
        }

        $preferredIds = array_filter([
            config('lovethaihome_articles.knowledge_category_id'),
            config('lovethaihome_articles.job_category_id'),
        ]);

        foreach ($preferredIds as $preferredId) {
            if ($categories->contains(fn (ArticleCategoryData $category) => $category->id === $preferredId)) {
                return $preferredId;
            }
        }

        return $categories->first()->id;
    }

    /**
     * @param  Collection<int, ArticleCategoryData>  $categories
     * @param  Collection<int, ArticleData>  $articles
     */
    private function resolveCategoryName(
        ?string $categoryId,
        Collection $categories,
        Collection $articles,
    ): string {
        if ($categoryId !== null) {
            $fromCategories = $categories->firstWhere('id', $categoryId)?->name;

            if ($fromCategories) {
                return $fromCategories;
            }
        }

        return $articles->first()?->category['name'] ?? 'บทความ';
    }
}
