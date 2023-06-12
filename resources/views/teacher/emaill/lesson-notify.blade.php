<!DOCTYPE html>
<html lang="en">

<head>

    <style>
        @import url(https://fonts.googleapis.com/css?family=Nunito);

        * {
            box-sizing: border-box;
            font-family: "Nunito", sans-serif !important;
        }

        body {
            background-color: rgba(212, 212, 212, 0.696) !important;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .message-container {
            width: 90%;
            margin: auto;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            margin: 50px 0 !important;
        }

        .app_name_title {
            font-size: 30px;
            text-align: center;
            width: 100%;
            margin-bottom: 20px;
            font-weight: 800;
            color: rgba(150, 150, 150);
            border-bottom: 1px solid rgba(150, 150, 150);
        }

        .title {
            font-size: 20px;
        }

        .lesson-title {
            font-size: 18px;
            border-bottom: 1px solid rgb(223, 223, 223);
            font-weight: 600;
        }

        .lesson-box {
            width: 90%;
            margin: auto;
            padding: 10px;
            border: 2px solid rgb(223, 223, 223);
            border-radius: 10px;
        }

        .lesson-table {
            padding: 10px 20px;
        }

        .lesson-table td {
            min-height: 50px;
            height: 30px;
            width: fit-content;
            padding: 0 0 0 20px;
        }

        .row-title {
            font-weight: 600;
        }

        .visit {
            font-size: 14px;
            margin: 20px 0 0 0;
        }

        ul {
            list-style: none;
            margin: 20px 0 0 0;
            padding: 0;
        }

        ul li {
            margin-bottom: 15px;
            font-weight: 600;
            border-bottom: 1px solid #00000030;
            padding-bottom: 5px;
        }

        ul li div {
            padding: 0 0 0 20px;
            font-weight: initial;
        }
    </style>
</head>

<body>
    <div class="message-container">
        <div class="app_name_title">Full Mark Institiute</div>
        <div class="">
            <div class="title">Good morning Professor {{$mail['teacher_name']}}🌼</div>
            <p class="desc">
                We wanted to remind you that you have a lesson in an hour from now.
            </p>

            <div class="lesson-box">
                <div class="lesson-title">Lesson information</div>
                <div class="lesson-info">
                    <ul>
                        <li>Lesson Date
                            <div>- {{$mail['lesson_date']}}</div>
                        </li>
                        <li>Student Name
                            <div>- {{$mail['student_name']}}</div>
                        </li>
                        <li>Student Address
                            <div>- {{$mail['student_address']}}</div>
                        </li>
                        <li>Lesson Cost
                            <div>-
                                {{number_format((float)$mail['lesson_cost'] , 2, '.', '')}} Dinar
                                (
                                {{number_format((float)(($mail['lesson_cost']/100)*$mail['teacher_cost_rate']), 2, '.', '')}} 
                                Dinar For you and
                                {{number_format((float)($mail['lesson_cost']-($mail['lesson_cost']/100)*$mail['teacher_cost_rate']), 2, '.', '')}}
                                Dinar For institute 
                                )
                            </div>
                        </li>
                    </ul>

                </div>
            </div>

            <div class="visit">
                You can view the daily lessons for you through the following link:
                <a href="" class="ms-1">teacher.com/teacher=elieiu</a>
            </div>
        </div>
    </div>
</body>

</html>