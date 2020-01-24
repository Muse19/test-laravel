<div class="chart-container" style="position: relative; height:800px; width:80vw">
    <canvas id="myChart"></canvas>
</div>

<script>

  function getRandomColor() {
    var letters = '0123456789ABCDEF';
    var color = '#';
    for (var i = 0; i < 6; i++) {
      color += letters[Math.floor(Math.random() * letters.length)];
    }
    return color+'55';
  }
  

  function setDataSets() {
    let datasets = new Array()   
    
    const months = [
      @foreach($result[0] as  $month)
      '{{$month}}',
      @endforeach
    ]
    const total_salary = {{$result[1]}}     
      
    datasets = [@foreach($result[2] as  $consultant){
        label: '{{$consultant->consultant}}',
        data: [@foreach($consultant->earnings as  $earn)'{{$earn}}',@endforeach],
        backgroundColor: getRandomColor()
      },@endforeach
    ]

    return {
      months,
      datasets,
      total_salary,
    }
    
  }
  console.log(setDataSets());
  
  
  var ctx = document.getElementById('myChart');
  var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: setDataSets().months,
      datasets: setDataSets().datasets,
    },
    options: {
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: true
          }
        }]
      },
      annotation: {
        annotations: [{
          type: 'line',
          mode: 'horizontal',
          scaleID: 'y-axis-0',
          value: setDataSets().total_salary,
          borderColor: 'rgb(75, 192, 192)',
          borderWidth: 4,
          label: {
            enabled: true,
            content: '$'+setDataSets().total_salary,
          }
        }]
      }
    }
  });
</script>