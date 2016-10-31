$('.datepicker').datepicker({
    todayBtn: "linked",
    keyboardNavigation: false,
    forceParse: false,
    autoclose: true,
    format: "yyyy-mm-dd"
});

$(document).ready(function(){

    var updateOutput = function (e) {
        var list = e.length ? e : $(e.target),
            output = list.data('output');
        console.log(JSON.stringify(list.nestable('serialize')));
        // if (window.JSON) {
        //     output.val(window.JSON.stringify(list.nestable('serialize')));//, null, 2));
        // } else {
        //     output.val('JSON browser support required for this demo.');
        // }
    };

    // activate Nestable for list 1
    $('#nestable').nestable({
        group: 1
    }).on('change', updateOutput);

    $('.summernote').summernote();

});
