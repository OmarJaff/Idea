<x-layout>
    <div class="py-8  mx-auto">
        <div class="flex justify-between items-center">
            <a href="{{ route('idea.index') }}" class="flex items-center gap-x-2 text-sm font-medium">
                <x-lucide-move-left class="h-5 w-5" />
                Back to Ideas
            </a>
            <div class="gap-x-3 flex items-center">
                <button class="btn btn-outlined">
                    <x-lucide-edit class="h-5 w-5"/>
                    Edit</button>
                <button class="btn btn-outlined text-red-500">Delete</button>
            </div>
        </div>
    </div>

    <h1 class="font-bold text-4xl">{{ $idea->title }}</h1>

    <x-card class="mt-6">
        <div class="text-foreground max-w-none cursor-pointer">{{ $idea->description }}</div>
    </x-card>
</x-layout>
