<?php

namespace App\Http\Controllers;

use App\Models\Letter;
use App\Models\User;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Schema;

class ManagerController extends Controller
{
     public function managerListLetters(Request $req) {
        /* 
        If the user is manager, then he's allowed to go to /manager
        and see all the messages
        Otherwise Acess denied
        */
        if(Auth::user()->isAdmin() && auth()->check()) {
            $letters = Letter::all();
            return view('manager.index', [
                'letters'=>$letters,
                'users'=>Auth::user()
            ]);
        }
        else {
            return redirect()
                ->route('letterIndex')
                ->with('msg', 'Access denied');
        }
    }

    public function managerPostLetters(Request $req, $id) {
        /* 
        Updates the letter, where status has been changed
        */
        $data = $req->only('topic','message','status', 'id', 'user_id');
        $letter = Letter::query()->findOrFail($id);
        $data['status'] = (!isset($data['status'])) ? 0 : 1;   
        $letter->update($data);
        return back()->with('Success','User updated successfully');
    }

    public function managerGetLetter(Request $req, $id) {
        $letter = Letter::find($id);
        return view('manager.letter', [
            'letter' => $letter
        ]);
    }

    public function respondLetter(Request $req, $id) {
        $letter = Letter::find($id);
        $response = $req->input('response');
        $letter['response'] = $response;
        $letter['status'] = 1;
        $letter->update();
        return back()->with('Success', 'You successfully responded');
    }

    
}
