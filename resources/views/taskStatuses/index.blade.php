@extends('layouts.app')
@section('content')
    <div class="grid col-span-full">
        <x-h1>{{ __('Statuses') }}</x-h1>

        @auth
            <div>
                <form action="{{ route('task_statuses.create') }}" method="get">
                    @csrf
                    <x-primary-button type="submit">{{ __('Create status') }}</x-primary-button>
                </form>
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
