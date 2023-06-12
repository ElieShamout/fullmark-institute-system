$(document).ready(function () {

    stu_id = -1;

    // get filtering and suggestion on area
    mapboxgl.accessToken = 'pk.eyJ1IjoiZWxpLXNoYW1vdXQiLCJhIjoiY2t0bzFydjEzMDhmcDJybDRqOWQ2NW4xOCJ9.BOhDGTM6J1cBUPFfH5RvjQ';
    const geocoder = new MapboxGeocoder({
        accessToken: mapboxgl.accessToken,
        autocomplete: true,
        types: 'country,region,place,locality',
    });

    geocoder.addTo('#address-container');
    // ---------------------------




    $('.scientific_literary').hide();
    $('.number_lesson_box').hide();
    $('.lesson_date_box').hide();
    $('.select_lesson_teacher').hide();
    $('.lesson_name_box').fadeIn(500);

    $('.back-btn').click(() => {
        $('.offset-box').animate({
            left: '0'
        }, 1000);
    });


    $('.student_name').keyup(() => {
        if ($('.student_name').val().length>0) {
            $.ajax({
                type: 'get',
                url: relative_path + 'filter-student-name',
                data: {
                    full_name: $('.student_name').val(),
                },
                success: function (data) {
                    $('#students_list').html('');
                    // students_list
                    data.forEach((ele, i) => {
                        // template=`<option value="${ele.full_name} | ${ele.phone} | ${ele.address}" class="test-opt">`;
                        template = `
                            <div class="option-item" student_id="${ele.id}">
                                <ul class="list-unstyled p-0 m-0">
                                    <li class="ele-fullname">${ele.full_name}</li>
                                    <li class="ele-phone">${ele.phone}</li>
                                    <li class="ele-address">${ele.address}</li>
                                    <li class="ele-class d-none">${ele.class}</li>
                                </ul>
                            </div>    
                        `;
                        $('#students_list').html($('#students_list').html() + template);
                    });
                    $('.option-item').each((i, ele) => {
                        $(ele).click(() => {
                            stu_id = $(ele).attr('student_id');
                            $('.alert-success .success-message').text('Welcome Student ' + data[i].full_name);
                            $('.alert-success').fadeIn(1500);
                            close_alert();
                            $('.student_class').val(data[i].class)
                            $('.offset-box').animate({
                                left: '-570'
                            }, 1000);
                        });
                    });

                }
            });
        } else { 
            $('#students_list').html('');
        }

    });


    $('.save-btn').click(() => {
        $('.student_name').val('');
        $('.mapboxgl-ctrl-geocoder--input').val('');
        $('.phone').val('');
        $(".student_class option:first").attr('selected', 'selected');


        $(".lesson_teacher option:first").attr('selected', 'selected');

        $('.lesson_date').val('');
        $('.number_of_lesson').val(0);

        $('.scientific_literary').hide();
        $('.number_lesson_box').hide();
        $('.lesson_date_box').hide();
        $('.select_lesson_teacher').hide();
        $('.offset-box').animate({
            left: '0'
        }, 1000);
    });

    $('.student_class').change(() => {
        if ($('.student_class option:selected').text() == '11' || $('.student_class option:selected').text() == '12') {
            $('.scientific_literary').fadeIn(500);
        } else {
            $('.scientific_literary').fadeOut(500);
            $('input[name="specialize"]:checked').val('')
        }
    });

    $('.next-btn').click(() => {
        $('.lesson_name_box').fadeIn(500);
        if (
            $('.student_name').val().length > 0 &&
            $('.mapboxgl-ctrl-geocoder--input').val().length > 0 &&
            $('.phone').val().length > 0
        ) {
            if (
                $('.student_name').val().length > 0 &&
                $('.mapboxgl-ctrl-geocoder--input').val().length > 0 &&
                $('.phone').val().length > 0 &&
                $('.student_class').val() != 'Select Class'
            ) {
                $('.offset-box').animate({
                    left: '-570'
                }, 1000);
                if (stu_id == -1) {
                    new_student($('.student_name').val(), $('.mapboxgl-ctrl-geocoder--input').val(), $('.near').val(), $('.phone').val(), $('.student_class').val(), $('input[name="specialize"]:checked').val());
                } else {
                    update_student(stu_id, $('.student_name').val(), $('.mapboxgl-ctrl-geocoder--input').val(), $('.near').val(), $('.phone').val(), $('.student_class').val(), $('input[name="specialize"]:checked').val());
                }

            }
        }
    });

    $('.lesson_name').change(() => {
        $('.number_lesson_box').fadeIn(500);
    });

    $('.number_lesson_box').change(() => {
        $('.lesson_date_box').fadeIn(500);

    });

    $('.lesson_date').change(() => {
        if ($('.lesson_name').val() != "Select Subject" && $('.student_class').val() != 'Select Class' && $('.lesson_date').val().length != 0) {
            get_techers_subject();
            $('.select_lesson_teacher').fadeIn(500);
        }
    });


    lesson_id = 0;
    $('.add-more-lesson').click(() => {

        if ($('.lesson_name').val() != 'Select Subject' && $('.lesson_teacher').val() != 'Select Teacher' && $('.lesson_date').val().length > 0) {
            new_lesson();
        }

    });

    function get_techers_subject(stu_class, subject, specialize, date, time) {
        var d = new Date(date);
        $.ajax({
            type: 'get',
            url: relative_path + 'get-teachers-api',
            data: {
                stu_class: $('.student_class').val(),
                subject: $('.lesson_name').val(),
                specialize: $('.specialize').val(),
                date: $('.lesson_date').val(),
                lesson_number: $('.number_of_lesson').val(),
            },
            success: function (data) {
                console.log($('.student_class').val());
                $('.lesson_teacher').html('<option selected>Select Teacher</option>');
                data.forEach((ele) => {
                    $('.lesson_teacher').html($('.lesson_teacher').html() + `<option teacher_id='${ele.teacher_id}'>${ele.first_name} ${ele.last_name}</option>`);
                });
            }
        });
    }

    function new_student(name, address, near, phone, stu_class, specialize) {
        $.ajax({
            type: 'post',
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            url: relative_path + 'new-student-api',
            data: {
                name: name,
                address: address,
                near: near,
                phone: phone,
                stu_class: stu_class,
                specialize: specialize,
            },
            success: function (data) {
                stu_id = data;
                $('.alert-success .success-message').text('A new student has been successfully added');
                $('.alert-success').fadeIn(1500);
                close_alert();
            },
            error: function (error) {
                $('.alert-danger .danger-message').html(`Student is not added. Please check the data!<div>Error:${error}</div>`);
                $('.alert-danger').fadeIn(1500);
                close_alert();
            }
        });
    }

    function update_student(stu_id, name, address, near, phone, stu_class, specialize) {
        $.ajax({
            type: 'get',
            // headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            url: relative_path + 'update-student-api',
            data: {
                id: stu_id,
                name: name,
                address: address,
                near: near,
                phone: phone,
                stu_class: stu_class,
                specialize: specialize,
            },
            success: function (data) {
                $('.alert-success .success-message').text('Student data has been successfully updated');
                $('.alert-success').fadeIn(1500);
                close_alert()
            },
            error: function (error) {
                $('.alert-danger .danger-message').html(`Student data was not updated successfully. Please check the data!<div>Error:${error}</div>`);
                $('.alert-danger').fadeIn(1500);
                close_alert()
            }
        });
    }

    function new_lesson() {
        $.ajax({
            type: 'get',
            // headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            url: relative_path + 'save-lesson-api',
            data: {
                teacher_id: $('.lesson_teacher option:selected').attr('teacher_id'),
                student_id: stu_id,
                subject_id: $('.lesson_name option:selected').val(),
                note: 'note',
                date: $('.lesson_date').val(),
                number_of_lesson: $('.number_of_lesson').val(),
            },
            success: function (data) {
                $('.alert-success .success-message').text('A new lesson has been successfully added to the student');
                $('.alert-success').fadeIn(1000);
                close_alert()

                let dateTimeUTC = new Date($('.lesson_date').val());
                template = `
                <div class="accordion accordion-flush lessons-selected-item border-bottom mb-1" lesson_id="${data}" id="lesson-${data}">
                    <div class="accordion-item">
                        <h2 class="accordion-header bg-dark position-relative" id="#toggle-accordion-${data}">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#toggle-accordion-${data}" aria-expanded="false" aria-controls="toggle-accordion-${data}">
                                ${$('.lesson_name option:selected').text()}
                            </button>
                        </h2>
                        <div id="toggle-accordion-${data}" class="accordion-collapse collapse" aria-labelledby="#toggle-accordion-${data}" data-bs-parent="">
                            <div class="accordion-body">
                                <table>
                                <tbody>
                                <tr>
                                    <td style="width:200px;">
                                        Subject:
                                    </td>
                                    <td>
                                        <span class="lessons-selected col-12" id="lesson time">${$('.lesson_name option:selected').text()}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:200px;">
                                        Number of Sessions:
                                    </td>
                                    <td>
                                        <span class="lessons-selected col-12" id="lesson time">${$('.number_of_lesson').val()}</span>
                                    </td>
                                <tr>
                                </tr>
                                    <td style="width:200px;">
                                        Teacher Name:
                                    </td>
                                    <td>
                                        <span class="lessons-selected col-12" id="lesson time">${$('.lesson_teacher option:selected').text()}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:200px;">
                                        Date:
                                    </td>
                                    <td>
                                        <span class="lessons-selected col-12" id="lesson time">${dateTimeUTC.toUTCString()}</span>
                                    </td>
                                </tr>
                                </tbody>
                                </table>
                                <div class="btn btn-danger clear-lesson-selected mt-2"  lesson-id="${data}">
                                    remove
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;

                // $('.student_class').val('Select Class');
                $(".lesson_name option:first").attr('selected', 'selected');
                $(".lesson_teacher option:first").attr('selected', 'selected');

                $('.lesson_date').val('');
                $('.number_of_lesson').val(0);

                $('.select_lesson_teacher').fadeOut(500);
                $('.number_lesson_box').fadeOut(500);
                $('.lesson_date_box').fadeOut(500);

                $('.lessons-selected-container').html($('.lessons-selected-container').html() + template);

                document.querySelectorAll('.clear-lesson-selected').forEach((ele, i) => {
                    ele.addEventListener('click', (item) => {
                        remove_lesson(ele.getAttribute('lesson-id'));
                    });
                });
            },
            error: function (error) {
                $('.alert-danger .danger-message').html(`The lesson has not been added. Please check the data<div>Error:${error}</div>`);
                $('.alert-danger').fadeIn(1000);
                close_alert()
            }
        });
    }

    function remove_lesson(lesson_id) {
        $.ajax({
            type: 'get',
            // headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            url: relative_path + 'remove-lesson-api',
            data: {
                lesson_id: lesson_id,
            },
            success: function (data) {
                $('.alert-success .success-message').text('New lesson removed successfully');
                $('.alert-success').fadeIn(1000);
                close_alert();
                $('#lesson-' + lesson_id).fadeOut(500);
                setTimeout(() => {
                    $('#lesson-' + lesson_id).remove();
                }, 2000);
            },
            error: function (error) {
                $('.alert-danger .danger-message').html(`The lesson has not been deleted. Please check the data<div>Error:${error}</div>`);
                $('.alert-danger').fadeIn(1000);
                close_alert()
            }
        });
    }

    function close_alert() {
        setTimeout(() => {
            $('.alert').fadeOut(1000);
        }, 3000);
    }

});