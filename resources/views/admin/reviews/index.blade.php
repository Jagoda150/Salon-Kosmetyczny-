@extends('layouts.admin')

@section('title', 'Panel Administratora - recenzje')

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@section('content')

<!-- Tabela recenzji -->
<div class="container mt-4">
    <table class="table table-bordered">
        <head>
            <tr>
                <th>ID</th>
                <th>Użytkownik</th>
                <th>Usługa</th>
                <th>Data wizyty</th>
                <th>Ocena</th>
                <th>Komentarz</th>
                <th>Dodano</th>
                <th>Akcje</th>
            </tr>
        </head>
        <body>
            @foreach($reviews as $review)
            <tr>
                <td>{{ $review->id }}</td>
                <td>{{ $review->user_name }}</td>
                <td>{{ $review->service_name }}</td>
                <td>{{ $review->appointment_date }}</td>
                <td>{{ $review->rating }}</td>
                <td>{{ $review->comment }}</td>
                <td>{{ $review->created_at }}</td>
                <td>
                    <form action="{{ route('admin.reviews.destroy', $review->id) }}" method="POST" onsubmit="return confirm('Czy na pewno chcesz usunąć tę recenzję?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Usuń</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </body>
    </table>
</div>

@endsection
