<?php 
/**
 * Autor: Cleomar Campos
 * Telefone: 45. 99151-7120
 * E-mail: clemarocampos@gmail.com
 */
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Google Analytics</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="./node_modules/angularjs-bootstrap-datetimepicker/src/css/datetimepicker.css"/>

    <link rel="stylesheet" href="./css/style.css">
  </head>
  <body ng-app="app">
    

    <div ng-controller="BarCtrl">
          
        <div class="container mt-4">

          <div class="d-flex justify-content-start  ">
              <div class="dropdown mr-2">
                  <a class="btn btn-secondary dropdown-toggle" id="dropdownStart" role="button" data-toggle="dropdown" data-target="#" href="#">
                      Data Inicial
                      {{ date.start | date:'MM/yyyy' }}
                  </a>
                  <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                      <datetimepicker 
                        data-ng-model="date.start"
                        data-datetimepicker-config="config.start"
                        data-on-set-time="endDateOnSetTime()"
                      ></datetimepicker>
                  </ul>
              </div> <!-- dropdown -->

              <div class="dropdown">
                  <a class="btn btn-secondary dropdown-toggle" id="dropdownEnd" role="button" data-toggle="dropdown" data-target="#" href="#">
                      Data Final
                      {{ date.end | date:'MM/yyyy' }}
                  </a>
                  <ul class="dropdown-menu" role="menu">
                    <datetimepicker 
                        data-ng-model="date.end"
                        data-datetimepicker-config="config.end"
                    ></datetimepicker>
                  </ul>
              </div> <!-- dropdown -->

              <div class="dropdown ml-2">
                  <a class="btn btn-secondary dropdown-toggle" id="dropdownEnd" role="button" data-toggle="dropdown" data-target="#" href="#">
                      {{ type.name }}
                  </a>
                  <ul class="dropdown-menu" role="menu">
                    <li ng-repeat="typeChart in types" class="dropdown-item" ng-click="setChartType(typeChart)">
                        {{ typeChart.name }}
                    </li>
                  </ul>
              </div> <!-- dropdown -->

              <button class="btn btn-secondary ml-2" ng-click="getData(date)">Filtrar</button>

          </div>

          <div class="card mt-2">
              <div class="card-header">
                  <span ng-if="!date.start || !date.end">Últimos 30 dias</span>
                  <span ng-if="date.start && date.end">
                      De {{ date.start | date:'MM/yyyy' }} 
                      Até {{ date.end | date:'MM/yyyy' }}
                  </span>
              </div>
              <div class="card-body">
                <canvas 
                  id="bar" 
                  class="chart-base" 
                  chart-type="type.type"
                  chart-data="data" 
                  chart-labels="labels" 
                  chart-series="series"
                  chart-options="chartOptions"
                  chart-dataset-override="datasetOverride" 
                >
                </canvas>
              </div>

          </div>
    </div> <!-- controller -->
    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    
    <script type="text/javascript" src="./node_modules/moment/moment.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.7.9/angular.min.js"></script>
    <script src="./node_modules/angular-locale-pt-br/angular-locale_pt-br.js"></script>
    <script src="./node_modules/chart.js/dist/Chart.js"></script>
    <script src="./node_modules/angular-chart.js/dist/angular-chart.min.js"></script>
    <script type="text/javascript" src="./node_modules/angularjs-bootstrap-datetimepicker/src/js/datetimepicker.js"></script>
    <script type="text/javascript" src="./node_modules/angularjs-bootstrap-datetimepicker/src/js/datetimepicker.templates.js"></script>


    <script src="./js/script.js"></script>

    <script>
      document.write(
        '<script src="http://' +
          (location.host || '${1:localhost}').split(':')[0] +
          ':${2:35729}/livereload.js?snipver=1"></' +
          'script>'
      );
    </script>
  </body>
</html>