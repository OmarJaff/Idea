<nav class="border-b border-border px-6">

        <div class="max-w-7xl mx-auto h-16 flex items-center justify-between">

            <div>

                <a href="/">

                    <img src="/images/logo.svg"  width="100" alt="Idea logo">

                </a>

            </div>



        <div class="flex gap-x-5">

            @auth
                <form action="/logout" method="post">
                    @csrf
                    <button type="submit" class="btn" data-test="logout-btn">Log out</button>
                </form>
            @endauth
            @guest
                    <a href="/login">Sign In</a>

                    <a href="/register" class="btn">Register</a>
            @endguest



        </div>
    </div>

</nav>
