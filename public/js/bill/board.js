;'use strict';
$(document).ready( function () {
    const addDataSelector = 'a.add-data';
    const tableSelector = 'table';
    const newTrSelector = 'tr.data-tr-new';
    const $table = $(tableSelector);
    const $newTr = $table.find(newTrSelector);

    $('body').on('click', addDataSelector, function(e) {
        e.preventDefault();
        e.stopPropagation();
        let $tr = $newTr.clone();
        $newTr.after($tr.show());
    });


} );
