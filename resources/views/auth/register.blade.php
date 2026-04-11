<x-layout>
    <div class="flex min-h-[calc(100dvh-4rem)] items-center justify-center px-4">
        <div class="w-full max-w-xl">
            <div class="text-center">
                <h1 class="text-3xl font-bold tracking-tight">Register an account</h1>
                <p class="text-muted-foreground mt-1">Start tracking your ideas today.</p>
            </div>

            <Form action="/register" method="POST" class="mt-10 space-y-2">
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
                <button type="submit" class="btn mt-4">Create your account</button>
            </Form>

        </div>
    </div>
</x-layout>
