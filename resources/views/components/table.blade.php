@props(['headers', 'items', 'routes', 'fields'])

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
    @foreach($items as $item)
        <tr class="border-b border-dashed text-left">
            @foreach($fields as $value)
                <td>
                    @switch($value)
                        @case('created_at')
                            {{ $item->$value->format('d.m.Y') }}
                            @break
                        @case('action')
                            @foreach($routes as $key => $route)
                                <x-link-table :item="$item" :route="$route" :name="$key"/>
                            @endforeach
                            @break
                        @default
                            {{ $item->$value }}
                    @endswitch
                </td>
            @endforeach
        </tr>
    @endforeach
    </tbody>
</table>


