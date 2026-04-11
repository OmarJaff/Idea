<x-layout>
        <x-form action="/register" method="POST" title="Register an account" description="Start tracking your ideas from today.">
            @csrf
            <div class="space-y-3">
                <label for="name" class="label">Name</label>
                <input type="text" class="input" id="name" name="name">
            </div>

            <div class=space-y-3">
                <label for="email" class="label">Email</label>
                <input type="text" class="input" id="email" name="email">
            </div>

            <div class="space-y-3">
                <label for="password" class="label">Password</label>
                <input type="password" class="input" id="password" name="password">
            </div>
            <button type="submit" class="btn mt-4 w-full h-10">Create your account</button>
        </x-form>


</x-layout>
