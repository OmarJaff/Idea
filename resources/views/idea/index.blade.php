<x-layout>
    <div>
        <header class="py-8 md:py-12">
            <h1 class="text-3xl font-bold">Ideas</h1>
            <p class="text-muted-foreground text-sm mt-2">Capture your thoughts. Make a plan.</p>
        </header>
        <x-card
            x-data
            @click="$dispatch('open-modal','create-idea')"
            is="button"
            data-test="create-new-idea"
            class="mt-10 mb-4 cursor-pointer h-32 w-full text-center">
            <p>What is the idea?</p>
        </x-card>

        <div class="space-x-2">

            <a href="/ideas"
               class="btn {{request()->has('status') ? 'btn-outlined' : ''}}">
                All
            </a>

            @foreach(\App\IdeaStatus::cases() as $status)
                <a href="/ideas?status={{$status->value}}"
                   class="btn {{request('status') === $status->value ? '' : 'btn-outlined'}}">
                    {{$status->label()}}
                    <span class="text-xs pl-1">{{$statusCounts->get($status->value)}}</span>
                </a>
            @endforeach

        </div>

        <div class="mt-10 text-muted-foreground">
            <div class="grid md:grid-cols-2 gap-6">
                @forelse($ideas as $idea)
                    <x-card href="{{route('idea.show',$idea->id)}}">
                        <h3 class="text-foreground text-lg">
                            {{$idea->title}}
                        </h3>
                        <div>
                        <x-idea.idea-status status="{{$idea->status}}">
                            {{$idea->status->label()}}
                        </x-idea.idea-status>
                        </div>
                        <div class="mt-5 line-clamp-3">{{$idea->description}}</div>
                        <div class="mt-4">{{$idea->created_at->diffForHumans()}}</div>
                    </x-card>
                @empty
                    <x-card>
                        <p>No cards yet</p>
                    </x-card>
                @endforelse
            </div>
        </div>
        <x-modal name="create-idea" title="New Idea" >
            <form x-data="{status: 'pending'}"
                  action="{{route("idea.store")}}"
                  method="POST">
                @csrf
                <div class="space-y-6">
                    <x-form.field
                        type="text"
                        name="title"
                        label="Idea"
                        placeholder="What is the idea?"
                        autofocus
                        required
                    />

                    <div>
                        <label for="status" class="label mb-2">Status</label>
                        <div class="flex gap-x-3">
                        @foreach(\App\IdeaStatus::cases() as $status)
                            <button class="btn flex-1 h-10"
                                    :class="{'btn-outlined': status !== @js($status->value)}"
                                    type="button"
                                    data-test="button-status-{{$status->value}}"
                                    @click="status = @js($status->value)">
                                {{$status->label()}}
                            </button>
                        @endforeach

                        </div>
                            <input type="hidden" name="status" id="status" class="text-white" :value="status" />
                        <x-form.error name="status" />
                    </div>

                    <x-form.field
                        type="textarea"
                        label="Description"
                        name="description"
                        required
                        placeholder="describe it more"
                        autofocus />

                    <div class="flex justify-end gap-x-5">
                        <button type="button" @click="$dispatch('close-modal')"
                                class="btn btn-outlined">Cancel</button>
                        <button type="submit" class="btn" data-test="create-idea-submit">Create</button>
                    </div>

                </div>
            </form>


        </x-modal>
    </div>
</x-layout>
