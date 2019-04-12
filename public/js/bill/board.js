;'use strict';
$(document).ready( function () {
    const addDataSelector = 'a.add-data';
    const tableSelector = 'table';
    const newTrSelector = '.new-data';
    const $table = $(tableSelector);
    const $newTr = $table.find(newTrSelector);
    const meterUpdateFormSelector = 'form.submit-by-post';
    const meterUpdateInputSelector = 'form.submit-by-post .autosubmit';

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
        $.post($(this).attr('action'), data, function () {
            $(this).find(meterUpdateInputSelector)
        });
    });


} );
