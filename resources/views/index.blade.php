@extends('layouts.app')

@section('title', 'Population Search')

@section('content')
<div class="container">
    <h2 class="text-center mb-4">Japan Population Search</h2>

    <!-- Form to select Prefecture and Year -->
    <form action="{{ route('population.search') }}" method="GET">
        <div class="row">
            <div class="col-md-5">
                <label for="prefecture" class="form-label">Select Prefecture:</label>
                <select name="prefecture_id" id="prefecture" class="form-control" required>
                    <option value="" disabled selected>Choose a Prefecture</option>
                    @foreach($prefectures->sortBy('id') as $prefecture)
                        <option value="{{ $prefecture->id }}" {{ request('prefecture_id') == $prefecture->id ? 'selected' : '' }}>
                            {{ $prefecture->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <div class="col-md-5">
                <label for="year" class="form-label">Select Year:</label>
                <select name="year" id="year" class="form-control" required>
                    <option value="" disabled selected>Choose a Year</option>
                    @foreach($years as $year)
                        <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>
                            {{ $year }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-2 d-flex align-items-end">
                <button type="submit" class="btn btn-primary w-100">
                    <i class="fas fa-search"></i> Search
                </button>
            </div>
        </div>
    </form>

    <!-- Display population result -->
    @if(isset($population))
        <div class="alert alert-info mt-4">
            <strong>Population in {{ $selectedYear }} ({{ $selectedPrefecture->name }}):</strong> {{ number_format($population) }}
        </div>
    @elseif(request()->has('prefecture_id') && request()->has('year'))
        <div class="alert alert-warning mt-4">
            No data available for the selected prefecture and year.
        </div>
    @endif
</div>
@endsection
