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
                    :taskStatuses="$taskStatuses"
            ></x-table>
        @endauth
        @guest
            <x-table
                    :headers="['ID', __('Name'), __('Date of creation')]"
                    :taskStatuses="$taskStatuses"
            ></x-table>
        @endguest
    </div>
@endsection
