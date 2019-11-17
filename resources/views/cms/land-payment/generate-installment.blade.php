@php $no = 1 @endphp
@foreach ($data as $d)
    <tr>
        <td>{{ $no++ }}</td>
        <td>
            <input type="date" class="form-control" name="installment_date[]" id="installment_date" placeholder="Enter installment date" value="{{ $d['date'] }}">
        </td>
        <td>
            <input type="number" minlength="0" class="form-control" name="installment_price[]" id="installment_price" placeholder="Enter installment price" value="{{ $d['price'] }}">
        </td>
    </tr>
@endforeach