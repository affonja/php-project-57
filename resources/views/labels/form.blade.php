{{ html()->label(__('Name'), 'name')->class('block text-gray-700 mb-3 ') }}
{{ html()->input('text', 'name')->class('shadow-sm block mb-3 required: w-1/3') }}
{{ html()->label(__('Description'), 'description')->class('block text-gray-700 mb-3 ') }}
{{ html()->textarea('description')->class('shadow-sm block mb-3 required: w-1/3 h-32')}}
