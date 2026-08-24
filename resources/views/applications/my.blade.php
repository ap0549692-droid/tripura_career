@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>My Applications</h2>
    
    @if($applications->isEmpty())
        <div class="alert alert-info">You haven't applied to any scholarship yet.</div>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Scholarship</th>
                    <th>Status</th>
                    <th>Applied On</th>
                    <th>Document</th>
                </tr>
            </thead>
            <tbody>
                @foreach($applications as $app)
                <tr>
                    <td>{{ $app->scholarship->title }}</td>
                    <td><span class="badge bg-warning">{{ $app->status }}</span></td>
                    <td>{{ $app->created_at->format('d M, Y') }}</td>
                    <td>
                        @if($app->document)
                            <a href="{{ asset('uploads/' . $app->document) }}" target="_blank" class="btn btn-sm btn-info">View</a>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection