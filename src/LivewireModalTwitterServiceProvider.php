<?php

namespace Lao9s\LivewireModalTwitter;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Lao9s\LivewireModalTwitter\Component\ModalTwitter;
use Livewire\Livewire;

class LivewireModalTwitterServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->registerViews();
        $this->registerDirectives();
        $this->registerPublishables();
        $this->registerComponents();
        $this->registerLivewireComponents();
    }

    private function registerViews(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'livewire-modal-twitter');
    }

    private function registerDirectives()
    {
        Blade::directive('livewireModalTwitterScript', function () {
            return '<script src="' . asset("/vendor/livewire-modal-twitter/modal-twitter.js") . '"></script>';
        });
    }

    private function registerPublishables(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../resources/views' => resource_path('views/vendor/livewire-modal-twitter'),
            ], 'livewire-modal-twitter:views');

            $this->publishes([
                __DIR__ . '/../resources/js' => resource_path('js/vendor/livewire-modal-twitter'),
            ], 'livewire-modal-twitter:script');

            $this->publishes([
                __DIR__ . '/../public' => public_path('vendor/livewire-modal-twitter'),
            ], 'livewire-modal-twitter:public');
        }
    }

    private function registerComponents(): void
    {
        Blade::component('livewire-modal-twitter::components.dialog', 'dialog', 'livewire-modal-twitter');
    }

    private function registerLivewireComponents(): void
    {
        Livewire::component('livewire-modal-twitter', ModalTwitter::class);
    }
}
