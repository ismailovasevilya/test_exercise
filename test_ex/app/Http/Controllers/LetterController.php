<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Letter;
use Illuminate\Support\Facades\Auth;

class LetterController extends Controller
{
    public function getIndex() {
        $letters = Letter::all();

        if (auth()->check() && auth()->user()->isAdmin()) {
            return redirect()->route('managerListLetters', [
                'letters'=>$letters
            ]);
        }
        else if (auth()->check() && !auth()->user()->isAdmin()) {
            return view('main.index');
        }
        else {
            return redirect(route('login'));
        }
    	
    }

    public function postCreate(Request $req) {
        
        $letter = new Letter([
            'message' => $req->input('message'),
            'topic' => $req->input('topic'),
            'user_id' => Auth::id()
        ]);
        $letter->save();
        return redirect()->route('ReadOwnLetter', [
            'id'=>$letter->id
        ]);
    }

    public function managerListLetters(Request $req) {
        $letters = Letter::all();
        return view('manager.index', [
            'letters'=>$letters
        ]);
    }

    public function ReadOwnLetter($id) {
        $letter = Letter::find($id);
        return view('main.sent', [
            'letter'=>$letter
        ]);
    }
    
}
