<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sistemas de vendas</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    </head>
    <body>
        @include('include.nav')
        <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
            <h1 class="display-4">Hist. de vendas</h1>
        </div>
        <div class="container">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Itens</th>
                        <th scope="col">Total</th>
                        <th scope="col">Data</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sales as $sale)    
                    <tr>
                        <th scope="row">{{ $sale->id }}</th>
                        <td>{{ implode(', ', $sale->products->pluck('name')->toArray()) }}</td>
                        <td>{{ $sale->total_price }}</td>
                        <td>{{ $sale->sale_date }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="row justify-content-end">
                <div class="col-auto">
                    <a href="{{ route('new-sale') }}"><button type="button" class="btn btn-outline-primary">Adicionar</button></a>
                </div>
            </div>
        </div>
    </body>
</html>
