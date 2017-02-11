    @if(count($permissions))
        <table class="table table-striped">
           <thead>

           <tr>
              <th>Permission</th>
              <th>Label</th>
              <th>Show</th>
              <th>Edit</th>
              <th>Delete</th>
          </tr>
       
    </thead>
    <tbody>
      @foreach($permissions as $permission)
      <tr>
        <td>{{$permission->name}}</td>
        <td>{{$permission->label}}</td>
        <!-- show button -->
        <td><a href="#" class="btn btn-info">
            <span class="glyphicon glyphicon-exclamation-sign"></span>
        </a></td>
       <!-- end of show button -->
        <!-- Edit button -->
        <td><a href="{{route('permissions.edit',$permission->id)}}" class="btn btn-warning">
            <span class="glyphicon glyphicon-edit"></span>
        </a></td>
       <!-- end of Edit button -->
        <!-- Delete button -->
        <td>
          <form method="post" action="{{route('permissions.destroy',$permission->id)}}">
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