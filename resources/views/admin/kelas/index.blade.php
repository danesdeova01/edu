@extends('layouts.app')

@section('title', 'Daftar Kelas')

@section('content')
<div class="container">

    {{-- Tidak perlu tombol tambah kelas --}}
    {{-- <a href="{{ route('admin.kelas.create') }}" class="btn btn-primary mb-3">Tambah Kelas</a> --}}

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Kelas</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kelas as $key => $item)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $item->nama }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
