<?php

namespace Yuricronos\VoltPermission\Livewire\Forms;

use Livewire\Form;
use Spatie\Permission\Models\Role;

class RoleForm extends Form
{
    public string|null $name;

    protected function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
        ];
    }

    public function save()
    {
        $this->validate();
        $params = $this->toArray();
        Role::create($params);
        $this->reset();
        session()->flash('success', 'Role has been created successfully.');
    }

    public function delete($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
        session()->flash('success', 'Role has been deleted successfully.');
    }
}
