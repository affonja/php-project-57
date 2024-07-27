@extends('layouts.app')

@section('content')
    <x-h1>{{ __('Change of status') }}</x-h1>

    {{ html()->modelForm($taskStatus, 'PATCH', route('task_statuses.update', $taskStatus))->open() }}
    @include('taskStatuses.form')
    {{ html()->submit( __('Update') )->class('bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded') }}
    {{ html()->closeModelForm() }}
@endsection
