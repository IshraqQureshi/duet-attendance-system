<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    

    
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="fas fa-sign-out-alt"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
          <a href="{{ route('logout') }}" class="dropdown-item">
           Logout
          </a>          
        </div>
      </li>
      
    </ul>
  </nav>
  <!-- /.navbar -->