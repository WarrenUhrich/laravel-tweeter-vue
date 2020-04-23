@extends( 'layouts.app' )

@section( 'content' )

  <section class="container">
    <div class="row">
      <h2 class="col-md-8">Tweeter Feed</h2>
      <div class="col-md-2">
        <a href="{{ route( 'tweets.create' ) }}" class="btn btn-success">
          Tweets
        </a>
      </div>
      <div class="col-md-2">
        <a href="{{ route( 'tweets.create' ) }}" class="btn btn-success">
          New Tweet
        </a>
      </div>
    </div>
    @if ($message = Session::get('success'))
      <div class="alert alert-success">
        <p>
          {{ $message }}
        </p>
      </div>
    @endif
    <ul class="row">
      @foreach( $tweets as $tweet )
        <li class="col-md-3">
          <h3>{{ $tweet->user()->name }}</h3>
          <p>
            {{ $tweet->message }}
          </p>
          <div class="row">
            <div class="col-md-4">
              <a href="{{ route( 'tweets.show', $tweet->id ) }}" class="btn btn-info">Read More</a>
            </div>
            @if( $tweet->user()->id === $tweet->user_id )
              <div class="col-md-4">
                <a href="{{ route( 'tweets.edit', $tweet->id ) }}" class="btn btn-primary">Edit</a>
              </div>
              <form class="col-md-4" action="{{ route( 'tweets.destroy', $tweet->id ) }}" method="POST">
                <button type="submit" class="btn btn-danger">Delete</button>
                @csrf
              </form>
            @endif
          </div>
        </li>
      @endforeach
    </ul>
  </section>
@endsection