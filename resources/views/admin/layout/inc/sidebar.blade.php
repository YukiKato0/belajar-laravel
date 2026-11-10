<div class="sidebar-wrapper" id="sidebar">
    <!-- Brand Logo / Identity -->
    <a href="index.html" class="sidebar-brand">
      <i class="bi bi-asterisk"></i>
      <span>Spark Admin</span>
    </a>

    <!-- Navigation Menu -->
    <div class="grow overflow-y-auto">
      <div class="sidebar-menu-section">
        <div class="sidebar-menu-title">Menu</div>
        <ul class="sidebar-menu-list">
          <li class="sidebar-menu-item">
            <a href="{{ route('admin.dashboard.index') }}" class="sidebar-menu-link {{ request()->routeIs('admin.dashboard.*') ? 'active' : '' }}" id="menu-dashboard" title="Dashboard">
              <i class="bi bi-grid-fill"></i>
              <span>Dashboard</span>
            </a>
          </li>
          <li class="sidebar-menu-item">
            <a href="{{ route('admin.category.index') }}" class="sidebar-menu-link {{ request()->routeIs('admin.category.*') ? 'active' : '' }}" id="menu-category" title="Category">
              <i class="bi bi-tags"></i>
              <span>Category</span>
            </a>
          </li>
          <li class="sidebar-menu-item">
            <a href="{{ route('admin.product.index') }}" class="sidebar-menu-link {{ request()->routeIs('admin.product.*') ? 'active' : '' }}" id="menu-product" title="Product">
              <i class="bi bi-box-seam"></i>
              <span>Product</span>
            </a>
          </li>
          <li class="sidebar-menu-item">
            <a href="{{ route('admin.user.index') }}" class="sidebar-menu-link {{ request()->routeIs('admin.user.*') ? 'active' : '' }}" id="menu-user" title="User">
              <i class="bi bi-person"></i>
              <span>User</span>
            </a>
          </li>
          <li class="sidebar-menu-item">
            <a href="{{ route('admin.settings') }}" class="sidebar-menu-link {{ request()->routeIs('admin.settings*') ? 'active' : '' }}" id="menu-setting" title="Setting">
              <i class="bi bi-gear"></i>
              <span>Setting</span>
            </a>
          </li>
        </ul>
      </div>
    </div>

    <!-- Sidebar Profile Card (Dynamic Footer) -->
    <div class="sidebar-profile">
      <img src="{{ asset("assets/images/avatar.png") }}" alt="Administrator" class="sidebar-profile-img"
        onerror="this.src='https://images.unsplash.com/photo-1534528741775-53994a69daeb?q=80&w=256&auto=format&fit=crop'">
      <div class="sidebar-profile-info">
        <div class="sidebar-profile-name">Administrator</div>
        <div class="sidebar-profile-email">admin@email.com</div>
      </div>
    </div>
  </div>