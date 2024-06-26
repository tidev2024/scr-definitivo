$(document).ready(function () {
    $(document).on('click', 'button[data-row]', function () {
        rowNumber = $(this).attr('data-row')
        $(`#percent_to_${rowNumber}`).remove()
        $(`#percent_from_${rowNumber}`).remove()
        $(`#seller_percentage_${rowNumber}`).remove()
        $(`#remove_button_${rowNumber}`).remove()
    })

    $(document).on('click', 'button#add_row', function () {
        lastRowNumber = $(this).attr('data-row-number')
        $(this).attr('data-row-number', Number(lastRowNumber) + 1)
        $(this).parent().before(`
            <div class="col-sm-4" id="percent_from_${lastRowNumber}">
                <input type="text" class="form-control" name="percent_from_${lastRowNumber}">
            </div>
            <div class="col-sm-4" id="percent_to_${lastRowNumber}">
                <input type="text" class="form-control" name="percent_to_${lastRowNumber}">
            </div>
            <div class="col-sm-3" id="seller_percentage_${lastRowNumber}">
                <input type="text" class="form-control" name="seller_percentage_${lastRowNumber}">
            </div>
            <div class="col-sm-1" id="remove_button_${lastRowNumber}">
                <button type="button" class="btn btnOrange" data-row="${lastRowNumber}">
                <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
        `)
    })

    $(document).on('input', 'input', function () {
        let value = $(this).val()
        value = value.replace(/[^0-9,]/g, '')

        let parts = value.split(',')
        if (parts.length > 2) {
            value = parts[0] + ',' + parts.slice(1).join('').replace(/,/g, '')
        }

        $(this).val(value)
    });
});
