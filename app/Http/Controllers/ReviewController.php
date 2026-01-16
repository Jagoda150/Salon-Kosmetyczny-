<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller
{
    // Wyświetlanie strony recenzji
    public function index()
    {
        $appointments = DB::table('appointments')
            ->join('services', 'appointments.service_id', '=', 'services.id')
            ->select('appointments.id', 'appointments.appointment_date', 'services.name as service_name')
            ->where('appointments.user_id', auth()->id())
            ->get();

        $reviews = DB::table('reviews')->get();

        return view('reviews', [
            'appointments' => $appointments,
            'reviews' => $reviews
        ]);
    }

    // Obsługa dodawania recenzji
    public function store(Request $request)
    {
        $validated = $request->validate([
            'appointment_id' => 'required|integer|exists:appointments,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
        ]);

        $appointment = DB::table('appointments')
            ->where('id', $validated['appointment_id'])
            ->where('user_id', auth()->id())
            ->first();

        if (!$appointment) {
            return redirect()->route('reviews.index')->with('error', 'Nie można dodać recenzji do tej wizyty.');
        }

        // Sprawdzamy, czy wizyta się odbyła
        if (now() <= $appointment->appointment_date) {
            return redirect()->route('reviews.index')->with('error', 'Możesz dodać recenzję tylko do wizyty, która się już odbyła.');
        }

        // Sprawdzamy, czy recenzja już istnieje
        $existingReview = DB::table('reviews')
            ->where('appointment_id', $validated['appointment_id'])
            ->exists();

        if ($existingReview) {
            return redirect()->route('reviews.index')->with('error', 'Recenzja dla tej wizyty już istnieje.');
        }

        DB::table('reviews')->insert([
            'user_id' => auth()->id(),
            'appointment_id' => $validated['appointment_id'],
            'rating' => $validated['rating'],
            'comment' => $validated['comment'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('reviews.index')->with('success', 'Recenzja została dodana.');
    }

    // Wyświetlanie recenzji dla administratora
    public function adminIndex()
    {
        $reviews = DB::table('reviews')
            ->join('appointments', 'reviews.appointment_id', '=', 'appointments.id')
            ->join('services', 'appointments.service_id', '=', 'services.id')
            ->join('users', 'reviews.user_id', '=', 'users.id')
            ->select(
                'reviews.id',
                'users.name as user_name',
                'services.name as service_name',
                'appointments.appointment_date',
                'reviews.rating',
                'reviews.comment',
                'reviews.created_at'
            )
            ->orderBy('reviews.created_at', 'desc')
            ->get();

        return view('admin.reviews.index', ['reviews' => $reviews]);
    }

    // Usuwanie recenzji przez administratora
    public function destroy($id)
    {
        DB::table('reviews')->where('id', $id)->delete();

        return redirect()->route('admin.reviews.index')->with('success', 'Recenzja została usunięta.');
    }
}
