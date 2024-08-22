<div>
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

        @if ($detail_buku && $selectedBuku)
            <div class="row">
                <div class="col-md-4 mb-3">
                    <img src="{{ Storage::url('img/' . $selectedBuku->sampul) }}" alt="{{ $selectedBuku->judul }}" class="img-fluid rounded">
                </div>
                <div class="col-md-8">
                    <table class="table table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th>Judul</th>
                                <td>:</td>
                                <td>{{ $selectedBuku->judul }}</td>
                            </tr>
                            <tr>
                                <th>Penulis</th>
                                <td>:</td>
                                <td>{{ $selectedBuku->penulis }}</td>
                            </tr>
                            <tr>
                                <th>Kategori</th>
                                <td>:</td>
                                <td>
                                    @if($selectedBuku->kategori)
                                        {{ $selectedBuku->kategori->nama }}
                                    @else
                                        Tidak ada kategori
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Penerbit</th>
                                <td>:</td>
                                <td>
                                    @if($selectedBuku->penerbit)
                                        {{ $selectedBuku->penerbit->nama }}
                                    @else
                                        Tidak ada penerbit
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Rak</th>
                                <td>:</td>
                                <td>
                                    @if($selectedBuku->rak)
                                        {{ $selectedBuku->rak->rak }}
                                    @else
                                        Tidak ada rak
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Stok</th>
                                <td>:</td>
                                <td>{{ $selectedBuku->stok }}</td>
                            </tr>
                        </thead>
                    </table>

                    <button wire:click="keranjang({{ $selectedBuku->id }})" class="btn btn-success mb-2">
                        <i class="fas fa-shopping-cart"></i> Pinjam
                    </button>
                    <button wire:click="kembali()" class="btn btn-secondary mb-2">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </button>
                </div>
            </div>
        @else
            @if ($buku->isNotEmpty())
                <div class="row">
                    @foreach ($buku as $item)
                        <div wire:click="detailBuku({{ $item->id }})" class="col-lg-3 col-md-4 col-sm-6 col-12 mb-4">
                            <div class="card shadow-sm h-100" style="cursor: pointer;">
                                <img src="{{ Storage::url('img/' . $item->sampul) }}" class="card-img-top" alt="{{ $item->judul }}">
                                <div class="card-body d-flex flex-column">
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
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-triangle"></i> Data Tidak ada
                </div>
            @endif
        @endif
    </div>
</div>
