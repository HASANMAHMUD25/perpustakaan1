<?php

namespace App\Livewire\Petugas;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads; // Import trait WithFileUploads
use Illuminate\Support\Facades\Storage; // Import Storage facade
use Illuminate\Http\UploadedFile; // Import UploadedFile
use App\Models\Buku as ModelsBuku;
use App\Models\Kategori;
use App\Models\Penerbit;
use App\Models\Rak;
use Illuminate\Support\Str;

class Buku extends Component
{
    use WithPagination, WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    public $judul, $sampul, $penulis, $penerbit_id, $kategori_id, $rak_id, $stok, $buku_id;
    public $createMode = false, $editMode = false, $deleteMode = false, $bukuToDelete;
    public $detailMode = false, $bukuDetail;
    public $search = '';

    protected $rules = [
        'judul' => 'required|min:2',
        'sampul' => 'image|max:1024', // max 1MB
        'penulis' => 'required|min:2',
        'penerbit_id' => 'required|exists:penerbit,id',
        'kategori_id' => 'required|exists:kategori,id',
        'rak_id' => 'required|exists:rak,id',
        'stok' => 'required|numeric|min:1',
    ];
    public function searchBuku()
    {
        $this->resetPage();
    }
    

    public function render()
    {
        $bukuQuery = ModelsBuku::with('kategori')
            ->when($this->search != '', function ($query) {
                $query->search($this->search);
            })
            ->latest()
            ->paginate(5);

            if ($this->search && $bukuQuery->isEmpty()) {
                session()->flash('gagal', 'Data tidak ditemukan.');
            }

        return view('livewire.petugas.buku', [
            'buku' => $bukuQuery,
            'kategoris' => Kategori::all(),
            'penerbits' => Penerbit::all(),
            'raks' => Rak::all(),
        ]);
    }

    public function showCreateForm()
    {
        $this->resetValidation();
        $this->reset(['judul', 'penulis', 'sampul', 'penerbit_id', 'kategori_id', 'rak_id', 'stok', 'buku_id']);
        $this->createMode = true;
    }

    public function cancelCreate()
    {
        $this->reset(['createMode']);
    }

    public function pilihkategori()
    {
        $this->rak_id = rak::where('kategori_id', $this->kategori_id)->get();
        $this->rak_id = null;
    }

    public function store()
    {
        $this->validate();

        if ($this->sampul) {
            $sampulPath = $this->sampul->store('public/img');
            $sampulName = Str::after($sampulPath, 'public/img/');
        } else {
            $sampulName = null;
        }

        ModelsBuku::create([
            'judul' => $this->judul,
            'slug' => Str::slug($this->judul),
            'sampul' => $sampulName,
            'penulis' => $this->penulis,
            'penerbit_id' => $this->penerbit_id,
            'kategori_id' => $this->kategori_id,
            'rak_id' => $this->rak_id,
            'stok' => $this->stok,
        ]);

        session()->flash('sukses', 'Data berhasil ditambahkan.');
        $this->reset(['judul', 'sampul', 'penulis', 'penerbit_id', 'kategori_id', 'rak_id', 'stok', 'createMode']);
    }

    public function showEditForm($id)
    {
        $buku = ModelsBuku::findOrFail($id);
        $this->buku_id = $id;
        $this->judul = $buku->judul;
        $this->penulis = $buku->penulis;
        $this->sampul = $buku->sampul;
        $this->penerbit_id = $buku->penerbit_id;
        $this->kategori_id = $buku->kategori_id;
        $this->rak_id = $buku->rak_id;
        $this->stok = $buku->stok;
        $this->editMode = true;
    }

    public function cancelEdit()
    {
        $this->reset(['editMode', 'judul', 'penulis', 'sampul', 'penerbit_id', 'kategori_id', 'rak_id', 'stok', 'buku_id']);
    }

    public function update()
    {
        $this->validate();

        $buku = ModelsBuku::findOrFail($this->buku_id);

        if ($this->sampul instanceof \Illuminate\Http\UploadedFile) {
            $sampulPath = $this->sampul->store('public/img');
            if ($buku->sampul && Storage::exists('public/img/' . $buku->sampul)) {
                Storage::delete('public/img/' . $buku->sampul);
            }
            $buku->sampul = Str::after($sampulPath, 'public/img/');
        }

        $buku->update([
            'judul' => $this->judul,
            'penulis' => $this->penulis,
            'penerbit_id' => $this->penerbit_id,
            'kategori_id' => $this->kategori_id,
            'rak_id' => $this->rak_id,
            'stok' => $this->stok,
        ]);

        session()->flash('sukses', 'Data berhasil diperbarui.');
        $this->reset(['editMode', 'judul', 'penulis', 'sampul', 'penerbit_id', 'kategori_id', 'rak_id', 'stok', 'buku_id']);
    }

    public function showDetail($id)
    {
        $this->bukuDetail = ModelsBuku::findOrFail($id);
        $this->detailMode = true;
    }

    public function cancelDetail()
    {
        $this->reset(['detailMode', 'bukuDetail']);
    }

    public function confirmDelete($id)
    {
        $this->bukuToDelete = $id;
        $this->deleteMode = true;
    }

    public function cancelDelete()
    {
        $this->reset(['deleteMode', 'bukuToDelete']);
    }

    public function delete()
    {
        $buku = ModelsBuku::findOrFail($this->bukuToDelete);
        if ($buku->sampul && Storage::exists('public/img/' . $buku->sampul)) {
            Storage::delete('public/img/' . $buku->sampul);
        }
        $buku->delete();
        session()->flash('sukses', 'Data berhasil dihapus.');
        $this->reset(['deleteMode', 'bukuToDelete']);
    }

    public function deleteKategori($id)
    {
        $kategori = Kategori::findOrFail($id);
        ModelsBuku::where('kategori_id', $id)->update(['kategori_id' => null]);
        $kategori->delete();
        session()->flash('sukses', 'Kategori berhasil dihapus.');
    }

    public function deletePenerbit($id)
    {
        $penerbit = Penerbit::findOrFail($id);
        ModelsBuku::where('penerbit_id', $id)->update(['penerbit_id' => null]);
        $penerbit->delete();
        session()->flash('sukses', 'Penerbit berhasil dihapus.');
    }

    public function deleteRak($id)
    {
        $rak = Rak::findOrFail($id);
        ModelsBuku::where('rak_id', $id)->update(['rak_id' => null]);
        $rak->delete();
        session()->flash('sukses', 'Rak berhasil dihapus.');
    }
}