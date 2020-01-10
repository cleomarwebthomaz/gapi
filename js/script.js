angular.module('app', ['chart.js', 'ui.bootstrap.datetimepicker'])

.controller("BarCtrl", function ($scope, $http) {
    $scope.labels = ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'];;  
    $scope.series = ['Visualizações de Páginas', 'Visitas'];

    moment.locale('pt-BR');  

    $scope.date = {
      start: null,
      end: null,
    };

    $scope.types = [
      { type: 'bar', name: 'Gráfico de barras' },
      { type: 'doughnut', name: 'Gráfico de rosca' },
      { type: 'horizontalBar', name: 'Gráfico de barras horizontais' },
    ]

    $scope.type = {
      type: 'bar',
      name: 'Gráfico de barras'
    };

    $scope.chartOptions = {
      legend: { display: true },
    };

    $scope.config = {
        start: {
          startView:'year', minView: 'month',
          dropdownSelector: '#dropdownStart'
        },
        end: {
          startView:'year', minView: 'month',
          dropdownSelector: '#dropdownEnd'
        }
    };

    if (!$scope.date.start || !$scope.date.end) {
      $scope.labels = ['Últimos 30 dias'];
    }

    $scope.data = [];

    $scope.setChartType = function(type) {
      $scope.type = type;
    }

    function getDate(date) {
      let month = new Date(date).getMonth();
      const year = new Date(date).getFullYear();

      month = month + 1;

      return `${year}-${month}`;
    }

    $scope.getData = function() {
      let start_date = '';
      let end_date = '';

      if ($scope.date.start && $scope.date.end) {
        start_date = getDate($scope.date.start);
        end_date = getDate($scope.date.end);
      }

      $http.get(`report.php?start_date=${start_date}&end_date=${end_date}`).then(function(result) {
          const data = result.data;
          
          $scope.data = [
            [data.page_views],
            [data.visits]
          ];

          console.log( $scope.data )
      })

    }

    $scope.getData();

  });