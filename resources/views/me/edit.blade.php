@extends('layout.main')

@section('content')
    <div class="card mt-3">
        <h5 class="card-header">{{ $user->name }}</h5>
        <div class="card-body">

            <form action="{{ route('me.update') }}" method="post" enctype="multipart/form-data">
                @csrf
                @if($user->avatar)
                    <img src="{{ asset('storage/' . $user->avatar) }}" class="rounded mx-auto d-block user-avatar">
                @else
                    <img src="/images/avatar.png" class="rounded mx-auto d-block">
                @endif

                <div class="form-group">

                    <div class="form-group">
                        <label for="avatar">Wybierz avatar ...</label>
                        <input
                            type="file"
                            class="form-control-file"
                            id="avatar"
                            name="avatar"
                        >
                        @error('avatar')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        @if($user->avatar)
                            <input
                                type="checkbox"
                                class=" custom-checkbox"
                                id="delete-avatar"
                                name="delete-avatar"
                                value="1"
                            >
                            <label for="delete-avatar">Usuń avatar</label>
                        @endif
                    </div>

                    <label for="name">Nazwa</label>
                    <input
                        type="text"
                        class="form-control @error('name') is-invalid @enderror"
                        id="name"
                        name="name"
                        value="{{ old('name', $user->name) }}"
                    />
                    @error('name')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Adres email</label>
                    <input
                        type="email"
                        class="form-control @error('email') is-invalid @enderror"
                        id="email"
                        name="email"
                        value="{{ old('email', $user->email) }}"
                    >
                    @error('email')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="phone">Telefon</label>
                    <input
                        type="text"
                        class="form-control @error('phone') is-invalid @enderror"
                        id="phone"
                        name="phone"
                        value="{{ old('phone', $user->phone) }}"
                    >
                    @error('phone')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Zapisz dane</button>
                <a href="{{ route('me.profile') }}" class="btn btn-secondary">Anuluj</a>
            </form>
        </div>
    </div>
@endsection
