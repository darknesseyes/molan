    @if(count($roles))
        <table class="table table-striped">
           <thead>

           <tr>
              <th>Role</th>
              <th>Label</th>
              <th>Show</th>
              <th>Edit</th>
              <th>Delete</th>
          </tr>
       
    </thead>
    <tbody>
      @foreach($roles as $role)
      <tr>
        <td>{{$role->name}}</td>
        <td>{{$role->label}}</td>
        <!-- show button -->
        <td><a href="{{route('roles.show',$role->id)}}" class="btn btn-info">
        	<span class="glyphicon glyphicon-exclamation-sign"></span>
        </a></td>
       <!-- end of show button -->
        <!-- Edit button -->
        <td><a href="{{route('roles.edit',$role->id)}}" class="btn btn-warning">
        	<span class="glyphicon glyphicon-edit"></span>
        </a></td>
       <!-- end of Edit button -->
        <!-- Delete button -->
        <td>
          <form method="post" action="{{route('roles.destroy',$role->id)}}">
          {{ method_field('DELETE') }}
          {{csrf_field()}}
          <button class="btn btn-danger">D</button> 
          </form>       
       <td>
       <!-- end of Delete button -->  
       </tr>
          @endforeach
    @endif
    </tbody>
  </table>