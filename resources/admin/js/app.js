import '@coreui/coreui';
import 'bootstrap';

(function ($) {

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

})(jQuery);
