<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Dades COVID</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">


        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    </head>
    <body >
        
        <div class="row">
            <h3 class="label label-success">PCR negatices i positives</h3>
            
            <div class="col-sm-5 text-center" id="pie-chart" ></div>
        </div>
        <div class="rallita"></div>
        <div class="row">
            <h3 class="label label-success">PCR fetes</h3>
            <div class="col-sm-5 text-center" id="pcr" ></div>
        </div>
        <div class="rallita"></div>
        <div class="row">
            <h3 class="label label-success">Positius totals</h3>
            <div class="col-sm-5 text-center" id="positiu" ></div>
        </div>
        

    <script>
        Morris.Bar({
            element : 'pcr',
            data:[<?php echo $pcrXdia; ?>],
            xkey:'x',
            ykeys:['a'],
            labels:['PCR fetes'],
            hideHover:'auto',
            stacked:true,
            barColors: ["grey"],
        });
        
    </script>

<script>
        Morris.Line({
            element : 'positiu',
            data:[<?php echo $positiuXdia; ?>],
            xkey:'x',
            ykeys:['a'],
            labels:['Positius'],
            hideHover:'auto',
            lineColors: ["red"],
        });
        
    </script>

    <script>
    var positiu = "#FF1744";
    var negatiu = "#008000"
        Morris.Donut({
            element: 'pie-chart',
            data: [
                {label:"Positiu", value:[<?php echo $finalPositiu; ?>], color:positiu},
                {label:"Negatiu", value:[<?php echo $pcrNegatiu; ?>], color:negatiu}
            ]
        });
        
        </script>
    </body>
    <style>
        body{
            font-family: "Lucida Console", "Courier New", monospace;
            text-align: center;
        }
        .rallita{
            width: 100%;
            border-bottom: 3px solid black;
        }
    </style>
</html>