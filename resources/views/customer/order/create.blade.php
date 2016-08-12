@extends('app')

@section('content')
    <div class="container">
        <h3>New order</h3>
    
        @include('errors._check')

        <div class="container">
            {!! Form::open(['route' => 'customer.order.store', 'class' => 'form'])  !!}

            <div class="form-group">
                <label>Total: </label>
                <p id="total"></p>

                <a href="#" id="btn-new-item" class="btn btn-default">New Item</a>
                <br>
                <br>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>
                                <select class="form-control" name="items[0][product_id]">
                                    @foreach($products as $p)
                                        <option value="{{ $p->id }}" data-price="{{ $p->price }}">{{ $p->name }} - $ {{ $p->price }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                {!! Form::text('items[0][qty]', 1, ['class' => 'form-control']) !!}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="form-group">
                {!! Form::submit('Create Order', ['class' => 'btn btn-primary']) !!}
            </div>

            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('post-script')
    <script type="text/javascript">
        $('#btn-new-item').click(function () {
            var row    = $('table tbody > tr:last'),
                newRow = row.clone(),
                length = $('table tbody > tr').length;

            newRow.find('td').each(function () {
                var td    = $(this),
                    input = td.find('input,select'),
                    name  = input.attr('name');

                input.attr('name', name.replace((length - 1) + "", length + ""));
            });

            newRow.find('input').val(1);
            newRow.insertAfter(row);
            calculateTotal();
        });

        $(document.body).on('click', 'select', function () {
            calculateTotal();
        });

        $(document.body).on('blur', 'input[name*=qty]', function () {
            calculateTotal();
        });

        function calculateTotal() {
            var total    = 0,
                trLength = $('table tbody > tr').length,
                tr       = null,
                price,
                qty;

            for (var i = 0; i < trLength; i++) {
                tr     = $('table tbody tr').eq(i);
                price  = tr.find(':selected').data('price');
                qty    = tr.find('input').val();
                total += price * qty;
            }

            $('#total').html(total);
        }
    </script>
@endsection