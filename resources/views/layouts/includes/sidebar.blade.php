 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('home') }}" class="brand-link">
      <img src="/assets/img/duet_logo.jpg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">DUET</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">      

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
                <a href="{{ route('departments.index') }}" class="nav-link">
                    <i class="fas fa-building"></i>
                    <p>Departments</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('batches.index') }}" class="nav-link">
                    <i class="fas fa-users"></i>
                    <p>Batches</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('semesters.index') }}" class="nav-link">
                    <i class="fas fa-book-open"></i>
                    <p>Semester</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('subjects.index') }}" class="nav-link">
                    <i class="fas fa-book"></i>
                    <p>Subjects</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('teachers.index') }}" class="nav-link">
                    <i class="fas fa-chalkboard-teacher"></i>
                    <p>Teachers</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('students.index') }}" class="nav-link">
                    <i class="fas fa-graduation-cap"></i>
                    <p>Students</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('time-table.index') }}" class="nav-link">
                    <i class="fas fa-table"></i>
                    <p>Timetable</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('attendance-sheet.view') }}" class="nav-link">
                    <i class="fas fa-file"></i>
                    <p>Attendence Sheets</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('attendance.index') }}" class="nav-link">
                    <i class="fas fa-file"></i>
                    <p>Attendence</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('import.index') }}" class="nav-link">
                <i class="fa fa-solid fa-file-import"></i>
                    <p>Import</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('export.index') }}" class="nav-link">
                <i class="fa fa-solid fa-file-export"></i>
                    <p>Export</p>
                </a>
            </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>