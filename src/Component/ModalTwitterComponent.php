<?php

namespace Lao9s\LivewireModalTwitter\Component;

use Livewire\Component;
use Lao9s\LivewireModalTwitter\Contracts\ModalTwitterComponent as Contract;

abstract class ModalTwitterComponent extends Component implements Contract
{
    public ?array $images = [];

    public function setImages(array $images)
    {
        $this->images = $images;
    }

    public function dispatch(): void
    {
        // Your logic
    }

    public function closeModal(): void
    {
        $this->emit('closeModalTwitter');
    }

    public static function hasLoading(): bool
    {
        return false;
    }
}
