<div class="fixed w-full">
    <nav class="bg-white border-gray-200 py-2.5 shadow-md ">
        <div class="flex flex-wrap items-center justify-between max-w-screen-xl px-4 mx-auto">

            <!-- Logo -->
            <div class="logo flex items-center">
                <div class="shrink-0 pr-2">
                    <a href="{{ route('index') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800"/>
                    </a>
                </div>

                <a href="{{ route('index') }}" class="flex items-center">
                    <span class="self-center text-xl font-semibold whitespace-nowrap">Менеджер задач</span>
                </a>
            </div>

            <div class="flex items-center lg:order-2">
                @auth
                    <div>{{ Auth::user()->name }}</div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-primary-button type="submit" class="ml-4">Выход</x-primary-button>
                    </form>
                @endauth
                @guest
                    <a href="{{ route('login') }}"
                       class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        {{ __('Sign in') }}
                    </a>
                    <a href="{{ route('register') }}"
                       class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-2">
                        {{ __('Sign up') }}
                    </a>
                @endguest


            </div>

            <div class="items-center justify-between hidden w-full lg:flex lg:w-auto lg:order-1">
                <ul class="flex flex-col mt-4 font-medium lg:flex-row lg:space-x-8 lg:mt-0">
                    <li>
                        <a href="{{ route('tasks.index') }}"
                           class="block py-2 pl-3 pr-4 text-gray-700 hover:text-blue-700 lg:p-0">
                            {{ __('Tasks') }} </a>
                    </li>
                    <li>
                        <a href="{{ route('task_statuses.index') }}"
                           class="block py-2 pl-3 pr-4 text-gray-700 hover:text-blue-700 lg:p-0">
                            {{ __('Statuses') }} </a>
                    </li>
                    <li>
                        <a href="/"
                           class="block py-2 pl-3 pr-4 text-gray-700 hover:text-blue-700 lg:p-0">
                            {{ __('Label') }} </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>
