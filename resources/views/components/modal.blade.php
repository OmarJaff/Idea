<div
    x-data="{ show: false, name: 'create-idea' }"
    x-show="show"
    @open-modal.window="if($event.detail === name) show = true;"
    @keydown.escape.window="show = false"
    x-transition.enter="ease-out duration-200"
    x-transition:enter-start="opacity-0 -translate-y-4 -translate-x-4"
    x-transition:enter-end="opacity-100"
    x-transition:leave="ease-in duration-150"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0 -translate-y-4 -translate-x-4"
    class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-xs"
    style="display: none"
    role="dialog"
    aria-modal="true"
    aria-label="Create new idea"
    aria-hidden="!show"
    tabindex="-1"
>
    <x-card @click.away="show = false">
        <p>I am a modal.</p>
    </x-card>
</div>
