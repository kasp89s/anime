$('.datepicker').datepicker({
    todayBtn: "linked",
    keyboardNavigation: false,
    showTimePicker: false,
    forceParse: false,
    autoclose: true,
    format: "yyyy-mm-dd"
});

$('.chosen-select').chosen({width: "100%"});

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

    $('#product-categoriesmultiple').on(
        'change',
        function () {
            $('#product-attributesmultiple').empty();
            $('#product-specificationsmultiple').empty();
            $.post(
                '/admin/product/get-attributes',
                {
                    categories: $(this).val(),
                    _csrf : $('meta[name="csrf-token"]').attr("content")
                },
                function (response) {
                    if (response.attributes != null) {
                        $.each(response.attributes, function (i, item) {
                            $('#product-attributesmultiple').append($('<option>', {
                                value: i,
                                text : item
                            }));
                        });
                        $('#product-attributesmultiple').show();
                    }
                    if (response.specifications != null) {
                        $.each(response.specifications, function (i, item) {
                            $('#product-specificationsmultiple').append($('<option>', {
                                value: i,
                                text : item
                            }));
                        });
                        $('#product-specificationsmultiple').show();
                    }

                },
                'json'
            );
        }
    );

    $('[data-target="#create-attribute"]').on('click', function () {
        $('[name="OptionValue[productOptionId]"]').val($(this).data('id'));
    });

    $('#product-specificationsmultiple').on('change', function () {
        $('.specifications-pull').empty();

        $.each($(this).find("option:selected"), function (i, item) {
            console.log();
            $('.specifications-pull').append($('<div></div>').append($('<input>', {
                    value: $(item).text(),
                    name : 'specifications['+$(item).val()+'][id]',
                    readonly: true
                })).append($('<input>', {
                    placeholder: 'Значение',
                    name : 'specifications['+$(item).val()+'][value]'
                })));
        });
    });
});
