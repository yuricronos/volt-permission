<?php

use Livewire\Volt\Component;
use Spatie\Permission\Models\Role;
use Livewire\WithPagination;
use Yuricronos\VoltPermission\Livewire\Forms\RoleForm;

new class extends Component {
    use WithPagination;

    public $sortBy = 'name';
    public $sortDirection = 'desc';
    public array $roles = [];
    public RoleForm $form;
    public $selectedRoleId;

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
        // $thijs->roles = Role::query()->tap(fn($query) => $this->sortBy ? $query->orderBy($this->sortBy, $this->sortDirection) : $query)->paginate(10);
        $this->roles = Role::select('id', 'name', 'created_at')->get()->toArray();
    }

    public function addRole()
    {
        $this->form->save();
        $this->boot();
    }

    public function deleteRole($id)
    {
        $this->form->delete($id);
        $this->boot();
    }
};

?>


<div x-data="{ confirm_open: false }">

    <div class="mb-4">
        <div class="flex items-center space-x-4">
            <input type="text" label="Role" wire:model="form.name" class="border rounded px-2 py-1" placeholder="Role name" />
            <flux:button type="button" wire:click="addRole" variant="primary"> Add Role </flux:button>
            {{-- <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500"> Add Role </button> --}}
        </div>
        @error('form.name')
            <span class="text-sm text-red-500">{{ $message }}</span>
        @enderror
        @if (session()->has('success'))
            <div class="mt-4 text-sm text-green-600">
                {{ session('success') }}
            </div>
        @endif
    </div>


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
                    <td class="px-6 py-4 text-sm text-gray-800"> {{ $role['name'] }} </td>
                    <td class="px-6 py-4 text-sm">
                        <flux:button type="button" @click="confirm_open = true; $wire.set('selectedRoleId', {{ $role['id'] }})" size="xs" variant="danger">
                            <flux:icon.trash variant="solid" />
                        </flux:button>
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>

    <!-- Modal Overlay -->
    <div x-show="confirm_open" class="absolute inset-0 flex items-center justify-center z-50" @click.self="confirm_open = false">
        <!-- Modal Content -->
        <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
            <h2 class="text-xl font-bold mb-4">Delete Role</h2>
            <p class="mb-4">Are you sure you want to delete the selected role?</p>
            <div class="flex justify-end space-x-4">
                <flux:button @click="confirm_open = false">Cancel</flux:button>
                <flux:button @click="confirm_open = false; $wire.deleteRole($wire.get('selectedRoleId'))" variant="danger">Delete</flux:button>
            </div>
        </div>
    </div>


</div>
