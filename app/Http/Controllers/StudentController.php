<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Aspiration, Category, Student};
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    public function showLoginStudent()
    {
        if (auth()->guard('student')->check()) {
            return redirect()->route('student.dashboard');
        }
        return view("auth.studentLogin");
    }


    public function Login(Request $request)
    {
        $credentials = $request->validate([
            'nisn' => 'required|numeric|min:10',
            'password' => 'required|string|min:8',
        ]);

        if (auth()->guard('student')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('student.dashboard')->with('success', 'Login Successfully');
        }

        return back()->withErrors([
            'nisn' => 'The Provided do not match'
        ])->onlyInput('nisn');
    }

    public function dashboard()
    {
        $studentId = auth()->guard('student')->id();


        $aspirations = Aspiration::with('Category')
            ->where('student_id', $studentId)
            ->whereIn('status', ['pending', 'progress'])
            ->latest()
            ->paginate(5)
            ->withQueryString();

        $total = Aspiration::where('student_id', $studentId)->whereIn('status', ['pending', 'progress', 'completed', 'rejected'])->count();
        $progress = Aspiration::where('student_id', $studentId)->whereIn('status', ['pending', 'progress'])->count();
        $completed = Aspiration::where('student_id', $studentId)->where('status', 'completed')->count();
        $rejected = Aspiration::where('student_id', $studentId)->where('status', 'rejected')->count();

        return view('student.dashboard', compact('total', 'progress', 'completed', 'rejected', 'aspirations'));
    }

    public function createaspiration()
    {
        $categories = Category::all();
        return view('student.createaspiration', compact('categories'));
    }

    public function storeaspirations(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'category_id' => 'required|string|exists:categories,id',
            'photo' => 'nullable|max:2048|image|mimes:jpg,png,gif,jpeg'
        ]);

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('photos', 'public');
        }

        Aspiration::create([
            'student_id' => auth()->guard('student')->id(),
            'title' => $request->title,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'location' => $request->location,
            'photo' => $photoPath,
            'status' => 'pending'
        ]);

        return redirect()->route('student.dashboard')->with('success', 'Aspiration created succesfully');
    }

    public function editaspiration($id)
    {
        $aspiration = Aspiration::findOrFail($id);
        $categories = Category::all();
        return view('student.editaspiration', compact('aspiration', 'categories'));
    }

    public function updateaspiration(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'category_id' => 'required|string|exists:categories,id',
            'photo' => 'nullable|max:2048|image|mimes:jpg,png,gif,jpeg'
        ]);

        $aspiration = Aspiration::findOrFail($id);

        if ($request->hasFile('photo')) {
            if ($aspiration->photo) {
                Storage::disk('public')->delete($aspiration->photo);
            }
            $aspiration->photo = $request->file('photo')->store('photos', 'public');
        }

        Aspiration::where('id', $id)->update([
            'title' => $request->title,
            'location' => $request->location,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'photo' => $aspiration->photo
        ]);
        return redirect()->route('student.dashboard')->with('success', 'Aspiration update succeddfully');
    }


    public function showhistoryaspirations($id)
    {
        $aspiration = Aspiration::with('Category')->findOrFail($id);
        return view('student.showhistoryaspirations', compact('aspiration'));
    }

    public function history()
    {
        $studentId = auth()->guard('student')->id();


        $aspirations = Aspiration::with('Category')
            ->where('student_id', $studentId)
            ->whereIn('status', ['completed', 'rejected'])
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('student.history', compact('aspirations'));
    }

    public function logout(Request $request)
    {
        auth()->guard('student')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login.form');
    }
}
