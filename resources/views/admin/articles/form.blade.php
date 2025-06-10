@extends('layouts.app')

@section('title', (isset($article) ? 'Edit' : 'Create') . ' Article - Financial Planner')

@section('header', (isset($article) ? 'Edit' : 'Create') . ' Article')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow">
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-800">{{ isset($article) ? 'Edit Article' : 'Create New Article' }}</h2>
        </div>

        <form action="{{ isset($article) ? route('admin.articles.update', $article) : route('admin.articles.store') }}" 
              method="POST" 
              enctype="multipart/form-data"
              class="p-6">
            @csrf
            @if(isset($article))
                @method('PUT')
            @endif

            <div class="space-y-6">
                <!-- Title -->
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                    <input type="text" 
                           name="title" 
                           id="title" 
                           value="{{ old('title', $article->title ?? '') }}" 
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                           required>
                    @error('title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Category -->
                <div>
                    <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
                    <select name="category" 
                            id="category" 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            required>
                        <option value="">Select a category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category }}" {{ old('category', $article->category ?? '') === $category ? 'selected' : '' }}>
                                {{ $category }}
                            </option>
                        @endforeach
                    </select>
                    @error('category')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Author -->
                <div>
                    <label for="author" class="block text-sm font-medium text-gray-700">Author</label>
                    <input type="text" 
                           name="author" 
                           id="author" 
                           value="{{ old('author', $article->author ?? auth()->user()->name) }}" 
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                           required>
                    @error('author')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Image -->
                <div>
                    <label for="image" class="block text-sm font-medium text-gray-700">Featured Image</label>
                    @if(isset($article) && $article->image_url)
                        <div class="mt-2">
                            <img src="{{ $article->image_url }}" alt="Current image" class="h-32 w-auto object-cover rounded-lg">
                        </div>
                    @endif
                    <input type="file" 
                           name="image" 
                           id="image" 
                           accept="image/*"
                           class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                    @error('image')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Content -->
                <div>
                    <label for="content" class="block text-sm font-medium text-gray-700">Content</label>
                    <textarea name="content" 
                              id="content" 
                              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                              rows="20"
                              required>{{ old('content', $article->content ?? '') }}</textarea>
                    @error('content')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Status -->
                <div>
                    <label class="inline-flex items-center">
                        <input type="checkbox" 
                               name="is_published" 
                               value="1" 
                               {{ old('is_published', $article->is_published ?? false) ? 'checked' : '' }}
                               class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <span class="ml-2 text-sm text-gray-600">Publish immediately</span>
                    </label>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end space-x-3">
                    <a href="{{ route('admin.articles.index') }}" 
                       class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Cancel
                    </a>
                    <button type="submit" 
                            class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        {{ isset($article) ? 'Update Article' : 'Create Article' }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: '#content',
        plugins: 'lists link image table code help wordcount',
        toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | link image | table | code',
        height: 500,
        images_upload_url: '{{ route("admin.articles.upload-image") }}',
        images_upload_handler: function (blobInfo, success, failure) {
            var xhr, formData;
            xhr = new XMLHttpRequest();
            xhr.withCredentials = false;
            xhr.open('POST', '{{ route("admin.articles.upload-image") }}');
            xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
            xhr.onload = function() {
                var json;
                if (xhr.status != 200) {
                    failure('HTTP Error: ' + xhr.status);
                    return;
                }
                json = JSON.parse(xhr.responseText);
                if (!json || typeof json.location != 'string') {
                    failure('Invalid JSON: ' + xhr.responseText);
                    return;
                }
                success(json.location);
            };
            formData = new FormData();
            formData.append('file', blobInfo.blob(), blobInfo.filename());
            xhr.send(formData);
        }
    });
</script>
@endpush 