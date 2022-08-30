<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Letter;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use DateTime;

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
        $user_id = Auth::id();
       
        if ($this->checkTime($user_id)) {
            $letter = new Letter([
                'message' => $req->input('message'),
                'topic' => $req->input('topic'),
                'user_id' => Auth::id($user_id)
            ]);
            $letter->save();
            return redirect()->route('ReadOwnLetter', [
                'id'=>$letter->id
            ]);
        }
        else {
            echo '24 hours hasnt passed';
        }
        
        
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

    public function checkTime($user_id) {
        if(Letter::where('user_id', $user_id)->exists()) {
            $lastLetter = Letter::orderBy('created_at', 'desc')->where( 'user_id', $user_id)->first();
            $lastLetterTime = $lastLetter->created_at;

            $currentTime = new DateTime("now");
            $diff = $currentTime->diff($lastLetterTime);

            $hours = $diff->h;
            if ($hours >= 2) {
                return TRUE;
            }
            else {
                return FALSE;
            }
        } else {
            return TRUE;
        }  
    }        
    
}
