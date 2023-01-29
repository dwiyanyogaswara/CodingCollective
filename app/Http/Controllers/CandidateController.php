<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidate;
use Illuminate\Support\Facades\Auth;

class CandidateController extends Controller
{
    public function all(){
        $results = Candidate::all();
        return $results;
    }

    public function get($id){
        $results = Candidate::find($id);
        return $results;
    }

    public function add(Request $request){
        $allow = false;
        if (Auth::user()->role_id == 1){
            $allow = true;
                $request->validate([
                    'name' => 'required|string', 
                    'education' => 'required|string', 
                    'birthday'  => 'required|date', 
                    'experience'  => 'required|integer', 
                    'last_position'  => 'required|string', 
                    'applied_position' => 'required|string', 
                    'top5_skills' => 'required|string', 
                    'email' => 'required|string|email|unique:users', 
                    'phone' => 'required|string', 
                    'resume' => 'required|string'
             ]);
             $candidate = new Candidate;
             $candidate->name = $request->name;
             $candidate->education = $request->education;
             $candidate->birthday = $request->birthday;
             $candidate->experience = $request->experience;
             $candidate->last_position = $request->last_position;
             $candidate->applied_position = $request->applied_position;
             $candidate->top5_skills = $request->top5_skills;
             $candidate->email = $request->email;
             $candidate->phone = $request->phone;
             $candidate->resume = $request->resume;
             $candidate->save();
        }
        if ($allow){
            return response()->json([
                      'message' => 'Successfully adding candidate '. $request->name .'!'
                 ], 201);
        }else {
            return response()->json([
                'message' => 'User role is not allowed to adding candidate!'
           ], 400);
        }
    }

    public function update(Request $request, $id)
    {
        $allow = false;
        if (Auth::user()->role_id == 1){
            $allow = true;
            $request->validate([
                'name' => 'required|string', 
                'education' => 'required|string', 
                'birthday'  => 'required|date', 
                'experience'  => 'required|integer', 
                'last_position'  => 'required|string', 
                'applied_position' => 'required|string', 
                'top5_skills' => 'required|string', 
                'email' => 'required|string|email|unique:users', 
                'phone' => 'required|string', 
                'resume' => 'required|string'
             ]);
             $candidate = Candidate::findOrFail($id);
             $candidate->update([
                'name' => $request->name,
                'education' => $request->education,
                'birthday' => $request->birthday,
                'experience' => $request->experience,
                'last_position' => $request->last_position,
                'applied_position' => $request->applied_position,
                'top5_skills' => $request->top5_skills,
                'email' => $request->email,
                'phone' => $request->phone,
                'resume' => $request->resume
             ]);
        }

        if ($allow){
            return response()->json([
                      'message' => 'Successfully updating candidate '. $request->name .'!'
                 ], 201);
        }else {
            return response()->json([
                'message' => 'User role is not allowed to updating candidate!'
           ], 400);
        }
    }

    public function delete($id)
    {
        $allow = false;
        if (Auth::user()->role_id == 1){
            $allow = true;
            $candidate = Candidate::findOrFail($id);
            $candidate->delete();
        }

        if ($allow){
            return response()->json([
                      'message' => 'Successfully deleting candidate!'
                 ], 201);
        }else {
            return response()->json([
                'message' => 'User role is not allowed to deleting candidate!'
           ], 400);
        }
    }
}
