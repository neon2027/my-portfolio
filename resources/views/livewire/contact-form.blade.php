<div>
    @if($submitted)
        <div class="flex flex-col items-center justify-center py-10 text-center space-y-4">
            <div class="w-16 h-16 rounded-full bg-green-100 dark:bg-green-900/30 flex items-center justify-center">
                {{-- Heroicons: check-circle --}}
                <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                </svg>
            </div>
            <h3 class="text-xl font-bold text-[#1b1b18] dark:text-white">Message Sent!</h3>
            <p class="text-sm text-gray-500 dark:text-gray-400 max-w-xs">
                Thanks for reaching out. I'll get back to you as soon as possible.
            </p>
            <button wire:click="resetForm"
                class="mt-2 text-sm font-semibold text-[#DC2626] hover:underline focus:outline-none">
                Send another message
            </button>
        </div>
    @else
        <form wire:submit="submit" novalidate class="space-y-4">
            {{-- Name --}}
            <div>
                <label for="cf-name" class="block text-sm font-semibold text-[#1b1b18] dark:text-white mb-1">
                    Full Name <span class="text-[#DC2626]">*</span>
                </label>
                <input
                    wire:model.live.debounce.400ms="name"
                    id="cf-name"
                    type="text"
                    autocomplete="name"
                    placeholder="John Doe"
                    class="w-full px-4 py-2.5 rounded-lg border text-sm bg-white dark:bg-[#111] dark:text-white
                           transition focus:outline-none focus:ring-2 focus:ring-[#DC2626]/50
                           @error('name') border-[#DC2626] @else border-gray-200 dark:border-gray-700 @enderror"
                />
                @error('name')
                    <p class="mt-1 text-xs text-[#DC2626]">{{ $message }}</p>
                @enderror
            </div>

            {{-- Email --}}
            <div>
                <label for="cf-email" class="block text-sm font-semibold text-[#1b1b18] dark:text-white mb-1">
                    Email Address <span class="text-[#DC2626]">*</span>
                </label>
                <input
                    wire:model.live.debounce.400ms="email"
                    id="cf-email"
                    type="email"
                    autocomplete="email"
                    placeholder="john@example.com"
                    class="w-full px-4 py-2.5 rounded-lg border text-sm bg-white dark:bg-[#111] dark:text-white
                           transition focus:outline-none focus:ring-2 focus:ring-[#DC2626]/50
                           @error('email') border-[#DC2626] @else border-gray-200 dark:border-gray-700 @enderror"
                />
                @error('email')
                    <p class="mt-1 text-xs text-[#DC2626]">{{ $message }}</p>
                @enderror
            </div>

            {{-- Subject --}}
            <div>
                <label for="cf-subject" class="block text-sm font-semibold text-[#1b1b18] dark:text-white mb-1">
                    Subject <span class="text-[#DC2626]">*</span>
                </label>
                <input
                    wire:model.live.debounce.400ms="subject"
                    id="cf-subject"
                    type="text"
                    placeholder="Project Inquiry"
                    class="w-full px-4 py-2.5 rounded-lg border text-sm bg-white dark:bg-[#111] dark:text-white
                           transition focus:outline-none focus:ring-2 focus:ring-[#DC2626]/50
                           @error('subject') border-[#DC2626] @else border-gray-200 dark:border-gray-700 @enderror"
                />
                @error('subject')
                    <p class="mt-1 text-xs text-[#DC2626]">{{ $message }}</p>
                @enderror
            </div>

            {{-- Message --}}
            <div>
                <label for="cf-body" class="block text-sm font-semibold text-[#1b1b18] dark:text-white mb-1">
                    Message <span class="text-[#DC2626]">*</span>
                </label>
                <textarea
                    wire:model.live.debounce.400ms="body"
                    id="cf-body"
                    rows="5"
                    placeholder="Tell me about your project or opportunity..."
                    class="w-full px-4 py-2.5 rounded-lg border text-sm bg-white dark:bg-[#111] dark:text-white
                           transition focus:outline-none focus:ring-2 focus:ring-[#DC2626]/50 resize-none
                           @error('body') border-[#DC2626] @else border-gray-200 dark:border-gray-700 @enderror"
                ></textarea>
                <div class="flex justify-between mt-1">
                    @error('body')
                        <p class="text-xs text-[#DC2626]">{{ $message }}</p>
                    @else
                        <span></span>
                    @enderror
                    <span class="text-xs text-gray-400">{{ strlen($body) }}/2000</span>
                </div>
            </div>

            {{-- Rate limit error --}}
            @if($rateLimitMessage)
                <div class="flex items-center gap-2 text-sm text-red-600 dark:text-red-400 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg px-4 py-3">
                    {{-- Heroicons: exclamation-triangle --}}
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z"/>
                    </svg>
                    {{ $rateLimitMessage }}
                </div>
            @endif

            {{-- Submit --}}
            <button
                type="submit"
                wire:loading.attr="disabled"
                @if($rateLimitMessage) disabled @endif
                class="w-full relative py-3 px-6 rounded-lg font-semibold text-sm text-white bg-[#DC2626]
                       hover:bg-[#B91C1C] active:bg-[#991B1B] transition-all duration-200
                       disabled:opacity-60 disabled:cursor-not-allowed focus:outline-none focus:ring-2 focus:ring-[#DC2626]/50"
            >
                <span wire:loading.remove wire:target="submit">Send Message</span>
                <span wire:loading wire:target="submit" class="flex items-center justify-center gap-2">
                    {{-- Heroicons: arrow-path (spinner) --}}
                    <svg class="animate-spin w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99"/>
                    </svg>
                    Sending...
                </span>
            </button>
        </form>
    @endif
</div>
