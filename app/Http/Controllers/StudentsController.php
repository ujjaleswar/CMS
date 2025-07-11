<?php

namespace App\Http\Controllers;

use App\Models\Students;
use App\Models\Attendance;
use App\Models\Myclass;
use App\Models\StudentsAttedance;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Mail;
use App\Mail\StudentRegisteredMail;

class StudentsController extends Controller
{
     public function create_student(){
        $classes=Myclass::all();
        return view('students.createstudent',compact('classes'));
    }

//    public function student_store(Request $request)
// {
//     // Handle student photo
//     $photo = $request->file('photo');
//     $photoName = time() . '_photo.' . $photo->getClientOriginalExtension();
//     $photo->move(public_path('images'), $photoName);

//     // Handle ID proof
//     $idProof = $request->file('idProof');
//     $idProofName = time() . '_id.' . $idProof->getClientOriginalExtension();
//     $idProof->move(public_path('images'), $idProofName);

//     $student = new Students();
//     $student->full_name = $request->input('fullName');
//     $student->email = $request->input('email');
//     $student->phone = $request->input('phone');
//     $student->dob = $request->input('dob');
//     $student->gender = $request->input('gender');
//     $student->address = $request->input('address');
//     $student->father_name = $request->input('fatherName');
//     $student->mother_name = $request->input('motherName');
//     $student->nationality = $request->input('nationality');
//     $student->religion = $request->input('religion');
//     $student->course = $request->input('course');
//     $student->qualification = $request->input('qualification');
//     $student->percetage = $request->input('tenth_percentage');
//     $student->course_year = $request->input('applied_year');

//     $student->photo_path = 'images/' . $photoName;
//     $student->id_proof_path = 'images/' . $idProofName;
//     $student->save();


//     $user = new User();
//     $user->name = $request->input('fullName');
//     $user->email = $request->input('email');
//     $user->password = Hash::make('1234');
//     // $user->role = 'student';
//     $user->save();

//     return redirect()->route('student.details', ['id' => $student->id]);
// }



public function student_store(Request $request)
{
    $request->validate([
        'fullName' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email',
        'phone' => 'required|string|max:20',
        'dob' => 'required|date',
        'gender' => 'required|string',
        'address' => 'required|string',
        'fatherName' => 'required|string',
        'motherName' => 'required|string',
        'nationality' => 'required|string',
        'religion' => 'required|string',
        'course' => 'required|string',
        'qualification' => 'required|string',
        'tenth_percentage' => 'required|numeric',
        'applied_year' => 'required|numeric',
        'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'idProof' => 'nullable|file|mimes:jpeg,png,jpg,gif,pdf|max:2048',
    ]);

    $photoName = null;
    if ($request->hasFile('photo')) {
        $photo = $request->file('photo');
        $photoName = time() . '_photo.' . $photo->getClientOriginalExtension();
        $photo->move(public_path('images'), $photoName);
    }

    $idProofName = null;
    if ($request->hasFile('idProof')) {
        $idProof = $request->file('idProof');
        $idProofName = time() . '_id.' . $idProof->getClientOriginalExtension();
        $idProof->move(public_path('images'), $idProofName);
    }

    $student = new Students();
    $student->full_name = $request->fullName;
    $student->email = $request->email;
    $student->phone = $request->phone;
    $student->dob = $request->dob;
    $student->gender = $request->gender;
    $student->address = $request->address;
    $student->father_name = $request->fatherName;
    $student->mother_name = $request->motherName;
    $student->nationality = $request->nationality;
    $student->religion = $request->religion;
    $student->course = $request->course;
    $student->qualification = $request->qualification;
    $student->percetage = $request->tenth_percentage;
    $student->course_year = $request->applied_year;
    $student->photo_path = $photoName ? 'images/' . $photoName : null;
    $student->id_proof_path = $idProofName ? 'images/' . $idProofName : null;
    $student->save();

    $regNumber = 'GVJC-' . now()->format('Y') . '-' . str_pad($student->id, 4, '0', STR_PAD_LEFT);
    $student->registration_number = $regNumber;
    $student->save();

    $studentRole = Role::where('name', 'student')->firstOrFail();

    $user = new User();
    $user->name = $student->full_name;
    $user->email = $student->email;
    $user->password = Hash::make('1234');
    $user->role = $studentRole->id;
    $user->save();

    $user->assignRole($studentRole->name);

    $student->userID = $user->id;
    $student->save();

    Mail::to($student->email)->send(new StudentRegisteredMail($student));

    return redirect()->route('student.details', ['id' => $student->id])
        ->with('success', 'Student registered and email sent successfully.');
}





public function student_list(Request $request)
{
    $students = Students::all();
    $query = Students::query();

    if ($request->has('search') && $request->search != '') {
        $query->where('full_name', 'LIKE', '%' . $request->search . '%');
    }

    $students = $query->get();

    return view('students.index', compact('students'));
}

public function student_view($id)
{
    $student = Students::findOrFail($id);
    return view('students.view', compact('student'));
}

public function student_edit($id)
{
    $roles = Role::all();
    $student = Students:: where('id',$id)->first();
    return view('students.edit', compact('student','roles'));

}
public function student_update(Request $request, $id)
{
    $student = Students::find($id);

    // Handle photo upload
    $photo = $request->file('photo');
    if ($photo) {
        $photoName = time() . '_photo.' . $photo->getClientOriginalExtension();
        $photo->move(public_path('images'), $photoName);
        $student->photo_path = 'images/' . $photoName;
    }
    // If no new photo is uploaded, retain the existing one

    // Handle ID proof upload
    $idProof = $request->file('idProof');
    if ($idProof) {
        $idProofName = time() . '_id.' . $idProof->getClientOriginalExtension();
        $idProof->move(public_path('images'), $idProofName);
        $student->id_proof_path = 'images/' . $idProofName;
    }
    // If no new ID proof is uploaded, retain the existing one

    // Save other student data
    $student->full_name = $request->input('fullName');
    $student->email = $request->input('email');
    $student->phone = $request->input('phone');
    $student->dob = $request->input('dob');
    $student->gender = $request->input('gender');
    $student->address = $request->input('address');
    $student->father_name = $request->input('fatherName');
    $student->mother_name = $request->input('motherName');
    $student->nationality = $request->input('nationality');
    $student->religion = $request->input('religion');
    $student->course = $request->input('course');
    $student->qualification = $request->input('qualification');
     $student->qualification = $request->input('qualification');
    $student->percetage = $request->input('tenth_percentage');

    $student->save();

    return redirect()->route('student-list');
}
// StudentsController.php

// public function student_preview()
// {
// $student = Students::all();
// //dd($student);
//    return view('students.preview', compact('student'));
// }
public function show($id)
    {
        // Fetch the student by ID or return null
        $student = Students::find($id);

        // Pass to view
        return view('students.preview', compact('student'));
    }

     public function std_destroy($id)
{
    $student = Students::findOrFail($id);
    $student->delete();

    return redirect()->route('student-list')->with('success', 'student deleted successfully.');
}

 public function downloadPDF($id)
{
    $student = Students::find($id);

    if (!$student) {
        return redirect()->back()->with('error', 'Student not found');
    }

    $pdf = Pdf::loadView('students.preview', compact('student'));

    return $pdf->download('student_application_' . $student->id . '.pdf');
}
public function showAttendanceForm()
{
    $students = Students::all();
    return view('teachers.attedance', compact('students'));
}

// public function submitShortlisted(Request $request)
// {
//     // dd($request->all());
//     foreach ($request->students as $studentData) {
//         Attendance::create([
//             'student_id' => $studentData['id'],
//             'status' => $studentData['status'],
//             'date' => now()->toDateString(),
//         ]);
//     }

//     return redirect()->route('attendance.list');
// }

public function submitShortlisted(Request $request)
{
    foreach ($request->students as $studentData) {
        $student = Students::find($studentData['id']);

        if (!$student) continue; // Skip if student not found

        // Save attendance record
        Attendance::create([
            'student_id' => $student->id,
            'UserID'     => $student->userID,
            'status'     => $studentData['status'],
            'date'       => now()->toDateString(),
        ]);

        // Update is_status = 1 if approved
        if (strtolower($studentData['status']) == 'approved') {
            $student->is_status = 1;
            $student->save();
        }
    }

    return redirect()->route('attendance.list')->with('success', 'Attendance submitted & students updated.');
}



public function showAttendanceList()
{
    // $today = now()->toDateString();

    $attendances = Attendance::with('student')->get();

    return view('teachers.view-attedance', compact('attendances'));
}


public function  shortlistedit($id)
{
    $attendance = Attendance::with('student')->findOrFail($id);

    return view('shortlisted.edit', compact('attendance'));
}



public function shortlist_update(Request $request, $id)
{
    $request->validate([
        'status' => 'required|in:Approved,Pending,Rejected',
    ]);

    $attendance = Attendance::findOrFail($id);
    $attendance->status = $request->status;
    $attendance->save();

    return redirect()->route('attendance.list')->with('success', 'Attendance updated successfully!');
}

public function shortlisted_destroy($id)
{
    $attendance = Attendance::findOrFail($id);
    $attendance->delete();

    return redirect()->route('attendance.list')->with('success', 'Attendance record deleted successfully!');
}

// public function std_information($id)
// {
//     $student = User::where('id', $id)->with('student')->first();

//     // $attendance = Attendance::where('student_id', $id)->latest()->first();
//     // dd( $attendance);
//     return view('students.student_information',compact('student'));
// }

public function std_information($id)
{
    $student = User::with('student')->findOrFail($id);

    $attendance = Attendance::where('student_id', $student->student->id)->latest()->first();
// dd($attendance);
    return view('students.student_information', compact('student', 'attendance'));
}

public function checkaAttendace()
{
    $user = Auth::user();
    $student = Students::where('userID', $user->id)->first();

    if (!$student) {
        return view('students.check_attendance', ['attendanceData' => []]);
    }

    $studentId = $student->id;
    $startOfMonth = Carbon::now()->startOfMonth()->toDateString();
    $endOfMonth = Carbon::now()->endOfMonth()->toDateString();

    $attendanceRecords = StudentsAttedance::whereBetween('date', [$startOfMonth, $endOfMonth])->get();

    $attendanceData = [];

    foreach ($attendanceRecords as $record) {
        $decoded = json_decode($record->attendance, true);

        if (isset($decoded[$studentId])) {
            $statusCode = $decoded[$studentId];
            $status = match ($statusCode) {
                1 => 'Present',
                0 => 'Absent',
                2 => 'Leave',
                default => 'Unknown',
            };

            $attendanceData[] = [
                'date' => $record->date,
                'status' => $status,
            ];
        }
    }

    return view('students.check_attendance', compact('attendanceData'));
}


}

