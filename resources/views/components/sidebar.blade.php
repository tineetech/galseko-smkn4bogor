 <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      {{-- menu admin  --}}
      {{-- @if (Auth::user()->role === "admin") --}}
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
          <a href="{{ route('dashboard') }}">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>

        <li class="{{ request()->routeIs('galery.*') ? 'active' : '' }}">
          <a href="{{ route('galery.index') }}">
            <i class="fa fa-image"></i> <span>Kelola Galery</span>
          </a>
        </li>

        <li class="{{ request()->routeIs('verifikasi-galery.*') ? 'active' : '' }}">
          <a href="{{ route('verifikasi-galery.index') }}">
            <i class="fa fa-picture-o"></i> <span>Verifikasi Galery</span>
          </a>
        </li>

        <li class="{{ request()->routeIs('pengaturan.*') ? 'active' : '' }}">
          <a href="{{ route('pengaturan.index') }}">
            <i class="fa fa-cog"></i> <span>Pengaturan</span>
          </a>
        </li>

      </ul>
      {{-- @endif --}}
    </section>
    <!-- /.sidebar -->
  </aside>