<div>
    <div class="row">
        <div class="col-12">
            @include('admin-lte.flash')

            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="card-title">Activity log</h3>

                        <div class="card-tools">
                            <form wire:submit.prevent="searchBuku">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" wire:model="search" class="form-control float-right" placeholder="Search">
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
                                <th style="width: 5%">ID</th>
                                <th style="width: 15%">User</th>
                                <th style="width: 10%">Role</th>
                                <th style="width: 10%">Event</th>
                                <th style="width: 15%">Old Values</th>
                                <th style="width: 15%">New Values</th>
                                <th style="width: 10%">Table</th>
                                <th style="width: 10%">Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($audits as $audit)
                                <tr>
                                    <td>{{ $audit->id }}</td>
                                    <td>{{ $audit->user->name }}</td>
                                    <td>{{ implode(', ', $audit->user->roles->pluck('name')->toArray()) }}</td>
                                    <td>{{ $audit->event }}</td>
                                    <td>
                                        @foreach ($audit->old_values as $key => $value)
                                            <div>{{ ucfirst($key) }}: {{ $value }}</div>
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach ($audit->new_values as $key => $value)
                                            <div>{{ ucfirst($key) }}: {{ $value }}</div>
                                        @endforeach
                                    </td>
                                    <td>{{ class_basename($audit->auditable_type) }}</td> <!-- Menampilkan nama tabel -->
                                    <td>{{ \Carbon\Carbon::parse($audit->created_at)->setTimezone('Asia/Jakarta')->format('d-m-Y H:i:s') }}</td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">No records found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                    {{ $audits->links() }}
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>

    @push('scripts')
        <script>
            Livewire.on('showAuditModal', () => {
                $('#auditModal').modal('show');
            });

            Livewire.on('closeAuditModal', () => {
                $('#auditModal').modal('hide');
            });
        </script>
    @endpush
</div>
