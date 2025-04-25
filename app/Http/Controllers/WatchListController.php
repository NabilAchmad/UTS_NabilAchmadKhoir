<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WatchList;
use Illuminate\Support\Facades\Auth;

class WatchListController extends Controller
{
    public function index()
    {
        $watchlist = WatchList::where('user_id', Auth::id())->get();
        return view('watchlist.index', compact('watchlist'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'movie_title' => 'required|string',
        ]);

        WatchList::create([
            'user_id' => Auth::id(),
            'movie_title' => $request->movie_title,
            'movie_id' => $request->movie_id,
        ]);

        return back()->with('success', 'Movie added to watch list!');
    }

    public function destroy($id)
    {
        $item = WatchList::findOrFail($id);
        if ($item->user_id == Auth::id()) {
            $item->delete();
        }
        return back()->with('success', 'Movie removed from watch list!');
    }
}
