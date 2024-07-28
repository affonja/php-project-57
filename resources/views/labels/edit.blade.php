@extends('layouts.app')

@section('content')
    <x-h1>{{ __('Change of label') }}</x-h1>

    {{ html()->modelForm($label, 'PATCH', route('labels.update', $label))->open() }}
    @include('labels.form')
    {{ html()->submit( __('Update') )->class('btn-primary') }}
    {{ html()->closeModelForm() }}
@endsection
