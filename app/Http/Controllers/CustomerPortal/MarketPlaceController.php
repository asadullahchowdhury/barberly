<?php

namespace App\Http\Controllers\CustomerPortal;

use App\Http\Controllers\Controller;
use App\Services\MarketplaceService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MarketPlaceController extends Controller
{
    private MarketplaceService $marketplaceService;

    public function __construct(MarketplaceService $marketplaceService)
    {
        $this->marketplaceService = $marketplaceService;
    }

    public function index(Request $request): JsonResponse
    {
        $keyword = $request->input('keyword');
        $type = $request->input('type');

        $marketplaces = $this->marketplaceService->getAllMarketPlace($keyword,$type);
        return response()->json($marketplaces, 200);
    }

    public function show($id)
    {
        $marketplace = $this->marketplaceService->getMarketplaceById($id);
        return response()->json($marketplace, 200);
    }

}
