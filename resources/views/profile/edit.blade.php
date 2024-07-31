@extends('admin-lte/app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Info Profile') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Display existing profile image -->


                        <!-- Display and edit name -->
                        <div class="form-group row mb-4">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Nama') }}</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control-plaintext" value="{{ $user->name }}" readonly>
                            </div>
                        </div>

                        <!-- Display email (readonly) -->
                        <div class="form-group row mb-4">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control-plaintext" value="{{ $user->email }}" readonly>
                            </div>
                        </div>

                        <!-- Display account creation date (readonly) -->


                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">

                                <a href="/dashboard" class="btn btn-secondary">
                                    {{ __('Kembali') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
