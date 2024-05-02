<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Laravel\Passport\ClientRepository;
use Laravel\Passport\Http\Rules\RedirectRule;

class CreateClient extends Controller
{
    public function __construct(readonly private ClientRepository $clients, readonly private RedirectRule $redirectRule)
    {
    }

    public function __invoke(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|max:191',
            'redirect' => ['required', $this->redirectRule],
            'confidential' => 'boolean',
        ]);

        $client = $this->clients->create(
            $request->user()->getAuthIdentifier(), $request->name, $request->redirect,
            null, false, false, (bool) $request->input('confidential', true)
        );

        return redirect()
            ->route('dashboard')
            ->with('success', 'Client created successfully.')
            ->with('created_client', ['plainSecret' => $client->plainSecret] + $client->toArray());
    }
}
