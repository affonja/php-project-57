@extends('layouts.app')

@section('content')
    <x-h1>{{ __('Create status') }}</x-h1>


    {{ html()->modelForm($taskStatus, 'POST', route('task_statuses.store', $taskStatus))->open() }}
    @include('taskStatuses.form')
    {{ html()->submit( __('Create'))->class('bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded') }}
    {{ html()->closeModelForm() }}

@endsection
