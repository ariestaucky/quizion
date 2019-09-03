<?php

namespace App\Http\Controllers;

use App\User;
use App\Question;
use App\Test_taker;
use Illuminate\Http\Request;

class TestTakerController extends Controller
{
    public function store(Request $request)
    {
        $id = $request->input('quiz_id');
        $name = $request->input('name');
        $quiz_detail = Question::detail($id)->first();

        foreach ($quiz_detail as $index => $quiz) {
            $q1 = $quiz_detail['question'];
        }

        if(auth()->check()) {
            $user = User::findorFail(auth()->user()->id)->first();
            $datas = $request->validate([
                'score' => 'required'
            ]);

            if($request->routeIs('save')) {
                if($tester = Test_taker::check($id, $user->id)->first()) {
                    if($tester->attemp == 1) {
                        $tester->increment('attemp');
                        $tester->score2 = $datas['score'];
                        $tester->save();
                    } else {
                        $tester->increment('attemp');
                        $tester->score1 = $datas['score'];
                        $tester->save();
                    }

                    return redirect('quiz')->with('success', 'You have completed the quiz');
                } else {
                    $tester = new Test_taker;    
                    $tester->user_id = $user->id;
                    $tester->name = $name;
                    $tester->quiz_id = $quiz_detail->quiz_id;
                    $tester->score = $datas['score']; 
                    $tester->save();

                    return redirect('quiz')->with('success', 'You have completed the quiz');
                }
            } else {
                if($tester = Test_taker::check($id, $user->id)->first()) {
                    if($tester->attemp == 2) {
                        return redirect('quiz')->with('alert', 'Your retry has run out');
                    } else if($tester->attemp == 1) {
                        $tester->increment('attemp');
                        $tester->score2 = $datas['score'];
                        $tester->save();
                    } else {
                        $tester->increment('attemp');
                        $tester->score1 = $datas['score'];
                        $tester->save();
                    }

                    return view('quiz.show', compact('quiz_detail', 'q1', 'name'));
                } else {
                    $tester = new Test_taker;    
                    $tester->user_id = $user->id;
                    $tester->name = $name;
                    $tester->quiz_id = $quiz_detail->quiz_id;
                    $tester->score = $datas['score']; 
                    $tester->save();

                    return view('quiz.show', compact('quiz_detail', 'q1', 'name'));
                }
            }
        } else {
            $datas = $request->validate([
                'score' => 'required',
                'status' => 'required'
            ]);

            $status = $datas['status'];

            if($request->routeIs('save')) {
                if($tester = Test_taker::guest($id, $status)->first()) {
                    if($tester->attemp == 1) {
                        $tester->increment('attemp');
                        $tester->score2 = $datas['score'];
                        $tester->save();
                    } else {
                        $tester->increment('attemp');
                        $tester->score1 = $datas['score'];
                        $tester->save();
                    }

                    return redirect('quiz')->with('success', 'You have completed the quiz');
                } else {
                    $tester = new Test_taker;    

                    $tester->name = $name;
                    $tester->status = $datas['status'];
                    $tester->quiz_id = $quiz_detail->quiz_id;
                    $tester->score = $datas['score']; 
                    $tester->save();

                    return redirect('quiz')->with('success', 'You have completed the quiz');
                }
            } else {
                if($tester = Test_taker::guest($id, $status)->first()) {
                    if($tester->attemp == 2) {
                        return redirect('quiz')->with('alert', 'Your retry has run out');
                    } else if($tester->attemp == 1) {
                        $tester->increment('attemp');
                        $tester->score2 = $datas['score'];
                        $tester->save();
                    } else {
                        $tester->increment('attemp');
                        $tester->score1 = $datas['score'];
                        $tester->save();
                    }

                    return view('quiz.show', compact('quiz_detail', 'q1', 'name', 'status'));
                } else {
                    $tester = new Test_taker;    

                    $tester->name = $name;
                    $tester->status = $datas['status'];
                    $tester->quiz_id = $quiz_detail->quiz_id;
                    $tester->score = $datas['score']; 
                    $tester->save();

                    return view('quiz.show', compact('quiz_detail', 'q1', 'name', 'status'));
                }
            }
        }
    }
}
