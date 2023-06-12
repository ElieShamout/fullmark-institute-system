$(document).ready(function () {


    $('.filter-techer-name').keyup(() => {
        $.ajax({
            type: 'get',
            url: relative_path + 'filter-teacher-name',
            data: {
                full_name: $('.filter-techer-name').val()
            },
            success: function (data) {
                view_data(data);
            }
        });
    });

    $('.filter-techer-address').keyup(() => {
        $.ajax({
            type: 'get',
            url: relative_path + 'filter-teacher-address',
            data: {
                address: $('.filter-techer-address').val()
            },
            success: function (data) {
                view_data(data);
            }
        });
    });

    $('.filter-techer-sex').change(() => {
        $.ajax({
            type: 'get',
            url: relative_path + 'filter-teacher-sex',
            data: {
                sex: $('.filter-techer-sex').val()
            },
            success: function (data) {
                view_data(data);
            }
        });
    });

    $('.filter-techer-nationality').change(() => {
        $.ajax({
            type: 'get',
            url: relative_path + 'filter-teacher-nationality',
            data: {
                nationality: $('.filter-techer-nationality').val()
            },
            success: function (data) {
                view_data(data);
            }
        });
    });

    function view_data(data) {
        $('.techers-data').empty();
        data.forEach(ele => {
            template = `
                <tr class="teacher-row-${ele.id}">
                    <td>${ele.first_name} ${ele.last_name}</td>
                    <td>${ele.sex}</td>
                    <td>${ele.nationality}</td>
                    <td>${ele.phone}</td>
                    <td>${ele.whatsapp}</td>
                    <td>${ele.address}</td>
                    <td>${ele.cost}</td>
                    <td>${ele.email}</td>
                    <td>
                    
                        <button class="btn btn-danger remove-teacher" teacher-id="${ele.id}">Remove</button>
                        <button class="btn btn-primary edit-teacher disabled" teacher-id="${ele.id}">Edit</button>
                    </td>
                </tr>
            `;
            $('.techers-data').html($('.techers-data').html()+$('.teachers-data').html() + template);
        });
        // <button class="btn btn-success teacher-all-info disabled" teacher-id="${ele.id}">More</button>
        $('.remove-teacher').each((i, ele) => {
            $(ele).click(() => {
                remove_teacher($(ele).attr('teacher-id'));
            })
        });
    }

    function remove_teacher(teacher_id) {
        $.ajax({
            type: 'get',
            url: relative_path + 'delete-teacher-api',
            data: {
                teacher_id: teacher_id
            },
            success: function (data) {
                $('.teacher-row-'+teacher_id).fadeOut(500);
                setTimeout(() => {
                    $('.teacher-row-'+teacher_id).remove();
                }, 2000);
            }
        });
    }


    function get_all_techers() {
        $.ajax({
            type: 'get',
            url: relative_path + 'get-all-teachers-api',
            data: {},
            success: function (data) {
                view_data(data);
            }
        });
    }
    get_all_techers();

});