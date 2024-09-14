<?php

namespace App\Http\Middleware;

use App\Models\DiabloClass;
use Illuminate\Http\Request;
use Inertia\Middleware;
use Tighten\Ziggy\Ziggy;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): string|null
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        return [
            ...parent::share($request),
            'appName' => config('app.name'),
            'classes' => DiabloClass::get(['id', 'name']),
            'auth' => [
                'user' => $request->user(),
            ],
            'ziggy' => fn() => [
                ...(new Ziggy)->toArray(),
                'location' => $request->url(),
            ],
            'toast' => [
                'type' => fn() => $request->session()->get('toast.type'),
                'title' => fn() => $request->session()->get('toast.title'),
                'message' => fn() => $request->session()->get('toast.message'),
                'duration' => fn() => $request->session()->get('toast.duration'),
            ],
        ];
    }
}
