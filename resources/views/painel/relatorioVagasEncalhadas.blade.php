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
        width:760px;
        background-color: whitesmoke;
        padding: 4%;
        padding-top:20px;
        padding-bottom:200px;
    }
 
    </style>
    

    <script src="{{url('highcharts/code/highcharts.js')}}"></script>
    <script src="{{url('highcharts/code/modules/data.js')}}"></script>
    <script src="{{url('highcharts/code/modules/drilldown.js')}}"></script>
    <div class='pagina'>
        <h1>Relatório</h1>
        <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
        <table class="table"> 
            <thead>
                <tr><th colspan="3"><h4 id="table_title">Informações das Vagas paradas há 3 meses</h4></th></tr>
                <tr><th>Nome Vaga</th><th>Empresa</th><th>Data Emissão da vaga</th></tr>
            </thead>                
            <tbody>
                @foreach($vaga3m as $vaga)
                <tr class="celula_3m">
                    <td>{{$vaga['vag_nome']}}</td>
                    <td>{{$vaga['vag_nomeEmpresa']}}</td>
                    <td>{{$vaga['created_at']}}</td>
                </tr>
                @endforeach
                @foreach($vaga6m as $vaga)
                <tr class="celula_6m" style="display:none;" >
                    <td>{{$vaga['vag_nome']}}</td>
                    <td>{{$vaga['vag_nomeEmpresa']}}</td>
                    <td>{{$vaga['created_at']}}</td>
                </tr>
                @endforeach
                @foreach($vaga1a as $vaga)
                <tr class="celula_1a" style="display:none;">
                    <td>{{$vaga['vag_nome']}}</td>
                    <td>{{$vaga['vag_nomeEmpresa']}}</td>
                    <td>{{$vaga['created_at']}}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr><th colspan='3'></th></tr>
            </tfoot>
        </table>
    <script type="text/javascript">
    
    function parseVisibleTR(cod){//função de controle de exibição da tabela
        if(cod==0){
            $('#table_title').text('Informações das Vagas paradas há 1 Ano');
            $('.celula_1a').css('display','table-row');
            $('.celula_3m').css('display','none');
            $('.celula_6m').css('display','none');
        }else if(cod==1){
            $('#table_title').text('Informações das Vagas paradas há 6 Meses');
            $('.celula_1a').css('display','none');
            $('.celula_6m').css('display','table-row');
            $('.celula_3m').css('display','none');
        }else if(cod==2){
            $('#table_title').text('Informações das Vagas paradas há 3 Meses');
            $('.celula_1a').css('display','none');
            $('.celula_6m').css('display','none');
            $('.celula_3m').css('display','table-row');
        }
    }

    // Create the chart
    Highcharts.chart('container', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Vagas que não foram ocupadas.'
        },
        subtitle: {
            text: 'Numeros de vagas que permaacem sem preechimento por falta de mão de obra.'
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            title: {
                text: 'Numero de Vagas'
            }

        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                borderWidth: 0,
                dataLabels: {
                    enabled: true,
                    format: '{point.y:.1f}'
                },
            point: {
                    events: {
                        click: function () {
                            parseVisibleTR(this.category) ;
                        }
                    }
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
        },

        series: [{
            name: 'Brands',
            colorByPoint: true,
            data: [{
                name: '1 Ano',
                y: {{count($vaga1a)}},
                click:function(e){
                    parseVisibleTR(1);
                }
            }, {
                name: '6 meses',
                y: {{count($vaga6m)}},
            }, {
                name: '3 meses',
                y: {{count($vaga3m)}},
            }]
        }],
    });

        </script>
    </div>
        
    
@endsection