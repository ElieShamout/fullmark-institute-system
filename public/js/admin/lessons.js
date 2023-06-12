$(document).ready(function () {


    $('.filter-lesson-teacher-name').keyup(() => {
        $.ajax({
            type: 'get',
            url: relative_path + 'filter-lesson-teacher-name',
            data: {
                teacher_name: $('.filter-lesson-teacher-name').val()
            },
            success: function (data) {
                view_data(data);
            }
        });
    });

    $('.filter-lesson-student-name').keyup(() => {
        $.ajax({
            type: 'get',
            url: relative_path + 'filter-lesson-student-name',
            data: {
                student_name: $('.filter-lesson-student-name').val()
            },
            success: function (data) {
                view_data(data);
            }
        });
    });

    $('.filter-subject').change(() => {
        $.ajax({
            type: 'get',
            url: relative_path + 'filter-subject',
            data: {
                subject: $('.filter-subject option:selected').val()
            },
            success: function (data) {
                view_data(data);
            }
        });
    });

    $('.filter-lesson-date').change(() => {
        $.ajax({
            type: 'get',
            url: relative_path + 'filter-lesson-date',
            data: {
                date: $('.filter-lesson-date').val()
            },
            success: function (data) {
                view_data(data);
            }
        });
    });

    function view_data(data) {
        $('.lessons-data').empty();
        data.forEach(ele => {
            template = `
                <tr class="lesson-row-${ele.id}">
                    <td>${ele.id}</td>
                    <td>${ele.teacher_first_name + ' ' + ele.teacher_first_name}</td>
                    <td>${ele.student_name}</td>
                    <td>${ele.subject}</td>
                    <td>${ele.number_of_lesson}</td>
                    <td>${ele.note}</td>
                    <td>${ele.date}</td>
                    <td>${ele.status}</td>
                    <td>
                        <button class="btn btn-success lesson-info" lesson-id="${ele.id}">More</button>
                        <button class="btn btn-danger delete-lesson" lesson-id="${ele.id}">Delete</button>
                        <button class="btn btn-primary edit-lesson disabled" lesson-id="${ele.id}">Edit</button>
                        <a href="new-payment-view/${ele.id}">
                            <button class="btn btn-warning text-light">Paymnet</button>
                        </a>
                    </td>
                </tr>
            `;
            $('.lessons-data').html($('.lessons-data').html() + template);
        });

        $('.delete-lesson').each((i, ele) => {
            $(ele).click(() => {
                delete_lesson($(ele).attr('lesson-id'));
                $('.lesson-row-' + $(ele).attr('lesson-id')).fadeOut(500);

            });
        });

        $('.lesson-info').each((i, ele) => {
            $(ele).click(() => {
                lesson_info($(ele).attr('lesson-id'));
            });
        });
    }

    function lesson_info(lesson_id) {
        $.ajax({
            type: 'get',
            url: relative_path + 'lesson-info-api',
            data: {
                lesson_id: lesson_id
            },
            success: function (data) {
                template = `
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="content-section w-100 m-auto mb-3">
                                                <div class="section-title border-bottom">
                                                    Subject
                                                </div>
                                                <div class="section-content ps-4 pt-2">
                                                    ${data.subject}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="content-section w-100 m-auto mb-3">
                                                <div class="section-title border-bottom">
                                                    Teacher
                                                </div>
                                                <div class="section-content ps-4 pt-2">
                                                    Name: ${data.teacher_first_name} ${data.teacher_last_name}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="content-section w-100 m-auto mb-3">
                                                <div class="section-title border-bottom">
                                                    Lesson Date
                                                </div>
                                                <div class="section-content ps-4 pt-2">
                                                    ${data.date}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="content-section w-100 m-auto mb-3">
                                                <div class="section-title border-bottom">
                                                    Cost
                                                </div>
                                                <div class="section-content ps-4 pt-2">
                                                    ${data.lesson_cost} (per houre)
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="content-section w-100 m-auto mb-3">
                                                <div class="section-title border-bottom">
                                                    Student
                                                </div>
                                                <div class="section-content ps-4 pt-2">
                                                    <div class="">Name: ${data.student_name}</div>
                                                    <div class="">Phone: ${data.student_phone}</div>
                                                    <div class="">Address: ${data.student_address}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                `;
                $('.content-text').html(template);
                $('.view-box').fadeIn('slow');
            }
        })
    }

    function get_all_lessons() {
        $.ajax({
            type: 'get',
            url: relative_path + 'get-all-lessons-api',
            data: {},
            success: function (data) {
                view_data(data);
            }
        });
    }
    get_all_lessons();

    function delete_lesson(lesson_id) {
        $.ajax({
            type: 'get',
            url: relative_path + 'delete-lesson-api',
            data: {
                lesson_id: lesson_id
            },
            success: function (data) {
            }
        });
    }


    // function add_payment_lesson(lesson_id,link,date,status,image) {
    //     let reader = new FileReader();

    //     reader.onload = (e) => { 
    //         $('#preview-image').attr('src', e.target.result); 
    //     }   

    //     reader.readAsDataURL(this.files[0]); 

    //     $.ajax({
    //         type: 'get',
    //         url: relative_path + 'add-payment-lesson-api',
    //         'Content-Type': 'application/x-www-form-urlencoded;charset=UTF-8',
    //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
    //         enctype: 'multipart/form-data',
    //         dataType: 'json',
    //         data: {
    //             lesson_id: lesson_id,
    //             link: link,
    //             date: date,
    //             status: status,
    //             image: image
    //         },
    //         success: function (data) {
    //             console.log(data);
    //         }
    //     });
    // }
});