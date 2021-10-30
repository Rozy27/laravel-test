<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
  <div class="position-sticky pt-3">
    <ul class="nav flex-column">
      <li class="nav-item">
        <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }} " href="/dashboard">
          <i class="fa fa-home"></i>
          Dashboard
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ Request::is('dashboard/orders*') ? 'active' : '' }}" href="/dashboard/orders">
          <i class="fa fa-circle-o"></i>
          Penjualan
        </a>
      </li>
    </ul>

    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
      <i>Menu Utama</i>
    </h6>
    <ul class="nav flex-column">
    <li class="nav-item">
        <a class="nav-link {{ Request::is('dashboard/pajak*') ? 'active' : '' }}" href="/dashboard/pajak">
          <i class="fa fa-circle-o"></i>
          Pajak
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ Request::is('dashboard/kategori*') ? 'active' : '' }}" href="/dashboard/kategori">
          <i class="fa fa-circle-o"></i>
          Kategori
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ Request::is('dashboard/item*') ? 'active' : '' }}" href="/dashboard/item">
          <i class="fa fa-circle-o"></i>
          Item
        </a>
      </li>
    </ul>

    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
      <i>Laporan</i>
    </h6>
    <ul class="nav flex-column mb-2">
      <li class="nav-item">
        <a class="nav-link {{ Request::is('dashboard/reportsales*') ? 'active' : '' }}" href="/dashboard/reportsales">
          <i class="fa fa-circle-o"></i>
          Penjualan
        </a>
      </li>
    </ul>
  </div>
</nav>