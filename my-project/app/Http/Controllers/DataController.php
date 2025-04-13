<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\File;
class DataController extends Controller
{
    public function index(Request $request)
    {
        $perPage = env('PAGINATION_PER_PAGE', 10);
        $visiblePages = env('PAGINATION_VISIBLE_PAGES', 3);
        $jsonFilePath = env('JSON_DATA_PATH');


        if (!$jsonFilePath) {
            abort(500, 'JSON file path is not defined in .env');
        }

        $filePath = base_path($jsonFilePath);

        if (!File::exists($filePath)) {
            abort(404, 'Data file not found at ' . $jsonFilePath);
        }

        $jsonData = collect(json_decode(File::get($filePath), true));

        $currentPage = LengthAwarePaginator::resolveCurrentPage();

        $paginatedData = new LengthAwarePaginator(
            $jsonData->forPage($currentPage, $perPage),
            $jsonData->count(),
            $perPage,
            $currentPage,
            [
                'path' => $request->url(),
                'query' => $request->query()
            ]
        );

        $paginatedData->onEachSide((int)($visiblePages - 1)/2);

        return view('items.index', [
            'items' => $paginatedData,
            'visiblePages' => $visiblePages
        ]);
    }
}
