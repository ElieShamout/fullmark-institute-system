$(document).ready(() => {

    $(window).bind("beforeunload", function () {
        change_status_notify();
    });

    function change_status_notify() {
        $.ajax({
            type: 'get',
            url: relative_path + 'change-status-notifications-api',
            data: {
                status: 'waite'
            },
            success: function (data) {
            }
        });
    }

    function marked_notify(notify_id, notify_div) {
        $.ajax({
            type: 'get',
            url: relative_path + 'marked-notify-api',
            data: {
                notify_id: notify_id,
                status: 'marked',
            },
            success: function (data) {
                $('.view-box').fadeOut('slow');
                $('.notify-item:eq(' + notify_div + ')').remove();
                $('.notification-number').text($('.notify-item').length);
            }
        });
    }


    setInterval(() => {
        get_notification();
    }, 10000);
    get_notification();

    function get_notification() {
        $.ajax({
            type: 'get',
            url: relative_path + 'notifications-api',
            data: {},
            success: function (data) {
                if (data.length == 0 && $('.notification .notify-item').length == 0) {
                    $('.notification').html(
                        `
                            <div class="w-100 h-100 text-muted text-center notify-item py-3">
                                No new notifications
                            </div>
                        `
                    );
                    $('.notification-number').text('0');

                    return;
                }
                data.forEach((ele) => {
                    if ($('.notification .notify-item').length == 0) {
                        $('.notification').html('');
                    }
                    if (ele.status == 'waite') {
                        template = `
                        <li class="border-bottom px-2 pb-1 fw-bold notify-item" notify-id="${ele.id}" lesson-id="${ele.lesson_id}">
                        new lesson at <div>${ele.date}</div>
                        </li>`;
                        $('.notification').html(template + $('.notification').html());

                        $('.notification-number').text($('.notify-item').length);

                        $('.notify-item').each((i, ele) => {
                            $(ele).click(() => {
                                lesson_id = $(ele).attr('lesson-id');
                                $('.view-box').fadeIn('slow');
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
                                                            <div>Name: ${data.teacher_first_name} ${data.teacher_last_name}</div>
                                                            <div>Phone: ${data.teacher_phone}</div>
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
                                            <div class="row">
                                                <div class="col-12">
                                                    <button class="btn btn-danger marked-notify">Marked</button>
                                                    <button class="btn btn-primary">More</button>
                                                </div>
                                            </div>
                                        `;
                                        $('.content-text').html(template);
                                        $('.view-box').fadeIn('slow');
                                        $('.marked-notify').click(() => {
                                            marked_notify($(ele).attr('notify-id'), i);
                                            get_notification();
                                        });
                                    }
                                });


                            });
                        });

                    }
                });

            }
        });
    }

});