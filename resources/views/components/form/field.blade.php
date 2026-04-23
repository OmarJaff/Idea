@props(['name', 'label' => false, 'type' => 'text', 'value' => null])

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
        >{{old($name, $value)}}</textarea>
    @else
    <input
        type={{$type}}
        class="input"
        id="{{$name}}"
        name="{{$name}}"
        {{$attributes}}
        value="{{old($name, $value)}}" />
    @endif

    <x-form.error name="{{$name}}" />
</div>
