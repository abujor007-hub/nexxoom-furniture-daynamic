@extends('pages.layout.layout')
@section('content')

    <div class="container-fluid  my-5">

        <!-- Heading -->
        <div class="d-flex justify-content-between align-items-center mb-4">

            <h3 class="fw-bold mb-0">
                <i class="bi bi-envelope-paper-fill text-primary me-2"></i>
                Contact Messages
            </h3>

            <span class="badge bg-primary">
                {{ $message->count() }} Messages
            </span>

        </div>


        <!-- Table -->
        <div class="table-responsive">

            <table class="table table-bordered table-hover align-middle">

                <thead class="table-">

                    <tr>

                        <th>
                            <i class="bi bi-hash me-1"></i>
                            ID
                        </th>

                        <th>
                            <i class="bi bi-person-fill me-1"></i>
                            Full Name
                        </th>

                        <th>
                            <i class="bi bi-envelope-fill me-1"></i>
                            Email
                        </th>

                        <th>
                            <i class="bi bi-telephone-fill me-1"></i>
                            Phone
                        </th>

                        <th>
                            <i class="bi bi-geo-alt-fill me-1"></i>
                            Address
                        </th>

                        <th>
                            <i class="bi bi-chat-left-text-fill me-1"></i>
                            Message
                        </th>

                        <th>
                            <i class="bi bi-calendar3 me-1"></i>
                            Date
                        </th>

                        <th>
                            <i class="bi bi-gear-fill me-1"></i>
                            Action
                        </th>

                    </tr>

                </thead>



                <tbody>

                    @php
                        $i = 1;
                    @endphp

                    @forelse($message as $message)

                        <tr>

                            <!-- Serial -->
                            <td>
                                {{ $i++ }}
                            </td>

                            <!-- Full Name -->
                            <td>
                                {{ $message->fullName }}
                            </td>

                            <!-- Email -->
                            <td>
                                {{ $message->email }}
                            </td>

                            <!-- Phone -->
                            <td>
                                {{ $message->phone }}
                            </td>

                            <!-- Address -->
                            <td>
                                {{ $message->address }}
                            </td>

                            <!-- Message -->
                            <td>
                                {{ $message->message }}
                            </td>

                            <!-- Date -->
                            <td>
                                {{ $message->created_at->format('d M Y') }}
                            </td>

                            <!-- Action -->
                            <td>

                                <form action="" method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this message?');">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-danger btn-sm">

                                        <i class="bi bi-trash-fill me-1"></i>
                                        Delete

                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="8" class="text-center py-4">

                                No messages found.

                            </td>

                        </tr>

                    @endforelse

                </tbody>



            </table>

        </div>

    </div>



@endsection