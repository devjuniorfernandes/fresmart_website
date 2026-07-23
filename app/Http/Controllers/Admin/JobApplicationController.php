<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobApplication;
use Illuminate\Http\Request;

class JobApplicationController extends Controller
{
    public function index()
    {
        $applications = JobApplication::orderBy('id', 'desc')->paginate(15);
        return view('admin.applications.index', compact('applications'));
    }

    public function show($id)
    {
        $application = JobApplication::findOrFail($id);
        return view('admin.applications.show', compact('application'));
    }

    public function destroy($id)
    {
        $application = JobApplication::findOrFail($id);
        
        if ($application->cv_path) {
            $filePath = public_path($application->cv_path);
            if (file_exists($filePath)) {
                @unlink($filePath);
            }
        }
        
        $application->delete();
        
        return redirect()->route('admin.applications.index')->with('success', 'Candidatura removida com sucesso.');
    }
}
