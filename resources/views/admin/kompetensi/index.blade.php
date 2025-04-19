@extends('layouts.app')

@section('title')
    Kompetensi
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <a href="{{ url('/admin/kompetensi/create', []) }}" class="btn btn-primary mb-4">
                Tambah Data
            </a>
            <div class="table-responsive">
                <table class="table table-striped datatable">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Judul Kompetensi</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kompetensis as $item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $item->judul }}</td>
                                <td class="text-center">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a href="{{ url('/admin/kompetensi/' . $item->id . '/edit', []) }}"
                                            class="btn btn-sm btn-warning">Edit</a>
                                        <a href="{{ url('/admin/kompetensi/' . $item->id) }}" class="btn btn-sm btn-danger"
                                            onclick="event.preventDefault();
                                                     document.getElementById('delete-{{ $item->id }}').submit();">
                                            Hapus
                                        </a>
                                    </div>
                                    <form id="delete-{{ $item->id }}"
                                        action="{{ url('/admin/kompetensi/' . $item->id) }}" method="POST" class="d-none">
                                        @csrf @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(".datatable").dataTable();
    </script>
@endsection
