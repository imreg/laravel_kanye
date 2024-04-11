<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\QuoteResource;
use App\Helpers\QuotesHelper;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Cache;

class QuoteController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $quotes = QuotesHelper::shuffled(Cache::get('quotes'), config('quotes.count'));
        return QuoteResource::collection($quotes);
    }
}
