<div class="invoice p-3 mb-3">
    <!-- title row -->
    <div class="row">
        <div class="col-12">
            <h4>
                <i class="fas fa-globe"></i> {{ $company->name }}
                <small class="float-right">Date: {{ date('d/m/Y', strtotime($payment->created_at)) }}</small>
            </h4>
        </div>
        <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
            From
            <address>
                <strong>{{ $company->name }}</strong><br>
                {{ $company->address }}
            </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
            To
            <address>
                <strong>{{ $customer->getFullName() }}</strong><br>
                Phone: {{ $customer->phone }}<br>
                Email: {{ $customer->email }}
            </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
            <b>Invoice {{ $payment->id }}</b><br>
            <b>Payment Type:</b> {{ $payment->payment_type }}<br>
            <b>Status:</b> {{ $payment->status }}<br>
            <b>Account:</b> {{ $payment->price }}
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
    <!-- Table row -->
    <div class="row">
        <div class="col-12 table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Land</th>
                        <th>Width(m)</th>
                        <th>Height(m)</th>
                        <th>Size(m2)</th>
                        <th>Type</th>
                        <th>Subtotal($)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $land->id }}-{{ $land->title }}  </td>
                        <td>{{ $land->width }}</td>
                        <td>{{ $land->height }}</td>
                        <td>{{ $land->size }}</td>
                        <td>{{ $land->type }}</td>
                        <td>{{ $payment->price }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
    <div class="row">
        <!-- accepted payments column -->
        <div class="col-6">
            <p class="lead">Note:</p>
            <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem
                plugg
                dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
            </p>
        </div>
        <!-- /.col -->
        <div class="col-6">
            <p class="lead">Amount Due 2/22/2014</p>
            <div class="table-responsive">
                @php 
                    $discount_price = $payment->price * $payment->discount / 100;
                    $total = $payment->price - $discount_price;
                    $owe = $total - $payment->deposit - $payment->receive;
                @endphp
                <table class="table">
                    <tr>
                        <th style="width:50%">Subtotal:</th>
                        <td>{{ $payment->price }}</td>
                    </tr>
                    <tr>
                        <th>Discount ({{ $payment->discount }}%):</th>
                        <td>{{ $discount_price }}</td>
                    </tr>
                    <tr>
                        <th>Total:</th>
                        <td>{{ $total }}</td>
                    </tr>
                    <tr>
                        <th>Deposit:</th>
                        <td>{{ $payment->deposit }}</td>
                    </tr>
                    <tr>
                        <th>Receive:</th>
                        <td>{{ $payment->receive }}</td>
                    </tr>
                    <tr>
                        <th>Owe:</th>
                        <td>{{ $owe }}</td>
                    </tr>
                </table>
            </div>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
    <!-- this row will not appear when printing -->
    <div class="row no-print">
        <div class="col-12">
            <a href="#" target="_blank" class="btn btn-default float-right"><i class="fas fa-print"></i> Print</a>
        </div>
    </div>
</div>