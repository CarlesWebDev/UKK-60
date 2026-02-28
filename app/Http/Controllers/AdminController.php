<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Aspiration, Category, Student, admin, feedback};

class AdminController extends Controller
{
    public function ShowLoginForm()
    {
        if (auth()->guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('auth.adminlogin');
    }

    public function Login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string|min:8',
        ]);

        if (auth()->guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }


    public function dashboard(Request $request)
    {
        $total = Aspiration::count();
        $proccessingaspirations = Aspiration::whereIn('status', ['pending', 'progress'])->count();
        $aspirationdone = Aspiration::whereIn('status', ['completed', 'archived'])->count();

        $Dataaspirations = Aspiration::with(['student', 'category'])->latest()->paginate(5)->withQueryString();
        $rejectedAspirations = Aspiration::where('status', 'rejected')->count();

        $categories = Category::all();
        $students = Student::all();

        $query = Aspiration::with(['student', 'category']);

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('student_id')) {
            $query->where('student_id', $request->student_id);
        }

        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        if ($request->filled('month')) {
            $query->whereYear('created_at', date('Y', strtotime($request->month)))
                ->whereMonth('created_at', date('m', strtotime($request->month)));
        }

        $Dataaspirations = $query->latest()->paginate(5)->withQueryString();

        return view('admin.dashboard', compact('total', 'proccessingaspirations', 'aspirationdone', 'Dataaspirations', 'rejectedAspirations', 'categories', 'students'));
    }

    public function UserManagement(Request $request)
    {
        $query = Student::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('nisn', 'like', "%{$search}%");
            });
        }

        if ($request->filled('grade') && $request->grade !== 'Semua Kelas') {
            $query->where('grade', $request->grade);
        }

        $grades = Student::select('grade')->distinct()->orderBy('grade', 'asc')->pluck('grade');

        $students = $query->latest()->paginate(5)->withQueryString();
        $totalStudents = Student::count();
        $totalClasses = Student::distinct('grade')->count('grade');

        return view('admin.userManagement', compact('students', 'totalStudents', 'totalClasses', 'grades'));
    }

    public function CategoryManagement(Request $request)
    {
        $query = Category::query();

        if ($request->filled('search')) {
            $query->where('category_name', 'like', '%' . $request->search . '%');
        }

        $categories = $query->latest()->paginate(5)->withQueryString();

        return view('admin.managementcategory', compact('categories'));
    }

    public function createstudent()
    {
        return view('admin.createstudent');
    }

    public function storestudent(Request $request)
    {
        $request->validate([
            'nisn' => 'required|numeric|unique:students,nisn|min:10',
            'name' => 'required|string|max:255',
            'grade' => 'required|string|max:10',
            'password' => 'required|string|min:8',
        ]);

        Student::create([
            'nisn' => $request->nisn,
            'name' => $request->name,
            'grade' => $request->grade,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('admin.user.management')->with('success', 'Student created successfully.');
    }

    public function editstudent($id)
    {
        $student = Student::findOrFail($id);
        return view('admin.editstudent', compact('student'));
    }

    public function updatestudent(Request $request, $id)
    {
        $student = Student::findOrFail($id);

        $request->validate([
            'nisn' => 'required|numeric|min:10|unique:students,nisn,' . $student->id,
            'name' => 'required|string|max:255',
            'grade' => 'required|string|max:10',
            'password' => 'nullable|string|min:8',
        ]);

        if ($request->filled('password')) {
            $student->password = bcrypt($request->password);
        }

        $student->nisn = $request->nisn;
        $student->name = $request->name;
        $student->grade = $request->grade;
        $student->save();

        return redirect()->route('admin.user.management')->with('success', 'Student updated successfully.');
    }

    public function deletestudent($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();

        return redirect()->route('admin.user.management')->with('success', 'Student deleted successfully.');
    }

    public function ManagementAspirations(Request $request)
    {
        $query = Aspiration::with(['student', 'category']);

        if ($request->filled('status')) {
            if ($request->status === 'completed') {
                $query->whereIn('status', ['completed', 'archived']);
            } else {
                $query->where('status', $request->status);
            }
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('location', 'like', "%{$search}%")
                    ->orWhere('created_at', 'like', "%{$search}%")
                    ->orWhereHas('student', function ($studentQuery) use ($search) {
                        $studentQuery->where('name', 'like', "%{$search}%")
                            ->orWhere('nisn', 'like', "%{$search}%");
                    })
                    ->orWhereHas('category', function ($categoryQuery) use ($search) {
                        $categoryQuery->where('category_name', 'like', "%{$search}%");
                    });
            });
        }

        $aspirations = $query->latest()->paginate(5)->withQueryString();
        return view('admin.managementaspirations', compact('aspirations'));
    }

    public function showaspirations($id)
    {
        $aspiration = Aspiration::with(['student', 'category', 'feedback'])->findOrFail($id);
        return view('admin.showaspirations', compact('aspiration'));
    }

    public function storeFeedback(Request $request, $id)
    {
        $request->validate(array(
            'status' => 'required|in:pending,progress,completed,rejected',
            'information' => 'required|string',
        ));

        $aspiration = Aspiration::findOrFail($id);
        $adminId = auth()->guard('admin')->id();

        if ($aspiration->feedback_id) {
            $feedback = feedback::findOrFail($aspiration->feedback_id);
        } else {
            $feedback = new feedback();
        }

        $feedback->information = $request->information;
        $feedback->admin_id = $adminId;
        $feedback->save();

        $aspiration->feedback_id = $feedback->id;
        $aspiration->status = $request->status;
        $aspiration->save();

        return redirect()->route('admin.management.aspiration')->with('success', 'Status dan feedback berhasil diperbarui.');
    }

    public function deleteaspiration($id)
    {
        $aspiration = Aspiration::findOrFail($id);
        $aspiration->delete();

        return redirect()->route('admin.management.aspiration')->with('success', 'Aspiration deleted successfully.');
    }
    public function createcategory()
    {
        return view('admin.createcategory');
    }

    public function storecategory(Request $request)
    {
        $request->validate([
            'category_name' => 'required|string|max:255|unique:categories,category_name'
        ]);

        Category::create([
            'category_name' => $request->category_name,
        ]);

        return redirect()->route('admin.category.management')->with('success', 'Category created successfully.');
    }

    public function deletecategory($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('admin.category.management')->with('success', 'Category deleted successfully.');
    }


    public function history()
    {
        $adminId = auth()->guard('admin')->id();

        $aspirations = Aspiration::with('category')
            ->whereHas('feedback', function ($query) use ($adminId) {
                $query->where('admin_id', $adminId);
            })
            ->latest()
            ->paginate(5);
        return view('admin.history', compact('aspirations'));
    }


    public function logout(Request $request)
    {
        auth()->guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/admin/login');
    }
}
