@extends('designer.layouts.dashboard')

@section('title', 'Created Budgets')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5>All budgets</h5>
                    <hr>
                    @if ($pdfs->count() > 0)
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Budget</th>
                                    <th>Client's Name</th>
                                    <th>Client's phone</th>
                                    <th>Date Created</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pdfs as $pdf)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <a href="{{ Storage::url($pdf->pdf_path) }}" target="_blank">
                                                <i class="fas fa-file-pdf fa-2x"></i>
                                            </a>
                                        </td>
                                        <td>{{ $pdf->requirement->client->name }}</td>
                                        <td>{{ $pdf->requirement->client->phone }}</td>
                                        <td>{{ $pdf->created_at->format('d-m-Y') }}</td>
                                        <td>
                                            <form action="{{ route('designer.budget.delete', $pdf->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this budget?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="fas fa-trash-alt"></i> Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body text-center p-3">
                                    <h4>No Budgets found</h4>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
