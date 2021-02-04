<link rel="stylesheet" href="../CSS/questionAppearance.css">
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../CSS/style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"
            integrity="sha512-d9xgZrVZpmmQlfonhQUvTR7lMPtO7NkZMkA0ABN3PHCbKA5nqylQ/yWlFAyY6hYgdF1Qh6nYiuADWwKB4C2WSw=="
            crossorigin="anonymous"></script>
    <title>Dundata</title>
    <link rel="icon" type="image/x-icon" href="../images/favicon.ico"/>

</head>

<!--Navigation bar -->
<nav class="navbar navbar-dark">
    <a class="navbar-brand" href="../index.html">
        <img src="../images/University_of_Dundee_shield_white.png" width="27" height="37" alt="Uni Logo"
             style="margin-right: 20px;">Home
    </a>
</nav>

<body>
<div class="container">
    <canvas id="myChart">
</div>

<script>
    var ctx = document.getElementById('myChart');
    // Global options
    Chart.defaults.global.defaultFontFamily = 'Lato';
    //  Chart.defaults.global.defaultFontSize = '5';
    Chart.defaults.global.defaultFontColor = '#777';

    var myChart = new Chart(ctx, {
        type: 'bar', //bar  , horizontalBar ,pie, line, doughnut, radar , polararea
        data: {
            labels: ['Data1', 'Data2', 'Data3', 'Data4'],
            datasets: [{
                label: 'Number of Votes',
                data: [1000, 2000, 3000, 4000, 0],
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
                hoverBorderWidth: 3,
            }]
        },
        options: {
            title: {
                display: true,
                text: 'Text TOP'
                //fontsize
            },
            legend: {
                display: true,
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
                enabled: false
            }
        },
    });
</script>


</body>


</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW"
        crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/8741ca18b0.js" crossorigin="anonymous"></script>
<script src="../createForm/addQuestions.js"></script>

