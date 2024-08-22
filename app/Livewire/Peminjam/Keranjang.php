<?php

namespace App\Livewire\Peminjam;

use App\Models\DetailPeminjaman;
use App\Models\Peminjaman;
use Carbon\Carbon;
use Livewire\Component;

class Keranjang extends Component
{
    public $tanggal_pinjam;
    public $isProcessing = false;
    public $status;

    protected $rules = [
        'tanggal_pinjam' => 'required|date|after_or_equal:today',
    ];

    public function mount()
    {
        $keranjang = Peminjaman::latest()->where('peminjam_id', auth()->user()->id)->where('status', '!=', 3)->first();
        $this->status = $keranjang ? $keranjang->status : null;
    }

    public function hapus(Peminjaman $peminjaman, DetailPeminjaman $detail_peminjaman)
{
    if ($peminjaman->status != 1 && $peminjaman->status != 2) {
        if ($peminjaman->detail_peminjaman->count() == 1) {
            $detail_peminjaman->delete();
            $peminjaman->delete();
            session()->flash('sukses', 'Data berhasil dihapus');
            redirect('/');
        } else {
            $detail_peminjaman->delete();
            session()->flash('sukses', 'Data berhasil dihapus');
            $this->dispatch('kurangiKeranjang');
        }
    }
}


public function hapusMasal()
{
    $keranjang = Peminjaman::latest()
        ->where('peminjam_id', auth()->user()->id)
        ->where('status', '!=', 3)
        ->first();

    if ($keranjang && $keranjang->status != 1 && $keranjang->status != 2) {
        foreach ($keranjang->detail_peminjaman as $detail_peminjaman) {
            $detail_peminjaman->delete();
        }
        $keranjang->delete();
        session()->flash('sukses', 'Data berhasil dihapus');
        return redirect('/buku1');
    }
}


    public function pinjam($keranjangId)
    {
        $this->isProcessing = true; // Mulai proses peminjaman

        $this->validate();

        $keranjang = Peminjaman::findOrFail($keranjangId);
        $keranjang->update([
            'status' => 1, // Sedang diproses
            'tanggal_pinjam' => $this->tanggal_pinjam,
            'tanggal_kembali' => Carbon::create($this->tanggal_pinjam)->addDays(10)
        ]);

        $this->status = 1; // Update status property
        $this->isProcessing = false; // Selesaikan proses peminjaman

        session()->flash('sukses', 'Buku sedang diproses');
    }

    public function setujui($keranjangId)
    {
        $keranjang = Peminjaman::findOrFail($keranjangId);
        $keranjang->update(['status' => 2]); // Sudah disetujui
        $this->status = 2; // Update status property
    }

    public function resetStatus($keranjangId)
    {
        $keranjang = Peminjaman::findOrFail($keranjangId);
        $keranjang->update(['status' => 3]); // Kembali ke status pinjam
        $this->status = 3; // Update status property
    }

    public function render()
    {
        $keranjang = Peminjaman::latest()->where('peminjam_id', auth()->user()->id)->where('status', '!=', 3)->first();
        if (!$keranjang) {
            redirect('/');
        }
        return view('livewire.peminjam.keranjang', [
            'keranjang' => $keranjang
        ]);
    }
}
