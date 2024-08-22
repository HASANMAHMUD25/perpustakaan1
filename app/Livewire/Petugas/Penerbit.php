<?php

namespace App\Livewire\Petugas;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Penerbit as ModelsPenerbit;
use Illuminate\Support\Str;

class Penerbit extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $nama, $penerbit_id, $search;
    public $createMode = false, $editMode = false, $deleteMode = false, $penerbitToDelete;

    protected $rules = [
        'nama' => 'required|min:5',
    ];

    public function searchPenerbit()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = ModelsPenerbit::query();

        if ($this->search) {
            $query->search($this->search);
        }

        $penerbits = $query->latest()->paginate(10);

        return view('livewire.petugas.penerbit', [
            'penerbits' => $penerbits,
        ]);
    }

    public function showCreateForm()
    {
        $this->resetValidation();
        $this->createMode = true;
    }

    public function cancelCreate()
    {
        $this->reset(['nama', 'createMode']);
    }

    public function store()
    {
        $this->validate();

        ModelsPenerbit::create([
            'nama' => $this->nama,
            'slug' => Str::slug($this->nama),
        ]);

        session()->flash('sukses', 'Data berhasil ditambahkan.');

        $this->reset(['nama', 'createMode']);
    }

    public function showEditForm($id)
    {
        $penerbit = ModelsPenerbit::findOrFail($id);
        $this->penerbit_id = $id;
        $this->nama = $penerbit->nama;
        $this->editMode = true;
    }

    public function cancelEdit()
    {
        $this->reset(['nama', 'editMode', 'penerbit_id']);
    }

    public function update()
    {
        $this->validate();

        $penerbit = ModelsPenerbit::findOrFail($this->penerbit_id);
        $penerbit->update([
            'nama' => $this->nama,
            'slug' => Str::slug($this->nama),
        ]);

        session()->flash('sukses', 'Data berhasil diperbarui.');

        $this->reset(['nama', 'editMode', 'penerbit_id']);
    }

    public function confirmDelete($id)
    {
        $this->penerbitToDelete = $id;
        $this->deleteMode = true;
    }

    public function cancelDelete()
    {
        $this->reset(['deleteMode', 'penerbitToDelete']);
    }

    public function delete()
    {
        ModelsPenerbit::findOrFail($this->penerbitToDelete)->delete();

        session()->flash('sukses', 'Data berhasil dihapus.');
        $this->reset(['deleteMode', 'penerbitToDelete']);
    }
}
