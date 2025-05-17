@extends('layouts.web')

@section('title', 'Pilih Tipe ujian')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-6">
                <a href="{{ route('kuis.show', ['id' => $mapel_id, 'tipe' => 'UAS']) }}">
                    <div class="card text-white bg-primary text-center">
                        <div class="card-body">
                            <div class="card-title">
                                <h3>UAS</h3>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-12 col-lg-6">
                <a href="{{ route('kuis.show', ['id' => $mapel_id, 'tipe' => 'UAS']) }}">
                    <div class="card text-white bg-primary text-center">
                        <div class="card-body">
                            <div class="card-title">
                                <h3>UTS</h3>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
@endsection
