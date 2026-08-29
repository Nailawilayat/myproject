@role('admin')
    <a href="{{ route('admin.dashboard') }}">Admin Dashboard</a>
@endrole

@can('manage courses')
    <button>Add Course</button>
@endcan