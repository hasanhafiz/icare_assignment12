<?php

namespace App\Http\Controllers;

use App\Models\Url;
use App\Http\Controllers\Controller;

class UrlController extends Controller
{    
    public function redirect($code)
    {
        
        $url = Url::where('short_code', $code)->firstOrFail();
        // dd( $url );
        if ( $url ) {
            $url->increment('views_count', 1);
        }
        return redirect($url->original_url);
    }
}
