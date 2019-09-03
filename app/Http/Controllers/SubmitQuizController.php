<?php

namespace App\Http\Controllers;

use App\User;
use App\Quiz;
use App\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubmitQuizController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('submitquiz.index');
    }

    public function create()
    {
        return view('submitquiz.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'catagory' => 'required',
            'author_id' => 'required',
            'subject' => 'required',
            'title' => 'required|min:8',
            'quantity' => 'required'
        ]);

        // $quiz = Quiz::create($data);

        // $quiz = new Quiz;
        // $quiz->catagory = $request->input('catagory');
        // $quiz->subject = $request->input('subject');
        // $quiz->quantity = (int)$request->input('quantity');
        // $quiz->title = $request->input('title');
        // $quiz->author_id = 1;

        // $quiz->save();
        // dd($data['author_id']);
        return view('submitquiz.create_question', compact('data'));
    }

    public function store_question(Request $request)
    {
        $detail_data = $request->validate([
            'catagory' => 'required',
            'author_id' => 'required',
            'subject' => 'required',
            'title' => 'required|min:8',
            'quantity' => 'required',
        ]); 
        
        // $quiz = Quiz::create($detail_data);

        if($request->input('catagory') == 1){
            $q_data = $request->validate([
                'q' => 'required',
                'op1' => 'required',
                'op2' => 'required',
                'op3' => 'required',
                'op4' => 'required',
                'answer' =>'required',
                'exp' => 'nullable'
            ]);
        }else{
            $q_data = $request->validate([
                'q' => 'required',
                'answer' =>'required',
                'exp' => 'nullable'
            ]);
        }
    
        $input = $request->input('q');
        $input_op1 = $request->input('op1');
        $input_op2 = $request->input('op2');
        $input_op3 = $request->input('op3');
        $input_op4 = $request->input('op4');
        $input_ans = $request->input('answer');
        $input_exp = $request->input('exp');
        $quiz = Quiz::create($detail_data);
        $question = new Question;
        $question->quiz_id = $quiz->id;
                
        $data = [];
        foreach ($input as $index =>$quiz)
        {
            if($request->input('catagory') == 1) {
                $data[] = [
                    'question' => $input[$index],
                    'op1' => $input_op1[$index],
                    'op2' => $input_op2[$index],
                    'op3' => $input_op3[$index],
                    'op4' => $input_op4[$index],
                    'answer' => $input_ans[$index],
                    'exp' => $input_exp[$index],
                ];
            } else {
                $data[] = [
                    'question' => $input[$index],
                    'answer' => $input_ans[$index],
                    'exp' => $input_exp[$index],
                ];
            }
        }
        $question->question = $data;
        $question->save();

        return redirect('submitquiz/'.$question->quiz_id)->with('success', 'Quiz Created');
    }

    public function show($id)
    {   
        $quiz_detail = Question::detail($id)->first();
        foreach ($quiz_detail as $index => $quiz) {
            $q1 = $quiz_detail['question'];
        }
        
        return view('submitquiz.show', compact('quiz_detail', 'q1'));
    }

    public function list()
    {
        $quiz_list = Quiz::list(auth()->user()->id);

        return view('submitquiz.list', compact('quiz_list'));
    }

    public function edit($id)
    {
        $quiz_detail = Quiz::find($id);

        $question_detail = Question::que($id)->first();
        foreach ($question_detail as $index => $quiz) {
            $q1 = $question_detail['question'];
        }

        return view('submitquiz.edit', compact('quiz_detail', 'q1'));
    }

    public function update(Request $request, $id)
    {
        $quiz_detail = Quiz::find($id);
        $question_detail = Question::que($id)->first();

        $detail_data = $request->validate([
            'title' => 'required|min:8',
        ]); 

        $quiz_detail->title = $request->input('title');
        $quiz_detail->save();

        if($request->input('catagory') == 1){
            $q_data = $request->validate([
                'q' => 'required',
                'op1' => 'required',
                'op2' => 'required',
                'op3' => 'required',
                'op4' => 'required',
                'answer' =>'required',
                'exp' => 'nullable'
            ]);
        }else{
            $q_data = $request->validate([
                'q' => 'required',
                'answer' =>'required',
                'exp' => 'nullable'
            ]);
        }
    
        $input = $request->input('q');
        $input_op1 = $request->input('op1');
        $input_op2 = $request->input('op2');
        $input_op3 = $request->input('op3');
        $input_op4 = $request->input('op4');
        $input_ans = $request->input('answer');
        $input_exp = $request->input('exp');
                 
        $data = [];
        foreach ($input as $index =>$quiz)
        {
            if($request->input('catagory') == 1) {
                $data[] = [
                    'question' => $input[$index],
                    'op1' => $input_op1[$index],
                    'op2' => $input_op2[$index],
                    'op3' => $input_op3[$index],
                    'op4' => $input_op4[$index],
                    'answer' => $input_ans[$index],
                    'exp' => $input_exp[$index],
                ];
            } else {
                $data[] = [
                    'question' => $input[$index],
                    'answer' => $input_ans[$index],
                    'exp' => $input_exp[$index],
                ];
            }
        }
        $question_detail->question = $data;
        $question_detail->save();

        return redirect('submitquiz/'.$id)->with('success', 'Quiz Updated');
    }

    public function destroy($id)
    {
        //
    }
}
