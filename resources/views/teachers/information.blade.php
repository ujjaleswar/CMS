@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Teachers Details</h4>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-bordered table-striped align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Preferred Subject</th>
                        </tr>
                    </thead>
                    <tbody>


                        <tr>

                            <td>{{ $teachers->name ?? 'No' }}</td>
                            <td>{{ $teachers->email ?? 'No' }}</td>
                            <td>{{ $teachers->teacher->phone ?? 'No' }}</td>
                            <td>{{ $teachers->teacher->preferred_sub ?? 'No' }}</td>

                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
