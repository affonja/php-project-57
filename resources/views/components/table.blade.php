@props(['headers'])
@props(['taskStatuses'])

<table {{ $attributes->merge(['class' => 'mt-5']) }}>
    <thead class="border-b-2 border-solid border-black text-left">
    <tr>
        @foreach($headers as $header)
            <th>
                {{ $header }}
            </th>
        @endforeach
    </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200">
    @foreach($taskStatuses as $status)
        <tr class="border-b border-dashed text-left">
            <td>{{ $status->id }}</td>
            <td>{{ $status->name }}</td>
            <td>{{ $status->created_at->format('d.m.Y') }}</td>
            @auth
                <td>
                    <a href="{{ route('task_statuses.destroy', $status) }}"
                       class="text-red-600 mr-4"
                       data-confirm="Вы уверены?"
                       data-method="delete"
                       rel="nofollow">{{ __('Delete') }}
                    </a>
                    <a href="{{ route('task_statuses.edit', $status) }}"
                       class="text-blue-600"
                       data-method="get"
                       rel="nofollow">{{ __('Change') }}
                    </a>
                </td>
        @endauth
    @endforeach
    </tbody>
</table>
