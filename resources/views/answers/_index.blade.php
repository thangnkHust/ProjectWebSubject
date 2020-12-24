<div class="row mt-4">
  <div class="col-md-12">
    <div class="card">
      <div class="card-body">
        <div class="card-title">
          <h2>{{ $question->answers_count . " " . str_plural("Answer", $question->answers_count) }}</h2>
        </div>
        <hr>
        @include('layouts._message')
        @foreach ($question->answers as $answer)
          <div class="media">
            <div class="d-flex flex-column vote-controls">
              <a title="This answer is useful" class="vote-up">
                <i class="fas fa-caret-up fa-3x"></i>
              </a>
              <span class="votes-count">
                1230
              </span>
              <a title="This answer is not userful" class="vote-down off">
                <i class="fas fa-caret-down fa-3x"></i>
              </a>
              <a title="Mark this answer as best answer" class="vote-accepted mt-2">
                <i class="fas fa-check fa-1x"></i>
              </a>
            </div>
            <div class="media-body">
              {!! $answer->body !!}
              
              <div class="float-right mt-3">
                <span class="text-muted">Answered {{ $answer->created_date }}</span>
                <div class="media mt-2">
                  <a href="{{ $answer->user->url}}" class="pr-2">
                    <img src="{{ $answer->user->avatar}}" alt="avatar">
                  </a>
                  <div class="media-body mt-1">
                    <a href="{{ $answer->user->url}}">{{ $answer->user->name}}</a>
                  </div>
                </div>
              </div>

            </div>
          </div>
          <hr>
        @endforeach
      </div>
    </div>
  </div>
</div>