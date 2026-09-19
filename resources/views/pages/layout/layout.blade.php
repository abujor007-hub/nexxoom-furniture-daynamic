@php
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>NexXoom Furniture — Dashboard</title>

<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,400;9..144,500;9..144,600;9..144,700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<link href="{{ asset('css/dashboard_style.css') }}" rel="stylesheet">
</head>
<body>

<!-- Sidebar -->
<aside class="sidebar" id="sidebar">
  <div class="sidebar-brand d-flex align-items-center gap-2">
    <div class="mark">N</div>
    <div>
      <div class="name">NexXoom</div>
      <div class="sub">Furniture Admin</div>
    </div>
  </div>

  <nav class="side-nav">
    <div class="nav-section">General</div>
    <a href="{{ route('dashboard') }}" class="nav-link " data-page="Dashboard"><i class="bi bi-grid-1x2"></i> Dashboard</a>
    <a href="{{ route('category.page') }}" class="nav-link"><i class="bi bi-collection "></i> Category</a>


    
    <button class="nav-link nav-parent" data-bs-toggle="collapse" data-bs-target="#navProducts">
      <i class="bi bi-box-seam"></i> Products <i class="bi bi-chevron-down chev ms-auto"></i>
    </button>
    <div class="collapse" id="navProducts">
      <div class="sub-nav">
        <a href="{{ route('addproduct.page') }}" class="sub-link" data-page="Add product">Add new product</a>
        <a href="{{ route('product.list') }}" class="sub-link" data-page="All products">All products</a>
        <a href="{{ route('product.sofa') }}" class="sub-link" data-page="Sofas &amp; seating">Sofa</a>
        <a href="{{ route('product.table') }}" class="sub-link" data-page="Tables">Tables</a>
        <a href="{{ route('product.bed') }}" class="sub-link" data-page="Bedroom">Bed</a>
        <a href="{{ route('product.slider') }}" class="sub-link" data-page="Bedroom">Slider</a>
        
      </div>
    </div>



    <button class="nav-link nav-parent" data-bs-toggle="collapse" data-bs-target="#navOrders">
      <i class="bi bi-bag-check"></i> Orders <i class="bi bi-chevron-down chev ms-auto"></i>
    </button>
    <div class="collapse" id="navOrders">
      <div class="sub-nav">
        <a href="{{ route('allorder.page') }}" class="sub-link" data-page="All orders">All orders</a>
        <a href="{{ route('penging.order') }}" class="sub-link" data-page="Pending">Pending</a>
        <a href="{{ route('prossessing.order') }}" class="sub-link" data-page="Pending">Processing</a>
        <a href="{{ route('delivered.order') }}" class="sub-link" data-page="Delivered">Delivered</a>
        <a href="{{ route('cancelled.order') }}" class="sub-link" data-page="Cancelled">Cancelled &amp; returns</a>
      </div>
    </div>

        
    <a href="{{ route('show.message') }}" class="nav-link" >
    <i class="bi bi-chat"></i> Message
    <span class="badge bg-danger ms-1 p-2 rounded-full"></span>
</a>

    <a href="{{ route('create.link') }}" class="nav-link" >
    <i class="bi bi-link"></i> Link
  
</a>

    <a href="{{ route('add.logo.create') }}" class="nav-link" >
    <i class="bi bi-link"></i> Adds And Logo
  
</a>

    <div class="nav-section">Insights</div>
    <a href="#" class="nav-link" data-page="Customers"><i class="bi bi-people"></i> Customers</a>

    <button class="nav-link nav-parent" data-bs-toggle="collapse" data-bs-target="#navReports">
      <i class="bi bi-bar-chart-line"></i> Reports <i class="bi bi-chevron-down chev ms-auto"></i>
    </button>
    <div class="collapse" id="navReports">
      <div class="sub-nav">
        <a href="#" class="sub-link" data-page="Sales report">Sales report</a>
        <a href="#" class="sub-link" data-page="Inventory report">Inventory report</a>
        <a href="#" class="sub-link" data-page="Customer report">Customer report</a>
      </div>
    </div>

    <div class="nav-section">Account</div>
    <a href="#" class="nav-link" data-page="Settings"><i class="bi bi-gear"></i> Settings</a>
    <a href="#" class="nav-link" data-page="Logout"><i class="bi bi-box-arrow-right"></i> Log out</a>
  </nav>

  <div class="sidebar-foot">
    <i class="bi bi-lamp"></i> Crafted spaces, sold well.
  </div>
</aside>

<!-- Main -->
<div class="main-wrap">

  <!-- Topbar -->
  <div class="topbar">
    <button class="icon-btn d-lg-none" id="menuToggle"><i class="bi bi-list fs-5"></i></button>

    <div class="search-box">
      <i class="bi bi-search text-muted"></i>
      <input type="text" id="globalSearch" placeholder="Search orders, products, customers…">
    </div>

    <div class="ms-auto d-flex align-items-center gap-2">

      <!-- Notifications dropdown -->
      <div class="dropdown">
        <button class="icon-btn" data-bs-toggle="dropdown" aria-expanded="false">
          <i class="bi bi-bell"></i><span class="dot"></span>
        </button>
        <div class="dropdown-menu dropdown-menu-end notif-menu p-0">
          <div class="notif-head">
            <span class="fw-semibold small">Notifications</span>
            <a href="#" class="small">Mark all read</a>
          </div>
          <div class="notif-list">
            <a href="#" class="notif-item">
              <span class="notif-dot" style="background:var(--brick);"></span>
              <div>
                <div class="small fw-medium">Haven Bed Frame is low on stock</div>
                <div class="notif-time">12 minutes ago</div>
              </div>
            </a>
            <a href="#" class="notif-item">
              <span class="notif-dot" style="background:var(--forest);"></span>
              <div>
                <div class="small fw-medium">Order NX-48213 was delivered</div>
                <div class="notif-time">1 hour ago</div>
              </div>
            </a>
            <a href="#" class="notif-item">
              <span class="notif-dot" style="background:var(--brass);"></span>
              <div>
                <div class="small fw-medium">New customer: Sadia Islam signed up</div>
                <div class="notif-time">3 hours ago</div>
              </div>
            </a>
            <a href="#" class="notif-item">
              <span class="notif-dot" style="background:var(--muted);"></span>
              <div>
                <div class="small fw-medium">Monthly sales report is ready</div>
                <div class="notif-time">Yesterday</div>
              </div>
            </a>
          </div>
          <a href="#" class="notif-foot">View all notifications</a>
        </div>
      </div>

      <button class="icon-btn d-none d-sm-flex"><i class="bi bi-envelope"></i></button>
      <div class="vr d-none d-sm-block mx-1" style="height:28px;"></div>

      <!-- Profile dropdown -->
   
<div class="dropdown">
    <button class="profile-toggle" data-bs-toggle="dropdown" aria-expanded="false">

        <div class="avatar">
            {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
        </div>

        <div class="d-none d-md-block text-start">
            <div class="profile-name">
                {{ Auth::user()->name }}
            </div>

            <div class="profile-role">
                Store Admin
            </div>
        </div>

        <i class="bi bi-chevron-down d-none d-md-inline"
           style="font-size:.75rem;color:var(--muted);"></i>
    </button>

    <ul class="dropdown-menu dropdown-menu-end profile-menu">

        <li class="profile-menu-head">
            <div class="avatar" style="width:44px;height:44px;">
                {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
            </div>

            <div>
                <div class="fw-semibold small">
                    {{ Auth::user()->name }}
                </div>

                <div class="notif-time">
                    {{ Auth::user()->email }}
                </div>
            </div>
        </li>

        <li><hr class="dropdown-divider"></li>

        <li>
            <a class="dropdown-item"
               href="{{ route('admin.profile') }}"
             
            >
                <i class="bi bi-person"></i> My profile
            </a>
        </li>

        <li>
            <a class="dropdown-item"
               href="{{ route('settings') }}"
             
            >
                <i class="bi bi-gear"></i> Account settings
            </a>
        </li>

        <li>
            <a class="dropdown-item" href="#">
                <i class="bi bi-shop"></i> Switch showroom
            </a>
        </li>

        <li>
            <a class="dropdown-item" href="#">
                <i class="bi bi-question-circle"></i> Help &amp; support
            </a>
        </li>

        <li><hr class="dropdown-divider"></li>

  <li>
    <form action="{{ route('logout') }}" method="POST">
        @csrf

        <button type="submit"
                class="dropdown-item text-danger border-0 bg-transparent w-100 text-start">
            <i class="bi bi-box-arrow-right"></i>
            Log out
        </button>
    </form>
</li>

    </ul>
</div>


    </div>
  </div> @include('alart.message')

@yield('content')





  </div>

<div class="offcanvas-backdrop fade d-none" id="backdrop" style="z-index:1030;"></div>

<!-- Profile / Settings Modal -->
<div class="modal fade" id="profileModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content settings-modal" style="border-radius:16px;border:none;">
      <div class="modal-header" style="border-bottom:1px solid var(--line);">
        <h5 class="modal-title font-display" style="font-size:1.25rem;">Account settings</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body p-4">

        <ul class="nav settings-tabs" id="settingsTabs">
          <li class="nav-item"><button class="nav-link active" data-tab-target="tab-profile">Profile</button></li>
          <li class="nav-item"><button class="nav-link" data-tab-target="tab-security">Security</button></li>
          <li class="nav-item"><button class="nav-link" data-tab-target="tab-notifications">Notifications</button></li>
          <li class="nav-item"><button class="nav-link" data-tab-target="tab-store">Store</button></li>
        </ul>

        <!-- Profile tab -->
        <div class="settings-pane" id="tab-profile">
          <div class="d-flex align-items-center gap-3 mb-4">
            <div class="avatar-upload" id="avatarPreview">RA
              <span class="cam"><i class="bi bi-camera"></i></span>
            </div>
            <div>
              <div class="fw-semibold">Profile photo</div>
              <div class="text-muted small mb-2">PNG or JPG, at least 200×200px.</div>
              <button class="btn btn-sm" style="border:1px solid var(--line);border-radius:8px;">Upload new photo</button>
            </div>
          </div>

          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label">Full name</label>
              <input type="text" class="form-control" value="Rafi Ahmed" id="profNameInput">
            </div>
            <div class="col-md-6">
              <label class="form-label">Role</label>
              <select class="form-select">
                <option selected>Store Admin</option>
                <option>Sales Manager</option>
                <option>Inventory Manager</option>
                <option>Support Staff</option>
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label">Email address</label>
              <input type="email" class="form-control" value="rafi@nexxoomfurniture.com">
            </div>
            <div class="col-md-6">
              <label class="form-label">Phone number</label>
              <input type="tel" class="form-control" value="+880 1712-345678">
            </div>
            <div class="col-12">
              <label class="form-label">Bio</label>
              <textarea class="form-control" rows="3">Manages day-to-day operations for the Dhaka showroom and online storefront.</textarea>
            </div>
          </div>
        </div>

        <!-- Security tab -->
        <div class="settings-pane d-none" id="tab-security">
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label">Current password</label>
              <input type="password" class="form-control" placeholder="••••••••">
            </div>
            <div class="col-md-6"></div>
            <div class="col-md-6">
              <label class="form-label">New password</label>
              <input type="password" class="form-control" placeholder="At least 8 characters">
            </div>
            <div class="col-md-6">
              <label class="form-label">Confirm new password</label>
              <input type="password" class="form-control" placeholder="Re-enter new password">
            </div>
          </div>
          <hr class="my-4" style="border-color:var(--line);">
          <div class="toggle-row">
            <div>
              <div class="t-label">Two-factor authentication</div>
              <div class="t-sub">Add an extra layer of security on login</div>
            </div>
            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" role="switch" checked>
            </div>
          </div>
          <div class="toggle-row">
            <div>
              <div class="t-label">Login alerts</div>
              <div class="t-sub">Get notified about new device sign-ins</div>
            </div>
            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" role="switch" checked>
            </div>
          </div>
        </div>

        <!-- Notifications tab -->
        <div class="settings-pane d-none" id="tab-notifications">
          <div class="toggle-row">
            <div>
              <div class="t-label">Order updates</div>
              <div class="t-sub">New orders, cancellations and returns</div>
            </div>
            <div class="form-check form-switch"><input class="form-check-input" type="checkbox" role="switch" checked></div>
          </div>
          <div class="toggle-row">
            <div>
              <div class="t-label">Inventory alerts</div>
              <div class="t-sub">Low stock and reorder reminders</div>
            </div>
            <div class="form-check form-switch"><input class="form-check-input" type="checkbox" role="switch" checked></div>
          </div>
          <div class="toggle-row">
            <div>
              <div class="t-label">Customer messages</div>
              <div class="t-sub">Support tickets and enquiries</div>
            </div>
            <div class="form-check form-switch"><input class="form-check-input" type="checkbox" role="switch"></div>
          </div>
          <div class="toggle-row">
            <div>
              <div class="t-label">Weekly summary email</div>
              <div class="t-sub">Performance digest every Monday</div>
            </div>
            <div class="form-check form-switch"><input class="form-check-input" type="checkbox" role="switch" checked></div>
          </div>
        </div>

        <!-- Store tab -->
        <div class="settings-pane d-none" id="tab-store">
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label">Store name</label>
              <input type="text" class="form-control" value="NexXoom Furniture">
            </div>
            <div class="col-md-6">
              <label class="form-label">Currency</label>
              <select class="form-select">
                <option selected>BDT — ৳ Bangladeshi Taka</option>
                <option>USD — $ US Dollar</option>
                <option>INR — ₹ Indian Rupee</option>
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label">Time zone</label>
              <select class="form-select">
                <option selected>(GMT+6:00) Dhaka</option>
                <option>(GMT+5:30) Kolkata</option>
                <option>(GMT+0:00) London</option>
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label">Default showroom</label>
              <select class="form-select">
                <option selected>Gulshan, Dhaka</option>
                <option>Chattogram</option>
                <option>Sylhet</option>
              </select>
            </div>
          </div>
        </div>

      </div>
      <div class="modal-footer" style="border-top:1px solid var(--line);">
        <button type="button" class="btn" style="border:1px solid var(--line);border-radius:9px;" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn" id="saveProfileBtn" style="background:var(--wood-espresso);color:#fff;border-radius:9px;">Save changes</button>
      </div>
    </div>
  </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.4/chart.umd.min.js"></script>
<script src="{{ asset('js/dashboard_script.js') }}"></script>


</body>
</html>
