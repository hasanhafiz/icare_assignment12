<?php

namespace App\Http\Controllers\Api\V2;

use App\Models\Url;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UrlController extends Controller
{
    public function createShortUrl(Request $request)
    {
        // return auth()->user()->id;
        // Validate the URL
        $request->validate(['url' => 'required|url']);
        
        // Check if URL already exists
        $existingUrl = Url::where('original_url', $request->url)->first();
        if ($existingUrl) {
            return response()->json([
                'short_url' => url('/' . $existingUrl->short_code)
            ]);
        }

        // Generate a unique short code
        do {
            $shortCode = Str::random(6);
        } while (Url::where('short_code', $shortCode)->exists());
        
        // Store the URL
        $url = Url::create([
            'original_url' => $request->url,
            'short_code' => $shortCode,
            'user_id' => auth()->user()->id
        ]);
        
        return response()->json([
            'short_url' => url('/' . $shortCode)
        ]);
    }
    
    public function getUrls(){
        return Url::select('original_url', 'short_code', 'views_count')->where('user_id', '=', auth()->user()->id )->get();
    }
    
}
