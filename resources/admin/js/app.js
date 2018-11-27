import '@coreui/coreui';
import 'bootstrap';
import Sortable from 'sortablejs';

(function ($) {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });

    $('[name="src_question_id"]').on('change', function () {
        const select      = $(this);
        const option      = select.find('> option:selected');
        const isMultiple  = option.data('is-multiple');
        const answers     = option.data('answers');
        const label       = $('label[for="src_question_value"]');
        const inputText   = '<input type="text" class="form-control" name="src_question_value" id="src_question_value">';
        const inputSelect = '<select name="src_question_value" id="src_question_value" class="form-control"><option selected disabled>---</option>{answers}</select>'.replace('{answers}', answers.map((answer) => `<option value="${answer.id}">${answer.name}</option>`));

        if (isMultiple) {
            label.next().remove();
            label.after(inputSelect);
        } else {
            label.next().remove();
            label.after(inputText);
        }
    });

    $(document).on('change input keydown keyup keypress', '[name="rule_id"], [name="src_question_id"], [name="src_question_sign"], [name="src_question_value"]', function (event) {
        //const elem     = $(event.target);
        const rule     = $('[name="rule_id"]').find('option:selected').data('name');
        const question = $('[name="src_question_id"]').val();
        const sign     = $('[name="src_question_sign"]').val();
        const value    = $('[name="src_question_value"]').val();

        if (rule && question && sign) {
            $('[name="conditions"]').val(`${rule}:questions[${question}] ${sign} '${value}'`);
        }
    });

    $(document).on('change input keydown keyup keypress', '[name="action_id"], [name="src_sign"], [name="src_value"]', function (event) {
        //const elem     = $(event.target);
        const action = $('[name="action_id"]').find('option:selected').data('name');
        const sign   = $('[name="src_sign"]').val();
        const value  = $('[name="src_value"]').val();

        if (action && sign) {
            $('[name="conditions"]').val(`${action}:this ${sign} '${value}'`);
        }
    });

    if ($('[data-sortable]').length) {
        Sortable.create($('[data-sortable]')[0], {
            animation: 150,
            scroll   : true,
            handle   : '.fa.fa-bars',
            onEnd    : (event) => {
                const from  = $($(event.from).find('tr').get(event.oldIndex)).data('id');
                const to    = $($(event.to).find('tr').get(event.newIndex)).data('id');
                const model = $(event.from).data('sortable');

                $.ajax({
                    url    : '/admin/sort',
                    type   : 'POST',
                    data   : { model, from, to },
                    success: (response) => {
                        if (!response.success) {
                            alert('Une erreur est survenue\n' + response.message);
                        }
                    },
                    error  : (error) => {
                        alert('Une erreur est survenue');
                        console.error(error);
                    }
                });
            }
        });
    }

})(jQuery);
