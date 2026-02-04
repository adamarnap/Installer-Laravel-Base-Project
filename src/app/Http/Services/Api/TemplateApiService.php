<?php

namespace App\Http\Services\Api;

class AuthService
{
    /** 
     * POST: Login & generate token
     */
    public function login(array $data)
    { 
        try {
            // Start DB Transaction
            DB::beginTransaction();

            // Example throw ServiceException
            // if () {
            //     throw new ServiceException(
            //         message: 'Message describing the error ...',
            //         code: 403,
            //         context: [

            //         ]
            //     );
            // }

            // Commit Transaction
            DB::commit();
        } catch (ServiceException $e) {
            DB::rollBack();
            throw $e;
        } catch (Throwable $th) {
            // Rollback Transaction
            DB::rollBack();
            throw new ServiceException(
                message: $th->getMessage(),
                code: 500,
                context: [
                'error' => $th->getMessage(),
                'file' => $th->getFile(),
                'line' => $th->getLine()
                ]
            );
        }
    }

    // Example function to get paginated list with caching  
    public function index(array $payload): LengthAwarePaginator
    {
        /** @var \App\Models\User */
        $user = Auth::user();
        $user->load(['viewedBlog']);

        $query = fn() => \App\Models\Blog::query()
            ->with('category')
            ->withCount(['likes', 'views'])
            ->when(empty($payload['with_content']), function ($q) {
                $q->addSelect([
                    'blogs.id',
                    'blogs._id',
                    'blogs.originalUrl',
                    'blogs.thumbnailUrl',
                    'blogs.titleMalay',
                    'blogs.titleEnglish',
                    'blogs.category_id',
                    'blogs.timestamp',
                    'blogs.created_at',
                    'blogs.updated_at',
                    'blogs.tag',
                ]);
            })
            ->when(!empty($payload['in_category_ids']), function ($q) use ($payload) {
                $q->whereHas('category', fn($subQ) => $subQ->where('_id', $payload['in_category_ids']));
            })
            ->when(!empty($payload['not_in_category_ids']), function ($q) use ($payload) {
                $q->whereDoesntHave('category', fn($subQ) => $subQ->where('_id', $payload['not_in_category_ids']));
            })
            ->when(!empty($payload['isSpecial']), function ($q) use ($payload) {
                $q->whereHas('category', fn($subQ) => $subQ->where('isSpecial', $payload['isSpecial']));
            })
            ->when(true, function ($q) use ($payload) {
                if (!empty($payload['order_by']) && in_array($payload['order_by'], ['most_liked', 'most_viewed'])) {
                    if ($payload['order_by'] == 'most_liked') {
                        $q->orderBy('likes_count', "DESC");
                    } else {
                        $q->orderBy('views_count', "DESC");
                    }
                } else {
                    $q->orderBy($payload['order_by'] ?? 'id', $payload['order_direction'] ?? 'DESC');
                }
            })
            ->paginate(perPage: $payload['limit'] ?? 10, page: $payload['page'] ?? 1);

        if (use_cache()) {
            $cacheKey = make_key($payload, $user);
            return remember_cache(CacheKeys::LIST_BLOGS, $cacheKey, cache_time(), $query);
        }

        return $query();
    }
}
