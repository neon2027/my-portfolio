<div>
    @if($submitted)
        <div class="flex flex-col items-center justify-center py-10 text-center space-y-4">
            <div class="w-16 h-16 rounded-full bg-green-100 dark:bg-green-900/30 flex items-center justify-center">
                <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
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

            {{-- Message (property renamed to $body to avoid conflict with Blade's $message error variable) --}}
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

            {{-- Submit --}}
            <button
                type="submit"
                wire:loading.attr="disabled"
                class="w-full relative py-3 px-6 rounded-lg font-semibold text-sm text-white bg-[#DC2626]
                       hover:bg-[#B91C1C] active:bg-[#991B1B] transition-all duration-200
                       disabled:opacity-60 disabled:cursor-not-allowed focus:outline-none focus:ring-2 focus:ring-[#DC2626]/50"
            >
                <span wire:loading.remove wire:target="submit">Send Message</span>
                <span wire:loading wire:target="submit" class="flex items-center justify-center gap-2">
                    <svg class="animate-spin w-4 h-4" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"/>
                    </svg>
                    Sending...
                </span>
            </button>
        </form>
    @endif
</div>
