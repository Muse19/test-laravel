
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
    let tags = [
      @foreach($result[0] as  $label)
      '{{$label}}',
      @endforeach
    ]
    let datos = [
      @foreach($result[1] as $data)
      {{$data}},
      @endforeach
    ]

    let colors = new Array()

    for (let i = 0; i < datos.length; i++) {
      colors.push(getRandomColor())
    }    
    return {
      tags,
      datos,
      colors
    }
  }
  
  var ctx = document.getElementById('myChart');
  var myChart = new Chart(ctx, {
    type: 'pie',
    data: {
      labels: setDataSets().tags,
      datasets: [{
        label: 'Pizza',
        data: setDataSets().datos,
        backgroundColor: setDataSets().colors,
        borderColor: setDataSets().colors,
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: true
          }
        }]
      }
    }
  });
</script>

