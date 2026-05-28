<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Question;
use App\Models\Answer;
use App\Models\Result;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    /**
     * Dashboard : Statistiques globales
     */
    public function index()
    {
        $stats = [
            'total_users' => User::where('role', 'player')->count(),
            'total_questions' => Question::count(),
            'total_quizzes_played' => Result::count(),
            'average_score' => round(Result::avg('score') ?? 0, 2),
        ];

        $topPlayers = User::withSum('results', 'score')
            ->orderByDesc('results_sum_score')
            ->take(5)
            ->get();

        $nationalityStats = User::select('nationality', DB::raw('count(*) as total'))
            ->whereNotNull('nationality')
            ->groupBy('nationality')
            ->get();

        $categoryStats = Category::withCount('questions')->get();

        return view('admin.dashboard', compact('stats', 'topPlayers', 'nationalityStats', 'categoryStats'));
    }

    /**
     * --- GESTION DES UTILISATEURS ---
     */
    public function usersIndex()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function userCreate()
    {
        return view('admin.users.create');
    }

    public function userStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:191',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role' => 'required|in:admin,player',
            'nationality' => 'nullable|string|max:191',
            'address' => 'nullable|string|max:191'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'nationality' => $request->nationality,
            'address' => $request->address,
        ]);

        return redirect()->route('users.index')->with('success', 'Utilisateur créé avec succès !');
    }

    /**
     * MÉTHODE MISE À JOUR : Affiche les détails avec statistiques réelles
     */
    public function userShow($id)
    {
        $user = User::with('results')->findOrFail($id);

        // 1. Nombre de quiz joués
        $quizCount = $user->results->count();

        // 2. Précision (Basée sur un score max de 100 par quiz)
        $totalObtained = $user->results->sum('score');
        $totalPossible = $quizCount * 100;
        $precision = $totalPossible > 0 ? round(($totalObtained / $totalPossible) * 100) : 0;

        // 3. Rang Global (Basé sur la somme des scores)
        $rank = DB::table('results')
            ->select('user_id', DB::raw('SUM(score) as total_points'))
            ->groupBy('user_id')
            ->having('total_points', '>', $totalObtained)
            ->count() + 1;

        return view('admin.users.show', compact('user', 'quizCount', 'precision', 'rank'));
    }

    public function userEdit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function userUpdate(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:191',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|in:admin,player',
            'nationality' => 'nullable|string|max:191'
        ]);

        $user->update($request->only('name', 'email', 'role', 'nationality', 'address'));

        if ($request->filled('password')) {
            $user->update(['password' => Hash::make($request->password)]);
        }

        return redirect()->route('users.index')->with('success', 'Profil mis à jour !');
    }

    public function userDelete($id)
    {
        $user = User::findOrFail($id);
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Impossible de supprimer votre propre compte.');
        }
        $user->delete();
        return back()->with('success', 'Utilisateur supprimé.');
    }

    /**
     * --- GESTION DES CATÉGORIES ---
     */
    public function categoriesIndex()
    {
        $categories = Category::withCount('questions')->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function categoryStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:191|unique:categories,name',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('categories', 'public');
        }

        Category::create([
            'name' => $request->name,
            'image' => $imagePath
        ]);

        return redirect()->route('categories.index')->with('success', 'Catégorie ajoutée !');
    }

    public function categoryDelete($id)
    {
        $category = Category::findOrFail($id);
        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Catégorie supprimée.');
    }

    /**
     * --- GESTION DU QUIZ (QUESTIONS & RÉPONSES) ---
     */
    public function questionsIndex()
    {
        $questions = Question::with(['category', 'answers'])->latest()->get();
        $categories = Category::all();
        return view('admin.questions.index', compact('questions', 'categories'));
    }

    public function questionStore(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'question_text' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'answers' => 'required|array|min:4|max:4',
            'answers.*' => 'required|string',
            'correct_answer' => 'required|integer|min:0|max:3'
        ]);

        DB::transaction(function () use ($request) {
            $imagePath = null;
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('questions', 'public');
            }

            $question = Question::create([
                'category_id' => $request->category_id,
                'question_text' => $request->question_text,
                'image_path' => $imagePath 
            ]);

            foreach ($request->answers as $index => $text) {
                Answer::create([
                    'question_id' => $question->id,
                    'answer_text' => $text,
                    'is_correct' => ($index == $request->correct_answer)
                ]);
            }
        });

        return redirect()->route('questions.index')->with('success', 'Question et réponses ajoutées avec succès !');
    }

    /**
     * MISE À JOUR D'UNE QUESTION
     */
    public function questionUpdate(Request $request, $id)
    {
        $question = Question::findOrFail($id);

        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'question_text' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        DB::transaction(function () use ($request, $question) {
            if ($request->hasFile('image')) {
                if ($question->image_path) {
                    Storage::disk('public')->delete($question->image_path);
                }
                $question->image_path = $request->file('image')->store('questions', 'public');
            }

            $question->update([
                'category_id' => $request->category_id,
                'question_text' => $request->question_text,
            ]);
        });

        return redirect()->route('questions.index')->with('success', 'Question mise à jour avec succès !');
    }

    public function questionDelete($id)
    {
        $question = Question::findOrFail($id);
        
        if ($question->image_path) {
            Storage::disk('public')->delete($question->image_path);
        }

        $question->answers()->delete();
        $question->delete();

        return redirect()->route('questions.index')->with('success', 'Question supprimée.');
    }
}