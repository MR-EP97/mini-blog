<header class="bg-white shadow-sm border-b border-gray-200">
    <div class="container mx-auto px-4 py-6">
        <div class="flex items-center justify-between">
            <!-- Logo & Title -->
            <div class="flex items-center space-x-4 space-x-reverse">
                <a href="{{ route('blog.index') }}" class="flex items-center">
                    <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                    <span class="mr-3 text-2xl font-bold text-gray-900">بلاگ من</span>
                </a>
            </div>

            <!-- Navigation -->
            <nav class="hidden md:flex items-center space-x-6 space-x-reverse">
                <a href="{{ route('blog.index') }}"
                   class="text-gray-700 hover:text-blue-600 transition-colors font-medium">
                    خانه
                </a>
                <a href="#" class="text-gray-700 hover:text-blue-600 transition-colors font-medium">
                    دسته‌بندی‌ها
                </a>
                <a href="#" class="text-gray-700 hover:text-blue-600 transition-colors font-medium">
                    درباره ما
                </a>
                <a href="#" class="text-gray-700 hover:text-blue-600 transition-colors font-medium">
                    تماس
                </a>
                <a href="{{ route('posts.create') }}"
                   class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-medium flex items-center">
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    ایجاد پست
                </a>
            </nav>

            <!-- Mobile Menu Button -->
            <button class="md:hidden text-gray-700 hover:text-blue-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>
    </div>
</header>
