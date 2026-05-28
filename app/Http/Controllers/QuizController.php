<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Question;
use App\Models\Answer;
use App\Models\Result;
use App\Models\User; // Ajout de l'import User
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class QuizController extends Controller
{
    /**
     * 1. Liste des catégories de quiz
     */
    public function index()
    {
        $categories = Category::withCount('questions')->get();
        return view('quiz.index', compact('categories'));
    }

    /**
     * 2. Lancer un quiz par catégorie (10 questions)
     */
    public function show($id)
    {
        $category = Category::findOrFail($id);
        
        $questions = Question::where('category_id', $id)
            ->with('answers')
            ->inRandomOrder()
            ->take(10)
            ->get();

        return view('quiz.play', compact('category', 'questions'));
    }

    /**
     * 3. Mode Expert (Toutes les questions mélangées)
     */
    public function playAll()
    {
        $category = (object) ['id' => null, 'name' => 'Mode Expert'];
        
        $questions = Question::with('answers')
            ->inRandomOrder()
            ->take(15) 
            ->get();

        return view('quiz.play', compact('category', 'questions'));
    }

    /**
     * 4. Validation du quiz et calcul du score
     */
    public function submit(Request $request)
    {
        $points = 0;
        $responses = $request->input('answers', []); 
        
        if (!empty($responses)) {
            foreach ($responses as $questionId => $answerId) {
                $answer = Answer::find($answerId);
                if ($answer && $answer->is_correct == 1) {
                    $points += 10; 
                }
            }
        }

        $categoryId = $request->input('category_id');
        if (empty($categoryId)) {
            $categoryId = 1; 
        }

        Result::create([
            'user_id' => Auth::id(),
            'category_id' => $categoryId,
            'score' => $points,
            'played_at' => now(),
        ]);

        $totalPossible = empty($request->input('category_id')) ? 150 : 100;

        return view('quiz.result', [
            'score' => $points,
            'total' => $totalPossible,
            'category_id' => $categoryId
        ]);
    }

    /**
     * 5. Classement Global (Mis à jour pour correspondre à la vue)
     */
    public function leaderboard()
    {
        // On utilise User avec withSum et withCount pour alimenter la vue leaderboard
        $users = User::withCount('results')
            ->withSum('results', 'score')
            ->orderBy('results_sum_score', 'desc')
            ->take(50)
            ->get();

        // On passe 'users' (au pluriel) pour correspondre au @foreach($users as ...) de la vue
        return view('quiz.leaderboard', compact('users'));
    }
}