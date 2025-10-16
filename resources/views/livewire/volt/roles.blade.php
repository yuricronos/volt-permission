<?php

use Livewire\Volt\Component;
use Spatie\Permission\Models\Role;
use Livewire\WithPagination;
use Yuricronos\VoltPermission\Livewire\Forms\RoleForm;

use function Livewire\Volt\{state, usesPagination, with, form};

usesPagination();
with(
    fn() => [
        'roles' => Role::select('id', 'name', 'created_at')->paginate(10),
    ],
);

form(RoleForm::class, 'form');

state([
    'selectedRoleId' => null,
]);

$addRole = function () {
    $this->form->save();
};

$deleteRole = function () {
    $this->form->delete($this->selectedRoleId);
};

?>


<div x-data="{ confirm_open: false }" class="w-full">

    <form wire:submit.prevent="addRole" class="flex flex-col gap-6 bg-white/80 dark:bg-gray-900/80 p-8 rounded-2xl shadow-2xl w-full mx-auto mt-3 border border-blue-200 dark:border-blue-800">
        <div class="flex flex-col md:flex-row gap-6">
            <div class="flex-1">
                <label for="date" class="block text-sm font-semibold text-blue-700 dark:text-blue-200 mb-1"> {{ __('Role Name') }} </label>
                <flux:input wire:model="form.name" type="text" placeholder="Enter role name" class="w-full" required />
            </div>
            <div class="flex items-end flex-1">
                <flux:button type="submit" variant="primary" color="blue"> {{ __('Add Role') }} </flux:button>
                {{-- <flux:button type="submit" variant="primary" color="blue" icon="inbox-arrow-down">Add Sales</flux:button> --}}
                {{-- <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500"> Add Role </button> --}}
            </div>
        </div>
    </form>

    @error('form.name')
        <span class="text-sm text-red-500">{{ $message }}</span>
    @enderror
    @if (session()->has('success'))
        <div class="mt-4 text-sm text-green-600">
            {{ session('success') }}
        </div>
    @endif


    <div class="overflow-x-auto z-50 relative rounded-2xl shadow-2xl border border-blue-200 dark:border-blue-800 bg-white/80 dark:bg-gray-900/80 mt-8">
        <table class="min-w-full divide-y divide-blue-100 dark:divide-blue-900">
            <thead class="bg-blue-100/80 dark:bg-blue-900/80">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-bold text-blue-700 dark:text-blue-200 uppercase tracking-wider"> {{ __('Role') }} </th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-blue-700 dark:text-blue-200 uppercase tracking-wider"> {{ __('Action') }} </th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-950 divide-y divide-blue-50 dark:divide-blue-900">

                @forelse ($roles as $role)
                    <tr class="hover:bg-blue-50/80 dark:hover:bg-blue-900/40 transition">
                        <td class="px-6 py-2 whitespace-nowrap text-base font-semibold text-blue-800 dark:text-blue-200"> {{ $role->name }} </td>
                        <td class="px-6 py-2 whitespace-nowrap text-base font-semibold text-blue-800 dark:text-blue-200">
                            <flux:modal.trigger name="delete-role">
                                <flux:button type="button" @click="$wire.selectedRoleId = {{ $role->id }}" size="xs" variant="danger">
                                    <flux:icon.trash variant="solid" /> {{ __('Delete') }}
                                </flux:button>
                            </flux:modal.trigger>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="px-6 py-4 whitespace-nowrap text-center text-base font-semibold text-blue-800 dark:text-blue-200"> No roles found. </td>
                    </tr>
                @endforelse

            </tbody>
        </table>
        <div class="py-2 px-4">
            {{ $roles->links() }}
        </div>
    </div>

    <flux:modal name="delete-role" class="min-w-[22rem]">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg"> {{ __('Delete Role') }} </flux:heading>

                <flux:text class="mt-2">
                    {{ __('Are you sure you want to delete the selected role? This action cannot be undone.') }}
                </flux:text>
            </div>

            <div class="flex gap-2">
                <flux:spacer />
                <flux:modal.close>
                    <flux:button variant="ghost">Cancel</flux:button>
                </flux:modal.close>
                <flux:modal.close>
                    <flux:button type="button" variant="danger" wire:click="deleteRole">Delete</flux:button>
                </flux:modal.close>
            </div>
        </div>
    </flux:modal>

</div>
