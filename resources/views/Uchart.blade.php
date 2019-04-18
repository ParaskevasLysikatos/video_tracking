<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>

    @include('/scripts')
    <title>User on video charts</title>
    <style>
        .grid-container {
            display: grid;
            grid-gap: 10px;
            padding: 10px;
        }

    </style>
</head>
<body>
@include('/navbar')
<div class="grid-container"style=" margin-top: 1%;">
    <center> <h1 style="font-size: 30px; " >User charts: {{ $username}} on video: {{$video}} </h1></center>
</div>

<div id="1" style="height: 70%; width:100%; margin-left: 1%; "><?=  Lava::render('ColumnChart', 'Events','1') ?></div>
<br>
<div id="2" style="height: 70%; width:100%; margin-left: 1%;"><?=  Lava::render('ScatterChart', 'Progress of '.$username.' on Played Seconds','2') ?></div>
<br>
<script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
<br>
<h4 style="alignment: center; margin-left: 200px; ">Heatmap with bar, x->seconds, y->user_name, z->times</h4>
<div id="myDiv1" style="  margin-left: 3%; "><!-- Plotly chart will be drawn inside this DIV --></div>
<script>
    <!-- JAVASCRIPT CODE GOES HERE -->
    var xValues = [@foreach($playedsecA as $s){{$s->video_current_timeStart}},@endforeach];

    var yValues = ['User->{{$username}}'];

    var zValues = [
        [@foreach($playedsecA as $s){{$s->count}},@endforeach]
    ];

    var colorscaleValue = [
        [0, '#ffffff'],
        [1, '#0fffff'],
        [2, '#1111ff'],
        [3, '#06666f'],
        [4, '#000000'],
        [5, '#000000'],
        [6, '#000000']
    ];

    var data = [{
        x: xValues,
        y: yValues,
        z: zValues,
        type: 'heatmap',
        colorscale: colorscaleValue,
        showscale: true
    }];

    var layout = {
        title: 'Annotated Heatmap, x->seconds, z->times',
        annotations: [],
        height:300,
        width:2200,

        xaxis: {
            range:[0,{{$videoRange}}],
            ticks: "inside",
            side: 'top',
            autosize: false
        },
        yaxis: {
            ticks: '',
            ticksuffix: ' ',
            autosize: false
        }
    };

    for ( var i = 0; i < yValues.length; i++ ) {
        for ( var j = 0; j < xValues.length; j++ ) {
            var currentValue = zValues[i][j];
            if (currentValue != 0) {
                var textColor = 'black';
            }else{
                var textColor = 'white';
            }
            var result = {
                xref: 'x',
                yref: 'y',
                x: xValues[j],
                y: yValues[i],
                text: zValues[i][j],
                font: {
                    family: 'Times New Roman',
                    size: 14,
                    width:20,
                    height:20,
                    opacity:2,
                    visible:true,
                    borderwidth:8,
                    borderpad:4,
                    align:"center",
                    valign:"middle",
                    color: textColor
                },
                showarrow: false,
            };
            layout.annotations.push(result);
        }

    }

    Plotly.newPlot('myDiv1', data, layout,{showSendToCloud: true});
</script>

<br>

<h4 style="alignment: center; margin-left: 200px; ">Heatmap with bar, x->progress, y->user_name, z->times</h4>
<div id="myDiv2" style="  margin-left: 3%; "><!-- Plotly chart will be drawn inside this DIV --></div>
<script>
    <!-- JAVASCRIPT CODE GOES HERE -->
    var xValues = [@foreach($playedsecA1 as $s){{$s->video_progress}},@endforeach];

    var yValues = ['User->{{$username}}'];

    var zValues = [
        [@foreach($playedsecA1 as $s){{$s->count}},@endforeach]
    ];

    var colorscaleValue = [
        [0, '#ffffff'],
        [1, '#0fffff'],
        [2, '#1111ff'],
        [3, '#06666f'],
        [4, '#000000'],
        [5, '#000000'],
        [6, '#000000']
    ];

    var data = [{
        x: xValues,
        y: yValues,
        z: zValues,
        type: 'heatmap',
        colorscale: colorscaleValue,
        showscale: true
    }];

    var layout = {
        title: 'Annotated Heatmap, x->progress, z->times',
        annotations: [],
        height:300,
        width:2200,

        xaxis: {
            range:[0,{{$videoRange}}],
            ticks: "inside",
            side: 'top',
            autosize: false
        },
        yaxis: {
            ticks: '',
            ticksuffix: ' ',
            autosize: false
        }
    };

    for ( var i = 0; i < yValues.length; i++ ) {
        for ( var j = 0; j < xValues.length; j++ ) {
            var currentValue = zValues[i][j];
            if (currentValue != 0) {
                var textColor = 'black';
            }else{
                var textColor = 'white';
            }
            var result = {
                xref: 'x',
                yref: 'y',
                x: xValues[j],
                y: yValues[i],
                text: zValues[i][j],
                font: {
                    family: 'Times New Roman',
                    size: 11,
                    width:20,
                    height:20,
                    opacity:2,
                    visible:true,
                    borderwidth:8,
                    borderpad:4,
                    align:"center",
                    valign:"middle",
                    color: textColor
                },
                showarrow: false,
            };
            layout.annotations.push(result);
        }

    }

    Plotly.newPlot('myDiv2', data, layout,{showSendToCloud: true});
</script>

<br>
<h4 style="alignment: center; margin-left: 200px; ">Heatmap with bar, x->progress on 5%, y->user_name, z->times</h4>
<div id="myDiv3" style=" width:100%; margin-left: 2%; "><!-- Plotly chart will be drawn inside this DIV --></div>
<script>
    <!-- JAVASCRIPT CODE GOES HERE -->
    var xValues = [@foreach($playedsecA5 as $s){{$s->video_progress5}},@endforeach];

    var yValues = ['User->{{$username}}'];

    var zValues = [
        [@foreach($playedsecA5 as $s){{$s->count}},@endforeach]
    ];

    var colorscaleValue = [
        [0, '#ffffff'],
        [1, '#0fffff'],
        [2, '#1111ff'],
        [3, '#06666f'],
        [4, '#000000'],
        [5, '#000000'],
        [6, '#000000']
    ];

    var data = [{
        x: xValues,
        y: yValues,
        z: zValues,
        type: 'heatmap',
        colorscale: colorscaleValue,
        showscale: true
    }];


    var layout = {
        title: 'Annotated Heatmap, x->progress_5, z->times',
        annotations: [],
        height:300,
        xaxis: {
            range:[-1,{{$videoRange}}],
            ticks: '',
            side: 'top',
            autosize: false
        },
        yaxis: {
            ticks: '',
            ticksuffix: ' ',
            autosize: false
        }
    };

    for ( var i = 0; i < yValues.length; i++ ) {
        for ( var j = 0; j < xValues.length; j++ ) {
            var currentValue = zValues[i][j];
            if (currentValue != 0) {
                var textColor = 'black';
            }else{
                var textColor = 'white';
            }
            var result = {
                xref: 'x',
                yref: 'y',
                x: xValues[j],
                y: yValues[i],
                text: zValues[i][j],
                font: {
                    family: 'Sans-Serif',
                    size: 12,
                    color: 'rgb(50, 171, 96)'
                },
                showarrow: false,
                font: {
                    color: textColor
                }
            };
            layout.annotations.push(result);
        }


    }

    Plotly.newPlot('myDiv3', data, layout, {showSendToCloud: true});
</script>



</body>
</html>
