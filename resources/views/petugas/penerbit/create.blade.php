@if($createMode)
        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <label for="nama">Penerbit</label>
                    <input wire:model="nama" type="text" class="form-control" id="nama" name="nama">
                    @error('nama') <small class="text-danger error">{{ $message }}</small> @enderror
                </div>
                <button wire:click="store" class="btn btn-sm btn-success">Simpan</button>
                <button wire:click="cancelCreate" class="btn btn-sm btn-secondary">Batal</button>
            </div>
        </div>
    @endif