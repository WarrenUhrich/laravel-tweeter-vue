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
    <form action="{{ route( 'tweets.store' ) }}" method="POST">
      @csrf
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <strong>Message</strong>
            <textarea name="message"></textarea>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <input class="btn btn-primary" type="submit" value="Create">
        </div>
      </div>
    </form>
  </section>