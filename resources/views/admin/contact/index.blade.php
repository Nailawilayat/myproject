@extends('admin.layouts.app')

@section('title', 'Contact Messages')
@section('page-title', 'Contact Messages')

@section('content')

<div class="container-fluid">

    <div class="card border-0 shadow-sm">

        <div class="card-body">

            <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">

                <h5 class="fw-bold mb-0">
                    Contact Messages
                </h5>

                <span class="badge bg-primary">
                    {{ $contacts->count() }} Messages
                </span>

            </div>


            {{-- Success Message --}}
            @if(session('success'))

                <div class="alert alert-success alert-dismissible fade show">

                    {{ session('success') }}

                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="alert">
                    </button>

                </div>

            @endif


            {{-- ================= DESKTOP / TABLET TABLE VIEW ================= --}}

            <div class="table-responsive d-none d-md-block">

                <table class="table table-bordered table-hover align-middle">

                    <thead class="table-dark">

                        <tr>

                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Subject</th>
                            <th>Message</th>
                            <th>Date</th>
                            <th width="100">Action</th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse($contacts as $contact)

                            <tr>

                                <td>
                                    {{ $contact->id }}
                                </td>

                                <td>
                                    <strong>
                                        {{ $contact->name }}
                                    </strong>
                                </td>

                                <td>
                                    {{ $contact->email }}
                                </td>

                                <td>
                                    {{ $contact->subject }}
                                </td>

                                <td>
                                    {{ \Illuminate\Support\Str::limit($contact->message, 40) }}
                                </td>

                                <td>
                                    {{ \Carbon\Carbon::parse($contact->created_at)->format('d M Y') }}
                                </td>

                                <td>

                                    <form action="{{ route('admin.contact-messages.destroy', $contact->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Kya aap waqai is message ko delete karna chahte hain?');">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="btn btn-sm btn-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="7"
                                    class="text-center text-muted py-5">

                                    <i class="bi bi-envelope"
                                       style="font-size: 40px;"></i>

                                    <h6 class="mt-3">
                                        No messages found.
                                    </h6>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>


            {{-- ================= MOBILE CARD VIEW ================= --}}

            <div class="d-md-none">

                @forelse($contacts as $contact)

                    <div class="card mb-3 shadow-sm">

                        <div class="card-body">

                            <div class="d-flex justify-content-between align-items-start mb-2">

                                <h6 class="fw-bold mb-0">
                                    {{ $contact->name }}
                                </h6>

                                <span class="badge bg-secondary">
                                    {{ \Carbon\Carbon::parse($contact->created_at)->format('d M Y') }}
                                </span>

                            </div>

                            <p class="mb-1 small text-muted">
                                <i class="bi bi-envelope me-1"></i>
                                {{ $contact->email }}
                            </p>

                            <p class="mb-1 small fw-semibold">
                                {{ $contact->subject }}
                            </p>

                            <p class="mb-3 small text-muted">
                                {{ $contact->message }}
                            </p>

                            <form action="{{ route('admin.contact-messages.destroy', $contact->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Kya aap waqai is message ko delete karna chahte hain?');">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="btn btn-sm btn-danger w-100">
                                    <i class="bi bi-trash"></i> Delete
                                </button>

                            </form>

                        </div>

                    </div>

                @empty

                    <div class="text-center text-muted py-5">

                        <i class="bi bi-envelope"
                           style="font-size: 40px;"></i>

                        <h6 class="mt-3">
                            No messages found.
                        </h6>

                    </div>

                @endforelse

            </div>

        </div>

    </div>

</div>

@endsection