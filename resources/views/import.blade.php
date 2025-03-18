    @extends('layouts.app')

    @section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg border-0">
                    <div class="card-header bg-primary text-white text-center">
                        <h4 class="mb-0">📂 Import CSV File</h4>
                    </div>
                    <div class="card-body text-center">
                        {{-- Success Message --}}
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                ✅ {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        {{-- Error Message --}}
                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                ❌ {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <form id="csvUploadForm" action="{{ route('import.csv') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="csvFile" class="form-label">Select a CSV file</label>
                                <input class="form-control" type="file" id="csvFile" name="csv_file" accept=".csv" required>
                            </div>
                            <button type="submit" class="btn btn-success w-100">
                                🚀 Upload & Import
                                <span id="loadingSpinner" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    document.getElementById('csvUploadForm').addEventListener('submit', function() {
        document.getElementById('loadingSpinner').classList.remove('d-none');
    });
    </script>
    @endsection
