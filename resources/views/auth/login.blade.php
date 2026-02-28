@extends('layouts.blog')

@section('content')
<main class="relative min-h-screen pt-40 pb-16">
    <div class="container mx-auto relative z-10 px-6">
        <section class="w-full bg-white/70 backdrop-blur-lg shadow-xl rounded-3xl p-12 lg:p-20">
            <h1 class="text-2xl font-bold mb-6">Login</h1>

            @if (session('status'))
                <div class="mb-6 rounded-xl bg-green-100 px-4 py-3 text-green-800">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input
                        id="email"
                        name="email"
                        type="email"
                        value="{{ old('email') }}"
                        class="mt-2 w-full rounded-xl border border-gray-300 px-4 py-3 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-200"
                        required
                        autofocus
                        autocomplete="username"
                    />
                    @error('email')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input
                        id="password"
                        name="password"
                        type="password"
                        class="mt-2 w-full rounded-xl border border-gray-300 px-4 py-3 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-200"
                        required
                        autocomplete="current-password"
                    />
                    @error('password')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center gap-2 text-sm text-gray-600">
                    <input
                        id="remember"
                        name="remember"
                        type="checkbox"
                        class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                    />
                    <label for="remember">Remember me</label>
                </div>

                <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                    @if (Route::has('password.request'))
                        <a class="text-sm text-gray-600 hover:text-indigo-600" href="{{ route('password.request') }}">
                            Forgot your password?
                        </a>
                    @endif

                    <button
                        type="submit"
                        class="w-full sm:w-auto rounded-xl bg-indigo-600 px-6 py-3 text-white font-semibold shadow-lg shadow-indigo-200 hover:bg-indigo-700 transition"
                    >
                        Log in
                    </button>
                </div>
            </form>
        </section>
    </div>
</main>
@endsection
