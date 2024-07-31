<?php

namespace App\Livewire\Petugas;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Rak as ModelsRak;
use App\Models\Kategori as ModelsKategori;
use Illuminate\Support\Str;

class Rak extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $rak, $baris, $kategori_id, $rak_id;
    public $createMode = false, $editMode = false, $deleteMode = false, $rakToDelete;
    public $search = '';

    protected $messages = [
        'rak.required' => 'rak harus diisi.',
        'baris.required' => 'baris harus diisi.',
    ];

    protected $rules = [
        'rak' => 'required|numeric|min:1',
        'baris' => 'required|numeric|min:1|not_in:rak_pilihan',
        'kategori_id' => 'required|numeric|min:1|exists:kategori,id',
    ];

    public function render()
    {
        $query = ModelsRak::query();

        if ($this->search) {
            $query->search($this->search);
        }

        $raks = $query->latest()->paginate(5);

        if ($raks->isEmpty()) {
            session()->flash('gagal', 'Data tidak ditemukan.');
        }

        return view('livewire.petugas.rak', [
            'raks' => $raks,
            'kategoris' => ModelsKategori::all(),
        ]);
    }


    public function showCreateForm()
    {
        $this->resetValidation();
        $this->createMode = true;
    }

    public function cancelCreate()
    {
        $this->reset(['rak', 'baris', 'kategori_id', 'createMode']);
    }

    public function store()
    {
        // Mendapatkan nilai 'baris' dari tabel 'rak' yang sesuai dengan nilai 'rak' yang diinput
        $rak_pilihan = ModelsRak::select('baris')->where('rak', $this->rak)->get()->implode('baris', ',');

        // Melakukan validasi dengan aturan tambahan
        $this->validate([
            'rak' => 'required|numeric|min:1',
            'baris' => 'required|numeric|min:1|not_in:' . $rak_pilihan,
            'kategori_id' => 'required|numeric|min:1|exists:kategori,id',
        ]);

        // Menyimpan data ke database
        ModelsRak::create([
            'rak' => $this->rak,
            'baris' => $this->baris,
            'slug' => Str::slug($this->rak . '-' . $this->baris),
            'kategori_id' => $this->kategori_id,
        ]);

        // Menampilkan pesan sukses
        session()->flash('sukses', 'Data berhasil ditambahkan.');

        // Mereset input
        $this->reset(['rak', 'baris', 'kategori_id', 'createMode']);
    }

    public function showEditForm($id)
    {
        $rak = ModelsRak::findOrFail($id);
        $this->rak_id = $id;
        $this->rak = $rak->rak;
        $this->baris = $rak->baris;
        $this->kategori_id = $rak->kategori_id;
        $this->editMode = true;
    }

    public function cancelEdit()
    {
        $this->reset(['rak', 'baris', 'kategori_id', 'editMode', 'rak_id']);
    }

    public function update()
    {
        // Mendapatkan nilai 'baris' dari tabel 'rak' yang sesuai dengan nilai 'rak' yang diinput
        $rak_pilihan = ModelsRak::select('baris')->where('rak', $this->rak)->get()->implode('baris', ',');

        // Melakukan validasi dengan aturan tambahan
        $this->validate([
            'rak' => 'required|numeric|min:1',
            'baris' => 'required|numeric|min:1|not_in:' . $rak_pilihan,
            'kategori_id' => 'required|numeric|min:1|exists:kategori,id',
        ]);

        // Memperbarui data di database
        $rak = ModelsRak::findOrFail($this->rak_id);
        $rak->update([
            'rak' => $this->rak,
            'baris' => $this->baris,
            'slug' => Str::slug($this->rak . '-' . $this->baris),
            'kategori_id' => $this->kategori_id,
        ]);

        // Menampilkan pesan sukses
        session()->flash('sukses', 'Data berhasil diperbarui.');

        // Mereset input
        $this->reset(['rak', 'baris', 'kategori_id', 'editMode', 'rak_id']);
    }

    public function confirmDelete($id)
    {
        $this->rakToDelete = $id;
        $this->deleteMode = true;
    }

    public function cancelDelete()
    {
        $this->reset(['deleteMode', 'rakToDelete']);
    }

    public function delete()
    {
        ModelsRak::findOrFail($this->rakToDelete)->delete();
        session()->flash('sukses', 'Data berhasil dihapus.');
        $this->reset(['deleteMode', 'rakToDelete']);
    }
}
