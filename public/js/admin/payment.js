$(document).ready(function () {


    function view_data(data) {
        $('.payments-data').empty();
        data.forEach(ele => {
            template = `
                <tr class="payment-row-${ele.id}">
                    <td><a href="${ele.link}" target="_blank">${ele.link}</a></td>
                    <td>
                        ${(ele.status != 'cancellation') ? '<span class="text-success">' + ele.status + "</span>" : '<span class="text-danger">' + ele.status + "</span>"}
                    </td>
                    <td>${(ele.note != null) ? ele.note : ''}</td>
                    <td>${ele.date}</td>
                    <td>
                        <button class="btn btn-success payment-all-info" payment-id="${ele.lesson_id}">Mory</button>
                        <button class="btn btn-danger delete-payment" payment-id="${ele.id}">Delete</button>
                        <button class="btn btn-primary lesson-payment disabled" payment-id="${ele.id}">Edit</button>
                    </td>
                </tr>
            `;
            $('.payments-data').html($('.payments-data').html() + template);
        });

        $('.delete-payment').each((i, ele) => {
            $(ele).click(() => {
                delete_payment($(ele).attr('payment-id'));
                $('.payment-row-' + $(ele).attr('payment-id')).fadeOut(500);
                setTimeout(() => {
                    $('.payment-row-' + $(ele).attr('payment-id')).remove();
                }, 2000);
            });
        });

        $('.payment-all-info').each((i, ele) => {
            $(ele).click(() => {
                lesson_id = $(ele).attr('payment-id');
                get_lessons_info(lesson_id);
            });
        });
    }

    function get_all_payments() {
        $.ajax({
            type: 'get',
            url: relative_path + 'get-all-payments-api',
            data: {},
            success: function (data) {
                view_data(data);
            }
        });
    }
    get_all_payments();


    function get_lessons_info(lesson_id) {
        $.ajax({
            type: 'get',
            url: relative_path + 'payment-info-api',
            data: {
                lesson_id: lesson_id
            },
            success: function (data) {
                console.log('00');
                console.log(data);
                template = `
                    <div class="row mb-3">
                        <div class="col-md-6 col-12">
                            <div class="content-section w-100 m-auto mb-3">
                                <div class="section-title border-bottom">
                                    Payment
                                </div>
                                <div class="section-content ps-4 pt-2">
                                    <table>
                                    <tbody>
                                    <tr>
                                        <td class="fw-bold pe-4">Link: </td>
                                        <td><a href="{{url(${data.link})}}">${data.link}</a></td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Status: </td>
                                        <td>${data.status}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Note: </td>
                                        <td>${data.note}</td>
                                    </tr>
                                    </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-12 overflow-hidden" style="max-height:150px">
                            <a href="http://127.0.0.1:8000/images/payments/1665594617.png" target="_blank" >
                            <img style="width:100%;object-fit: cover;" src="../images/payments/${data.imageURL}"/>
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="content-section w-100 m-auto mb-3">
                                <div class="section-title border-bottom">
                                    Subject
                                </div>
                                <div class="section-content ps-4 pt-2">
                                    ${data.subject}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
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
                        <div class="col-md-6 col-12">
                            <div class="content-section w-100 m-auto mb-3">
                                <div class="section-title border-bottom">
                                    Lesson Date
                                </div>
                                <div class="section-content ps-4 pt-2">
                                    ${data.date}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
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
        });
    }

    function delete_payment(payment_id) {
        $.ajax({
            type: 'get',
            url: relative_path + 'delete-payment-api',
            data: {
                payment_id: payment_id
            },
            success: function (data) {
            }
        });
    }


    $('.filter-payment-status').change(() => {
        $.ajax({
            type: 'get',
            url: relative_path + 'filter-payment-status',
            data: {
                status: $('.filter-payment-status option:selected').val()
            },
            success: function (data) {
                view_data(data);
            }
        });
    });

    $('.filter-payment-date').change(() => {
        $.ajax({
            type: 'get',
            url: relative_path + 'filter-payment-date',
            data: {
                date: $('.filter-payment-date').val()
            },
            success: function (data) {
                view_data(data);
            }
        });
    });

});