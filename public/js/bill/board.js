;'use strict';
$(document).ready( function () {
    const addDataSelector = 'a.add-data';
    const tableSelector = 'table';
    const newTrSelector = '.new-data';
    const $table = $(tableSelector);
    const $newTr = $table.find(newTrSelector);
    const meterUpdateFormSelector = 'form.submit-by-post';
    const meterUpdateInputSelector = 'form.submit-by-post .autosubmit';
    const meterIdHolderSelector = '.meter-id-holder';

    $('body').on('click', addDataSelector, function(e) {
        e.preventDefault();
        e.stopPropagation();
        let $tr = $newTr.clone();
        $newTr.after($tr.show());
    });

    $('body').on('change', meterUpdateInputSelector, function(e) {
        e.preventDefault();
        e.stopPropagation();
        $(this).closest(meterUpdateFormSelector).submit();
    });

    $('body').on('submit', meterUpdateFormSelector, function(e) {
        e.preventDefault();
        e.stopPropagation();
        const data = $(this).serializeArray();
        const $tr = $(this).closest(meterIdHolderSelector);
        if ($tr.length && $tr.data('meter-id')) {
            data.push({'name': 'id', 'value': $tr.data('meter-id')});
        }
        $.post($(this).attr('action'), data, function () {
            $(this).find(meterUpdateInputSelector)
        });
    });


} );
