@props(['images' => []])
<div class="flex flex-row w-full">
    <div wire:ignore.self x-show="loading"
         class="absolute w-full h-full top-0 left-0 z-30 bg-gray-800 bg-opacity-50 flex items-center justify-center">
        <div class="modal-twitter-loading w-16 h-16 border-2 border-white border-t-0 rounded-full"></div>
    </div>
    <div class="flex flex-col w-full h-full relative overflow-hidden">
        <button wire:ignore x-on:click.stop="show = false" type="button"
                class="absolute top-0 left-0 ml-5 mt-5 w-10 h-10 flex items-center justify-center rounded-full z-30 bg-gray-700 bg-opacity-75 text-white hover:bg-gray-500 focus:shadow focus:outline-none focus:border-gray-700 focus:ring focus:ring-gray-500 transition ease-in-out duration-200">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                 xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
        <button wire:ignore x-on:click="toggleSidebar" type="button"
                class="absolute top-0 right-0 mr-5 mt-5 w-10 h-10 flex items-center justify-center rounded-full z-20 text-white bg-gray-700 bg-opacity-75 hover:bg-gray-500 focus:shadow focus:outline-none transition ease-in-out duration-200">
            <template x-if="showSidebar">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                     xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M13 5l7 7-7 7M5 5l7 7-7 7"></path>
                </svg>
            </template>
            <template x-if="!showSidebar">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                     xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M11 19l-7-7 7-7m8 14l-7-7 7-7"></path>
                </svg>
            </template>
        </button>
        <div class="flex flex-1 relative items-center justify-center h-full">
            @if(count($images) > 1)
                <div wire:ignore class="absolute top-0 left-0 flex justify-between items-center w-full h-full">
                    <button x-on:click="activeImage = activeImage === 1 ? {{ count($images) }} : activeImage - 1"
                            class="w-9 h-9 ml-5 flex items-center justify-center rounded-full z-20 text-white bg-gray-700 bg-opacity-75 hover:bg-gray-500 focus:shadow focus:outline-none transition ease-in-out duration-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                             xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </button>
                    <button x-on:click="activeImage = (activeImage === {{ count($images) }} ? 1 : activeImage + 1)"
                            class="w-9 h-9 mr-5 flex items-center justify-center rounded-full z-20 text-white bg-gray-700 bg-opacity-75 hover:bg-gray-500 focus:shadow focus:outline-none transition ease-in-out duration-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                             xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M9 5l7 7-7 7"></path>
                        </svg>
                    </button>
                </div>
            @endif
            @if(count($images))
                @foreach($images as $image)
                    <div x-show.transition.opacity="activeImage === {{ $loop->iteration }}" aria-label="Image"
                         class="absolute top-0 left-0 right-0 w-full h-full">
                        <div class="absolute top-0 left-0 right-0 bg-contain w-full h-full bg-no-repeat bg-center"
                             style="background-image: url('{{ $image }}')">
                        </div>
                        <img alt="Image" draggable="true" src="{{ $image }}"
                             class="absolute h-full w-full opacity-0 inset-0"/>
                    </div>
                @endforeach
            @endif
        </div>
        @if($toolbar ?? null)
            <div class="py-5 text-white text-center">
                {{ $toolbar }}
            </div>
        @endif
    </div>
    <div wire:ignore.self x-show="showSidebar" class="w-96"
         x-bind:class="{'fixed w-full h-full z-30' : showSidebarMobile}">
        <div class="flex flex-col w-full h-full bg-white overflow-x-hidden overflow-y-auto">
            {{ $slot }}
        </div>
    </div>
</div>
<style>
    @keyframes spin {
        from {
            transform: rotate(0);
        }
        to {
            transform: rotate(359deg);
        }
    }

    .modal-twitter-loading {
        animation: spin .5s linear 0s infinite;
    }
</style>
