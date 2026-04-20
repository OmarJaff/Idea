@props(['name', 'label' => false, 'type' => 'text'])

<div class="space-y-3">
    @if($label)
    <label for="{{$name}}" class="label">{{$label}}</label>
    @endif

    @if($type == 'textarea')
        <textarea
        class="textarea"
        id="{{$name}}"
        name="{{$name}}"
        {{$attributes}}
        >{{old($name)}}</textarea>
    @else
    <input
        type={{$type}}
        class="input"
        id="{{$name}}"
        name="{{$name}}"
        {{$attributes}}
        value="{{old($name)}}" />
    @endif

    <x-form.error name="{{$name}}" />
</div>
