<?php

namespace App\Http\Controllers;

use App\Models\Specialty;
use App\Models\Doctor;
use Illuminate\Http\Request;

class SpecialtyController extends Controller
{
    public function index()
    {
        $specialties = Specialty::withCount('doctors')->get();
        return view('specialties.index', compact('specialties'));
    }

    public function show(Specialty $specialty)
    {
        $doctors = Doctor::where('specialty_id', $specialty->id)
            ->where('status', 'active')
            ->with('user')
            ->paginate(12);

        return view('specialties.show', compact('specialty', 'doctors'));
    }
}
