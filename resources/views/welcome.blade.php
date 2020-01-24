<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Agence - Comercial</title>
  

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

 
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-success">
  <div class="container">
    <a class="navbar-brand" href="#">AGENCE</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-item nav-link" href="#">Agence</span></a>
        <a class="nav-item nav-link" href="#">Projetos</a>
        <a class="nav-item nav-link" href="#">Administrativo</a>
        <a class="nav-item nav-link active" href="#">Comercial</a>
        <a class="nav-item nav-link" href="#">Financeiro</a>
        <a class="nav-item nav-link" href="#">Usuário</a>
        <a class="nav-item nav-link" href="#">Sair</a>
      </div>
    </div>
  </div>
</nav>

<div class="container mt-3">
  <ul class="nav nav-tabs">
    <li class="nav-item bg-success">
      <a class="nav-link  text-white" href="#">Por Consultor</a>
    </li>
    <li class="nav-item">
      <a class="nav-link text-dark" href="#">Por Cliente</a>
    </li>
  </ul>


  <div class="row">
    <div class="col-sm-12 mt-2">Periodo</div>
    <div class="col-sm-12 mt-2">
      <form id="form" action="">    
        <div class="row">
          <div class="col-sm-1">
            <select class="custom-select" id="inputGroupSelect01" name="m1">
              <option value="01">Jan</option>
              <option value="02">Fev</option>
              <option value="03">Mar</option>
              <option value="04">Abr</option>
              <option value="05">Mai</option>
              <option value="06">Jun</option>
              <option value="07">Jul</option>
              <option value="08">Ago</option>
              <option value="09">Set</option>
              <option value="10">Out</option>
              <option value="11">Nov</option>
              <option value="12">Dez</option>
            </select>    
          </div>

          <div class="col-sm-2">
            <select class="custom-select" id="inputGroupSelect01" name="y1">
              @foreach($years as $year)
              <option value="{{$year}}">{{$year}}</option>
              @endforeach
            </select>    
          </div>

          <div class="col-sm-1 text-center pt-2">
            a   
          </div>

          <div class="col-sm-1">
            <select class="custom-select" id="inputGroupSelect01" name="m2">
              <option value="01">Jan</option>
              <option value="02">Fev</option>
              <option value="03">Mar</option>
              <option value="04">Abr</option>
              <option value="05">Mai</option>
              <option value="06">Jun</option>
              <option value="07">Jul</option>
              <option value="08">Ago</option>
              <option value="09">Set</option>
              <option value="10">Out</option>
              <option value="11">Nov</option>
              <option value="12">Dez</option>
            </select>    
          </div>

          <div class="col-sm-2">
            <select class="custom-select" id="inputGroupSelect01" name="y2">
              @foreach($years as $year)
              <option value="{{$year}}">{{$year}}</option>
              @endforeach
            </select>    
          </div>
        </div>
      </form>
    </div>


    <div class="col-sm-12 mt-2">Consultores</div>
    <div class="col-sm-12">
      <div class="row">
        <div class="col-sm-4">
          <div class="form-group">
            <select id="consultants" multiple class="form-control" id="exampleFormControlSelect2">
              @foreach($consultants as $consultant)
              <option value="{{$consultant->co_usuario}}">{{$consultant->no_usuario}}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="col-sm-1">
          <button id="addConsultants" type="button" class="btn btn-primary m-2">>></button>
          <button id="removeConsultants" type="button" class="btn btn-primary m-2"><<</button>
        </div>
        <div class="col-sm-4">
          <div class="form-group">
            <select form="form" name="users[]" id="consultantsQuery" multiple class="form-control" id="exampleFormControlSelect2">
            </select>
          </div>
        </div>
        <div class="col-sm-3">
          <button id="relatorio" type="button" class="btn btn-primary">Relatório</button>
          <button id="grafico" type="button" class="btn btn-primary">Gráfico</button>
          <button id="pizza" type="button" class="btn btn-primary">Pizza</button>
        </div>
      </div>
    </div>   
    <div id="results" class="col-sm-12 mt-2">
    
    </div>
  </div>
  

</div>


</body>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
  integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
  integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="/app.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.js"></script>
<script src="https://rawgit.com/chartjs/chartjs-plugin-annotation/master/chartjs-plugin-annotation.js"></script>
</html>
