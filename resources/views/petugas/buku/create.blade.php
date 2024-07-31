@if ($createMode)
    <div class="modal fade show" id="modal-default" style="display: block; padding-right: 17px;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Buku</h4>
                    <span wire:click="cancelCreate" type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </span>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="judul">Judul</label>
                        <input wire:model="judul" type="text" class="form-control" id="judul">
                        @error('judul') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="penulis">Penulis</label>
                                <input wire:model="penulis" type="text" class="form-control" id="penulis">
                                @error('penulis') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="stok">Stok</label>
                                <input wire:model="stok" type="number" class="form-control" id="stok" min="1">
                                @error('stok') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="sampul">Sampul</label>
                        <input wire:model="sampul" type="file" class="form-control" id="sampul">
                        @error('sampul') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="kategori_id">Kategori</label>
                                <select wire:model="kategori_id"  wire:click="pilihkategori" class="form-control" id="kategori_id">
                                    <option value="">Pilih Kategori</option>
                                    @foreach ($kategoris as $kategori)
                                        <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                                    @endforeach
                                </select>
                                @error('kategori_id') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="penerbit_id">Penerbit</label>
                                <select wire:model="penerbit_id" class="form-control" id="penerbit_id">
                                    <option value="">Pilih Penerbit</option>
                                    @foreach ($penerbits as $penerbit)
                                        <option value="{{ $penerbit->id }}">{{ $penerbit->nama }}</option>
                                    @endforeach
                                </select>
                                @error('penerbit_id') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="rak_id">Rak</label>
                                <select wire:model="rak_id" class="form-control" id="rak_id">
                                    <option value="">Pilih Rak</option>
                                   @isset ($raks)
                                   @foreach ($raks as $rak)
                                        <option value="{{ $rak->id }}">Rak: {{ $rak->rak }}, Baris: {{ $rak->baris }}</option>
                                    @endforeach
                                   @endisset
                                </select>
                                @error('rak_id') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <span wire:click="cancelCreate" type="button" class="btn btn-default" data-dismiss="modal">Batal</span>
                    <span wire:click="store" type="button" class="btn btn-success">Simpan</span>
                </div>
            </div>
        </div>
    </div>
@endif
