@extends('layouts.web')

@section('title')
    {{ $forum->judul }}
@endsection

@section('breadcrumb')
    <div class="breadcrumb-item">Forum Diskusi</div>
    <div class="breadcrumb-item">{{ $forum->judul }}</div>
@endsection

@section('content')
<div class="row">
    <div class="col-12 mb-4">
        <div class="card" style="border-radius: 1rem">
            <div class="card-body">
                <h4>{{ $forum->judul }}</h4>
                <p class="mb-1">
                    <strong>Oleh:</strong> {{ $forum->user->name }}
                    <span class="text-muted">| {{ $forum->created_at->format('d M Y H:i') }}</span>
                </p>
                <div>{!! nl2br(e($forum->konten)) !!}</div>
            </div>
        </div>
    </div>

    <div class="col-12 mb-3">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Balasan ({{ $forum->replies->count() }})</h5>
            </div>
            <div class="card-body">
                @forelse($forum->replies as $reply)
                    <div class="media mb-4 pb-3 border-bottom">
                        <div class="media-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <strong>{{ $reply->user->name }}</strong>
                                <small class="text-muted">{{ $reply->created_at->format('d M Y H:i') }}</small>
                            </div>
                            <div class="mt-2">{!! nl2br(e($reply->konten)) !!}</div>
                        </div>
                    </div>
                @empty
                    <p class="text-muted">Belum ada balasan.</p>
                @endforelse
            </div>
        </div>
    </div>

    <div class="col-12 mt-4">
        <div class="card" style="border-radius: 1rem">
            <div class="card-body">
                <form method="POST" action="{{ url('forum/' . $forum->id) }}">
                    @csrf
                    <div class="form-group">
                        <label>Tambahkan Balasan</label>
                        <textarea name="konten" rows="3" class="form-control" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Balas</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
