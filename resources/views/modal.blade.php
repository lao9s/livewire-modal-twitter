<div x-data="LivewireModalTwitter()"
     x-init="init()"
     x-show="show"
     x-on:close.stop="show = false"
     x-on:keydown.escape.window="closeModalViaEscape()"
     x-on:resize.window="responsive()"
     class="fixed top-0 left-0 right-0 flex flex-column h-full m-0 p-0 box-border z-0"
     style="display: none;">
    <div x-show="show && showActiveComponent"
         x-transition:enter="ease-out duration-200"
         x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
         x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
         x-transition:leave="ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
         x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
         class="flex w-full h-full bg-gray-900 bg-opacity-90">
        @if($component)
            @livewire($component['name'], $component['attributes'])
        @endif
    </div>
</div>
