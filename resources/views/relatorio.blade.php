@foreach($items as $item)
<table class="table table-sm mt-3 table-bordered">
  <thead class="bg-secondary">
    <tr>
      <th colspan="5" scope="col">{{$item->consultant}}</th>
    </tr>
    <tr>
      <th scope="col" class="text-center">Periodo</th>
      <th scope="col" class="text-center">Receita Liquida</th>
      <th scope="col" class="text-center">Custo Fixo</th>
      <th scope="col" class="text-center">Comissao</th>
      <th scope="col" class="text-center">Lucro</th>
    </tr>
  </thead>
  <tbody>
    @foreach($item->relatorio as $r)
    <tr>
      <th>{{$r->period}}</th>
      <td>R$ {{$r->earning}}</td>
      <td>R$ {{$item->salary}}</td>
      <td>R$ {{$r->commission}}</td>
      <td>R$ {{$r->profit}}</td>
    </tr>
    @endforeach
    <tr  class="bg-secondary">
      <th>SALDO</th>
      <td>R$ {{$item->relatorio->sum('earning')}}</td>
      <td>R$ {{$item->salary * $item->relatorio->count()}}</td>
      <td>R$ {{$item->relatorio->sum('commission')}}</td>
      <td>R$ {{$item->relatorio->sum('profit')}}</td>
    <tr>
  </tbody>
</table>
@endforeach