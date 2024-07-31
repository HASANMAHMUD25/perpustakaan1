@if ($createn1)
    <form wire:submit.prevent="store">
        <div class="form-group">
            <label for="name">Nama</label>
            <input wire:model="name" type="text" class="form-control">
            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input wire:model="email" type="email" class="form-control">
            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input wire:model="password" type="password" class="form-control">
            @error('password') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="password_confirmation">Ulangi Password</label>
            <input wire:model="password_confirmation" type="password" class="form-control">
            @error('password_confirmation') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
@endif
