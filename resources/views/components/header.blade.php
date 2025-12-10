
  <header class="main-header">
    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>LT</span>
      <!-- logo for regular state and mobile devices -->
      <span class="" style="font-size: 12px">Galseko - Admin</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              @if (Auth::user()->role === 'santri')
              <img src="{{ Auth::user()->santri->foto ? '/storage/santri/' . Auth::user()->santri->foto : url('dist/img/user2-160x160.jpg') }}" class="user-image" alt="User Image">
              @else
                @if (Auth::user()->foto)
                  <img src="{{ asset('storage/users/' . Auth::user()->foto) }}" 
                      class="user-image">
                @else
                  <img src="{{ url('dist/img/user2-160x160.jpg') }}" class="user-image" alt="User Image">
                @endif
              @endif
              <span class="hidden-xs">{{ Auth::user()->name }}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
              @if (Auth::user()->role === 'santri')
              <img src="{{ Auth::user()->santri->foto ? '/storage/santri/' . Auth::user()->santri->foto : url('dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
              @else
                @if (Auth::user()->foto)
                  <img src="{{ asset('storage/users/' . Auth::user()->foto) }}" 
                      class="img-circle">
                @else
                  <img src="{{ url('dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
                @endif
              @endif

                <p>
                  {{ Auth::user()->name }}
                  <small>Role {{ Auth::user()->role }}</small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="/pengaturan" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-default btn-flat">Logout</button>
                  </form>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>