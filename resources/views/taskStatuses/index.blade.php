@extends('layouts.app')
@section('content')
    <div class="grid col-span-full">
        <x-h1>{{ __('Statuses') }}</x-h1>

        @auth
            <div>
                {{ html()->modelForm($taskStatuses, 'GET', route('task_statuses.create'))->open() }}
                {{ html()->submit( __('Create status'))->class('bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded') }}
                {{ html()->closeModelForm() }}
            </div>
        @endauth

        @auth
            <x-table
                    :headers="['ID', __('Name'), __('Date of creation'), __('Action')]"
                    :items="$taskStatuses"
                    :routes="['delete'=> 'task_statuses.destroy',
                               'edit'=> 'task_statuses.edit']"
                    :fields="['id', 'name', 'created_at', 'action']">
                >
            </x-table>
        @endauth
        @guest
            <x-table
                    :headers="['ID', __('Name'), __('Date of creation')]"
                    :items="$taskStatuses"
                    :fields="['id', 'name', 'created_at']">
                >
            </x-table>
        @endguest
    </div>
@endsection
