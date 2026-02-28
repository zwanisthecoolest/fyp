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
            <h1 class="text-4xl font-bold text-gray-800 mb-2">Categories Management</h1>
            <p class="text-lg text-gray-600">Create, update, and manage your post categories</p>
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

            <!-- Categories List Section -->
            <div class="lg:col-span-2">
                <section class="bg-white/70 backdrop-blur-lg shadow-xl rounded-3xl p-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">All Categories</h2>

                    @if($categories->count())
                        <div class="space-y-3">
                            @foreach($categories as $category)
                                <div class="bg-gradient-to-r from-indigo-50 to-purple-50 border border-indigo-200 rounded-xl p-4 flex items-center justify-between hover:shadow-lg transition">
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-800">{{ $category->name }}</h3>
                                        <p class="text-sm text-gray-600">ID: {{ $category->id }}</p>
                                    </div>
                                    <div class="flex gap-3">
                                        <a
                                            href="?edit={{ $category->id }}"
                                            class="inline-flex items-center px-4 py-2 bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 transition font-medium"
                                        >
                                            ✎ Edit
                                        </a>
                                        @if (strtolower($category->name) !== 'miscellaneous')
                                            <form method="POST" action="{{ route('categories.destroy', $category) }}" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button
                                                    type="submit"
                                                    onclick="return confirm('Are you sure you want to delete this category?')"
                                                    class="inline-flex items-center px-4 py-2 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition font-medium"
                                                >
                                                    🗑 Delete
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-12">
                            <p class="text-gray-500 text-lg mb-4">No categories found yet.</p>
                            <p class="text-gray-600">Create your first category using the form on the right.</p>
                        </div>
                    @endif
                </section>

                <section class="bg-white/70 backdrop-blur-lg shadow-xl rounded-3xl p-8 mt-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Post Category Manager</h2>

                    @if($posts->count())
                        <div class="space-y-3">
                            @foreach($posts as $post)
                                <div class="bg-gradient-to-r from-gray-50 to-slate-50 border border-gray-200 rounded-xl p-4 flex items-center justify-between">
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-800">{{ $post->title }}</h3>
                                        <p class="text-sm text-gray-600">Post ID: {{ $post->id }} | Current Category ID: {{ $post->category_id }}</p>
                                    </div>

                                    <form method="POST" action="{{ route('posts.update-category', $post) }}" class="flex items-center gap-2">
                                        @csrf
                                        @method('PATCH')
                                        <input
                                            type="number"
                                            name="new_category_id"
                                            value="{{ $post->category_id }}"
                                            class="w-28 rounded-lg border border-gray-300 px-3 py-2 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-200"
                                            required
                                        />
                                        <button
                                            type="submit"
                                            class="rounded-lg bg-indigo-600 px-4 py-2 text-white font-semibold hover:bg-indigo-700 transition"
                                        >
                                            Update Category
                                        </button>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8 text-gray-600">No posts available to edit.</div>
                    @endif

                    @error('new_category_id')
                        <p class="mt-4 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </section>
            </div>

            <!-- Create/Edit Form Section -->
            <div class="lg:col-span-1">
                <section class="bg-white/70 backdrop-blur-lg shadow-xl rounded-3xl p-8 top-28">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">
                        @isset($editingCategory)
                            Edit Category
                        @else
                            Create New Category
                        @endisset
                    </h2>

                    <form method="POST" action="@isset($editingCategory) {{ route('categories.update', $editingCategory) }} @else {{ route('categories.store') }} @endisset" class="space-y-4">
                        @csrf
                        @isset($editingCategory)
                            @method('PATCH')
                        @endisset

                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Category Name</label>
                            <input
                                id="name"
                                name="name"
                                type="text"
                                value="@isset($editingCategory){{ $editingCategory->name }}@else{{ old('name') }}@endisset"
                                class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-200"
                                placeholder="Enter category name"
                                required
                            />
                            @error('name')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        @isset($editingCategory)
                            <div>
                                <label for="id" class="block text-sm font-medium text-gray-700 mb-2">Category ID</label>
                                <input
                                    id="id"
                                    name="id"
                                    type="number"
                                    value="{{ old('id', $editingCategory->id) }}"
                                    class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-200"
                                    placeholder="Enter category ID"
                                    required
                                />
                                @error('id')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                <p class="mt-1 text-xs text-gray-500">Current ID: {{ $editingCategory->id }}</p>
                            </div>
                        @endisset

                        <div class="flex gap-2">
                            <button
                                type="submit"
                                class="flex-1 rounded-lg bg-indigo-600 px-4 py-2 text-white font-semibold hover:bg-indigo-700 transition"
                            >
                                @isset($editingCategory)
                                    Update Category
                                @else
                                    Create Category
                                @endisset
                            </button>
                            @isset($editingCategory)
                                <a
                                    href="{{ route('categories') }}"
                                    class="flex-1 rounded-lg bg-gray-300 px-4 py-2 text-gray-800 font-semibold hover:bg-gray-400 transition text-center"
                                >
                                    Cancel
                                </a>
                            @endisset
                        </div>
                    </form>
                </section>
            </div>

        </div>
    </div>
</main>
@endsection