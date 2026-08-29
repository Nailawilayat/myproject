<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lesson;

class LessonController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'pdf' => 'required|mimes:pdf'
        ]);

        $fileName = time() . '.pdf';

        $request->pdf->storeAs('public/pdfs', $fileName);

        Lesson::create([
            'title' => $request->title,
            'pdf' => $fileName
        ]);

        return back()->with('success', 'Saved');
    }

    // OPTIONAL TEST METHOD
    public function testInsert()
    {
        Lesson::create([
            'title' => 'Arabic Alphabet',
            'pdf' => 'Noorani-Qaida.pdf'
        ]);

        return "Inserted";
    }
}