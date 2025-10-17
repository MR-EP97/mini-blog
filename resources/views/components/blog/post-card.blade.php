@props(['post'])

<article class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">

    {{-- Post Image --}}
    <div class="relative h-48 bg-gradient-to-br from-blue-500 to-purple-600">
        <div class="absolute inset-0 flex items-center justify-center">
            <svg class="w-16 h-16 text-white opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
        </div>

        {{-- Status Badge --}}
        <x-post-status-badge :status="$post['status']"/>
    </div>

    {{-- Post Content --}}
    <div class="p-6">

        {{-- Post Meta --}}
        <div class="flex items-center text-sm text-gray-500 mb-3">
            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            <span>{{ \Carbon\Carbon::parse($post['created_at'])->format('Y/m/d') }}</span>

            <span class="mx-2">•</span>

            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
            </svg>
            <span>{{ $post['user']['name'] }}</span>
        </div>

        {{-- Post Title --}}
        <h2 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2 hover:text-blue-600 transition-colors">
            <a href="{{ route('posts.show', $post['slug']) }}">
                {{ Str::limit(strip_tags($post['title']), 35) }}
            </a>
        </h2>


        {{-- Post Excerpt --}}
        <p class="text-gray-600 text-sm line-clamp-3 mb-4 leading-relaxed">
            {{ Str::limit(strip_tags($post['content']), 150) }}
        </p>

        {{-- Read More Button --}}
        <a
            href="{{ route('posts.show', $post['slug']) }}"
            class="inline-flex items-center text-blue-600 hover:text-blue-700 font-medium text-sm transition-colors"
        >
            ادامه مطلب
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
        </a>
    </div>

    {{-- Post Footer --}}
    <div class="px-6 py-3 bg-gray-50 border-t border-gray-100">
        <div class="flex items-center justify-between text-xs text-gray-500">
            <span class="flex items-center">
                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                </svg>

                <span class="text-gray-600 text-sm">
                    {{ $post['category']['name'] }}
                </span>
            </span>
            <span>ID: {{ $post['id'] }}</span>
        </div>
    </div>
</article>
