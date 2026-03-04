<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\{Aspiration, Category, student};
use Illuminate\Support\Facades\Storage;
class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function ShowLoginStudent()
    {
        if (auth()->guard('student')->check()) {
            return redirect()->route('student.dashboard');
        }
        return view('auth.studentLogin');
    }

    public function Login(Request $request)
    {
        $credentials = $request->validate([
            'nisn' => 'required|string|min:10|',
            'password' => 'required|string|min:8',
        ]);
        if (auth()->guard('student')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('student.dashboard')->with('success', 'Berhasil Login');
        }
        return back()->withErrors([
            'nisn' => 'The provided credentials do not match our records.',
        ])->onlyInput('nis');
    }

    public function dashboard()
    {
        $studentId = auth()->guard('student')->id();

        $aspirations = Aspiration::with('category')
            ->where('student_id', $studentId)
            ->where('status', '!=', 'archived')
            ->latest()
            ->paginate(5)
            ->withQueryString();

        $total      = Aspiration::where('student_id', $studentId)->where('status', '!=', 'archived')->count();
        $progress   = Aspiration::where('student_id', $studentId)->whereIn('status', ['pending', 'progress'])->count();
        $completed  = Aspiration::where('student_id', $studentId)->where('status', 'completed')->count();

        return view('student.dashboard', compact('aspirations', 'total', 'progress', 'completed'));
    }

    public function History()
    {
        $studentId = auth()->guard('student')->id();

        $aspirations = Aspiration::with('category')
            ->where('student_id', $studentId)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('student.history', compact('aspirations'));
    }

    public function showhistoryaspirations($id)
    {
        $aspiration = Aspiration::with('category')->findOrFail($id);
        return view('student.showhistoryaspirations', compact('aspiration'));
    }

    public function deleteaspirations($id)
    {
        $aspiration = Aspiration::findOrFail($id);

        if ($aspiration->status === 'completed') {
            $aspiration->update(['status' => 'archived']);
        } else {
            $aspiration->delete();
        }

        return redirect()->route('student.dashboard')->with('success', 'Aspirasi berhasil dihapus dari dashboard.');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function createaspiration()
    {
        $categories = Category::all();
        return view('student.createaspiration', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeaspirations(Request $request)
    {

        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'photo'       => 'nullable|image|max:2048',
            'location'    => 'required|string|max:255',
        ]);

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('photos', 'public');
        }


        Aspiration::create([
            'category_id' => $request->category_id,
            'title'       => $request->title,
            'description' => $request->description,
            'location'    => $request->location,
            'photo'       => $photoPath,
            'student_id'  => auth()->guard('student')->id(),
            'status'      => 'pending',
        ]);

        return redirect()->route('student.dashboard')->with('success', 'Aspirasi berhasil ditambahkan.');
    }


    public function editaspiration($id)
    {
        $aspiration = Aspiration::findOrFail($id);
        $categories = Category::all();
        return view('student.editaspiration', compact('aspiration', 'categories'));
    }

    public function updateaspiration(Request $request, $id)
    {
        $aspiration = Aspiration::findOrFail($id);

        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'photo'       => 'nullable|image|max:2048',
            'location'    => 'required|string|max:255',
        ]);

        if ($request->hasFile('photo')) {
            if ($aspiration->photo) {
                Storage::disk('public')->delete($aspiration->photo);
            }
            $aspiration->photo = $request->file('photo')->store('photos', 'public');
        }

        $aspiration->category_id = $request->category_id;
        $aspiration->title       = $request->title;
        $aspiration->description = $request->description;
        $aspiration->location    = $request->location;
        $aspiration->save();

        return redirect()->route('student.dashboard')->with('success', 'Aspirasi berhasil diperbarui.');
    }
    // public function deleteaspirations($id)
    // {
    //     $aspirations = Aspiration::findOrFail($id);
    //     $aspirations->delete();

    //     return redirect()->route('student.dashboard')->with('success', 'Aspirations deleted successfully.');
    // }
    public function logout(Request $request)
    {
        auth()->guard('student')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/student/login');
    }
}
