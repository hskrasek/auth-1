@php
    /**
     * @var \Laravel\Passport\Client[] $clients
     */
@endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container mx-auto p-8">
            <div class="mb-4 sm:mb-6 lg:mb-8 px-4 sm:px-6 lg:px-8">
                <h2 class="text-2xl font-semibold mb-4 dark:text-gray-200">Create New OAuth 2.0 Client</h2>
                <form action="{{ route('dashboard.clients.store') }}" method="POST">
                    @csrf
                    <div class="flex flex-col sm:flex-row sm:items-center mb-4">
                        <label for="name" class="w-full sm:w-1/4 dark:text-white">Name:</label>
                        <input type="text" id="name" name="name" class="form-input w-full sm:w-3/4" required>
                        @error('name')
                        <p class="text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="flex flex-col sm:flex-row sm:items-center mb-4">
                        <label for="redirect" class="w-full sm:w-1/4 dark:text-white">Redirect URI:</label>
                        <input type="text" id="redirect" name="redirect" class="form-input w-full sm:w-3/4"
                               required>
                        @error('redirect')
                        <p class="text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Create Client
                    </button>
                </form>
            </div>

            <div class="pt-4 sm:pt-6 lg:pt-8 px-4 sm:px-6 lg:px-8 bg-gray-200 dark:bg-gray-800">
                <h2 class="text-2xl font-semibold mb-4 dark:text-gray-200">Existing OAuth 2.0 Clients</h2>
                <div class="mt-8 flow-root">
                    <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                            <table class="min-w-full divide-y divide-gray-300">
                                <thead>
                                <tr>
                                    <th scope="col"
                                        class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0 dark:text-white">
                                        ID
                                    </th>
                                    <th scope="col"
                                        class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 dark:text-white">
                                        Name
                                    </th>
                                    <th scope="col"
                                        class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 dark:text-white">
                                        Redirect URI
                                    </th>
                                    <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-0">
                                        <span class="sr-only">Edit/Delete</span>
                                    </th>
                                </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                @foreach($clients as $client)
                                    <tr>
                                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-0 dark:text-white">
                                            {{ $client->id }}
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 dark:text-white">
                                            {{ $client->name }}
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 dark:text-white">{{ $client->redirect }}</td>
                                        <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-0 flex flex-row">
                                            <a {{--href="{{ route('clients.edit', $client->id) }}"--}} class="rounded bg-indigo-600 px-2 py-1 mx-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Edit<span
                                                    class="sr-only">, {{ $client->name }}</span>
                                            </a>
                                            <form
                                                {{--action="{{ route('clients.destroy', $client->id) }}" --}} method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="rounded bg-rose-600 px-2 py-1 text-sm font-semibold text-white shadow-sm hover:bg-rose-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-rose-600">
                                                    Delete<span
                                                        class="sr-only">, {{ $client->name }}</span></button>
                                            </form>
                                    </tr>
                                    @isset($client->plainSecret)
                                        <tr class="border-none">
                                            <td colspan="4" class="p-2 bg-emerald-600 dark:text-white">
                                                Please copy your client secret now. You will not be able to see it again.<br />
                                                <span class="font-bold">
                                                    {{ $client->plainSecret }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endisset
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{--        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">--}}
        {{--            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">--}}
        {{--                <div class="p-6 text-gray-900 dark:text-gray-100">--}}
        {{--                    <div class="sm:flex sm:flex-row">--}}
        {{--                        <form class="sm:flex-auto sm:basis-1/2" action="{{ route('dashboard.clients.store') }}" method="POST">--}}
        {{--                            {{ csrf_field() }}--}}
        {{--                            <div class="space-y-12">--}}
        {{--                                <div class="border-b border-white/10 pb-12">--}}
        {{--                                    <h2 class="text-base font-semibold leading-7 text-white">Create a new client</h2>--}}
        {{--                                    <p class="mt-1 text-sm leading-6 text-gray-400">Create a new OAuth2 client for testing.</p>--}}

        {{--                                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">--}}
        {{--                                        <div class="sm:col-span-4">--}}
        {{--                                            <label for="name"--}}
        {{--                                                   class="block text-sm font-medium leading-6 text-white">Name</label>--}}
        {{--                                            <div class="mt-2">--}}
        {{--                                                <div--}}
        {{--                                                    class="flex rounded-md bg-white/5 ring-1 ring-inset ring-white/10 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-500">--}}
        {{--                                                    <input type="text" name="name" id="name"--}}
        {{--                                                           autocomplete="off"--}}
        {{--                                                           class="flex-1 border-0 bg-transparent py-1.5 pl-1 text-white focus:ring-0 sm:text-sm sm:leading-6"--}}
        {{--                                                           placeholder="Please enter a client name">--}}
        {{--                                                </div>--}}
        {{--                                            </div>--}}
        {{--                                        </div>--}}

        {{--                                        <div class="sm:col-span-4">--}}
        {{--                                            <label for="redirect"--}}
        {{--                                                   class="block text-sm font-medium leading-6 text-white">Redirect</label>--}}
        {{--                                            <div class="mt-2">--}}
        {{--                                                <div--}}
        {{--                                                    class="flex rounded-md bg-white/5 ring-1 ring-inset ring-white/10 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-500">--}}
        {{--                                                    <input type="text" name="redirect" id="redirect"--}}
        {{--                                                           autocomplete="off"--}}
        {{--                                                           class="flex-1 border-0 bg-transparent py-1.5 pl-1 text-white focus:ring-0 sm:text-sm sm:leading-6"--}}
        {{--                                                           placeholder="http://localhost:3000,https://localhost:3000">--}}
        {{--                                                </div>--}}
        {{--                                            </div>--}}
        {{--                                        </div>--}}
        {{--                                    </div>--}}
        {{--                                </div>--}}
        {{--                            </div>--}}

        {{--                            <div class="mt-6 flex items-center justify-end gap-x-6">--}}
        {{--                                <button type="submit"--}}
        {{--                                        class="rounded-md bg-indigo-500 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">--}}
        {{--                                    Save--}}
        {{--                                </button>--}}
        {{--                            </div>--}}
        {{--                        </form>--}}
        {{--                        <div class="sm:flex-auto sm:basis-1/2 px-4 sm:px-6 lg:px-8">--}}
        {{--                            <div class="sm:flex sm:items-center">--}}
        {{--                                <div class="sm:flex-auto">--}}
        {{--                                    <h1 class="text-base font-semibold leading-6 text-white mb-2">Clients</h1>--}}
        {{--                                </div>--}}
        {{--                            </div>--}}
        {{--                            <ul role="list" class="divide-y divide-gray-100 overflow-hidden bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl">--}}
        {{--                                @forelse($clients as $client)--}}
        {{--                                    <li class="relative flex justify-between gap-x-6 px-4 py-5 hover:bg-gray-50 sm:px-6">--}}
        {{--                                        <div class="flex min-w-0 gap-x-4">--}}
        {{--                                            <div class="min-w-0 flex-auto">--}}
        {{--                                                <p class="text-sm font-semibold leading-6 text-gray-900">--}}
        {{--                                                    <a href="#">--}}
        {{--                                                        <span class="absolute inset-x-0 -top-px bottom-0"></span>--}}
        {{--                                                        {{ $client->name }}--}}
        {{--                                                    </a>--}}
        {{--                                                </p>--}}
        {{--                                                @isset($client->plainSecret)--}}
        {{--                                                    <p class="text-sm font-semibold leading-6 text-gray-900">--}}
        {{--                                                        {{ $client->plainSecret }}--}}
        {{--                                                    </p>--}}
        {{--                                                @endisset--}}
        {{--                                                <div class="mt-1 flex text-xs leading-5 text-gray-500">--}}
        {{--                                                    <ul>--}}
        {{--                                                        @foreach(explode(',', $client->redirect) as $redirect)--}}
        {{--                                                            <li>{{ $redirect }}</li>--}}
        {{--                                                        @endforeach--}}
        {{--                                                    </ul>--}}
        {{--                                                </div>--}}
        {{--                                                <div class="hidden sm:flex sm:flex-col sm:items-end">--}}
        {{--                                                    <p class="mt-1 text-xs leading-5 text-gray-500">Created <time datetime="{{ $client->created_at?->toIso8601ZuluString() }}">{{ $client->created_at?->diffForHumans() }}</time></p>--}}
        {{--                                                </div>--}}
        {{--                                            </div>--}}
        {{--                                        </div>--}}
        {{--                                        <div class="flex shrink-0 items-center gap-x-4">--}}
        {{--                                            <svg class="h-5 w-5 flex-none text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">--}}
        {{--                                                <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />--}}
        {{--                                            </svg>--}}
        {{--                                        </div>--}}
        {{--                                    </li>--}}
        {{--                                @empty--}}
        {{--                                    <li class="relative flex justify-center gap-x-6 px-4 py-5 hover:bg-gray-50 sm:px-6">--}}
        {{--                                        <div class="text-center">--}}
        {{--                                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">--}}
        {{--                                                <path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />--}}
        {{--                                            </svg>--}}
        {{--                                            <h3 class="mt-2 text-sm font-semibold text-gray-900">No clients</h3>--}}
        {{--                                            <p class="mt-1 text-sm text-gray-500">Get started by creating a new client.</p>--}}
        {{--                                        </div>--}}
        {{--                                    </li>--}}
        {{--                                @endforelse--}}
        {{--                            </ul>--}}
        {{--                        </div>--}}
        {{--                    </div>--}}
        {{--                    --}}{{--                    <ul>--}}
        {{--                    --}}{{--                        @forelse($clients as $client)--}}
        {{--                    --}}{{--                            <li>--}}
        {{--                    --}}{{--                                <a href="{{ route('client.show', $client->id) }}">{{ $client->name }}</a>--}}
        {{--                    --}}{{--                            </li>--}}
        {{--                    --}}{{--                        @empty--}}
        {{--                    --}}{{--                            <li>No clients</li>--}}
        {{--                    --}}{{--                        @endforelse--}}
        {{--                    --}}{{--                    </ul>--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--        </div>--}}
    </div>
</x-app-layout>
