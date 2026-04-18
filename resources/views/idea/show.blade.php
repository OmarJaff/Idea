<x-layout>
    <div class="py-8  mx-auto">
        <div class="flex justify-between">
            <a href="{{ route('idea.index') }}" class="flex items-center gap-x-2 text-sm font-medium">
                <x-lucide-move-left class="h-5 w-5" />
                Back to Ideas
            </a>
        </div>
    </div>

    <h1 class="font-bold text-4xl">{{ $idea->title }}</h1>

    <x-card class="mt-6">
        <div class="text-foreground max-w-none cursor-pointer">{{ $idea->description }}</div>
    </x-card>
</x-layout>
