<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Keranjang</h1>
        </div>
    </div>

    @include('admin-lte/flash')

    @if($status != 1 && $status != 2)
    <div class="row">
        <div class="col-md-12 mb-4">
            <label for="tanggal_pinjam">Tanggal Pinjam</label>
            <input wire:model="tanggal_pinjam" type="date" class="form-control" id="tanggal_pinjam">
            @error('tanggal_pinjam') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
    </div>
    @endif

    <div class="row">
        <div class="col-md-12 mb-2">
            @if($status == 1)
                <button class="btn btn-secondary" disabled>Sedang di Proses</button>
            @elseif($status == 2)
                <button class="btn btn-success" disabled>Sudah Disetujui</button>
            @else
                <button wire:click="pinjam({{ $keranjang->id }})" 
                        wire:loading.attr="disabled" 
                        wire:target="pinjam" 
                        wire:loading.class="btn-secondary" 
                        class="btn btn-primary" 
                        {{ $isProcessing ? 'disabled' : '' }}>
                    {{ $isProcessing ? 'Masih di Proses' : 'Pinjam' }}
                </button>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th>Rak</th>
                    <th>Baris</th>
                    @if ($keranjang->status != 1 && $keranjang->status != 2)
                    <th>Aksi</th> 
                    @endif 
                </tr>
                </thead>
                <tbody>
                    @foreach ($keranjang->detail_peminjaman as $item)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$item->buku->judul}}</td>
                            <td>{{$item->buku->penulis}}</td>
                            <td>{{$item->buku->rak->rak}}</td>
                            <td>{{$item->buku->rak->baris}}</td>
                            <td>
                            @if ($keranjang->status != 1 && $keranjang->status != 2)
    <button wire:click="hapus({{ $keranjang->id }}, {{ $item->id }})" class="btn btn-sm btn-danger">Hapus</button>
@endif

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            @if ($keranjang->status != 1 && $keranjang->status != 2)
    <button wire:click="hapusMasal" class="btn btn-sm btn-danger">Hapus Masal</button>
@endif
            <a href="/buku1" class="btn btn-sm btn-primary">Kembali</a>
        </div>
    </div>
</div>
