<div>
    <div class="row">
        <div class="col-12">

        @include('admin-lte/flash')   

        @include('petugas/rak/create')
        @include('petugas/rak/edit')  
        @include('petugas/rak/delete') 

        
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="btn btn-sm btn-primary" wire:click="showCreateForm">Tambah raks</span>

                        <div class="card-tools">
                            <form wire:submit.prevent="">
                            <div class="input-group input-group-sm mb-3">
    <input type="text" class="form-control" placeholder="Cari Rak..." wire:model="search">
    <div class="input-group-append">
        <button class="btn btn-outline-secondary" type="button" wire:click="$refresh">
            <i class="fas fa-search"></i>
        </button>
    </div>
</div>

                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th width="10%">No</th>
                                <th>Rak</th>
                                <th>Baris</th>
                                <th>kategori</th>
                                <th width="10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($raks as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->rak }}</td>
                                    <td>{{ $item->baris }}</td>
                                    <td>{{ $item->kategori->nama}}</td>
                                    <td>
                                        <div class="btn-group">
                                        <button wire:click="showEditForm({{ $item->id }})" class="btn btn-sm btn-primary">Edit</button>
                                            <button wire:click="confirmDelete({{ $item->id }})"
                                                class="btn btn-sm btn-danger">Hapus</button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                    {{ $raks->links() }}
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>

   
</div>
