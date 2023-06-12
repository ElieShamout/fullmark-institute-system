@extends('admin.admin-layout')

@section('head')
<script src='https://api.mapbox.com/mapbox-gl-js/v2.10.0/mapbox-gl.js'></script>
<link href='https://api.mapbox.com/mapbox-gl-js/v2.10.0/mapbox-gl.css' rel='stylesheet' />

<script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v5.0.0/mapbox-gl-geocoder.min.js"></script>
<link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v5.0.0/mapbox-gl-geocoder.css" type="text/css">
@endsection



@section('style')
<link rel="stylesheet" href="{{asset('css/admin/new-lesson.css')}}">
<style>
    .student_name {
        position: relative;
        z-index: 10000000;
    }

    #students_list {
        position: absolute;
        top: 0;
        left: 0;
        background-color: rgb(240, 240, 240) !important;
        box-shadow: 0px 5px 5px #00000050;
        width: 95%;
        margin: 0 15px;
        z-index: 100000;
        margin-top: 40px;
        max-height: 300px;
        overflow-x: hidden;
        overflow-y: scroll;
    }

    .option-item {
        color: #444;
        border-bottom: 1px solid #333333a0;
        padding: 10px 10px;
        cursor: pointer;
    }

    .option-item:hover {
        background-color: rgb(250, 250, 250) !important;
    }
</style>
@endsection


@section('content')
<div class="lesson-section container">
    <div class="row align-items-center mb-4">
        <span class="title d-flex align-items-center border-bottom">{{__('New Lesson')}}</span>
    </div>

    <div class="lesson-form-new">
        <div class="row justify-content-center">
            <div class="form-container shadow">

                <div class="offset-box">
                    <div class="student-informatian w-100">
                        <h3 class="border-bottom">Student Information</h3>
                        <div class="row mb-4">
                            <label for="student_name" class="col-sm-12 col-form-label">{{__('Full Name')}}</label>
                            <div class="col-sm-12 position-relative">
                                <input type="text" name="" for="student_name" class="form-control student_name">
                                <div id="students_list">

                                </div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="address" class="col-sm-12 col-form-label">{{__('Address')}}</label>
                            <div class="col-sm-12" id="address-container">
                                <!-- <input type="text" name="" class="form-control address" id="address"> -->
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="near" class="col-sm-12 col-form-label">{{__('Near')}}</label>
                            <div class="col-sm-12" id="near-container">
                                <input type="text" class="form-control near">
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="phone" class="col-sm-12 col-form-label">{{__('Phone')}}</label>
                            <div class="col-sm-12">
                                <input type="text" name="" class="form-control phone" id="phone">
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="student_class" class="col-sm-12 col-form-label">{{__('Student Class')}}</label>

                            <select class="form-select student_class" name="student_class" id="student_class">
                                <option selected>Select Class</option>
                                <option value="1">1</option>
                                <option value="1">2</option>
                                <option value="1">3</option>
                                <option value="1">4</option>
                                <option value="1">5</option>
                                <option value="1">6</option>
                                <option value="2">7</option>
                                <option value="2">8</option>
                                <option value="2">9</option>
                                <option value="3">10</option>
                                <option value="3">11</option>
                                <option value="3">12</option>
                            </select>

                            <div class="row mt-3 ms-2 scientific_literary">
                                <div class="col-8 mb-1">
                                    <div class="form-check">
                                        <input class="form-check-input specialize d-none" type="radio" value="" name="specialize" id="scientific" selected>
                                        <input class="form-check-input specialize" type="radio" value="scientific" name="specialize" id="scientific">
                                        <label class="form-check-label" for="scientific">
                                            {{__('Scientific')}}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="form-check">
                                        <input class="form-check-input specialize" type="radio" value="literary" name="specialize" id="literary">
                                        <label class="form-check-label" for="literary">
                                            {{__('Literary')}}
                                        </label>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-12 me-0 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary me-0 next-btn">{{__('Next')}}</button>
                            </div>
                        </div>
                    </div>

                    <div class="lesson-booking-box w-100">
                        <h3 class="border-bottom">Lessons</h3>

                        <div class="row mb-4 lesson_name_box">

                            <label for="lesson_name" class="col-sm-12 col-form-label">{{__('Subject')}}</label>
                            <select class="form-select lesson_name" name="" id="lesson_name" require>
                                <option selected>Select Subject</option>
                                <option value="1">{{__('Math')}}</option>
                                <option value="2">{{__('Programming')}}</option>
                                <option value="3">{{__('Sciences')}}</option>
                                <option value="4">{{__('Arabic')}}</option>
                                <option value="5">{{__('English')}}</option>
                                <option value="6">{{__('physics')}}</option>
                                <option value="7">{{__('chemistry')}}</option>
                                <option value="8">{{__('French')}}</option>
                                <option value="9">{{__('geology')}}</option>
                                <option value="10">{{__('Islamic')}}</option>
                                <option value="11">{{__('philosophy')}}</option>
                                <option value="12">{{__('alive')}}</option>

                            </select>
                        </div>

                        <div class="row mb-4 p-0 m-0 number_lesson_box">
                            <label for="number_of_lesson" class="col-sm-12 col-form-label">{{__('Number Of Sessions')}}</label>
                            <input type="number" max="24" min="1" value="0" name="" class="form-control number_of_lesson" id="number_of_lesson" require>
                        </div>

                        <div class="row mb-4 p-0 m-0 lesson_date_box">
                            <label for="lessonDate" class="col-form-label">{{__('Lesson Date')}}</label>
                            <input type="datetime-local" name="lesson_date" class="form-control lesson_date" id="lessonDate" require>
                        </div>

                        <div class="row p-0 m-0 mb-4 select_lesson_teacher">
                            <label for="lesson_teacher" class="col-form-label">{{__('Techer')}}</label>
                            <select class="form-select lesson_teacher" name="" id="lesson_teacher" require>
                            </select>
                        </div>

                        <div class="row mb-4">
                            <div class="add-more-lesson mt-3 py-1">Save Subject</div>
                        </div>

                        <div class="row mb-4 px-0 mx-0">
                            <div class="lessons-selected-container">

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6 me-0 d-flex justify-content-start">
                                <button type="submit" class="btn btn-danger me-0 back-btn">{{__('Back')}}</button>
                            </div>
                            <div class="col-6 me-0 d-flex justify-content-end">
                                <button type="submit" class="btn btn-success me-0 save-btn">{{__('Save')}}</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


</div>
@endsection

@section('script')
<script src="{{asset('js/admin/new-lesson.js')}}"></script>
@endsection