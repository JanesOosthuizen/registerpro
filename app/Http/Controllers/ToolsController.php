<?php

namespace App\Http\Controllers;

use App\Models\CellAssignment;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegisterExportMail;

class ToolsController extends Controller
{
    public function exportRegister(Request $request)
    {

		$userId = Auth::id();

		$user = Auth::user();

		$exportData = $request->input(); 

		$className = $exportData['className'];
		$data = $exportData['data'];

		if (!$className || !$data) {
			return response()->json(['message' => 'Invalid input'], 400);
		}
	
		// Generate PDF
		$pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pdf.register', compact('className', 'data'));
	
		// Save the PDF to a temporary file
		$filePath = storage_path("app/public/{$className}_register.pdf");
		$pdf->save($filePath);
	
		// Send Email
		Mail::to($user->email)->send(new RegisterExportMail($className, $filePath));
	
		return response()->json(['message' => 'Register exported and emailed successfully.']);
	}

}
