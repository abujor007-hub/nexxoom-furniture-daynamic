@extends('pages.layout.layout')

@section('content')

  <div class="container-fluid py-4">

    {{-- Page Header --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
      <div>
        <h3 class="fw-bold mb-1">Dashboard Overview</h3>
        <p class="text-muted mb-0">
          Welcome back — here's how NexXoom Furniture is performing.
        </p>
      </div>

      <div>
        <span class="badge bg-success px-3 py-2">
          Admin Dashboard
        </span>
      </div>
    </div>


    {{-- Statistics Cards --}}
    <div class="row g-4 mb-4">

      {{-- Total Users --}}
      <div class="col-xl-3 col-md-6">
        <div class="card border-0 shadow-sm h-100">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
              <div>
                <p class="text-muted mb-2">Total Users</p>
                <h3 class="fw-bold mb-0">
                  {{ $totalUsers }}
                </h3>
              </div>

              <div class="bg-primary bg-opacity-10 text-primary rounded-circle p-3">
                <i class="bi bi-people fs-4"></i>
              </div>
            </div>
          </div>
        </div>
      </div>


      {{-- Total Orders --}}
      <div class="col-xl-3 col-md-6">
        <div class="card border-0 shadow-sm h-100">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
              <div>
                <p class="text-muted mb-2">Total Orders</p>
                <h3 class="fw-bold mb-0">
                  {{ $totalOrders }}
                </h3>
              </div>

              <div class="bg-info bg-opacity-10 text-info rounded-circle p-3">
                <i class="bi bi-cart-check fs-4"></i>
              </div>
            </div>
          </div>
        </div>
      </div>


      {{-- Delivered Orders --}}
      <div class="col-xl-3 col-md-6">
        <div class="card border-0 shadow-sm h-100">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
              <div>
                <p class="text-muted mb-2">Delivered Orders</p>
                <h3 class="fw-bold mb-0">
                  {{ $deliveredOrders }}
                </h3>
              </div>

              <div class="bg-success bg-opacity-10 text-success rounded-circle p-3">
                <i class="bi bi-check-circle fs-4"></i>
              </div>
            </div>
          </div>
        </div>
      </div>


      {{-- Pending Orders --}}
      <div class="col-xl-3 col-md-6">
        <div class="card border-0 shadow-sm h-100">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
              <div>
                <p class="text-muted mb-2">Pending Orders</p>
                <h3 class="fw-bold mb-0">
                  {{ $pendingOrders }}
                </h3>
              </div>

              <div class="bg-warning bg-opacity-10 text-warning rounded-circle p-3">
                <i class="bi bi-clock fs-4"></i>
              </div>
            </div>
          </div>
        </div>
      </div>


      {{-- Processing Orders --}}
      <div class="col-xl-3 col-md-6">
        <div class="card border-0 shadow-sm h-100">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
              <div>
                <p class="text-muted mb-2">Processing Orders</p>
                <h3 class="fw-bold mb-0">
                  {{ $processingOrders }}
                </h3>
              </div>

              <div class="bg-secondary bg-opacity-10 text-secondary rounded-circle p-3">
                <i class="bi bi-arrow-repeat fs-4"></i>
              </div>
            </div>
          </div>
        </div>
      </div>


      {{-- Shipped Orders --}}
      <div class="col-xl-3 col-md-6">
        <div class="card border-0 shadow-sm h-100">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
              <div>
                <p class="text-muted mb-2">Shipped Orders</p>
                <h3 class="fw-bold mb-0">
                  {{ $shippedOrders }}
                </h3>
              </div>

              <div class="bg-dark bg-opacity-10 text-dark rounded-circle p-3">
                <i class="bi bi-truck fs-4"></i>
              </div>
            </div>
          </div>
        </div>
      </div>


      {{-- Low Stock Products --}}
      <div class="col-xl-3 col-md-6">
        <div class="card border-0 shadow-sm h-100">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
              <div>
                <p class="text-muted mb-2">Low Stock Items</p>
                <h3 class="fw-bold mb-0">
                  {{ $lowStockProducts }}
                </h3>
              </div>

              <div class="bg-danger bg-opacity-10 text-danger rounded-circle p-3">
                <i class="bi bi-exclamation-triangle fs-4"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>


    {{-- Main Dashboard Content --}}
    <div class="row g-4">

      {{-- Order Status Chart --}}
      <div class="col-lg-5">
        <div class="card border-0 shadow-sm h-100">
          <div class="card-header bg-white border-0">
            <h5 class="fw-bold mb-0">
              Order Status
            </h5>
          </div>

          <div class="card-body">
            <canvas id="orderStatusChart"></canvas>
          </div>
        </div>
      </div>


      {{-- Recent Orders --}}
      <div class="col-lg-7">
        <div class="card border-0 shadow-sm h-100">

          <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
            <h5 class="fw-bold mb-0">
              Recent Orders
            </h5>

            <a class="btn btn-secondary" href="{{ route('allorder.page') }}">
              View All
            </a>
          </div>

          <div class="card-body p-0">

            <div class="table-responsive">
              <table class="table table-hover align-middle mb-0">

                <thead class="table-light">
                  <tr>
                    <th>#</th>
                    <th>Customer</th>
                    <th>Total</th>
                    <th>Status</th>
                  </tr>
                </thead>

                <tbody>

                  @forelse($recentOrders as $order)

                    @php
                      $status = strtolower(trim($order->status ?? 'pending'));

                      $statusClass = match ($status) {
                        'delivered' => 'success',
                        'processing' => 'info',
                        'shipped' => 'primary',
                        'cancelled' => 'danger',
                        default => 'warning',
                      };
                    @endphp

                    <tr>
                      <td>
                        {{ $order->id }}
                      </td>

                      <td>
                        {{ $order->user->name ?? $order->fullName }}
                      </td>

                      <td>
                        ৳{{ number_format($order->total, 2) }}
                      </td>

                      <td>
                        <span class="badge text-bg-{{ $statusClass }}">
                          {{ ucfirst($status) }}
                        </span>
                      </td>
                    </tr>

                  @empty

                    <tr>
                      <td colspan="4" class="text-center py-4">
                        No orders found.
                      </td>
                    </tr>

                  @endforelse

                </tbody>

              </table>
            </div>

          </div>
        </div>
      </div>


      {{-- Top Selling Products --}}
      <div class="col-lg-6">
        <div class="card border-0 shadow-sm">

          <div class="card-header bg-white border-0">
            <h5 class="fw-bold mb-0">
              Top Selling Products
            </h5>
          </div>

          <div class="card-body">

            @forelse($topProducts as $product)

              <div class="d-flex justify-content-between align-items-center border-bottom py-3">

                <div>
                  <h6 class="mb-1">
                    {{ $product->title }}
                  </h6>

                  <small class="text-muted">
                    Product ID: {{ $product->id }}
                  </small>
                </div>

                <span class="badge bg-primary">
                  {{ $product->total_sold }} Sold
                </span>

              </div>

            @empty

              <p class="text-muted text-center mb-0">
                No selling data found.
              </p>

            @endforelse

          </div>
        </div>
      </div>


      {{-- Inventory Alerts --}}
      <div class="col-lg-6">
        <div class="card border-0 shadow-sm">

          <div class="card-header bg-white border-0">
            <h5 class="fw-bold mb-0">
              Inventory Alerts
            </h5>
          </div>

          <div class="card-body">

            @forelse($stockAlerts as $product)

              <div class="d-flex justify-content-between align-items-center border-bottom py-3">

                <div>
                  <h6 class="mb-1">
                    {{ $product->title }}
                  </h6>

                  <small class="text-muted">
                    Category: {{ $product->category }}
                  </small>
                </div>

                <span class="badge bg-danger">
                  {{ $product->quantity }} Left
                </span>

              </div>

            @empty

              <p class="text-success text-center mb-0">
                All products have sufficient stock.
              </p>

            @endforelse

          </div>
        </div>
      </div>

    </div>

  </div>


  {{-- Chart.js --}}
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <script>
    const orderStatusLabels = @json($orderStatuses->keys());
    const orderStatusData = @json($orderStatuses->values());

    const chartElement = document.getElementById('orderStatusChart');

    new Chart(chartElement, {
      type: 'doughnut',

      data: {
        labels: orderStatusLabels,

        datasets: [{
          label: 'Orders',
          data: orderStatusData
        }]
      },

      options: {
        responsive: true,

        plugins: {
          legend: {
            position: 'bottom'
          }
        }
      }
    });
  </script>

@endsection