{{ html()->label(__('Name'), 'name')->class('block text-gray-700 mb-3 ') }}
{{ html()->input('text', 'name')->class('shadow-sm block mb-3 required: w-1/3') }}
<x-task-input-error :messages="$errors->get('name')" class="mt-2"/>

{{ html()->label(__('Description'), 'description')->class('block text-gray-700 mb-3') }}
{{ html()->textarea('description')->class('  shadow-sm block mb-3 required: w-1/3 h-32')  }}

{{ html()->label(__('Status'), 'status_id')->class('block text-gray-700 mb-3') }}
{{ html()->select('status_id', ['0' => ''] + $taskStatuses->pluck('name', 'id')->toArray())
    ->class(' shadow-sm block mb-3 required: w-1/3') }}
<x-task-input-error :messages="$errors->get('status_id')" class="mt-2"/>

{{ html()->label(__('Executor'), 'executor')->class('block text-gray-700 mb-3') }}
{{ html()->select('assigned_to_id', ['' => ''] + $users->pluck('name', 'id')->toArray())
    ->class(' shadow-sm block mb-3 required: w-1/3') }}

{{ html()->label(__('Points'), 'points')->class('block text-gray-700 mb-3') }}
{{ html()->textarea('points')->class('shadow-sm block mb-3 required: w-1/3 h-20') }}
