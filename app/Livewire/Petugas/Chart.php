<?php

namespace App\Livewire\Petugas;

use App\Models\Peminjaman;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Chart extends Component
{
    public $bulan_tahun;

    protected $listeners = ['updateChart'];

    public function updateChart()
    {
        if ($this->bulan_tahun) {
            $bulan = substr($this->bulan_tahun, -2);
            $tahun = substr($this->bulan_tahun, 0, 4);

            $selesai_dipinjam = Peminjaman::select(DB::raw('count(*) as count, tanggal_pengembalian'))
                ->groupBy('tanggal_pengembalian')
                ->whereMonth('tanggal_pengembalian', $bulan)
                ->whereYear('tanggal_pengembalian', $tahun)
                ->where('status', 3)
                ->get();

            $hari_per_bulan = Carbon::parse($this->bulan_tahun)->daysInMonth;

            $tanggal_pengembalian = [];
            $count = [];
            for ($i = 1; $i <= $hari_per_bulan; $i++) {
                $tanggal_pengembalian[$i] = $i;
                $count[$i] = 0;
                
                foreach ($selesai_dipinjam as $item) {
                    if (substr($item->tanggal_pengembalian, 0, 2) == $i) {
                        $tanggal_pengembalian[$i] = substr($item->tanggal_pengembalian, 0, 2);
                        $count[$i] = $item->count;
                        break;
                    }
                }
            }

            $count = collect($count)->flatten();
            $tanggal_pengembalian = collect($tanggal_pengembalian)->flatten();

            // Emit event with data
            $this->dispatch('ubahBulanTahun', $count, $tanggal_pengembalian);
        }
    }

    public function render()
    {
        return view('livewire.petugas.chart');
    }
}
