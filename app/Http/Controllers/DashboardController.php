<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Laravel\Passport\ClientRepository;

class DashboardController extends Controller
{
    public function __construct(private readonly ClientRepository $clients)
    {
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): View
    {
        $userId = $request->user()->getAuthIdentifier();

        $clients = $this->clients->activeForUser($userId)
            ->sortByDesc('created_at');

        if ($request->session()->has('created_client') &&
            $clients->first()->id === $request->session()->get('created_client')['id']
        ) {
            $clients->first()->plainSecret = $request->session()->get('created_client')['plainSecret'];
        }

        return view('dashboard', compact('clients'));
    }
}
