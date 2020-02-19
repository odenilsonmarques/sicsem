<?php
require './config/conexao.php';
require './pages/header.php';
session_start();

$meses = array('', 'Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez');
for ($x = 1; $x <= 12; $x = $x + 1) {
    $dinero[$x] = 0;
}

$anno = date('Y');

$sql = "SELECT *FROM tb_licenca";
$recebesql = mysqli_query($con, $sql);
while ($row = mysqli_fetch_array($recebesql)) {

    $y = date('Y', strtotime($row['data_emissao']));

    $mes = (int) date("m", strtotime($row['data_emissao']));

    if ($y == $anno) {
        $dinero[$mes] = $dinero[$mes] + $row['data_emissao'];
    }
    $dinero[$mes] = $dinero[$mes] + $row['data_emissao'];
}
?>

<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <script type="text/javascript" src="https://www.google.com/jsapi"></script>
        <script type="text/javascript">
            google.load("visualization", "1", {packages: ["corechart"]});
            google.setOnLoadCallback(drawChart);
            function drawChart() {
                var data = google.visualization.arrayToDataTable([
                    ['mes', 'licença'],
<?php
for ($x = 1; $x <= 12; $x = $x + 1) {
    ?>
                        ['<?php echo $meses[$x]; ?>', <?php echo $dinero[$x] ?>],
<?php } ?>
                ]);

                var options = {
                    hAxis: {title: 'Grafico Mensal da Licenças 2018', titleTextStyle: {color: '#000'}}
                };

                var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
                chart.draw(data, options);
            }
        </script>
        <title></title>
    </head>

    <body>
        <div id="chart_div" style="width: 98%; height: 500px"></div>
    </body>
</html>
