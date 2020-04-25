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
    @if( $errors->any() )
      <div class="alert alert-danger">
        <ul>
          @foreach( $errors->all() as $error )
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif
    <div id="app">
      <tweet-create-form submission-url="{{ route( 'tweets.store' ) }}">
        @csrf
      </tweet-create-form>
      <Giphy />
    </div>
  </section>