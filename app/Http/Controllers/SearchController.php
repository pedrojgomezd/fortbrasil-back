<?php

namespace App\Http\Controllers;

use App\Http\Resources\Establishments;
use App\Models\Establishment;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function __invoke($q)
    {
        $establishments = Establishment::whereHas('address', function (Builder $query) use ($q) {
            $query->where('localidade', '=', $q);
        })->with('address')->get();

        return response()->json(
            Establishments::collection($establishments)
        );
    }
}
