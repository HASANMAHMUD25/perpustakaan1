<div>
    <div class="row">
        <div class="col-12">
            @include('admin-lte.flash')

            {{-- Form Tambah Penerbit --}}
            @if ($createMode)
                @include('petugas.penerbit.create')
            @endif

            {{-- Form Edit Penerbit --}}
            @if ($editMode)
                @include('petugas.penerbit.edit')
            @endif

            {{-- Form Hapus Penerbit --}}
            @if ($deleteMode)
                @include('petugas.penerbit.delete')
            @endif

            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="btn btn-sm btn-primary" wire:click="showCreateForm">Tambah Penerbit</span>

                        <div class="card-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" wire:model.defer="search" class="form-control float-right" placeholder="Search">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-default" wire:click="searchPenerbit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    @if($penerbits->count())
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th width="10%">No</th>
                                    <th>Nama</th>
                                    <th width="10%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($penerbits as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <button wire:click="showEditForm({{ $item->id }})" class="btn btn-sm btn-primary">Edit</button>
                                                <button wire:click="confirmDelete({{ $item->id }})" class="btn btn-sm btn-danger">Hapus</button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="alert alert-warning text-center">
                            Data tidak ditemukan.
                        </div>
                    @endif
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                    {{ $penerbits->links() }}
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
</div>
