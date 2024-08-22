<?php

namespace App\Livewire\Petugas;

use App\Models\Peminjaman;
use Livewire\Component;
use Livewire\WithPagination;
use Carbon\Carbon;

class Transaksi extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $belum_dipinjam, $sedang_dipinjam, $selesai_dipinjam, $search;

    public function belumDipinjam()
    {
        $this->format();
        $this->belum_dipinjam = true;
    }

    public function sedangDipinjam()
    {
        $this->format();
        $this->sedang_dipinjam = true;
    }

    public function selesaiDipinjam()
    {
        $this->format();
        $this->selesai_dipinjam = true;
    }

    public function pinjam(Peminjaman $peminjaman)
    {
        foreach ($peminjaman->detail_peminjaman as $detail_peminjaman) {
            $detail_peminjaman->buku->update([
                'stok' => $detail_peminjaman->buku->stok -1
            ]);
        }

        $peminjaman->update([
            'petugas_pinjam' => auth()->user()->id,
            'status' => 2
        ]);

        session()->flash('sukses', 'Buku berhasil dipinjam.');
    }

    public function kembali(Peminjaman $peminjaman)
    {
        $data = [
            'status' => 3,
            'petugas_kembali' => auth()->user()->id,
            'tanggal_pengembalian' => today(),
            'denda' => 0
        ];

        foreach ($peminjaman->detail_peminjaman as $detail_peminjaman) {
            $detail_peminjaman->buku->update([
                'stok' => $detail_peminjaman->buku->stok + 1
            ]);
        }

        if (Carbon::create($peminjaman->tanggal_kembali)->lessThan(today())) {
            $denda = Carbon::create($peminjaman->tanggal_kembali)->diffInDays(today());
            $denda *= 1000;
            $data['denda'] = $denda;
        }
        
        $peminjaman->update($data);
        session()->flash('sukses', 'Buku berhasil dikembalikan.');
    }

    public function render()
    {
        $query = Peminjaman::query();

        if ($this->search) {
            $query->search($this->search);
        }

        if ($this->belum_dipinjam) {
            $query->where('status', 1);
        } elseif ($this->sedang_dipinjam) {
            $query->where('status', 2);
        } elseif ($this->selesai_dipinjam) {
            $query->where('status', 3);
        } else {
            $query->where('status', '!=', 0);
        }

        $transaksi = $query->latest()->paginate(5);



        return view('livewire.petugas.transaksi', [
            'transaksi' => $transaksi,
        ]);
    }
    public function searchBuku()
    {
        $this->resetPage();
    }

    public function format()
    {
        $this->sedang_dipinjam = false;
        $this->belum_dipinjam = false;
        $this->selesai_dipinjam = false;
    }
}