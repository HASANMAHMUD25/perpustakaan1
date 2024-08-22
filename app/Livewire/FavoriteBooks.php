<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Buku as ModelsBuku;
use App\Models\Peminjaman;
use App\Models\DetailPeminjaman;
use App\Models\Kategori;
use Illuminate\Support\Facades\DB;

class FavoriteBooks extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search;
    public $category_id = null;
    public $detail_buku = false;
    public $buku_id;
    public $selectedBuku = null;
    public $pilih_kategori = false;

    protected $listeners = ['searchBooks', 'pilihKategori', 'searchBooks'];



    public function pilihKategori($id)
    {
        $this->category_id = $id;
        $this->pilih_kategori = true;
        $this->updatingSearch();
    }

    public function semuaKategori()
    {
        $this->category_id = null;
        $this->pilih_kategori = false;
        $this->updatingSearch();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function searchBooks()
    {
        $this->updatingSearch();
    }

    public function detailBuku($id)
    {
        $this->buku_id = $id;
        $this->detail_buku = true;
        $this->selectedBuku = ModelsBuku::find($id);
    }

    public function kembali()
    {
        $this->detail_buku = false;
        $this->buku_id = null;
        $this->selectedBuku = null;
    }

    public function keranjang(ModelsBuku $buku)
    {
        if (auth()->user()) {
            if (auth()->user()->hasRole('peminjam')) {
                $peminjaman_lama = DB::table('peminjaman')
                    ->join('detail_peminjaman', 'peminjaman.id', '=', 'detail_peminjaman.peminjaman_id')
                    ->where('peminjam_id', auth()->user()->id)
                    ->where('status', '!=', 3)
                    ->get();

                if ($peminjaman_lama->count() == 2) {
                    session()->flash('gagal', 'Buku yang dipinjam maksimal 2');
                } else {
                    if ($peminjaman_lama->count() == 0) {
                        $peminjaman_baru = Peminjaman::create([
                            'kode_pinjam' => random_int(100000000, 999999999),
                            'peminjam_id' => auth()->user()->id,
                            'status' => 0
                        ]);

                        DetailPeminjaman::create([
                            'peminjaman_id' => $peminjaman_baru->id,
                            'buku_id' => $buku->id
                        ]);

                        $this->dispatch('tambahKeranjang');
                        session()->flash('sukses', 'Buku berhasil ditambahkan ke dalam keranjang');
                    } else {
                        if ($peminjaman_lama[0]->buku_id == $buku->id) {
                            session()->flash('gagal', 'Buku tidak boleh sama');
                        } else {
                            DetailPeminjaman::create([
                                'peminjaman_id' => $peminjaman_lama[0]->peminjaman_id,
                                'buku_id' => $buku->id
                            ]);

                            $this->dispatch('tambahKeranjang');
                            session()->flash('sukses', 'Buku berhasil ditambahkan ke dalam keranjang');
                        }
                    }
                }
            } else {
                session()->flash('gagal', 'Role user anda bukan peminjam');
            }
        } else {
            session()->flash('gagal', 'Anda harus login terlebih dahulu');
            return redirect('/login');
        }
    }

    public function render()
{
    $bukuQuery = ModelsBuku::whereIn('id', function ($query) {
        $query->select('buku_id')
            ->from('detail_peminjaman')
            ->join('peminjaman', 'detail_peminjaman.peminjaman_id', '=', 'peminjaman.id')
            ->where('peminjaman.status', 3) // Assuming status 3 means completed
            ->groupBy('buku_id')
            ->orderByRaw('COUNT(buku_id) DESC')
            ->pluck('buku_id');
    });

    if ($this->search) {
        $bukuQuery->search($this->search);
    }

    if ($this->category_id) {
        $bukuQuery->where('kategori_id', $this->category_id);
    }

    $buku = $bukuQuery->latest()->paginate(12);

    $title = 'Buku Favorit';

    return view('livewire.favorite-books', [
        'buku' => $buku,
        'title' => $title,
        'selectedBuku' => $this->selectedBuku,
        'kategori' => Kategori::all(),
    ]);
}

}