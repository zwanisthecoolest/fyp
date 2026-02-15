@extends('layouts.blog')
 
@section('content')
<main class="container mx-auto px-6 mt-10">
    <div class="flex flex-col lg:flex-row gap-8">

        <!-- Blog Posts Section -->
        <section class="lg:w-3/4 space-y-10">

            <h2 class="text-3xl font-bold text-gray-800 tracking-tight">
                Latest <span class="text-indigo-600">Posts</span>
            </h2>

            @if($posts->count())

                <!--  Featured Latest Post -->
                @php $latest = $posts->first(); @endphp
                <article class="bg-gradient-to-br from-indigo-600 to-purple-600 text-white rounded-3xl shadow-xl p-8 flex flex-col md:flex-row gap-8">

                    <div class="md:w-1/2">
                        <img src="{{ $latest->image }}" 
                             alt="Post Image"
                             class="w-full h-64 object-cover rounded-2xl shadow-lg">
                    </div>

                    <div class="md:w-1/2 flex flex-col justify-between">
                        <div>
                            <span class="text-sm uppercase tracking-widest text-indigo-200">
                                Featured Post
                            </span>

                            <h3 class="text-3xl font-bold mt-3 mb-4 leading-tight">
                                <a href="{{ route('post.show', $latest) }}">
                                    {{ $latest->title }}
                                </a>
                            </h3>

                            <p class="text-indigo-100 leading-relaxed">
                                {{ Str::limit($latest->text, 200) }}
                            </p>
                        </div>

                        <div class="mt-6">
                            <a href="{{ route('post.show', $latest) }}"
                               class="inline-block bg-white text-indigo-600 font-semibold px-6 py-3 rounded-xl shadow hover:shadow-lg hover:scale-105 transition">
                                Read Full Article →
                            </a>
                        </div>
                    </div>

                </article>

                <!-- 📰 Other Posts -->
                <div class="space-y-8">
                    @foreach($posts->skip(1) as $post)
                    <article class="bg-white/80 backdrop-blur-lg border border-gray-200 rounded-2xl shadow-sm hover:shadow-lg transition duration-300 p-6 flex flex-col md:flex-row gap-6">

                        <div class="md:w-1/4">
                            <img src="{{ $post->image }}" 
                                 alt="Post Image" 
                                 class="w-full h-40 object-cover rounded-xl">
                        </div>

                        <div class="md:w-3/4 flex flex-col justify-between">
                            <div>
                                <h3 class="text-xl font-semibold text-gray-800 mb-2 hover:text-indigo-600 transition">
                                    <a href="{{ route('post.show', $post) }}">
                                        {{ $post->title }}
                                    </a>
                                </h3>

                                <p class="text-gray-600 leading-relaxed">
                                    {{ Str::limit($post->text, 120) }}
                                </p>
                            </div>

                            <div class="mt-4">
                                <a href="{{ route('post.show', $post) }}"
                                   class="inline-block text-sm font-medium text-indigo-600 hover:text-indigo-800 transition">
                                    Read More →
                                </a>
                            </div>
                        </div>

                    </article>
                    @endforeach
                </div>

            @endif

        </section>

        <!-- Sidebar -->
        <aside class="lg:w-1/4">
            <div class="bg-white/80 backdrop-blur-lg border border-gray-200 rounded-2xl shadow-sm p-6 top-28">

                <h2 class="text-2xl font-semibold text-gray-800 mb-6">
                    Categories
                </h2>

                <ul class="space-y-3">
                    @foreach($categories as $category)
                    <li>
                        <a href="/?category_id={{ $category->id }}"
                           class="block px-4 py-2 rounded-lg text-gray-600 hover:bg-indigo-50 hover:text-indigo-600 transition">
                            {{ $category->name }}
                        </a>
                    </li>
                    @endforeach
                </ul>

            </div>
        </aside>

    </div>
</main>
@endsection