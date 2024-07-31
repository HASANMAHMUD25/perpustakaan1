<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\User as ModelsUser;
use Livewire\WithPagination;
use Illuminate\Validation\Rules\Password;

class User extends Component
{
    use WithPagination;

    public $admin, $petugas, $peminjam, $search;
    public $create, $edit = false;
    public $name, $email, $password, $password_confirmation, $role;
    public $showAll = false; // Tambahan variabel untuk menampilkan semua data
    public $confirmingUserDeletion = false;
    public $userIdBeingDeleted;
    protected $paginationTheme = 'bootstrap';

    protected $validationAttributes = [
        'name' => 'nama',
        'password_confirmation' => 'ulangi password'
    ];

    protected function rules()
    {
        $rules = [
            'name' => 'required',
            'email' => ['required', 'email', 'unique:App\Models\User,email'],
            'role' => 'required'
        ];

        if ($this->edit) {
            $rules['email'] = ['required', 'email', 'unique:App\Models\User,email,' . $this->edit];
            if ($this->password) {
                $rules['password'] = ['required', 'confirmed', Password::min(8)];
                $rules['password_confirmation'] = 'required';
            }
        } else {
            $rules['password'] = ['required', 'confirmed', Password::min(8)];
            $rules['password_confirmation'] = 'required';
        }

        return $rules;
    }

    public function mount()
    {
        // Set default filter
        $this->admin_1();
    }

    public function admin_1()
    {
        $this->resetFilters();
        $this->admin = true;
    }

    public function petugas_1()
    {
        $this->resetFilters();
        $this->petugas = true;
    }

    public function peminjam_1()
    {
        $this->resetFilters();
        $this->peminjam = true;
    }

    public function semua()
    {
        $this->resetFilters();
        $this->showAll = true;
    }

    public function resetFilters()
    {
        $this->admin = false;
        $this->petugas = false;
        $this->peminjam = false;
        $this->create = false;
        $this->edit = false;
        $this->showAll = false;
        $this->confirmingUserDeletion = false;
        $this->userIdBeingDeleted = null;
        $this->reset(['name', 'email', 'password', 'password_confirmation', 'role']);
    }

    public function createForm()
    {
        $this->resetFilters();
        $this->create = true;
    }

    public function store()
    {
        $this->validate();

        $user = ModelsUser::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password)
        ]);

        $user->assignRole($this->role);

        session()->flash('sukses', 'Data berhasil ditambahkan.');
        $this->resetFilters();
    }

    public function showEditForm($userId)
    {
        $this->resetFilters();
        $this->edit = $userId;
        $user = ModelsUser::findOrFail($userId);
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role = $user->roles->pluck('name')->first();
    }

    public function update()
    {
        $this->validate();

        $user = ModelsUser::findOrFail($this->edit);
        $user->update([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password ? bcrypt($this->password) : $user->password
        ]);

        $user->syncRoles($this->role);

        session()->flash('sukses', 'Data berhasil diubah.');
        $this->resetFilters();
    }

    public function confirmDelete($userId)
    {
        $this->confirmingUserDeletion = true;
        $this->userIdBeingDeleted = $userId;
    }

    public function delete()
    {
        ModelsUser::findOrFail($this->userIdBeingDeleted)->delete();
        session()->flash('sukses', 'Data berhasil dihapus.');
        $this->resetFilters();
    }

    public function updatingSearch()
    {
        $this->resetPage(); // Reset halaman saat melakukan pencarian
    }

    public function searchBuku()
    {
        $this->resetPage();
    }

    public function render()
    {
        $usersQuery = ModelsUser::query();

        if ($this->admin) {
            $usersQuery->role('admin');
        } elseif ($this->petugas) {
            $usersQuery->role('petugas');
        } elseif ($this->peminjam) {
            $usersQuery->role('peminjam');
        }

        if ($this->search) {
            $usersQuery->search($this->search);
        }

        $users = $usersQuery->paginate(5);

        // Tambahkan penanganan jika data kosong
        if ($users->isEmpty()) {
            session()->flash('gagal', 'Data tidak ditemukan.');
        }

        return view('livewire.admin.user', compact('users'));
    }
}
