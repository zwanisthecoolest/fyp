@extends('layouts.plain')
 
@section('content')
<main class="relative min-h-screen pt-40 pb-16">

    <div class="container mx-auto relative z-10 px-6">

        <!-- Blog Article Section -->
        <section class="w-full bg-white/70 backdrop-blur-lg shadow-xl rounded-3xl p-12 lg:p-20">

            <h1 class="text-2xl font-bold mb-6">Sign In</h1>

            @if (session('success'))
                <div class="mb-6 rounded-xl bg-green-100 px-4 py-3 text-green-800">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('signin.store') }}" class="space-y-5">
                @csrf

                <div>
                    <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                    <input
                        id="username"
                        name="username"
                        type="text"
                        value="{{ old('username') }}"
                        class="mt-2 w-full rounded-xl border border-gray-300 px-4 py-3 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-200"
                        required
                    />
                    @error('username')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input
                        id="email"
                        name="email"
                        type="email"
                        value="{{ old('email') }}"
                        class="mt-2 w-full rounded-xl border border-gray-300 px-4 py-3 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-200"
                        required
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
                    />
                    @error('password')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <button
                    type="submit"
                    class="w-full rounded-xl bg-indigo-600 px-4 py-3 text-white font-semibold shadow-lg shadow-indigo-200 hover:bg-indigo-700 transition"
                >
                    Create Account
                </button>
            </form>
        </section>
    </main>
@endsection