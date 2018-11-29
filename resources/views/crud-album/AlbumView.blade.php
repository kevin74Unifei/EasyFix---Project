
@extends('../templates/template_base')

@section('tools-icon')
@endsection
@section('menu')
@endsection

@section('Base')
    <style>
        .pagina{position: absolute;
            top:80px;
            left:350px;
            width:1050en;
            background-color: whitesmoke;
            padding: 4%;
            padding-top:20px;
            padding-bottom:100px;
        }

        .img_view{
            height: 500px;
            width: 500px;
        }

    </style>

    <div class="pagina">

<div class="row">
    <div class="col-md-6">
        <img src="" class="img_view">
    </div>

</div>

    </div>
@endsection
