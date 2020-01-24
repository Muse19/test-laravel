<script>

  function getRandomColor() {
    var letters = '0123456789ABCDEF';
    var color = '#';
    for (var i = 0; i < 6; i++) {
      color += letters[Math.floor(Math.random() * letters.length)];
    }
    return color+'55';
  }
  const labels = ['Red', 'Blue']
  const data = [12, 19]
  let colors = new Array()

  for (let i = 0; i < data.length; i++) {
    colors.push(getRandomColor())
  }
  console.log(colors);
  
  var ctx = document.getElementById('myChart');
  var myChart = new Chart(ctx, {
    type: 'pie',
    data: {
      labels,
      datasets: [{
        label: '# of Votes',
        data,
        backgroundColor: colors,
        borderColor: colors,
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

{{dd($result)}}