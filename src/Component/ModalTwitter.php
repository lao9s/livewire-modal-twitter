<?php

namespace Lao9s\LivewireModalTwitter\Component;

use Illuminate\View\View;
use Livewire\Component;

class ModalTwitter extends Component
{
    public ?array $component = null;

    public function resetState(): void
    {
        $this->component = null;
    }

    public function openModalTwitter($component, $componentAttributes = [], $modalAttributes = []): void
    {
        $componentClass = app('livewire')->getClass($component);

        $this->component = [
            'name' => $component,
            'attributes' => $componentAttributes,
            'modalAttributes' => array_merge([
                'closeOnEscape' => $componentClass::closeModalOnEscape(),
                'hasLoading' => $componentClass::hasLoading(),
            ], $modalAttributes),
        ];

        $this->emit('activeModalTwitterComponentChanged');
    }

    public function getListeners(): array
    {
        return [
            'openModalTwitter',
        ];
    }

    public function render(): View
    {
        return view('livewire-modal-twitter::modal');
    }
}
