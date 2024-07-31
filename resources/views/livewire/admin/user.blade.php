<div>
    <div class="row">
        <div class="col-12">
            @include('admin-lte.flash')

            <div class="btn-group mb-3">
                <button wire:click="semua" class="btn btn-sm bg-secondary text-white mr-2">Semua</button>
                <button wire:click="admin_1" class="btn btn-sm bg-teal mr-2">Admin</button>
                <button wire:click="petugas_1" class="btn btn-sm bg-indigo mr-2">Petugas</button>
                <button wire:click="peminjam_1" class="btn btn-sm bg-olive mr-2">Peminjam</button>
            </div>

            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        @if (!$create && !$edit)
                            <div class="card-tools">
                                <form wire:submit.prevent="search">
                                    <div class="input-group input-group-sm" style="width: 150px;">
                                        <input type="text" wire:model="search" class="form-control float-right" placeholder="Cari">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-default" wire:click="searchBuku">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        @endif

                            <button wire:click="createForm" class="btn btn-sm btn-primary">Tambah</button>

                    </div>
                </div>
                <!-- /.card-header -->

                @if ($create || $edit)
                    <div class="card-body">
                        <form wire:submit.prevent="{{ $edit ? 'update' : 'store' }}">
                            <div class="form-group">
                                <label for="name">Nama</label>
                                <input wire:model="name" type="text" class="form-control" id="name">
                                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input wire:model="email" type="email" class="form-control" id="email">
                                @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            @if ($edit)
                                <div class="form-group">
                                    <label for="password">Password Baru (Kosongkan jika tidak ingin mengganti)</label>
                                    <input wire:model="password" type="password" class="form-control" id="password">
                                    @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="form-group">
                                    <label for="password_confirmation">Ulangi Password Baru</label>
                                    <input wire:model="password_confirmation" type="password" class="form-control" id="password_confirmation">
                                    @error('password_confirmation') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            @else
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input wire:model="password" type="password" class="form-control" id="password">
                                    @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="form-group">
                                    <label for="password_confirmation">Ulangi Password</label>
                                    <input wire:model="password_confirmation" type="password" class="form-control" id="password_confirmation">
                                    @error('password_confirmation') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            @endif

                            <div class="form-group">
                                <label for="role">Role</label>
                                <select wire:model="role" class="form-control" id="role">
                                    <option value="">Pilih Role</option>
                                    <option value="admin">Admin</option>
                                    <option value="petugas">Petugas</option>
                                    <option value="peminjam">Peminjam</option>
                                </select>
                                @error('role') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">{{ $edit ? 'Update' : 'Simpan' }}</button>
                            @if ($edit)
                                <button wire:click="resetFilters" type="button" class="btn btn-secondary ml-2">Batal</button>
                            @endif
                        </form>
                    </div>
                @endif

                @if (!$create && !$edit)
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->roles->pluck('name')->implode(', ') }}</td>
                                        <td>
                                            <button wire:click="showEditForm({{ $user->id }})" class="btn btn-sm btn-warning">Edit</button>
                                            <button wire:click="confirmDelete({{ $user->id }})" class="btn btn-sm btn-danger">Hapus</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer clearfix">
                        {{ $users->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Modal untuk konfirmasi penghapusan -->
    <div class="modal fade @if($confirmingUserDeletion) show d-block @endif" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Penghapusan</h5>
                    <button type="button" class="close" wire:click="$set('confirmingUserDeletion', false)" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus data ini?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="$set('confirmingUserDeletion', false)">Batal</button>
                    <button type="button" class="btn btn-danger" wire:click="delete">Hapus</button>
                </div>
            </div>
        </div>
    </div>
</div>
