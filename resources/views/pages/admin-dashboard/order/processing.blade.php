@extends('pages.layout.layout')
@section('content')

<div class="card border-0 shadow-sm">
    <div class="card-header bg-white py-3">
        <h5 class="mb-0">
            <i class="bi bi-cart-check-fill text-success me-2"></i>
            Penging
        </h5>
    </div>

    <div class="card-body">

        <div class="table-responsive">
            <table class="table table-hover align-middle">

                <thead class="table-light">
                    <tr>

                        <th>
                            <i class="bi bi-hash me-1"></i>
                            ID
                        </th>

                        <th>
                            <i class="bi bi-person-fill me-1"></i>
                            Customer
                        </th>

                        <th>
                            <i class="bi bi-telephone-fill me-1"></i>
                            Phone
                        </th>

                        <th>
                            <i class="bi bi-envelope-fill me-1"></i>
                            Email
                        </th>

                        <th>
                            <i class="bi bi-cash-stack me-1"></i>
                            Total
                        </th>

                        <th>
                            <i class="bi bi-credit-card-fill me-1"></i>
                            Payment
                        </th>

                        <th>
                            <i class="bi bi-info-circle-fill me-1"></i>
                            Status
                        </th>

                        <th>
                            <i class="bi bi-calendar-date-fill me-1"></i>
                            Date
                        </th>

                        <th class="text-center">
                            <i class="bi bi-gear-fill me-1"></i>
                            Action
                        </th>

                    </tr>
                </thead>

                <tbody>

                    @forelse($order as $order)

                        <tr>

                            <td>
                                #{{ $order->id }}
                            </td>

                            <td>
                                {{ $order->fullName }}
                            </td>

                            <td>
                                {{ $order->phone }}
                            </td>

                            <td>
                                {{ $order->email }}
                            </td>

                            <td>
                                <strong>
                                    ৳{{ number_format($order->total, 2) }}
                                </strong>
                            </td>

                            <td>
                                <span class="badge bg-secondary">
                                    {{ $order->paymentMethod }}
                                </span>
                            </td>

                            <td>

                                @if($order->status == 'pending')

                                    <span class="badge bg-warning text-dark">
                                        <i class="bi bi-clock me-1"></i>
                                        Pending
                                    </span>

                                @elseif($order->status == 'processing')

                                    <span class="badge bg-info">
                                        <i class="bi bi-arrow-repeat me-1"></i>
                                        Processing
                                    </span>

                                @elseif($order->tstatus == 'completed')

                                    <span class="badge bg-success">
                                        <i class="bi bi-check-circle me-1"></i>
                                        Completed
                                    </span>

                                @elseif($order->status == 'cancelled')

                                    <span class="badge bg-danger">
                                        <i class="bi bi-x-circle me-1"></i>
                                        Cancelled
                                    </span>

                                @else

                                    <span class="badge bg-secondary">
                                        {{ $order->status }}
                                    </span>

                                @endif

                            </td>

                            <td>
                                {{ $order->created_at->format('d M Y') }}
                            </td>

                            {{-- LAST TH : EYE BUTTON --}}
                            <td class="text-center">

                                <a href="{{ route('admin.order.show',$order->id) }}"
                                   class="btn btn-sm btn-outline-primary"
                                   title="View Order">

                                    <i class="bi bi-eye-fill"></i>

                                </a>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="9" class="text-center py-4">

                                <i class="bi bi-cart-x fs-1 text-muted"></i>

                                <p class="text-muted mb-0 mt-2">
                                    No orders found.
                                </p>

                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>
        </div>

    </div>
</div>

@endsection