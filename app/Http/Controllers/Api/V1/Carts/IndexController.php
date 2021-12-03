<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Carts;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\CartResource;
use Symfony\Component\HttpFoundation\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use JustSteveKing\StatusCode\Http;

class IndexController extends Controller
{
    public function __invoke(Request $request): Response
    {
        if (! auth()->check() || ! auth()->user()->cart()->count()) {
            return new Response(
                null,
                Http::NO_CONTENT,
            );
        }

        return new JsonResponse(
            data: new CartResource(
                resource: auth()->user()->cart,
            ),
            status: Http::OK,
        );
    }
}
