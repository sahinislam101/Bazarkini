<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use Illuminate\Foundation\Inspiring;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     */
    public function share(Request $request): array
    {
        [$message, $author] = str(Inspiring::quotes()->random())->explode('-');

        return array_merge(parent::share($request), [
            'name' => config('app.name'),

            // ✅ Random quote
            'quote' => [
                'message' => trim($message),
                'author' => trim($author),
            ],

            // ✅ Auth info
            'auth' => [
                'user' => $request->user(),
            ],

            // ✅ Sidebar state
            'sidebarOpen' => !$request->hasCookie('sidebar_state')
                || $request->cookie('sidebar_state') === 'true',

            // ✅ Cart item count (for logged-in users)
            'cartCount' => Auth::check()
                ? Cart::where('user_id', Auth::id())->count()
                : 0,
        ]);
    }
}
