<nav class="sidebar">
  <div class="sidebar-header">
    <a href="#" class="sidebar-brand" style="padding-left:50px;">
      <img src="{{asset('assets/images/others/qadsia.png')}}" style="width:55px;height:55px;" alt="user.png">
    </a>

    <div class="sidebar-toggler not-active">
      <span></span>
      <span></span>
      <span></span>
    </div>
  </div>
  <div class="sidebar-body">

    <ul class="nav">

      <li class="nav-item {{ active_class(['dashboard.index']) }}">
        <a href="{{ url('dashboard') }}" class="nav-link mb-2">
          <span class="bg-white rounded-circle text-center" style="width:30px;height:30px;">
            <i class="fas fa-home" style="width:14px;height:14px; margin-top:8px;"></i>
          </span>
          <span class="link-title menuDashboard">{{__('sidebar.dashboard')}}</span>
        </a>
      </li>

      @can('view user')
      <li class="nav-item {{ active_class(['users.index', 'users.create', 'users.edit']) }}">
        <a href="{{ route('users.index') }}" class="nav-link mb-2">
          <span class="bg-white rounded-circle text-center" style="width:30px;height:30px;">
            <i class="fas fa-user" style="width:17px;height:17px; margin-top:8px;"></i>
          </span>
          <span class="link-title menuUsers">{{__('sidebar.Users')}}</span>
        </a>
      </li>
      @endcan

      @can('view class')
      <li class="nav-item {{ active_class(['classes.index','classes.view', 'classes.create', 'classes.edit']) }}">
        <a href="{{route('classes.index') }}" class="nav-link mb-2">
          <span class="bg-white rounded-circle text-center" style="width:30px;height:30px;">
            <i class="fas fa-users" style="width:17px;height:17px;margin-top:8px;"></i>
          </span>
          <span class="link-title menuClasses">{{__('sidebar.Classes')}}</span>
        </a>
      </li>
      @endcan

      @can('view level')
      <li class="nav-item {{ active_class(['levels.index', 'levels.create', 'levels.edit']) }}">
        <a href="{{route('levels.index') }}" class="nav-link mb-2">
          <span class="bg-white rounded-circle text-center" style="width:30px;height:30px;">
            <i class="fa-solid fa-layer-group" style="width:17px;height:17px;margin-top:8px;"></i>
          </span>
          <span class="link-title menuLevels">{{__('sidebar.Levels')}}</span>
        </a>
      </li>
      @endcan

      @can('view instructor')
      <li class="nav-item {{ active_class(['instructors.index', 'instructors.create', 'instructors.edit']) }}">
        <a href="{{route('instructors.index') }}" class="nav-link mb-2">
          <span class="bg-white rounded-circle text-center" style="width:30px;height:30px;">
            <i class="fas fa-chalkboard-teacher" style="width:17px;height:17px;margin-top:8px;"></i>
          </span>
          <span class="link-title menuInstructors">{{__('sidebar.Instructors')}}</span>
        </a>
      </li>
      @endcan

      @can('view student')
      <li class="nav-item {{ active_class(['students.index','students.renew', 'students.create', 'students.edit','students.view','students.id-card-generation']) }}">
        <a href="{{route('students.index') }}" class="nav-link mb-2">
          <span class="bg-white rounded-circle text-center" style="width:30px;height:30px;">
            <i class="fas fa-user-graduate" style="width:17px;height:17px;margin-top:6px;"></i>
          </span>
          <span class="link-title menuStudents">{{__('sidebar.Students')}}</span>
        </a>
      </li>
      @endcan

      @can('view student')
      <li class="nav-item {{ active_class(['students.testStudent']) }}">
        <a href="{{route('students.testStudent') }}" class="nav-link mb-2">
          <span class="bg-white rounded-circle text-center" style="width:30px;height:30px;">
            <i class="fas fa-vial" style="width:17px;height:17px;margin-top:6px;"></i>
          </span>
          <span class="link-title menuStudents">{{__('sidebar.StudentTest')}}</span>
        </a>
      </li>
      @endcan

      @can('mark_attendance')
      <li class="nav-item {{ active_class(['mark_attendance']) }}">
        <a href="{{url('/mark_attendance') }}" class="nav-link mb-2">
          <span class="bg-white rounded-circle text-center" style="width:30px;height:30px;">
            <i class="fas fa-check-circle" style="width:20px;height:20px;margin-top:8px;"></i>
          </span>
          <span class="link-title menuMarkAttendance">{{__('sidebar.MarkAttendance')}}</span>
        </a>
      </li>
      @endcan

      @can('view attendance')
      <li class="nav-item {{ active_class(['attendence.studentDetails','attendence.allStudents','attendence.index', 'attendence.create','attendence.attendenceDetails']) }}">
        <a href="{{route('attendence.studentDetails') }}" class="nav-link mb-2">
          <span class="bg-white rounded-circle text-center" style="width:30px;height:30px;">
            <i class="fas fa-calendar-check" style="width:17px;height:17px;margin-top:6px;"></i>
          </span>
          <span class="link-title menuAttendance">{{__('sidebar.Attendance')}}</span>
        </a>
      </li>
      @endcan

      @can('view role')
      <li class="nav-item {{ active_class(['roles.index','roles.create','roles.edit']) }}">
        <a href="{{route('roles.index') }}" class="nav-link mb-2">
          <span class="bg-white rounded-circle text-center" style="width:30px;height:30px;">
            <i class="fas fa-cogs" style="width:17px;height:17px;margin-top:6px;"></i>
          </span>
          <span class="link-title menuRoles">{{__('sidebar.roles')}}</span>
        </a>
      </li>
      @endcan

      <li class="nav-item">
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: inline;">
          @csrf
          <button type="submit" class="nav-link mb-2" style="border: none; background: none; padding: 0; cursor: pointer;">
            <span class="bg-white rounded-circle text-center" style="width:30px;height:30px;">
              <i class="fas fa-sign-out-alt" style="width:14px;height:14px;margin-top:8px;"></i>
            </span>
            <span class="link-title menuLogout">{{__('sidebar.Logout')}}</span>
          </button>
        </form>
      </li>
      <li class="nav-item ">
        <a href="#" id="language-toggle-btn" class=" btn text-center" style="width:200px;">

        </a>
      </li>

    </ul>
  </div>
</nav>