@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
              <div class="card-body">
                {{-- Header card --}}
                <div class="card-title">
                  <div class="d-flex align-items-center">
                    <h2>{{ $question->title }}</h2>
                    <div class="ml-auto">
                      <a href="{{ route('questions.index' )}}" class="btn btn-outline-secondary">Back to all questions</a>
                    </div>
                  </div>
                </div>

                <hr>
                {{-- Body card --}}
                <div class="media">
                  <div class="d-flex flex-column vote-controls">
                    <a title="This question is useful" class="vote-up">
                      <i class="fas fa-caret-up fa-3x"></i>
                    </a>
                    <span class="votes-count">
                      1230
                    </span>
                    <a title="This question is not userful" class="vote-down off">
                      <i class="fas fa-caret-down fa-3x"></i>
                    </a>
                    <a title="Click to mark as favorite question" class="favorite mt-2 favorited">
                      <i class="fas fa-star fa-1x"></i>
                      <span class="favorites-count">123</span>
                    </a>
                  </div>
                  <div class="media-body">
                    {!! $question->body !!}
                    <div class="float-right mt-3">
                      <span class="text-muted">Question {{ $question->created_date }}</span>
                      <div class="media mt-2">
                        <a href="{{ $question->user->url}}" class="pr-2">
                          <img src="{{ $question->user->avatar}}" alt="avatar">
                        </a>
                        <div class="media-body mt-1">
                          <a href="{{ $question->user->url}}">{{ $question->user->name}}</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </div>

    @include('answers._index')
    @include('answers._create')
</div>
@endsection
