$(document).ready(() => {

    $('.view-box').hide();
    $('.close-view-box').click(() => {
        $('.view-box').fadeOut(500);
    });

    icon = 'right';
    $('.daily-lessons-btn').css('transform', 'rotate(180deg)');
    $('.daily-lessons-btn').click(() => {
        if (icon == 'left') {
            icon = 'right';
            $('.daily-lessons-btn').css('transform', 'rotate(180deg)');
            $('.daily-lessons-content').animate({
                width: '60px'
            }, 1000);
        } else {
            icon = 'left';
            $('.daily-lessons-btn').css('transform', 'rotate(0deg)');
            $('.daily-lessons-content').animate({
                width: '300px'
            }, 1000);
        }
    });

    function daily_lessons() {
        $.ajax({
            type: 'get',
            url: relative_path + 'daily-lessons-api',
            data: {},
            success: function (data) {
                $('.daily-lessons-list ul').html('');
                data.forEach(element => {
                    date = new Date(element.date);
                    template = `
                        <li lesson_id='${element.id}' class='lesson-item text-dark d-flex align-items-center'>
                        <div class="date me-2 px-1 py-2">
                        ${date.getHours()}:${(date.getMinutes() == 0) ? '00' : date.getMinutes()}
                        <div class="date-border-right"></div>
                        </div>
                        <div class="desc">
                            ${element.student_name} -  ${element.student_phone}</div>
                        </li>
                        `;
                    $('.daily-lessons-list ul').html($('.daily-lessons-list ul').html() + template);
                    $('.lesson-item').each((i, ele) => {
                        $(ele).click(() => {
                            lesson_id = $(ele).attr('lesson_id');
                            $('.view-box').fadeIn('slow');

                            template = `
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="content-section w-100 m-auto mb-3">
                                                <div class="section-title border-bottom">
                                                    Subject
                                                </div>
                                                <div class="section-content ps-4 pt-2">
                                                    ${data[i].subject}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="content-section w-100 m-auto mb-3">
                                                <div class="section-title border-bottom">
                                                    Teacher
                                                </div>
                                                <div class="section-content ps-4 pt-2">
                                                    <div>Name: ${data[i].teacher_first_name} ${data[i].teacher_last_name}</div>
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
                                                    ${data[i].date}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="content-section w-100 m-auto mb-3">
                                                <div class="section-title border-bottom">
                                                    Cost
                                                </div>
                                                <div class="section-content ps-4 pt-2">
                                                    ${data[i].lesson_cost} (per houre)
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
                                                    <div class="">Name: ${data[i].student_name}</div>
                                                    <div class="">Phone: ${data[i].student_phone}</div>
                                                    <div class="">Address: ${data[i].student_address}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                `;
                            $('.content-text').html(template);
                            $('.view-box').fadeIn('slow');
                        });
                    });
                });
            }
        });
    }
    daily_lessons();
    setInterval(() => {
        daily_lessons();
    }, 10000);

});



// UPDATE `notify_lessons` SET status='waite'


// if (data.length > 0) {
//     data.forEach(element => {
//         date = new Date(element.date);
//         template = `
//         <li lesson_id='${element.id}' class='lesson-item text-dark d-flex align-items-center'>
//         <div class="date me-2 px-1 py-2">
//         ${date.getHours()}:${(date.getMinutes()==0) ? '00' : date.getMinutes()}
//         <div class="date-border-right"></div>
//         </div>
//         <div class="desc">
//             ${element.student_name} -  ${element.student_phone}</div>
//         </li>
//         `;
//         $('.daily-lessons-list ul').html($('.daily-lessons-list ul').html() + template);
//         $('.lesson-item').each((i, ele) => {
//             $(ele).click(() => {
//                 lesson_id = $(ele).attr('lesson_id');
//                 $('.view-box').fadeIn('slow');

//                 template = `
//                     <div class="row">
//                         <div class="col-6">
//                             <div class="content-section w-100 m-auto mb-3">
//                                 <div class="section-title border-bottom">
//                                     Subject
//                                 </div>
//                                 <div class="section-content ps-4 pt-2">
//                                     ${data[i].subject}
//                                 </div>
//                             </div>
//                         </div>
//                         <div class="col-6">
//                             <div class="content-section w-100 m-auto mb-3">
//                                 <div class="section-title border-bottom">
//                                     Teacher
//                                 </div>
//                                 <div class="section-content ps-4 pt-2">
//                                     <div>Name: ${data[i].teacher_first_name} ${data[i].teacher_last_name}</div>
//                                 </div>
//                             </div>
//                         </div>
//                     </div>
//                     <div class="row">
//                         <div class="col-6">
//                             <div class="content-section w-100 m-auto mb-3">
//                                 <div class="section-title border-bottom">
//                                     Lesson Date
//                                 </div>
//                                 <div class="section-content ps-4 pt-2">
//                                     ${data[i].date}
//                                 </div>
//                             </div>
//                         </div>
//                         <div class="col-6">
//                             <div class="content-section w-100 m-auto mb-3">
//                                 <div class="section-title border-bottom">
//                                     Cost
//                                 </div>
//                                 <div class="section-content ps-4 pt-2">
//                                     ${data[i].lesson_cost} (per houre)
//                                 </div>
//                             </div>
//                         </div>
//                     </div>
//                     <div class="row">
//                         <div class="col-12">
//                             <div class="content-section w-100 m-auto mb-3">
//                                 <div class="section-title border-bottom">
//                                     Student
//                                 </div>
//                                 <div class="section-content ps-4 pt-2">
//                                     <div class="">Name: ${data[i].student_name}</div>
//                                     <div class="">Phone: ${data[i].student_phone}</div>
//                                     <div class="">Address: ${data[i].student_address}</div>
//                                 </div>
//                             </div>
//                         </div>
//                     </div>
//                 `;
//                 $('.content-text').html(template);
//                 $('.view-box').fadeIn('slow');
//             });
//         });
//     });
// }