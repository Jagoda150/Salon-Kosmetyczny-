<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HolidayController extends Controller
{
    // Wyświetlenie listy dni wolnych
    public function index()
    {
        $holidays = DB::table('holidays')->get();
        return view('admin.holidays.index', compact('holidays'));
    }

    // Dodanie dnia wolnego
    public function store(Request $request)
    {
        $request->validate([
            'holiday_date' => 'required|date|unique:holidays,holiday_date',
            'description' => 'nullable|string|max:255',
        ]);

        DB::table('holidays')->insert([
            'holiday_date' => $request->holiday_date,
            'description' => $request->description,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('admin.holidays.index')->with('success', 'Dzień wolny został dodany.');
    }

    // Usunięcie dnia wolnego
    public function destroy($id)
    {
        DB::table('holidays')->where('id', $id)->delete();
        return redirect()->route('admin.holidays.index')->with('success', 'Dzień wolny został usunięty.');
    }
}
