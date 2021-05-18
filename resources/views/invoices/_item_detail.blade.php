<tr id="row_{{ $index }}">
    <td class="p-0">
        <x-input :prefix="$index" name="detail_id[]" type="hidden" :value="$detail->id ?? ''" />
        <x-input :prefix="$index" name="item[]" class="border-0" :value="$detail->item ?? ''" />
    </td>
    <td class="p-0">
        <x-input :prefix="$index" name="qty[]" class="border-0 text-right autonumeric"  :value="$detail->qty ?? ''" />
    </td>
    <td class="p-0">
        <x-input :prefix="$index" name="unit[]" class="border-0" :value="$detail->unit ?? ''" />
    </td>
    <td class="p-0">
        <x-input :prefix="$index" name="price[]" class="border-0 text-right autonumeric" :value="$detail->price ?? ''" />
    </td>
    <td class="font-weight-bold py-2 vertical-middle text-right" id="{{ $index }}total"></td>
    <td class="p-0 text-center vertical-middle">
        <button class="btn btn-danger py-1 px-2" type="button" onclick="delete_row({{ $index }}, '{{ !empty($detail) ? $detail->id : '' }}')">
            <i class="mdi mdi-close text-white"></i>
        </button>
    </td>
</tr>

<script>
    init_form_element();

    $('#{{ $index }}qty, #{{ $index }}price').change(() => {
        let qty = $('#{{ $index }}qty').val(),
            price = $('#{{ $index }}price').val();

        qty = remove_commas(qty);
        price = remove_commas(price);
        let total = '0';
        if (qty !== '' && price !== '') total = parseFloat(price) * parseFloat(qty);
        $('#{{ $index }}total').html(add_commas(total));
    });

    $('#{{ $index }}qty').trigger('change');
</script>
