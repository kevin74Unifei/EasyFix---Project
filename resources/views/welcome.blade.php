    <!DOCTYPE html>
    <html lang="pt-br">
    <head>
    	<meta charset="utf-8"/>
    	<meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
    	<title>{{$title or "EasyFix"}}</title>
        
        <link href="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/build/css/bootstrap-datetimepicker.css" rel="stylesheet">
        <script type="text/javascript" src="//code.jquery.com/jquery-2.1.1.min.js"></script>
	<script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
	<script src="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/src/js/bootstrap-datetimepicker.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
        
        
       <!-- <link rel="stylesheet" href="{{url('bootstrap/css/bootstrap.css')}}"  crossorigin="anonymous">-->
        <link rel="stylesheet" href="{{url('bootstrap/css/bootstrap.min.css')}}"  crossorigin="anonymous">
        <script src="{{url('bootstrap/js/bootstrap.min.js')}}"></script>
        <script src="{{url('bootstrap/js/bootstrap.js')}}"></script>

        
        <style>
            body{                
                padding: 0px;
                margin:0px; 
                background-color:#bbbbd6; 
            }
            .navbar-per1{
                font-family: Serif;
                font-size: 30px;
                padding-top:10px;
                padding-left:25%;
                color:whitesmoke;
            }            
         </style>
	
    </head>
    <body>
    <div style="top:200px;"> 
        @include('../templates/components/DialogConfirm');
    </div>
    <body>




