@extends('layouts.blog')

@section('content')
<main class="relative min-h-screen pt-5 pb-16">
    <div class="container mx-auto relative z-10 px-6">

        <!-- Header -->
        <div class="mb-10">
            <a href="{{ route('home') }}" class="inline-flex items-center text-indigo-600 hover:text-indigo-800 mb-4 transition">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Back to Home
            </a>
            <h1 class="text-4xl font-bold text-gray-800 mb-2">Posts Management</h1>
            <p class="text-lg text-gray-600">Create, update, and manage your blog posts</p>
        </div>

        <!-- Success Message -->
        @if (session('success'))
            <div class="mb-6 rounded-xl bg-green-100 px-6 py-4 text-green-800 border border-green-300">
                <strong>Success!</strong> {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="mb-6 rounded-xl bg-red-100 px-6 py-4 text-red-800 border border-red-300">
                <strong>Error:</strong> {{ session('error') }}
            </div>
        @endif

        <div class="grid lg:grid-cols-3 gap-8">

            <!-- Create/Edit Form Section -->
            <div class="lg:col-span-1">
                <section class="bg-white/70 backdrop-blur-lg shadow-xl rounded-3xl p-8 top-28">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">
                        @isset($editingPost)
                            Edit Post
                        @else
                            Create New Post
                        @endisset
                    </h2>

                    <form method="POST" action="@isset($editingPost) {{ route('posts.update', $editingPost) }} @else {{ route('posts.store') }} @endisset" class="space-y-4">
                        @csrf
                        @isset($editingPost)
                            @method('PATCH')
                        @endisset

                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Post Title</label>
                            <input
                                id="title"
                                name="title"
                                type="text"
                                value="@isset($editingPost){{ $editingPost->title }}@else{{ old('title') }}@endisset"
                                class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-200"
                                placeholder="Enter post title"
                                required
                            />
                            @error('title')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="text" class="block text-sm font-medium text-gray-700 mb-2">Post Content</label>
                            <textarea
                                id="text"
                                name="text"
                                rows="5"
                                class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-200"
                                placeholder="Enter post content"
                                required
                            >@isset($editingPost){{ $editingPost->text }}@else{{ old('text') }}@endisset</textarea>
                            @error('text')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Image URL</label>
                            <input
                                id="image"
                                name="image"
                                type="text"
                                value="@isset($editingPost){{ $editingPost->image }}@else{{ old('image') }}@endisset"
                                class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-200"
                                placeholder="https://example.com/image.jpg"
                            />
                            @error('image')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                            <select
                                id="category_id"
                                name="category_id"
                                class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-200"
                                required
                            >
                                <option value="">Select a category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" 
                                        @isset($editingPost)
                                            {{ $editingPost->category_id == $category->id ? 'selected' : '' }}
                                        @else
                                            {{ old('category_id') == $category->id ? 'selected' : '' }}
                                        @endisset
                                    >
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        @isset($editingPost)
                            <div>
                                <label for="id" class="block text-sm font-medium text-gray-700 mb-2">Post ID</label>
                                <input
                                    id="id"
                                    name="id"
                                    type="number"
                                    value="{{ old('id', $editingPost->id) }}"
                                    class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-200"
                                    placeholder="Enter post ID"
                                    required
                                />
                                @error('id')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                <p class="mt-1 text-xs text-gray-500">Current ID: {{ $editingPost->id }}</p>
                            </div>
                        @endisset

                        <div class="flex gap-2">
                            <button
                                type="submit"
                                class="flex-1 rounded-lg bg-indigo-600 px-4 py-2 text-white font-semibold hover:bg-indigo-700 transition"
                            >
                                @isset($editingPost)
                                    Update Post
                                @else
                                    Create Post
                                @endisset
                            </button>
                            @isset($editingPost)
                                <a
                                    href="{{ route('posts.manage') }}"
                                    class="flex-1 rounded-lg bg-gray-300 px-4 py-2 text-gray-800 font-semibold hover:bg-gray-400 transition text-center"
                                >
                                    Cancel
                                </a>
                            @endisset
                        </div>
                    </form>
                </section>
            </div>

            <!-- Posts List Section -->
            <div class="lg:col-span-2">
                <section class="bg-white/70 backdrop-blur-lg shadow-xl rounded-3xl p-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">All Posts</h2>

                    @if($posts->count())
                        <div class="space-y-3">
                            @foreach($posts as $post)
                                <div class="bg-gradient-to-r from-indigo-50 to-purple-50 border border-indigo-200 rounded-xl p-4 hover:shadow-lg transition">
                                    <div class="flex items-start gap-4">
                                        @if($post->image)
                                            <div class="flex-shrink-0">
                                                <img 
                                                    src="{{ $post->image }}" 
                                                    alt="{{ $post->title }}"
                                                    class="w-20 h-20 object-cover rounded-lg border border-indigo-300"
                                                />
                                            </div>
                                        @endif
                                        <div class="flex-1">
                                            <h3 class="text-lg font-semibold text-gray-800">{{ $post->title }}</h3>
                                            <p class="text-sm text-gray-600 mt-1">{{ Str::limit($post->text, 100) }}</p>
                                            <p class="text-xs text-gray-500 mt-2">
                                                ID: {{ $post->id }} | Category ID: {{ $post->category_id }}
                                            </p>
                                        </div>
                                        <div class="flex gap-3 flex-shrink-0">
                                            <a
                                                href="?edit={{ $post->id }}"
                                                class="inline-flex items-center px-4 py-2 bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 transition font-medium"
                                            >
                                                ✎ Edit
                                            </a>
                                            <form method="POST" action="{{ route('posts.destroy', $post) }}" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button
                                                    type="submit"
                                                    onclick="return confirm('Are you sure you want to delete this post?')"
                                                    class="inline-flex items-center px-4 py-2 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition font-medium"
                                                >
                                                    🗑 Delete
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-12">
                            <p class="text-gray-500 text-lg mb-4">No posts found yet.</p>
                            <p class="text-gray-600">Create your first post using the form on the left.</p>
                        </div>
                    @endif
                </section>
            </div>

        </div>
    </div>
</main>
@endsection
