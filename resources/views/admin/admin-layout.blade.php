<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300&display=swap" rel="stylesheet">

    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- Bootstrap CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>

    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>

    <!-- Bootstrap Icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    <!-- common components css -->
    <link rel="stylesheet" href="{{asset('css/components/header.css')}}">
    <link rel="stylesheet" href="{{asset('css/components/footer.css')}}">
    <link rel="stylesheet" href="{{asset('css/components/notifications.css')}}">



    <link rel="stylesheet" href="{{asset('css/admin/sidebar.css')}}">
    <link rel="stylesheet" href="{{asset('css/admin/admin-layout.css')}}">
    <link rel="stylesheet" href="{{asset('css/admin/daily-lessons.css')}}">




    @yield('head')
    @yield('style')

    <script>
        // let relative_path = 'http://31.9.57.141/laravel/Full%20Mark%20institute/Full%20Mark%20institute/public/admin/';
        let relative_path = '';
        $(document).ready(() => {
            $('.view-box').hide();
            $('.alert').hide();
            $('.btn-close').click(() => {
                $('.alert').fadeOut(200);
            });
        });
    </script>
</head>

<body style="background-image: url()">

    @include('components.header')

    <div class="container-fluid d-flex m-0 p-0 parentBox">

        <div class="sidebar">
            @include('admin.components.sidebar')
        </div>

        <div class="d-block w-100 mt-5">
            @yield('content')

            <div class="alert-message p-0 m-0">
                <div class="alert alert-warning alert-dismissible m-0" role="alert">
                    <div class="success-message"></div>
                    <button type="button" class="btn-close"></button>
                </div>
                <div class="alert alert-danger alert-dismissible m-0" role="alert">
                    <div class="success-message"></div>
                    <button type="button" class="btn-close"></button>
                </div>
                <div class="alert alert-success alert-dismissible m-0" role="alert">
                    <div class="success-message"></div>
                    <button type="button" class="btn-close"></button>
                </div>
                <div class="alert alert-info alert-dismissible m-0" role="alert">
                    <div class="success-message"></div>
                    <button type="button" class="btn-close"></button>
                </div>
            </div>
        </div>

        <div class="daily-lessons shadow">
            @include('admin.components.daily-lessons')
        </div>

    </div>


    <div class="view-box fixed-top w-100 h-100">
        <div class="view-box-content py-5">
            <div class="bi bi-x close-view-box"></div>
            <div class="content-text">
                <!-- <div class="row">
                    <div class="col-6">
                        <div class="content-section w-100 m-auto mb-3">
                            <div class="section-title border-bottom">
                                Subject
                            </div>
                            <div class="section-content ps-4 pt-2">
                                Math
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="content-section w-100 m-auto mb-3">
                            <div class="section-title border-bottom">
                                Teacher
                            </div>
                            <div class="section-content ps-4 pt-2">
                                Name: Elie Shamout
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
                                2022-10-14 17:00:00 pm
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="content-section w-100 m-auto mb-3">
                            <div class="section-title border-bottom">
                                Cost
                            </div>
                            <div class="section-content ps-4 pt-2">
                                15 (per houre)
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
                                <div class="">Name: Haya Alassaf</div>
                                <div class="">Phone: 98765472</div>
                                <div class="">Address: syria, hama, kafr buhum</div>
                            </div>
                        </div>
                    </div>
                    
                </div> -->
            </div>
        </div>
    </div>

    <!-- common components js -->
    <script src="{{asset('js/admin/daily-lessons.js')}}"></script>
    <script src="{{asset('js/components/sidebar.js')}}"></script>
    <script src="{{asset('js/components/notifications.js')}}"></script>

    @yield('script')
</body>

</html>