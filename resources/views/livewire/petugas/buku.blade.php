<div>
    <div class="row">
        <div class="col-12">
            @include('admin-lte.flash')

            @include('petugas.buku.create')
            @include('petugas.buku.edit')
            @include('petugas.buku.detail')
            @include('petugas.buku.delete')

            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="btn btn-sm btn-primary" wire:click="showCreateForm">Tambah Buku</span>

                        <div class="card-tools">
                            <div class="input-group input-group-sm" style="width: 250px;">
                                <input type="text" class="form-control float-right" placeholder="Search"
                                       wire:model.debounce.300ms="search">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-default" wire:click="searchBuku">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th width="10%">No</th>
                                <th>Sampul</th>
                                <th>Rak</th>
                                <th>Judul</th>
                                <th>Stok</th>
                                <th>Penulis</th>
                                <th>Kategori</th>
                                <th width="10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($buku as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        @if ($item->sampul)
                                            <img src="{{ Storage::url('img/' . $item->sampul) }}" alt="Sampul"
                                                 style="max-width: 100px;">
                                        @else
                                            <span>Tidak ada gambar</span>
                                        @endif
                                    </td>
                                    <td>{{ $item->rak_id }}</td>
                                    <td>{{ $item->judul }}</td>
                                    <td>{{ $item->stok }}</td>
                                    <td>{{ $item->penulis }}</td>
                                    <td>{{ $item->kategori->nama ?? 'None' }}</td>
                                    <td>
                                    <button wire:click="showDetail({{ $item->id }})"
                                                    class="btn btn-sm btn-info">Detail
                                            </button>
                                        <div class="btn-group">
                                            <button wire:click="showEditForm({{ $item->id }})"
                                                    class="btn btn-sm btn-primary">Edit
                                            </button>
                                            <button wire:click="confirmDelete({{ $item->id }})"
                                                    class="btn btn-sm btn-danger">Hapus
                                            </button>

                                        </div>
                                    </td>
                                </tr>
                            
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                    {{ $buku->links() }}
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
</div>
