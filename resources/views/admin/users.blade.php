@extends('admin.layouts.app')

@section('title', 'Manage Users')
@section('page-title', 'Manage Users')

@section('content')

<div class="container py-5">

    <h1 class="mb-4">
        Manage Users
    </h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive">

        <table class="table table-bordered table-striped">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Current Role</th>
                    <th>Change Role</th>
                </tr>
            </thead>

            <tbody>

                @foreach($students as $student)

                    <tr>

                        <td>
                            {{ $student->id }}
                        </td>

                        <td>
                            {{ $student->name }}
                        </td>

                        <td>
                            {{ $student->email }}
                        </td>

                        <td>
                            <span class="badge bg-primary">
                                {{ ucfirst($student->role) }}
                            </span>
                        </td>

                        <td>

                            <form method="POST"
                                  action="{{ route('admin.users.role', $student->id) }}">

                                @csrf
                                @method('PUT')

                                <select name="role"
                                        class="form-select mb-2">

                                    <option value="user"
                                        {{ $student->role === 'user' ? 'selected' : '' }}>
                                        User
                                    </option>

                                    <option value="teacher"
                                        {{ $student->role === 'teacher' ? 'selected' : '' }}>
                                        Teacher
                                    </option>

                                    <option value="admin"
                                        {{ $student->role === 'admin' ? 'selected' : '' }}>
                                        Admin
                                    </option>

                                </select>

                                <button type="submit"
                                        class="btn btn-success btn-sm">
                                    Update Role
                                </button>

                            </form>

                        </td>

                    </tr>

                @endforeach

            </tbody>

        </table>

    </div>

</div>
@endsection