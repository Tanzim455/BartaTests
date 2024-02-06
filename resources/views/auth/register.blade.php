@include('partials.header')


<body class="h-full">
    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <a href="/" class="text-center text-6xl font-bold text-gray-900">
                <h1>Barta</h1>
            </a>
            <h1 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">
                Create a new account
            </h1>
        </div>
        @if (session('success'))
            <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50">
                <span class="font-medium"> {{ session('success') }}</span>

            </div>
        @endif

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            <form class="space-y-6" action="{{ route('register') }}" method="POST">
                <!-- First Name -->
                @csrf
                <div>
                    <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Name</label>
                    <div class="mt-2">
                        <input name="name" type="text" autocomplete="name" placeholder="Muhammad"
                            required
                            class="block w-full rounded-md border-0 p-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-black sm:text-sm sm:leading-6" />
                        @error('name')
                            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50"
                                role="alert">
                                <span class="font-medium">{{ $message }}</span>

                            </div>
                        @enderror
                    </div>
                </div>

                <!-- First Name -->
                <div>
                    <label for="username" class="block text-sm font-medium leading-6 text-gray-900">User Name</label>
                    <div class="mt-2">
                        <input name="username" type="text" autocomplete="last_name" placeholder="Alp Arslan"
                            required
                            class="block w-full rounded-md border-0 p-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-black sm:text-sm sm:leading-6" />
                        @error('username')
                            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50"
                                role="alert">
                                <span class="font-medium">{{ $message }}</span>

                            </div>
                        @enderror
                    </div>
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email</label>
                    <div class="mt-2">
                        <input id="email" name="email" type="email" autocomplete="email"
                            placeholder="alp.arslan@mail.com" required
                            class="block w-full rounded-md border-0 p-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-black sm:text-sm sm:leading-6" />
                        @error('email')
                            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50"
                                role="alert">
                                <span class="font-medium">{{ $message }}</span>

                            </div>
                        @enderror
                    </div>
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
                    <div class="mt-2">
                        <input id="password" name="password" type="password" required
                            class="block w-full rounded-md border-0 p-2 p-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-black sm:text-sm sm:leading-6" />
                        @error('password')
                            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50"
                                role="alert">
                                <span class="font-medium">{{ $message }}</span>

                            </div>
                        @enderror
                    </div>
                </div>

                <div>
                    <button type="submit"
                        class="flex w-full justify-center rounded-md bg-black px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-black focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black">
                        Register
                    </button>
                </div>
            </form>

            <p class="mt-10 text-center text-sm text-gray-500">
                Already a member?
                <a href="{{'login'}}" class="font-semibold leading-6 text-black hover:text-black">Sign
                    In</a>
            </p>
        </div>
    </div>
</body>
