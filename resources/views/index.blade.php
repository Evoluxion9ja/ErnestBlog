<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.5.2/css/fileinput.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
   
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{Html::style('css/style')}}
    @include('partials._head')
    <title>Document</title>
</head>
<body class="bg-info">
        <div class="container-fluid"> 
            <div class="col-lg-12 col-sm-12 col-l1 main-section">
                <h1> Upload Image </h1> 
                <form>
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="form-control">
                    <input type="file" id="file-1" name="file" multiple="" data-overwrite-initial="false" data-min-file-count="2">
                    </div>
                </form>
            </div>
        </div>
              
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.5.2/js/fileinput.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/themes/fa/theme.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
        

        <script type="text/javascript">
            $('#file-1').fileinput({
             theme:'fa',
             uploadUrl:"{{url('image-submit')}}",
             uploadExtraData:function(){
              return{
               _token:$("input[name='_token']").val()
              };
             },
             allowedFileExtensions:['jpg','png','gif'],
             overwriteInitial:false,
             maxFileSize:2000,
             maxFileNum:8,
             slugCallback:function(filename){
              return filename.replace('(','_').replace(']','_');
             }
            });
           </script>
           
</body>
</html>