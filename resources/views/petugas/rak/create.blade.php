@if($createMode)
    <div class="card">
        <div class="card-body">
            <div class="form-group">
                <label for="rak">Rak</label>
                <input wire:model="rak" type="text" class="form-control" id="rak" name="rak">
                @error('rak') <small class="text-danger error">{{ $message }}</small> @enderror
            </div>
            <div class="form-group">
                <label for="baris">Baris</label>
                <input wire:model="baris" type="text" class="form-control" id="baris" name="baris">
                @error('baris') <small class="text-danger error">{{ $message }}</small> @enderror
            </div>
            <div class="form-group">
                <label for="kategori_id">Kategori</label>
                <select wire:model="kategori_id" class="form-control" id="kategori_id" name="kategori_id">
                    <option value="">Pilih Kategori</option>
                    @foreach($kategoris as $kategori)
                        <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                    @endforeach
                </select>
                @error('kategori_id') <small class="text-danger error">{{ $message }}</small> @enderror
            </div>
            <button wire:click="store" class="btn btn-sm btn-success">Simpan</button>
            <button wire:click="cancelCreate" class="btn btn-sm btn-secondary">Batal</button>
        </div>
    </div>
@endif
