<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Letter;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Schema;
use DateTime;

class LetterController extends Controller
{
    
    public function getIndex() {
        
        /* 
        If it's a simple user, then he's redirected to '/',
        if it's manager then he's redirecred to /manager, 
        if the user isn't authenticated => /login
        */

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
        /* 
        First, input validation. 
        Then, if user attached the file, then the filename is generated.
        Next, uses checkTime, if it returns true, the letter is posted,
        otherwise, the message alert
        */

        $user_id = Auth::id();
        $this->validate($req, [
            'topic' => 'required|min:5',
            'message' => 'required|min:5',
            'file' => 'mimes:jpeg,jpg,png,pdf'
        ]);

        if ($req->file != null) {
            $fileName = time().'.'.$req->file->extension();  
            $req->file->move(public_path('uploads'), $fileName);
        }
            
        if ($this->checkTime($user_id)) {
            $letter = new Letter([
                'message' => $req->input('message'),
                'topic' => $req->input('topic'),
                'user_id' => $user_id,
                'file' => (isset($fileName)) ? $fileName : null
            ]);
            $letter->save();
            return redirect()->route('ReadOwnLetter', [
                'id'=>$letter->id
            ]);
        }
        else {
            return redirect()
                ->route('letterIndex')
                ->with('msg', '24 hours has not passed yet');
        }
            
    }

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

    public function ReadOwnLetter($id) {
        /*
        Shows the letter to an owner. 
        Shows if manager answered the letter. 
        */
        $letter = Letter::find($id);
        if ($letter->status) {
            return back()->with('msg', 'Your letter is answered');
        }
        else {
            return back()->with('msg', 'Your letter is delivered');
        }
    }

    public function checkTime($user_id) {
        /* 
        Checks if the 24 hours has passed since the last letter. 
        If user has no any sent letters, then returns true (he can send a letter)
        */
        if(Letter::where('user_id', $user_id)->exists()) {
            $lastLetter = Letter::orderBy('created_at', 'desc')->where( 'user_id', $user_id)->first();
            $lastLetterTime = $lastLetter->created_at;

            $currentTime = new DateTime("now");
            $diff = $currentTime->diff($lastLetterTime);

            $hours = $diff->h;
            if ($hours >= 24) {
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
