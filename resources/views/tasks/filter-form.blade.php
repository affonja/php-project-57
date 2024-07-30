<div class="flex">
    {{ html()->modelForm($task, 'GET', route('tasks.index', $task))->id('filterForm')->open() }}
    {{ html()->select('filter[status_id]', ['0' => 'Статус'] + $taskStatuses->pluck('name', 'id')->toArray(), $filters['status_id'] ?? null) }}
    {{ html()->select('filter[created_by_id]', ['0' => 'Автор'] + $users->pluck('name', 'id')->toArray(), $filters['created_by_id'] ?? null) }}
    {{ html()->select('filter[assigned_to_id]', ['0' => 'Исполнитель'] + $users->pluck('name', 'id')->toArray(), $filters['assigned_to_id'] ?? null) }}
    {{ html()->submit(__('Apply'))->class('btn-primary') }}
    {{ html()->reset(__('Reset'))->class('btn-primary')->id('resetButton') }}
    {{ html()->closeModelForm() }}
</div>
