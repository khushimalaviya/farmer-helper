@extends('layouts.adminlayout')

@section('content')
<div class="container">
    <h1>Farmers List</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- <!-- Update the route to the correct admin.farmers.create route -->
    <a href="{{ route('admin.farmers.create') }}" class="btn btn-primary mb-3">Add New Farmer</a> --}}

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Contact</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($farmers as $farmer)
                <tr>
                    <td>{{ $farmer->id }}</td>
                    <td>{{ $farmer->username }}</td>
                    <td>{{ $farmer->email }}</td>
                    <td>{{ $farmer->contact_no }}</td>
                    <td>
                        <!-- Update the route to the correct admin.farmers.edit route -->
                        <a href="{{ route('admin.farmers.edit', $farmer->id) }}" class="btn btn-warning btn-sm mr-2">Edit</a>

                        <!-- Update the route to the correct admin.farmers.destroy route -->
                        <form action="{{ route('admin.farmers.destroy', $farmer->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Are you sure?')" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">No farmers found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- <!-- Optional: Add pagination if you have a lot of farmers -->
    {{ $farmers->links() }} --}}
</div>
@endsection