@if ($detailMode && $bukuDetail)
    <div class="modal fade show" id="modal-default" style="display: block; padding-right: 17px;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Lihat Buku</h4>
                    <button wire:click="cancelDetail" type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="row justify-content-center">
                                @if ($bukuDetail->sampul)
                                    <img src="{{ Storage::url('img/' . $bukuDetail->sampul) }}" alt="{{ $bukuDetail->judul }}" width="250" height="350">
                                @else
                                    <span>Tidak ada gambar</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-7">
                            <table class="table text-nowrap">                    
                                <tbody>
                                    <tr>
                                        <th>Judul</th>
                                        <td>:</td>
                                        <td>{{ $bukuDetail->judul }}</td>
                                    </tr>
                                    <tr>
                                        <th>Penulis</th>
                                        <td>:</td>
                                        <td>{{ $bukuDetail->penulis }}</td>
                                    </tr>
                                    <tr>
                                        <th>Penerbit</th>
                                        <td>:</td>
                                        <td>{{ optional($bukuDetail->penerbit)->nama ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Kategori</th>
                                        <td>:</td>
                                        <td>{{ optional($bukuDetail->kategori)->nama ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Rak</th>
                                        <td>:</td>
                                        <td>{{ $bukuDetail->rak_id ? $bukuDetail->rak->rak ?? 'none' : 'none' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Baris</th>
                                        <td>:</td>
                                        <td>{{ $bukuDetail->rak_id ? $bukuDetail->rak->baris ?? 'none' : 'none' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Stok</th>
                                        <td>:</td>
                                        <td>{{ $bukuDetail->stok }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button wire:click="cancelDetail" type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
                </div>
            </div>
        </div>
    </div>
@endif
