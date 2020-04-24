<?php

namespace App\Http\Controllers;

use Auth;
use App\Tweet;
use Illuminate\Http\Request;

class TweetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Retreive 5 latest Tweets.
        $tweets = Tweet::latest()->paginate( 5 );
        // Return Tweets index view.
        return view( 'tweets.index', compact( 'tweets' ) ) // Paginate.
               ->with( 'i', ( request()->input( 'page', 1 ) - 1 ) * 5 );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        if ( $user ) // Yay! You're logged in, create away!
            return view('tweets.create');
        else // Uh oh, logged out! Redirect.
            return redirect()->route( 'tweets.index' );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Assign and check user all at once.
        if ( $user = Auth::user() ) { // Proceed and store data if the user is logged in.
            $validatedData = $request->validate(array(
                'message' => 'required|max:255'
            ));
            $tweet = new Tweet;
            $tweet->user_id = $user->id;
            $tweet->message = $validatedData['message'];
            $tweet->save();
            return redirect()->route( 'tweets.index' )->with( 'success', 'Tweet saved.' );
        }
        // Redirect by default.
        return redirect()->route( 'tweets.index' );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tweet  $tweet
     * @return \Illuminate\Http\Response
     */
    public function show(Tweet $tweet)
    {
        // Return Tweet show view.
        return view( 'tweets.show', compact( 'tweet' ) );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tweet  $tweet
     * @return \Illuminate\Http\Response
     */
    public function edit(Tweet $tweet)
    {
        // Return Tweet edit view.
        return view( 'tweets.edit', compact( 'tweet' ) );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tweet  $tweet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tweet $tweet)
    {
        // Assign and check user all at once.
        if ( $user = Auth::user() ) { 
            // Ensure only the user that created the Tweet may edit it.
            if ( $user->id === $tweet->user_id ) { // Proceed and store data.
                $validatedData = $request->validate(array(
                    'message' => 'required|max:255'
                ));
                $tweet = new Tweet;
                $tweet->message = $validatedData['message'];
                $tweet->save();
                return redirect()->route( 'tweets.index' )->with( 'success', 'Tweet saved.' );
            }
        }
        // Redirect by default.
        return redirect( '/tweets' );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tweet  $tweet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tweet $tweet)
    {
        // Delete this Tweet.
        $tweet->delete();
        return redirect()->route( 'tweets.index' );
    }
}
