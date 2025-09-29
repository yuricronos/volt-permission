<?php

use Livewire\Volt\Component;
use Spatie\Permission\Models\Role;

new class extends Component {
    use \Livewire\WithPagination;

    public $sortBy = 'name';
    public $sortDirection = 'desc';
    public array $roles = [];

    public function sort($column)
    {
        if ($this->sortBy === $column) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $column;
            $this->sortDirection = 'asc';
        }
    }

    public function boot()
    {
        // $this->roles = Role::query()->tap(fn($query) => $this->sortBy ? $query->orderBy($this->sortBy, $this->sortDirection) : $query)->paginate(10);
        $this->roles = Role::select('id', 'name', 'created_at')->get()->toArray();
    }
};

?>


<div>

    <table class="min-w-full border border-gray-200 divide-y divide-gray-200">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Role</th>
                <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Action</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">

            @foreach ($roles as $role)
                <tr>
                    <td class="px-6 py-4 text-sm text-gray-800"> {{ $role->name }} </td>
                    <td class="px-6 py-4 text-sm">
                        <span class="px-2 py-1 text-xs font-semibold text-green-800 bg-green-100 rounded">Active</span>
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>

</div>
