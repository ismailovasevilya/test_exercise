<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Letter;

class LetterController extends Controller
{
    public function getIndex() {
    	return view('main.index');
    }

    public function postCreate(Request $req) {
        $letter = new Letter([
            'message' => $req->input('message'),
            'topic' => $req->input('topic')
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
