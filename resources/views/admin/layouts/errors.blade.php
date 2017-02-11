
@if(count($errors))

 <div class="col-sm-12 col-md-12">
      <div class="alert-message alert-message-danger ">
              <h4>Alert Message Danger</h4>
              <ul>
            @foreach($errors->all() as $error)
            <li>
                <p><strong>{{$error}}</strong>.</p>
             </li>
           @endforeach
           </ul>
       </div>
   </div>
   @endif