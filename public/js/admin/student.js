$(document).ready(function () {


    $('.filter-student-name').keyup(() => {
        $.ajax({
            type: 'get',
            url: relative_path + 'filter-student-name',
            data: {
                full_name: $('.filter-student-name').val()
            },
            success: function (data) {
                view_data(data);
            }
        });
    });

    $('.filter-student-address').keyup(() => {
        $.ajax({
            type: 'get',
            url: relative_path + 'filter-student-address',
            data: {
                address: $('.filter-student-address').val()
            },
            success: function (data) {
                view_data(data);
            }
        });
    });

    $('.filter-student-class').change(() => {
        $.ajax({
            type: 'get',
            url: relative_path + 'filter-student-class',
            data: {
                class: $('.filter-student-class option:selected').val()
            },
            success: function (data) {
                view_data(data);
            }
        });
    });

    $('.filter-student-specialization').change(() => {
        $.ajax({
            type: 'get',
            url: relative_path + 'filter-student-specialization',
            data: {
                specialization  : $('.filter-student-specialization option:selected').val()
            },
            success: function (data) {
                view_data(data);
            }
        });
    });

    function view_data(data) {
        $('.students-data').empty();
        data.forEach(ele => {
            template = `
                <tr class="student-row-${ele.id}">
                    <td>${ele.full_name}</td>
                    <td>${ele.class}</td>
                    <td>${(ele.specialization==null) ? '---' : ele.specialization}</td>
                    <td>${ele.address}</td>
                    <td>${ele.phone}</td>
                    <td>
                        <button class="btn btn-danger delete-student" student-id="${ele.id}">Delete</button>
                        <button class="btn btn-primary lesson-student disabled" student-id="${ele.id}">Edit</button>
                    </td>
                </tr>
            `;
            $('.students-data').html($('.students-data').html()+ template);
        });
        // <button class="btn btn-success student-all-info disabled" student-id="${ele.id}">Mory</button>

        $('.delete-student').each((i,ele)=>{
            $(ele).click(()=>{
                delete_student($(ele).attr('student-id'));
                $('.student-row-'+$(ele).attr('student-id')).fadeOut(500);
                setTimeout(() => {
                    $('.student-row-'+$(ele).attr('student-id')).remove();
                }, 2000);
            });
        });
    }

    function get_all_students() {
        $.ajax({
            type: 'get',
            url: relative_path + 'get-all-students-api',
            data: {},
            success: function (data) {
                view_data(data);
            }
        });
    }
    get_all_students();
    
    function delete_student(student_id) {
        $.ajax({
            type: 'get',
            url: relative_path + 'delete-student-api',
            data: {
                student_id:student_id
            },
            success: function (data) {
            }
        });
    }


});