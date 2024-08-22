@if ($editMode)
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="nama">Kategori</label>
                        <input wire:model="nama" type="text" class="form-control" id="nama" name="nama">
                        @error('nama') <small class="text-danger error">{{ $message }}</small> @enderror
                    </div>
                    <button wire:click="update" class="btn btn-sm btn-primary">Update</button>
                    <button wire:click="cancelEdit" class="btn btn-sm btn-secondary">Batal</button>
                </div>
            </div>
        @endif