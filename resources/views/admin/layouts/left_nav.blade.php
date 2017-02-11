          <ul class="nav navbar-nav">
            @if(auth()->check())
          <li class="active"><a href="{{route('home')}}">Home</a></li>
          @can('manage_all')
          <li><a href="{{route('users.index')}}">Users</a></li>
          <li><a href="{{route('roles.index')}}">Roles</a></li>
          <li><a href="{{route('permissions.index')}}">Permissions</a></li>
          @endcan
          @can('manage_users')
           <li><a href="{{route('users.index')}}">Users</a></li>
          @endcan
          @endif
        </ul>