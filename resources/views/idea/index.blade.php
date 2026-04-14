<x-layout>
    <div>
        <header class="py-8 md:py-12">
            <h1 class="text-3xl font-bold">Ideas</h1>
            <p class="text-muted-foreground text-sm mt-2">Capture your thoughts. Make a plan.</p>
        </header>
        <div class="mt-10">
            <div class="grid md:grid-cols-2 gap-6">
                @forelse($ideas as $idea)
                    <x-card>
                        <h3>
                            {{$idea->title}}
                        </h3>
                    </x-card>
                @empty
                    <x-card>
                        <p>No cards yet</p>
                    </x-card>
                @endforelse
            </div>
        </div>
    </div>
</x-layout>
