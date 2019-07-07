<html lang="en">
<head>
  <title>Laravel Multiple File Upload Example</title>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
</head>
<body>
   

  <div class="container">
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There is an error with yout file upload <br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if (session('success'))
        <div class="alert alert-success">
            {{session('success')}}
        </div>
    @endif
    <h3 class="jumbotron">Laravel Multiple File Upload</h3>
<form method="POST" action="{{route('form.store')}}" enctype="multipart/form-data">
  {{csrf_field()}}

    <div class="input-group control-group increment" >
        <input type="file" name="filename[]" class="form-control">
        <div class="input-group-btn"> 
          <button class="btn btn-success" type="button"><i class="glyphicon glyphicon-plus"></i>Add</button>
        </div>
    </div>
      <div class="clone">
        <div class="control-group input-group" style="margin-top:10px">
          <input type="file" name="filename[]" class="form-control">
          <div class="input-group-btn"> 
            <button class="btn btn-danger" type="button"><i class="glyphicon glyphicon-plus"></i> Remove</button>
          </div>
        </div>
      </div>
      <div class="clone2">
        <div class="control-group input-group" style="margin-top:10px">
          <input type="file" name="filename[]" class="form-control">
          <div class="input-group-btn"> 
            <button class="btn btn-danger" type="button"><i class="glyphicon glyphicon-plus"></i> Remove</button>
          </div>
        </div>
      </div>

        <button type="submit" class="btn btn-primary" style="margin-top:10px">Submit</button>

  </form>        
  </div>


<script type="text/javascript">

    $(document).ready(function() {

      $(".btn-success").click(function(){ 
          var html = $(".clone").html();
          $(".increment").after(html);
          var html = $('clone2').html();
          $(".increament").after(html);
      });

      $("body").on("click",".btn-danger",function(){ 
          $(this).parents(".control-group").remove();
      });

    });

</script>


</body>
</html>