<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes(['verify' => true]);

Route::view('/', 'welcome')->name('home');
Route::view('/privacy', 'privacy_policy')->name('privacy_policy');

Route::view('/contact', 'contact.form')->name('contact.form');
Route::post('/contact', 'SendContactEmailController')->name('contact.send');

Route::get('/reddit', function() {
    // return 'jai test';

    // Subreddit to retrieve
    $subreddit = 'vegan';

    // The sorting mode to use on each subreddit. Supported modes are: top, hot, controversial, rising
    $mode = 'rising';

    // The number of threads to retrieve (note we initially retrieve 5 more to filter out pinned posts/threads)
    $numberOfThreads = 5;

    // Whether to filter out sticked threads/posts or not.
    $filterSticked = true;

    $jsonUrl = 'https://www.reddit.com/r/'.$subreddit.'/';
    $limit = $filterSticked ? $numberOfThreads+5 : $numberOfThreads;

    if ($mode === 'top') {
        $jsonUrl .= 'top/.json?t=day&limit='.$limit;
    }
    else if ($mode === 'hot') {
        $jsonUrl .= 'hot/.json?limit='.$limit;
    }
    else if ($mode === 'controversial') {
        $jsonUrl .= 'controversial/.json?limit='.$limit;
    }
    else if ($mode === 'rising') {
        $jsonUrl .= 'rising/.json?limit='.$limit;
    }

    $rawJson = file_get_contents($jsonUrl);
    $decodedJson = json_decode($rawJson, true);
    $children = $decodedJson['data']['children'];

    $processedThreads = array();

    foreach ($children as $rawRedditThread) {
        $redditThread = $rawRedditThread['data'];

        // Are we filtering out stickied posts?
        if (!$filterSticked || !$redditThread['stickied']) {
            array_push($processedThreads, $redditThread);
        }

        // If we've reached the thread limit then stop looping.
        if (count($processedThreads) === $numberOfThreads) {
            break;
        }
    }

    dd($processedThreads);
});

Route::middleware('auth')->group(function () {
    Route::get('/settings', 'SettingsController@edit')->name('settings.edit');
    Route::put('/settings', 'SettingsController@update')->name('settings.update');

    Route::delete('/account', 'DeleteAccountController')->name('account.destroy');
});
