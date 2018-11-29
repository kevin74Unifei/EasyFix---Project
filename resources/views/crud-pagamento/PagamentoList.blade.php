
@extends('../templates/template_base')

@section('tools-icon')
@endsection
@section('menu')
@endsection

@section('Base')

<?php
date_default_timezone_set('America/Araguaina');

if (isset($_GET['ym'])) {
    $ym = $_GET['ym'];
} else {
    $ym = date('Y-m');
}
$timestamp = strtotime($ym, "-01");

if ($timestamp === false) {
    $timestamp = time();
}

$today = date('Y-m-d', time());

$html_title = date('m/Y', $timestamp);

$prev = date('Y-m', mktime(0, 0, 0, date('m', $timestamp) - 1, 1, date('Y', $timestamp)));
$next = date('Y-m', mktime(0, 0, 0, date('m', $timestamp) + 1, 1, date('Y', $timestamp)));

$day_count = date('t', $timestamp);

$str = date('w', mktime(0, 0, 0, date('m', $timestamp), 1, date('Y', $timestamp)));

$week = '';
$week .= str_repeat('<td></td>', $str);

for ($day = 1; $day <= $day_count; $day ++, $str++) {
    $date = $ym . '-' . $day;
    $info = '';
    foreach($ent as $key => $item){
        $dataI = $item['ent_data_inicial'];
        $dateI = date('Y-m-d');
        $dataF = $item['ent_data_final'];
        $dateF = date('Y-m-d');
        if($date == $dateI || $date == $dataF){
            $info .= '<a href="/EasyFix---Project/servico/form/'.$item['ent_cod'].'"> Código: '.$item['ent_cod']. '</a><br>';
        }
    }
    if ($today == $date) {
        $week .= '<td class="today">' . $day . '<br>' . $info;
    } else {
        $week .= '<td>' . $day . '<br>' . $info;
    } $week .= '</td>';

    if ($str % 7 == 6 || $day == $day_count) {
        if ($day == $day_count) {
            $week .= str_repeat('<td></td>', 6 - ($str % 7));
        }

        $weeks[] = '<tr>' . $week . '</tr>';
        $week = '';
    }
}
?>


<style>

    .pagina{position: absolute;
            top:100px;
            left:15%;        
            width:1050en;
            background-color: whitesmoke;
            padding: 4%;
            padding-bottom:100px;
    }

    .info_pessoal{position:relative;
                  float:right;
    }
    .img_perfil{
        padding-left: 4%;
        float:left;
    }

    .form-group{
        padding-left: 11px;
        padding-top: 10px;
    }     

    .buttons{position: relative;  
             top:30px;
             left:10px;
    }

    th{
        height: 3em;
        text-align: center;
        font-weight: 700;
    }

    td{
        height: 10em;
    }

    .today{
        background-color: orange;
    }

    th:nth-of-type(7), td:nth-of-type(7){
        color: blue;
    }
    th:nth-of-type(1), td:nth-of-type(1){
        color: red;
    }

    h3{
        text-align: center;
    }
    
    h1{
        text-align: center;
    }

</style>

<div class="pagina">
    <h1>Calendário</h1>
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <h3>
                    <a href="?ym={{$prev}}">&lt;</a> 
                    {{$html_title}}
                    <a href="?ym={{$next}}">&gt;</a></h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Domingo</th>
                            <th scope="col">Segunda</th>
                            <th scope="col">Terça</th>
                            <th scope="col">Quarta</th>
                            <th scope="col">Quinta</th>
                            <th scope="col">Sexta</th>
                            <th scope="col">Sabado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($weeks as $week)
                        <?php echo $week; ?>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection