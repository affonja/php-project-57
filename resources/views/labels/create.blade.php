@extends('layouts.app')

@section('content')
    <x-h1>{{ __('Create label') }}</x-h1>

    {{ html()->modelForm($label, 'POST', route('labels.store', $label))->open() }}
    <input type="hidden" name="backUrl" value="{{ $backUrl }}">
    @include('labels.form')
    {{ html()->submit( __('Create'))->class('btn-primary') }}
    {{ html()->closeModelForm() }}
@endsection
