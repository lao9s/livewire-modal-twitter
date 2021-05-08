## About Livewire Modal Twitter

Livewire component that provides a modal like on Twitter. Also, it supports images gallery with content or without.

![Alt text](./screenshots/preview.png?raw=true "Preview - Livewire Modal Twitter")

## Installation

To get started, require the package via Composer:

```
composer require lao9s/livewire-modal-twitter
```

## Livewire directive

Add the Livewire directive `@livewire('livewire-modal-twitter')` and also the Javascript `@livewireModalTwitterScript`
directive to your template.

```html

<html>
<body>
<!-- your content -->

@livewire('livewire-modal-twitter')
@livewireModalTwitterScript
</body>
</html>
```

Next you will need to publish the required scripts with the following command:

```shell
php artisan vendor:publish --tag=livewire-modal-twitter:public --force
```

## Alpine

Livewire Modal Twitter requires [Alpine](https://github.com/alpinejs/alpine). You can use the official CDN to quickly
include Alpine:

```html

<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
```

## TailwindCSS

This modal is made with TailwindCSS. If you use a different CSS framework I recommend that you publish the modal
template and change the markup to include the required classes for your CSS framework.

```shell
php artisan vendor:publish --tag=livewire-modal-twitter:views
```

## Creating modal

You can run `php artisan make:livewire ShowPost` to make the initial Livewire component. Open your component class and
make sure it extends the `ModalTwitterComponent` class:

```php
<?php

namespace App\Http\Livewire;

use Lao9s\LivewireModalTwitter\Component\ModalTwitterComponent;

class ShowPost extends ModalTwitterComponent
{
    public function mount()
    {
        // Set images with the method setImages()
        $this->setImages([asset('img/1.jpg')]);
    }
    
    public function render()
    {
        return view('livewire.show-post');
    }
}
```


If you need to load data inside of your livewire component, you need to use method dispatch() instead mount(), also for
display preloading you has in hasLoading() return to true:

```php
<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Http;
use Lao9s\LivewireModalTwitter\Component\ModalTwitterComponent;

class ShowPost extends ModalTwitterComponent
{
    public static function hasLoading(): bool
    {
        return true;
    }
    
    public function dispatch(): void
    {
        $request = Http::get('/api/post');
        // Set images with the method setImages()
        $this->setImages($request['images']);
    }
    
    public function render()
    {
        return view('livewire.show-post');
    }
}
```

# Blade

In your blade Livewire component `show-post.blade.php`, you has to use standard laravel component `livewire-modal-twitter::dialog`:
```html
<x-livewire-modal-twitter::dialog :images="$images">
    Your content
    
    <x-slot name="toolbar">
        This is toolbar
    </x-slot>
</x-livewire-modal-twitter::dialog :images="$images">
```

## Opening a modal

To open a modal you will need to emit an event. To open the `ShowPost` modal for example:

```html
<!-- Outside of any Livewire component -->
<button onclick="Livewire.emit('openModalTwitter', 'show-post')">Show Post</button>

<!-- Inside existing Livewire component -->
<button wire:click="$emit('openModalTwitter', 'show-post')">Show Post</button>
```

## Passing parameters

You can pass parameters like `images` or `post_id`:

```html
<!-- Outside of any Livewire component -->
<button onclick='Livewire.emit("openModalTwitter", "show-post", {{ json_encode(["post_id" => $post->id]) }})'>Show Post</button>

<!-- Inside existing Livewire component -->
<button wire:click='$emit("openModalTwitter", "show-post", {{ json_encode(["post_id" => $post->id]) }})'>Show Post</button>
```

The parameters are passed to the `mount` method on the modal component:

```php
<?php

namespace App\Http\Livewire;

use Lao9s\LivewireModalTwitter\Component\ModalTwitterComponent;

class ShowPost extends ModalTwitterComponent
{
    public function mount($post_id)
    {  
       // Your logic
    }

    public function render()
    {
        return view('livewire.show-post');
    }
}
```

## Security

If you are new to Livewire, I recommend to take a look at
the [security details](https://laravel-livewire.com/docs/2.x/security). In short, it's **very important** to validate
all information given Livewire stores this information on the client-side, or in other words, this data can be
manipulated.

## Credits

- [Dumitru Botezatu](https://github.com/lao9s)
- [All Contributors](../../contributors)

## License

Livewire Modal Twitter is open-sourced software licensed under the [MIT license](LICENSE.md).
