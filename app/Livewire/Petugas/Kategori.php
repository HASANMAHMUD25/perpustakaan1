<?php

namespace App\Livewire\Petugas;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Kategori as ModelsKategori;
use Illuminate\Support\Str;
use App\Models\Rak as ModelsRak;

class Kategori extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $nama, $kategori_id, $search;
    public $createMode = false, $editMode = false, $deleteMode = false;

    protected $rules = [
        'nama' => 'required|min:5',
    ];

    public function showCreateForm()
    {
        $this->resetValidation();
        $this->resetForm();
        $this->createMode = true;
    }

    public function store()
    {
        $this->validate();

        ModelsKategori::create([
            'nama' => $this->nama,
            'slug' => Str::slug($this->nama)
        ]);

        session()->flash('sukses', 'Data berhasil ditambahkan.');

        $this->resetForm();
    }

    public function showEditForm(ModelsKategori $kategori)
    {
        $this->resetValidation();
        $this->resetForm();

        $this->editMode = true;
        $this->nama = $kategori->nama;
        $this->kategori_id = $kategori->id;
    }

    public function update()
    {
        $this->validate();

        $kategori = ModelsKategori::findOrFail($this->kategori_id);
        $kategori->update([
            'nama' => $this->nama,
            'slug' => Str::slug($this->nama)
        ]);

        session()->flash('sukses', 'Data berhasil diperbarui.');

        $this->resetForm();
    }

    public function confirmDelete($id)
    {
        $this->deleteMode = true;
        $this->kategori_id = $id;
    }

    public function delete()
    {
        $rak = ModelsRak::where('kategori_id', $this->kategori_id)->get();
        foreach ($rak as $key => $value) {
            $value->update([
                'kategori_id' => 1 // Assuming default category ID for moved items
            ]);
        }

        ModelsKategori::findOrFail($this->kategori_id)->delete();

        session()->flash('sukses', 'Data berhasil dihapus.');

        $this->resetForm();
    }

    public function cancelCreate()
    {
        $this->resetForm();
        $this->createMode = false;
    }

    public function cancelEdit()
    {
        $this->resetForm();
        $this->editMode = false;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = ModelsKategori::query();
    
        if ($this->search) {
            $query->search($this->search);
        }
    
        $kategori = $query->latest()->paginate(5);
    
        // Jika tidak ada hasil pencarian
        if ($this->search && $kategori->isEmpty()) {
            session()->flash('gagal', 'Data tidak ditemukan.');
        }
    
        return view('livewire.petugas.kategori', [
            'kategori' => $kategori
        ]);
    }
    

    public function resetForm()
    {
        $this->nama = '';
        $this->kategori_id = null;
        $this->createMode = false;
        $this->editMode = false;
        $this->deleteMode = false;
    }
}
