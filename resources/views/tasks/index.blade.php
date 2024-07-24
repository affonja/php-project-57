@extends('layouts.app')
@section('content')
    <div class="grid col-span-full">
        <x-h1>{{ __('Tasks') }}</x-h1>


        {{-- фильтр

        <div class="w-full flex items-center">
            <div>
                <form method="GET" action="https://php-task-manager-ru.hexlet.app/tasks">
                    <div class="flex">
                        <select class="rounded border-gray-300" name="filter[status_id]" id="filter[status_id]">
                            <option value="" selected="selected">Статус</option>
                            <option value="1">новая</option>
                            <option value="2">завершена</option>
                            <option value="3">выполняется</option>
                            <option value="4">в архиве</option>
                        </select>
                        <select class="rounded border-gray-300" name="filter[created_by_id]" id="filter[created_by_id]">
                            <option value="" selected="selected">Автор</option>
                            <option value="1">Вадим Евгеньевич Пономарёв</option>
                            <option value="2">Ксения Евгеньевна Соловьёва</option>
                        </select>
                        <select class="rounded border-gray-300" name="filter[assigned_to_id]"
                                id="filter[assigned_to_id]">
                            <option value="" selected="selected">Исполнитель</option>
                            <option value="1">Вадим Евгеньевич Пономарёв</option>
                        </select>
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-2"
                                type="submit">Применить
                        </button>

                    </div>
                </form>
            </div>
            <div class="ml-auto">
            </div>
        </div>

                   фильтр--}}

        {{--таблица--}}


        @auth
            <x-table
                    :headers="['ID', __('Status'), __('Name'), __('Author'), __('Executor'),__('Date of creation'), __('Action')]"
                    :items="$tasks"
                    :routes="['edit'=> 'tasks.edit']"
                    :fields="['id', 'status_name','name', 'author_name', 'executor_name', 'created_at', 'action']">
                >
            </x-table>
        @endauth
        @guest
            <x-table
                    :headers="['ID', __('Status'), __('Name'), __('Author'), __('Executor'),__('Date of creation')]"
                    :items="$tasks"
                    :fields="['id', 'status_name', 'name', 'author_name', 'executor_name', 'created_at']">
                >
            </x-table>
        @endguest

        <div class="mt-10">
            {{ $tasks->links() }}
        </div>
    </div>
@endsection
