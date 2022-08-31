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

        // $validated = $req->validate([
        //     'topic' => 'required|min:4',
        //     'message' => 'required|min:10',
        //     'file' => 'mimes:jpeg,jpg,png,pdf',
        // ]);
        $this->validate($req, [
            'topic' => 'required|min:5',
            'message' => 'required|min:5',
            'file' => 'mimes:jpeg,jpg,png,pdf'
        ]);

        $user_id = Auth::id();

        $fileName = time().'.'.$req->file->extension();  
        // $req->file->move(public_path('uploads'), $fileName);
            
        if ($this->checkTime($user_id) && $req->file != null) {
            $letter = new Letter([
                'message' => $req->input('message'),
                'topic' => $req->input('topic'),
                'user_id' => Auth::id($user_id),
                'file' => $fileName
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
        if(Auth::user()->isAdmin()) {
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

    public function managerPostLetters(Request $request, $id) {
        $data = $request->only('topic','message','status', 'id', 'user_id');
        $letter = Letter::query()->findOrFail($id);
        $data['status'] = (!isset($data['status'])) ? 0 : 1;   
        $letter->update($data);
        return back()->with('Success','User updated successfully');
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
    
    public function updateLetterStatus(Request $request) {
        $status = Letter::find($req->status);
        $letter->status = $req->status;
        $letter->save;
    }
    
}
