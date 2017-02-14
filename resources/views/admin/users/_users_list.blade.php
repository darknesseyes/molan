    @if(count($users))
        <table class="table table-striped">
           <thead>

           <tr>
              <th>Name</th>
              <th>Email</th>
              <th>Role</th>
              <th>Show</th>
              <th>Edit</th>
              <th>Delete</th>
              <th>Login</th>
              <th>Status</th>
          </tr>
       
    </thead>
    <tbody>
      @foreach($users as $user)
      <tr @if($user->active == 0)
            class="alert alert-danger"
            @endif
            @if($user->active == 1)
            class="alert alert-success"
            @endif
            >
        <td>{{$user->name}}</td>
        <td>{{$user->email}}</td>
         <td>
           @if(count($user->roles)==0)
           <i class="glyphicon glyphicon-warning-sign alert alert-warning"></i>
           @endif
           @if(count($user->roles) >0)
           @foreach($user->roles as $role)
           {{$role->name}}
           @endforeach
           @endif

         </td>
        <!-- show button -->
        <td><a href="#" class="btn btn-info">
        	<span class="glyphicon glyphicon-exclamation-sign"></span>
        </a></td>
       <!-- end of show button -->
        <!-- Edit button -->
        <td>
        <a href="{{route('users.edit',$user->id)}}" class="btn btn-warning">
        	<span class="glyphicon glyphicon-edit"></span>
        </a>
        </td>
       <!-- end of Edit button -->
        <!-- Delete button -->
        <td>
          <form method="post" action="{{route('users.destroy',$user->id)}}">
          {{ method_field('DELETE') }}
          {{csrf_field()}}
          <button class="btn btn-danger">D</button> 
          </form>       
       <td>
       <!-- end of Delete button --> 
       <!-- login button -->
       <a href="{{route('user.login',$user->id)}}"><i class="glyphicon glyphicon-log-in" ></i></a>
       <!-- end of login --> 
       <!-- status -->
       <td>
       @if(count($user->roles)> 0)
         <form method="post" action="{{route('users.toggleActive',$user->id)}}">
          {{csrf_field()}}
         <button 

         @if($user->active == 0) class="btn btn-danger" @endif
         @if($user->active == 1) class="btn btn-success" @endif>

         @if($user->active == 0)
          Activate
         @endif
         @if($user->active == 1)
          Deactivate
         @endif
         </button>
         </form>
         @endif
          @if(count($user->roles)== 0)
          <a href="{{route('users.edit',$user->id)}}" class="btn btn-warning">
        assign Role First
        </a>
         @endif
       </td>

       <!-- end of status -->
       </tr>
          @endforeach
    @endif
    </tbody>
  </table>