<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShortLink;
use App\Services\UrlShortener;
use Illuminate\Support\Facades\Validator;

class ShortLinkController extends Controller
{
    public function short(Request $request, UrlShortener $shortener)
    {
        $validator = Validator::make($request->all(), [ 
            'url' => 'required|url|max:512',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()->toArray()
            ], 200);
        }

        $link = $shortener->shorten($request->url);
        return response()->json([
            'status' => 'success',
            'shortLink' => $link->short_link,
        ], 200);
    }

    public function goTo(string $shortLink)
    {
        $record = ShortLink::where('short_link', $shortLink)->firstOrFail();
        return redirect($record->source_link);
    }
}
