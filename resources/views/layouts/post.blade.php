@extends('layouts.blog')

@section('content')
<main class="relative min-h-screen py-16 ">

    <div class="container mx-auto relative z-10 px-6">

        <!-- Blog Article Section -->
        <section class="max-w-4xl w-full mx-auto bg-white/70 backdrop-blur-lg shadow-xl rounded-3xl p-10 lg:p-16">

            <!-- Title -->
            <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-6 text-center">
                {{ $post->title }}
            </h1>
            <!-- Publish Date -->
            <p class="text-gray-500 text-sm text-center mb-6">
                Published on <span class="font-semibold">{{ $post->created_at->format('F j, Y') }}</span>
            </p>

            <!-- Post Image -->
            <div class="mb-8 rounded-2xl overflow-hidden shadow-md">
                <img src="@if(str_starts_with($post->image, 'http') || str_starts_with($post->image, '//')){{ $post->image }}@else{{ asset('storage/' . $post->image) }}@endif" 
                     alt="Post Image" 
                     class="w-full h-64 md:h-80 lg:h-96 object-cover">
            </div>

            <!-- Post Content -->
            <div class="text-gray-800 space-y-6 leading-relaxed text-base md:text-lg">
                {!! nl2br(e($post->text)) !!}
            </div>

            <!-- Back Button -->
            <div class="mt-12 flex justify-center">
                <a href="{{ route('home') }}"
                   class="inline-block bg-white text-indigo-600 font-semibold px-8 py-3 rounded-2xl shadow hover:shadow-md hover:scale-105 transition transform">
                    ← Back to Home
                </a>
            </div>

        </section>
    </div>
</main>
@endsection