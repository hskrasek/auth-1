<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class APIStatuses extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, int $code): Response
    {
        if ($code === Response::HTTP_NO_CONTENT) {
            return response()->noContent();
        }

        return response(content: Response::$statusTexts[$code] ?? '', status: $code);
    }
}
