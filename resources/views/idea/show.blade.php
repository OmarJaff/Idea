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
                <form   method="POST" action="{{route('idea.destroy', $idea)}}">
                    @csrf
                    @method('DELETE')
                   <button class="btn btn-outlined text-red-500">Delete</button>
                </form>
            </div>
        </div>
    </div>

    <div class="mt-6 space-y-6">
        <h1 class="font-bold text-4xl">{{ $idea->title }}</h1>
        <div class="mt-2 flex gap-x-3 items-center">
            <x-idea.idea-status :status="$idea->status->value">
                {{$idea->status->label()}}
            </x-idea.idea-status>
            <div class="text-muted-foreground text-sm">{{$idea->created_at->diffForHumans()}}</div>
        </div>
        <x-card class="mt-6">
            <div class="text-foreground max-w-none cursor-pointer">{{ $idea->description }}</div>
        </x-card>
    </div>

</x-layout>
