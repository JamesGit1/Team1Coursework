<script>
var ctx = document.getElementById('myChart');
// Global options
Chart.defaults.global.defaultFontFamily = 'Lato';
//  Chart.defaults.global.defaultFontSize = '5';
Chart.defaults.global.defaultFontColor = '#777';

var myChart = new Chart(ctx, {
    type: 'horizontalBar', //bar  , horizontalBar ,pie, line, doughnut, radar , polararea
    data: {
        labels: [<?php 
                  foreach($questionnaires as $row) {
                    $id = "#".$row["ID"];
                    echo "'$id',";
                  }
                  ?>],
        datasets: [{
            //label: 'Number of Votes',
            data: [<?php 
            foreach($questionnaires as $row) {
              $id = $row["ID"];
              foreach($questionnairescount as $rowrow) {
                if($id==$rowrow["Questionnaire ID"]){
                  echo $rowrow["Number of Questions"].",";
                }
              }
            }?>, 0],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
            ],
            borderWidth: 1,
            borderColor: '#777',
            hoverBorderWidth: 4,
        }]
    },
    options: {
        title: {
            display: true,
            text: 'Volume of quesitons'
            //fontsize
        },
        scales: {
            yAxes: [{
                scaleLabel: {
                    display: true,
                    labelString: 'Question ID'
                }
            }]
        },
        legend: {
            display: false,
            position: 'right',
            labels: {
                fontColor: '#000'
            }
        },
        layout: {
            padding: {
                left: 0,
                right: 0,
                bottom: 0,
                top: 0
            }
        },
        tooltips: {
            enabled: true
        }
    },
});
</script>