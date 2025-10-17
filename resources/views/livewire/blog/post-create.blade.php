<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">

        {{-- Breadcrumb --}}
        <nav class="mb-6">
            <ol class="flex items-center space-x-2 space-x-reverse text-sm text-gray-600">
                <li>
                    <a href="{{ route('blog.index') }}" class="hover:text-blue-600 transition-colors">خانه</a>
                </li>
                <li>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </li>
                <li>
                    <a href="{{ route('blog.index') }}" class="hover:text-blue-600 transition-colors">وبلاگ</a>
                </li>
                <li>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </li>
                <li class="text-gray-900 font-medium">ایجاد پست جدید</li>
            </ol>
        </nav>

        {{-- Page Header --}}
        <div class="mb-8">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-2">ایجاد پست جدید</h1>
            <p class="text-gray-600">فرم زیر را برای ایجاد یک پست جدید تکمیل کنید</p>
        </div>

        {{-- Success Message --}}
        @if($successMessage)
            <div class="mb-6 bg-green-50 border border-green-200 rounded-lg p-4 flex items-start">
                <svg class="w-6 h-6 text-green-600 ml-3 flex-shrink-0" fill="none" stroke="currentColor"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <div>
                    <p class="text-green-800 font-medium">{{ $successMessage }}</p>
                    <p class="text-green-700 text-sm mt-1">در حال انتقال به صفحه لیست پست‌ها...</p>
                </div>
                <button wire:click="clearMessages" class="mr-auto text-green-600 hover:text-green-800">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        @endif

        {{-- Error Message --}}
        @if($errorMessage)
            <div class="mb-6 bg-red-50 border border-red-200 rounded-lg p-4 flex items-start">
                <svg class="w-6 h-6 text-red-600 ml-3 flex-shrink-0" fill="none" stroke="currentColor"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <div>
                    <p class="text-red-800 font-medium">{{ $errorMessage }}</p>
                </div>
                <button wire:click="clearMessages" class="mr-auto text-red-600 hover:text-red-800">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        @endif

        {{-- Form --}}
        <form wire:submit.prevent="submit" class="bg-white rounded-lg shadow-lg p-8">

            {{-- Title Field --}}
            <div class="mb-6">
                <label for="title" class="block text-sm font-medium text-gray-900 mb-2">
                    عنوان پست <span class="text-red-500">*</span>
                </label>
                <input
                    type="text"
                    id="title"
                    wire:model.debounce.300ms="title"
                    class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all @error('title') border-red-500 @else border-gray-300 @enderror"
                    placeholder="عنوان پست خود را وارد کنید..."
                >
                @error('title')
                <p class="mt-2 text-sm text-red-600 flex items-center">
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    {{ $message }}
                </p>
                @enderror
            </div>

            {{-- Category Field --}}
            <div class="mb-6">
                <label for="category_id" class="block text-sm font-medium text-gray-900 mb-2">
                    دسته‌بندی <span class="text-red-500">*</span>
                </label>
                <select
                    id="category_id"
                    wire:model="category_id"
                    class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all @error('category_id') border-red-500 @else border-gray-300 @enderror"
                >
                    <option value="">دسته‌بندی را انتخاب کنید</option>
                    @foreach($categories as $category)
                        <option value="{{ $category['id'] }}">
                            {{ str_repeat('— ', $category['depth']) }}{{ $category['name'] }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                <p class="mt-2 text-sm text-red-600 flex items-center">
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    {{ $message }}
                </p>
                @enderror
            </div>

            {{-- Content Field --}}
            <div class="mb-6">
                <label for="content" class="block text-sm font-medium text-gray-900 mb-2">
                    محتوای پست <span class="text-red-500">*</span>
                </label>
                <textarea
                    id="content"
                    wire:model.debounce.500ms="content"
                    rows="12"
                    class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all resize-y {{ $errors->has('content') ? 'border-red-500' : 'border-gray-300' }}"
                    placeholder="محتوای پست خود را بنویسید..."
                ></textarea>
                <div class="flex items-center justify-between mt-2">
                    @if($errors->has('content'))
                        <p class="text-sm text-red-600 flex items-center">
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            {{ $errors->first('content') }}
                        </p>
                    @else
                        <span></span>
                    @endif
                    <span class="text-sm text-gray-500">{{ strlen($content) }} کاراکتر</span>
                </div>
            </div>

            {{-- Status and Published Date --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">

                {{-- Status Field --}}
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-900 mb-2">
                        وضعیت <span class="text-red-500">*</span>
                    </label>
                    <select
                        id="status"
                        wire:model="status"
                        class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all @error('status') border-red-500 @else border-gray-300 @enderror"
                    >
                        <option value="draft">پیش‌نویس</option>
                        <option value="published">منتشر شده</option>
                        <option value="archived">آرشیو شده</option>

                    </select>
                    @error('status')
                    <p class="mt-2 text-sm text-red-600 flex items-center">
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        {{ $message }}
                    </p>
                    @enderror
                </div>

                {{-- Published Date Field --}}
                <div>
                    <label for="published_at" class="block text-sm font-medium text-gray-900 mb-2">
                        تاریخ انتشار (اختیاری)
                    </label>
                    <input
                        type="datetime-local"
                        id="published_at"
                        wire:model="published_at"
                        class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all {{ $errors->has('published_at') ? 'border-red-500' : 'border-gray-300' }}"
                    >
                    @if($errors->has('published_at'))
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            {{ $errors->first('published_at') }}
                        </p>
                    @endif
                </div>
            </div>

            {{-- Form Actions --}}
            <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                <a
                    href="{{ route('blog.index') }}"
                    class="inline-flex items-center px-6 py-3 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors"
                >
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    انصراف
                </a>

                <button
                    type="submit"
                    wire:loading.attr="disabled"
                    wire:target="submit"
                    class="inline-flex items-center px-8 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors disabled:opacity-50 disabled:cursor-not-allowed"
                >
                    <span wire:loading.remove wire:target="submit">
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        ایجاد پست
                    </span>
                    <span wire:loading wire:target="submit" class="flex items-center">
                        <svg class="animate-spin h-5 w-5 ml-2" xmlns="http://www.w3.org/2000/svg" fill="none"
                             viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor"
                                  d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        در حال ارسال...
                    </span>
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
    <script>
        window.addEventListener('post-created', event => {
            setTimeout(() => {
                window.location.href = "{{ route('blog.index') }}";
            }, 2000);
        });
    </script>
@endpush
