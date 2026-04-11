<x-layout>

        <x-form action="/register" method="POST" title="Register an account" description="Start tracking your ideas from today.">
            @csrf
            <x-form.field name="name" label="Your Name" placeholder="type your name..." />

            <x-form.field type="email" name="email" label="Write your email" placeholder="what is your email address?"  />

            <x-form.field type="password" name="password" label="Write your password"  />

            <button type="submit" class="btn mt-4 w-full h-10">Create your account</button>
        </x-form>

</x-layout>
