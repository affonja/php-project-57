@extends('layouts.app')
@section('content')
    <div class="grid col-span-full">
        <x-h1>{{ __('Tasks') }}</x-h1>


        <div class="w-full flex justify-between">
            <div class="flex">
                {{ html()->modelForm($task, 'GET', route('tasks.index', $task))->id('filterForm')->open() }}
                {{ html()->select('filter[status_id]', ['0' => 'Статус'] + $taskStatuses->pluck('name', 'id')->toArray(), $filters['status_id'] ?? null)->class('rounded border-gray-300') }}
                {{ html()->select('filter[created_by_id]', ['0' => 'Автор'] + $users->pluck('name', 'id')->toArray(), $filters['created_by_id'] ?? null)->class('rounded border-gray-300') }}
                {{ html()->select('filter[assigned_to_id]', ['0' => 'Исполнитель'] + $users->pluck('name', 'id')->toArray(), $filters['assigned_to_id'] ?? null)->class('rounded border-gray-300') }}
                {{ html()->submit(__('Apply'))->class('bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded') }}
                {{ html()->reset(__('Reset'))->class('bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded')->attribute('id', 'resetButton') }}
                {{ html()->closeModelForm() }}
            </div>

            @auth
                <div class="">
                    {{ html()->modelForm($task, 'GET', route('tasks.create'))->open() }}
                    {{ html()->submit( __('Create task'))->class('bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded') }}
                    {{ html()->closeModelForm() }}
                </div>
            @endauth
        </div>

        @auth
            <x-table
                    :headers="['ID', __('Status'), __('Name'), __('Author'), __('Executor'),__('Date of creation'), __('Action')]"
                    :items="$tasks"
                    :routes="['update'=> 'tasks.edit', 'delete' => 'tasks.destroy']"
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
