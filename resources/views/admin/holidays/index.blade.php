@extends('layouts.admin')

@section('title', 'Dni wolne')

@section('content')
<div class="container mt-4">
    <h1>Zarządzanie dniami wolnymi</h1>

    <form action="{{ route('admin.holidays.store') }}" method="POST" class="mb-4">
        @csrf
        <div class="mb-3">
            <label for="holiday_date" class="form-label">Data</label>
            <input type="date" id="holiday_date" name="holiday_date" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Opis</label>
            <input type="text" id="description" name="description" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Dodaj dzień wolny</button>
    </form>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Data</th>
                <th>Opis</th>
                <th>Akcje</th>
            </tr>
        </thead>
        <tbody>
            @foreach($holidays as $holiday)
            <tr>
                <td>{{ $holiday->id }}</td>
                <td>{{ $holiday->holiday_date }}</td>
                <td>{{ $holiday->description }}</td>
                <td>
                    <form action="{{ route('admin.holidays.destroy', $holiday->id) }}" method="POST" onsubmit="return confirm('Czy na pewno chcesz usunąć ten dzień wolny?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Usuń</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
