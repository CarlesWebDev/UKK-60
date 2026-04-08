<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Admin, Aspiration, Category, Feedback, Student};

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
            'password' => 'string|required|min:8',
            'email' => 'email|string|required',
        ]);

        if (auth()->guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard')->with('success', 'Login Successfully');
        }

        return back()->withErrors([
            'email' => 'your credentials do not match!'
        ])->onlyInput('email');
    }

    public function dashboard(Request $request)
    {
        $total = Aspiration::count();
        $proccessingaspirations = Aspiration::whereIn('status', ['pending', 'procees'])->count();
        $aspirationdone = Aspiration::where('status', 'completed')->count();
        $rejectedAspirations = Aspiration::where('status', 'completed')->count();

        $categories = Category::all();
        $students = Student::all();

        $Dataaspirations = Aspiration::with(['Student', 'Category'])
            ->whereIn('status', ['pending', 'progress'])
            ->when($request->category_id, function ($q, $categoryId) {
                $q->where('category_id', $categoryId);
            })
            ->when($request->student_id, function ($q, $StudentId) {
                $q->where('student_id', $StudentId);
            })
            ->when($request->date, function ($q, $date) {
                $q->whereDate('created_at', $date);
            })
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('admin.dashboard', compact('total', 'proccessingaspirations', 'aspirationdone', 'rejectedAspirations', 'categories', 'students', 'Dataaspirations'));
    }

    public function UserManagement(Request $request)
    {
        $students = Student::query()
            ->when($request->search, function ($q, $search) {
                $q->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                    $q->orWhere('nisn', 'like', "%{$search}%");
                });
            })
            ->when($request->grade !== 'Semua Kelas' ? $request->grade : null, function ($q, $grade) {
                $q->where('grade', $grade);
            })
            ->latest()
            ->paginate(5)
            ->withQueryString();

        $totalStudents = Student::count();
        $grades = Student::select('grade')->distinct()->orderBy('grade', 'asc')->pluck('grade');
        $totalClasses = Student::distinct('grade')->count('grade');
        return view('admin.usermanagement', compact('totalStudents', 'totalClasses', 'grades', 'students'));
    }

    public function createstudent()
    {
        return view('admin.createstudent');
    }


    public function storestudent(Request $request)
    {
        $request->validate([
            'nisn' => 'numeric|required|min:10|unique:students,nisn',
            'name' => 'required|string|max:255',
            'grade' => 'required|string|max:255',
            'password' => 'required|string|min:8',
        ]);

        Student::create([
            'nisn' => $request->nisn,
            'name' => $request->name,
            'grade' => $request->grade,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('admin.user.management')->with('success', 'Student Created Successfully');
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
            'nisn' => 'numeric|required|min:10|unique:students,nisn,' . $student->id,
            'name' => 'required|string|max:255',
            'grade' => 'required|string|max:255',
            'password' => 'nullable|string|min:8',
        ]);

        if ($request->filled('password')) {
            $student->password = bcrypt($request->password);
        }

        Student::where('id', $id)->update([
            'nisn' => $request->nisn,
            'name' => $request->name,
            'grade' => $request->grade,
            'password' => bcrypt($request->password),
        ]);
        return redirect()->route('admin.user.management')->with('success', 'Student Update Succesfully', compact('student'));
    }


    public function deletestudent($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();

        return redirect()->route('admin.user.management')->with('success', 'Student Deleted SuccessFully');
    }

    public function CategoryManagement(Request $request)
    {
        $categories = Category::query()
            ->when($request->search, function ($q, $search) {
                $q->where(function ($q) use ($search) {
                    $q->where('category_name', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(5)
            ->withQueryString();
        return view('admin.managementcategory', compact('categories'));
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

        return redirect()->route('admin.category.management')->with('success', 'Categtory Created Succesfully');
    }

    public function deletecategory($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('admin.category.management')->with('success', 'Categtory Deleted Succesfully');
    }

    public function ManagementAspirations(Request $request)
    {
        $categories = Category::all();
        $aspirations = Aspiration::with(['Student', 'Category'])
            ->whereIn('status', ['pending', 'progress'])
            ->when($request->status, function ($q, $status) {
                $q->where('status', $status);
            })
            ->when($request->category_id, function ($q, $catgoryId) {
                $q->where('category_id', $catgoryId);
            })
            ->when($request->date, function ($q, $date) {
                $q->whereDate('created_at', $date);
            })
            ->when($request->search, function ($q, $search) {
                $q->where(function ($q) use ($search) {
                    $q->orWhere('title', 'like', "%{$search}%");
                    $q->orWhere('description', 'like', "%{$search}%");
                    $q->orWhere('location', 'like', "%{$search}%");
                    $q->orWhereHas('student', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                        $q->orWhere('nisn', 'like', "%{$search}%");
                    });
                });
            })
            ->latest()
            ->paginate(5)
            ->withQueryString();
        return view('admin.managementaspirations', compact('categories', 'aspirations'));
    }

    public function storeFeedback(Request $request, $id)
    {
        $request->validate([
            'information' => 'string|max:255|required',
            'status' => 'required|in:pending,progress,completed,rejected'
        ]);

        $aspiration = Aspiration::findOrFail($id);

        $feedback = Feedback::findOrNew($aspiration->feedback_id);
        $feedback->information = $request->information;
        $feedback->admin_id = auth()->guard('admin')->id();
        $feedback->save();

        $aspiration->feedback_id = $feedback->id;
        $aspiration->status = $request->status;
        $aspiration->save();

        return redirect()->route('admin.management.aspiration')->with('success', 'Feedback submitted succesfully');
    }

    public function showaspirations($id)
    {
        $aspiration = Aspiration::with('category')->findOrFail($id);
        return view('admin.showaspirations', compact('aspiration'));
    }

    public function history()
    {
        $aspirations = Aspiration::with('Category', 'Student')->whereIn('status', ['rejected', 'completed'])->latest()->paginate(5)->withQueryString();
        return view('admin.history', compact('aspirations'));
    }

    public function showhistoryaspiration($id)
    {
        $aspiration = Aspiration::with('category')->findOrFail($id);
        return view('admin.showaspirations',compact('aspiration'));
    }

    public function logout(Request $request)
    {
        auth()->guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('student.login.form');
    }
}
