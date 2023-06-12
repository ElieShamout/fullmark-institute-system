$(document).ready(function () {


    $('.add-subject-btn').click(() => {
        if (
            $('.subject-name').val().length > 0
        ) {
            $.ajax({
                type: 'get',
                url: relative_path + 'add-subjects-api',
                data: {
                    subject_name: $('.subject-name').val(),
                    specialization: $('.specialization').val()
                },
                success: function (data) {
                    view_data(data);
                    $('html').animate({
                        scrollTop: 10000
                    });
                    $('.subject-name').val('');
                    $(".Specialization option:first").attr('selected', 'selected');
                }
            });
        }
    });

    $('.remove-subject').each((i, ele) => {
        $(ele).click(() => {
            remove_subject($(ele).attr('subject-id'));
        })
    });

    function view_data(data) {
        // $('.subjects-data').empty();
        template = `
        <tr class="subject-row-${data.id}">
                    <td>${data.id}</td>
                    <td>${data.name}</td>
                    <td>${(data.specialization != null) ? data.specialization : ''}</td>
                    <td>
                        <button class="btn btn-success subject-all-info disabled" student-id="${data.id}">Mory</button>
                        <button class="btn btn-danger remove-subject" subject-id="${data.id}">Remove</button>
                        <button class="btn btn-primary edit-subject disabled" subject-id="${data.id}">Edit</button>
                    </td>
                </tr>
            `;

        $('.subjects-data').html($('.subjects-data').html() + template);

        $('.remove-subject').each((i, ele) => {
            $(ele).click(() => {
                remove_subject($(ele).attr('subject-id'));
            })
        });
    }

    function remove_subject(subject_id) {
        $.ajax({
            type: 'get',
            url: relative_path + 'remove-subject-api',
            data: {
                subject_id: subject_id
            },
            success: function (data) {
                $('.subject-row-' + subject_id).fadeOut(500);
                setTimeout(() => {
                    $('.subject-row-' + subject_id).remove();
                }, 2000);
            }
        });
    }
});