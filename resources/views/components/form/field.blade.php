@props(['name', 'label' , 'type' => 'text'])

<div class="space-y-3">
    <label for="{{$name}}" class="label">{{$label}}</label>
    <input {{$type}}  class="input" id="{{$name}}" name="{{$name}}" {{$attributes}}  >
</div>
