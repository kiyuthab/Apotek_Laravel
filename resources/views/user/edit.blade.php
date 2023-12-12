@extends('layouts.template')

@section('content')
    <form action="{{ route('user.update', $users['id']) }}" method="POST" class="card p-5">
        @csrf
        @method('PATCH')

        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <div class="mb mb-3 row">
            <label for="name" class="col-sm-2 col-form-label">Nama :</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="name" name="name" value="{{ $users['name'] }}">
            </div>
        </div>
        <div class="mb mb-3 row">
            <label for="email" class="col-sm-2 col-form-label">Email :</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="email" name="email" value="{{ $users['email'] }}">
            </div>
        </div>
        <div class="mb mb-3 row">
            <label for="type" class="col-sm-2 col-form-label">Tipe Pengguna :</label>
            <div class="col-sm-10">
                <select class="form-select" name="role" id="role">
                    <option selected disable hidden>Pilih</option>
                    <option value="admin" {{ $users['type'] == 'admin' ? 'selected' : '' }}>admin</option>
                    <option value="kasir" {{ $users['type'] == 'kasir' ? 'selected' : '' }}>kasir</option>
                </select>
            </div>
        </div>
        <div class="mb mb-3 row">
            <label for="password" class="col-sm-2 col-form-label">Ubah Password :</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="password"  name="password" value="{{ $users['password'] }}">
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Simpan Perubahan</button>
    </form>
@endsection