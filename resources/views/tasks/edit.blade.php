@extends('layouts.app')

@section('content')
    <x-h1>{{ __('Change of task') }}</x-h1>

    {{ html()->modelForm($task, 'PATCH', route('tasks.update', $task))->id('taskForm')->open() }}
    @include('tasks.form')
    {{ html()->submit( __('Update') )->class('btn-primary') }}
    {{ html()->closeModelForm() }}
@endsection
