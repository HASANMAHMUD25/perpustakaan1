<div class="container my-5">
    @include('admin-lte/flash')

    <div class="row">
        <div class="col-md-8 mb-3">
            <h1>{{ $title }}</h1>
        </div>
        @if (!$detail_buku)
            <div class="col-md-4">
                <label class="sr-only" for="inlineFormInputGroup">Cari Buku</label>
                <div class="input-group mb-3">
                    <input wire:model="search" type="text" class="form-control" id="inlineFormInputGroup" placeholder="Cari Buku">
                    <div class="input-group-append">
                        <button wire:click="searchBooks" class="btn btn-outline-secondary">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        @endif
    </div>

    @if ($detail_buku)
        <div class="row">
            <div class="col-md-4">
                <img src="/storage/img/{{ $buku->sampul }}" alt="{{ $buku->judul }}" class="img-fluid rounded">
            </div>
            <div class="col-md-8">
                <table class="table table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>Judul</th>
                            <td>:</td>
                            <td>{{ $buku->judul }}</td>
                        </tr>
                        <tr>
                            <th>Penulis</th>
                            <td>:</td>
                            <td>{{ $buku->penulis }}</td>
                        </tr>
                        <tr>
                            <th>Kategori</th>
                            <td>:</td>
                            <td>
                                @if($buku->kategori)
                                    {{ $buku->kategori->nama }}
                                @else
                                    Tidak ada kategori
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Penerbit</th>
                            <td>:</td>
                            <td>
                                @if($buku->penerbit)
                                    {{ $buku->penerbit->nama }}
                                @else
                                    Tidak ada penerbit
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Rak</th>
                            <td>:</td>
                            <td>
                                @if($buku->rak)
                                    {{ $buku->rak->rak }}
                                @else
                                    Tidak ada rak
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Stok</th>
                            <td>:</td>
                            <td>{{ $buku->stok }}</td>
                        </tr>
                    </thead>
                </table>

                <button wire:click="keranjang({{ $buku->id }})" class="btn btn-success"><i class="fas fa-shopping-cart"></i> Pinjam</button>
                <button wire:click="kembali()" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</button>
            </div>
        </div>
    @else
        @if ($buku->isNotEmpty())
            <div class="row">
                @foreach ($buku as $item)
                    <div wire:click="detailBuku({{ $item->id }})" class="col-lg-3 col-md-4 col-sm-6 mb-4">
                        <div class="card shadow-sm" style="cursor: pointer;">
                            <img src="{{ Storage::url('img/' . $item->sampul) }}" class="card-img-top img-fluid" alt="{{ $item->judul }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $item->judul }}</h5>
                                <p class="card-text">{{ $item->penulis }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="row justify-content-center">
                {{ $buku->links() }}
            </div>
        @else
            <div class="alert alert-danger text-center">
                <i class="fas fa-exclamation-triangle"></i> Data Tidak ada
            </div>
        @endif
    @endif
</div>
