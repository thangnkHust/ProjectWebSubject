@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                {{-- Header card --}}
                <div class="card-header">
                  <div class="d-flex align-items-center">
                    <h2>{{ $question->title }}</h2>
                    <div class="ml-auto">
                      <a href="{{ route('questions.index' )}}" class="btn btn-outline-secondary">Back to all questions</a>
                    </div>
                  </div>
                </div>

                {{-- Body card --}}
                <div class="card-body">
                  {!! $question->body !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
