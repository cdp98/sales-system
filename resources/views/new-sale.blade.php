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
            <h1 class="display-4">Produtos</h1>
        </div>
        <form id="save-sale-form" action="{{ route('save-sale') }}" method="POST">
        {{ csrf_field() }}
            <div class="container">
                <div class="card-deck mb-3 text-center">
                    @foreach($products as $product)
                    <div class="card mb-4 shadow-sm">
                        <div class="card-header">
                            <h4 class="my-0 font-weight-normal" id="name-{{ $product->id }}">{{ $product->name }}</h4>
                        </div>
                        <div class="card-body">
                            <h1 class="card-title pricing-card-title">$ <small id="price-{{ $product->id }}">{{ $product->price }}</small></h1>
                            <ul class="list-unstyled mt-3 mb-4">
                                <li>{{ $product->reference }}</li>
                            </ul>
                            <button type="button" class="btn btn-lg btn-block btn-outline-primary js-add" data-id="{{ $product->id }}" data-providers="{{ json_encode($product->providers) }}">Adicionar</button>
                        </div>
                    </div>
                    @endforeach
                </div>
                <table class="table table-striped" id="table-products">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Preço</th>
                            <th scope="col">Fornecedores</th>
                        </tr>
                    </thead>
                    <tbody id="tbody-table-js">
                    </tbody>
                </table>
                <div class="row justify-content-end">
                    <h5>Total: $ <small id="total-js">0.00</small></h5>
                    <div class="col-auto">
                        <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#modalFinalizar" id="open-modal">Salvar venda</button>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="modalFinalizar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Título do modal</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="cep">CEP</label>
                                        <input type="text" class="form-control js-mask-cep" id="cep" placeholder="CEP">
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="cep">Data da venda</label>
                                        <input type="text" class="form-control" name="sale_date" id="sale-date">
                                    </div>
                                </div>
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-md-12 ml-auto text-center" id="ender" style="margin: auto !important;"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                <input type="hidden" name="products" id="products" value=""/>
                                <input type="hidden" name="address_delivery" id="address_delivery" value=""/>
                                <input type="hidden" name="total" id="total-input" value=""/>
                                <button type="submit" class="btn btn-primary save-sale">Salvar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <!-- Principal JavaScript do Bootstrap -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.11.2/jquery.mask.min.js"></script>
        <script>
            var products = [];

            $(".js-add").on('click', function(e) {
                e.preventDefault();

                var id = $(this).data('id');
                    price = $('#price-'+id).text();
                    name = $('#name-'+id).text();
                    tbody = $('#tbody-table-js');
                    providers = $(this).data('providers');
                    newProviders = '';
                    html = `<tr>
                                <th scope="row">`+id+`</th>
                                <td>`+name+`</td>
                                <td class="price-js">`+price+`</td>`;

                providers.forEach((item) => {
                    newProviders += item.name+' ';
                });

                html += '<td>'+newProviders+'</td></tr>';

                tbody.append(html);

                updateAmounts();
                products.push(id);
            });

            function updateAmounts()
            {
                var sum = 0.0;
                $('#table-products > tbody  > tr').each(function() {
                    var price = $(this).find('.price-js').text();
                    sum += parseFloat(price);
                });

                $('#total-js').html(sum.toFixed(2));
                $('#total-input').val(sum.toFixed(2));
            }

            var element = $('.js-mask-cep')

            if (element.length > 0) {
                element.mask('00000-000', {
                    onComplete: function (cep) {
                        $.ajax({
                            type: 'POST',
                            url: 'get-address',
                            data: {
                                'cep': cep,
                                '_method': "POST",
                                "_token": "{{ csrf_token() }}",
                            },
                            dataType:'JSON',
                            success:function(response) {
                                if(response.logradouro) {
                                    var ender = `<p style="margin-bottom: 0;">`+response.logradouro+`</p>
                                            <p style="margin-bottom: 0;">`+response.bairro+` - `+response.cep+`</p>
                                            <p style="margin-bottom: 0;">`+response.localidade+` / `+response.uf+`</p>`;

                                    $('#ender').html(ender);
                                    $('#products').val(JSON.stringify(products));
                                    $('#address_delivery').val(JSON.stringify(response));
                                }
                            }
                        });
                    },
                    onInvalid: function (val, e, f, invalid, options) {
                        var error = invalid[0]
                        alert('CEP inválido!');
                    },
                })
            }

            $("#search-js").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#table-products tbody tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });

            $('.save-sale').on('cilck', (e) => {
                e.preventDefault();

                $('#save-sale-form').submit();
            });

            $('#sale-date').mask("99/99/9999", {
                onComplete: function (cep) {},
                onInvalid: function (val, e, f, invalid, options) {
                    var error = invalid[0]
                    alert('Data inválida!');
                }
            });
        </script>
    </body>
</html>