@props(['idea' => new \App\Models\Idea()])

<x-modal name="{{$idea->exists ? 'update-idea' : 'create-idea'}}"
         title="{{$idea->exists ? 'Update Idea':'Create a new idea'}}" >
    <form x-data="{
                    status: @js(old('status', $idea->status->value)),
                    newLink: '',
                    'links': @js(old('links',$idea->links)),
                    newStep: '',
                    'steps': @js(old('steps', $idea->steps->map(fn($step) => $step->description))),
                    hasImage: false
                  }"
          action="{{$idea->exists ? route("idea.update", $idea) : route("idea.store")}}"
          method="POST"
          :enctype="hasImage ? 'multipart/form-data' : false"
    >
            @csrf
              @if($idea->exists)
              @method('PATCH')
             @endif

        <div class="space-y-6">
            <x-form.field
                type="text"
                name="title"
                label="Idea"
                placeholder="What is the idea?"
                autofocus
                required
                :value="$idea->title"
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
                <input type="hidden"
                       name="status"
                       id="status"
                       class="text-white"
                       :value="status" />
                <x-form.error name="status" />
            </div>

            @if($idea->image_path)
                <div class="rounded-lg overflow-hidden my-4">
                    <img class="w-full h-auto object-cover " src="{{asset('storage/' . $idea->image_path)}}" alt="the idea image">

                    <button type="submit" class="btn btn-outlined w-full my-2 h-8" form="delete-idea-image-form">Remove</button>
                </div>
            @endif

            <div>
                <label for="image" class="label mb-2">Featured Image</label>
                <input type="file" name="image" id="image" accept="image/*"
                       @change="hasImage = $event.target.files.length > 0" />
                <x-form.error name="image" />
            </div>

            <x-form.field
                type="textarea"
                label="Description"
                name="description"
                :value="$idea->description"
                required
                placeholder="describe it more"
                autofocus />


            {{-- steps--}}

            <fieldset class="space-y-3">

                <legend class="label">Actionable Steps</legend>


                <template x-for="(step, index) in steps" :key='index' >
                    <div class="flex gap-x-2">

                        <input  class="input"
                                name="steps[]"
                                x-model="step"

                        />

                        <button
                            type="button"
                            @click="steps.splice(index,1)"
                            aria-label="a button to remove a step"
                        >
                            <x-lucide-x class="h-5 w-5 form-muted-icon text-white" />
                        </button>
                    </div>

                </template>

                <div class="flex gap-x-2 items-center">

                    <input
                        type="url"
                        id="new-step"
                        data-test="new-step"
                        x-model="newStep"
                        placeholder="write down your idea steps..."
                        class="input flex-1"
                        spellcheck="false"
                    />

                    <button
                        type="button"
                        @click="steps.push(newStep.trim()); newStep = ''"
                        data-test="add-new-step"
                        :disabled="newStep === ''"
                        aria-label="a button to add a url for an idea"
                        class="disabled:text-gray-500 disabled:cursor-not-allowed form-muted-icon"
                    >
                        <x-lucide-plus class="h-5 w-5" />
                    </button>
                </div>

            </fieldset>


            {{--Links--}}

            <fieldset class="space-y-3">

                <legend class="label">Links</legend>


                <template x-for="(link, index) in links" :key='index' >
                    <div class="flex gap-x-2">

                        <input  class="input"
                                name="links[]"
                                x-model="link" />

                        <button
                            type="button"
                            @click="links.splice(index,1)"
                            aria-label="a button to remove a url"
                        >
                            <x-lucide-x class="h-5 w-5 form-muted-icon text-white" />
                        </button>
                    </div>

                </template>

                <div class="flex gap-x-2 items-center">

                    <input
                        type="url"
                        id="new-link"
                        data-test="new-link"
                        x-model="newLink"
                        placeholder="http://example.com"
                        autocomplete="url"
                        class="input flex-1"
                        spellcheck="false"
                        @keydown.shift.enter="links.push(newLink.trim()); newLink = '';"
                    />

                    <button
                        type="button"
                        @click="links.push(newLink.trim()); newLink = '';"

                        data-test="add-new-link"
                        :disabled="newLink === ''"
                        aria-label="a button to add a url for an idea"
                        class="disabled:text-gray-500 disabled:cursor-not-allowed form-muted-icon"
                    >
                        <x-lucide-plus class="h-5 w-5" />
                    </button>
                </div>

            </fieldset>

            <div class="flex justify-end gap-x-5">
                <button type="button" @click="$dispatch('close-modal')"
                        class="btn btn-outlined">Cancel</button>
                <button type="submit" class="btn" data-test="create-idea-submit">{{$idea->exists ? 'Update' : 'Create'}}</button>
            </div>

        </div>
    </form>

    @if($idea->image_path)
        <form id="delete-idea-image-form" action="{{route('idea.image.delete', $idea)}}" method="post">
            @csrf
            @method('DELETE')
        </form>
    @endif

</x-modal>
