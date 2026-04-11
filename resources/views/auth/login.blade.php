<x-layout>

    <x-form action="/login" method="POST" title="Login to your account" description="Welcome Back!">
        @csrf

        <x-form.field type="email" name="email" label="Write your email" placeholder="email address?"  />

        <x-form.field type="password" name="password" label="Write your password" placeholder="your password please?"  />

        <button type="submit" class="btn mt-4 w-full h-10">Login</button>
    </x-form>

</x-layout>
