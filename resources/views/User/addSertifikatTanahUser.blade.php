@extends('layouts.pengadilan')
@section('content')
    <!-- Page header -->
    <div class="page-header page-header-light shadow">
        <div class="page-header-content d-lg-flex">
            <div class="d-flex">
                <h4 class="page-title mb-0">
                    Home - <span class="fw-normal">Dashboard</span>
                </h4>

                <a href="#page_header" class="btn btn-light align-self-center collapsed d-lg-none border-transparent rounded-pill p-0 ms-auto" data-bs-toggle="collapse">
                    <i class="ph-caret-down collapsible-indicator ph-sm m-1"></i>
                </a>
            </div>
        </div>

        <div class="page-header-content d-lg-flex border-top">
            <div class="d-flex">
                <div class="breadcrumb py-2">
                    <a href="index.html" class="breadcrumb-item"><i class="ph-house"></i></a>
                    <a href="#" class="breadcrumb-item">Home</a>
                    <span class="breadcrumb-item active">Dashboard</span>
                </div>

                <a href="#breadcrumb_elements" class="btn btn-light align-self-center collapsed d-lg-none border-transparent rounded-pill p-0 ms-auto" data-bs-toggle="collapse">
                    <i class="ph-caret-down collapsible-indicator ph-sm m-1"></i>
                </a>
            </div>
        </div>
    </div>
    <!-- /page header -->
    <!-- Basic setup -->
    <div class="content">
        <div class="card">
            <div class="card-header">
                <h6 class="mb-0">Basic example</h6>
            </div>

            <form class="wizard-form steps-basic" action="#">
                <h6>Personal data</h6>
                <fieldset>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Applicant name:</label>
                                <input type="text" name="name" class="form-control" placeholder="John Doe">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Email address:</label>
                                <input type="email" name="email" class="form-control" placeholder="your@email.com">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Phone #:</label>
                                <input type="text" name="tel" class="form-control" placeholder="+99-99-9999-9999">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <label class="form-label">Date of birth:</label>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <select name="birth-month" class="form-select">
                                            <option value="1" selected>January</option>
                                            <option value="2">February</option>
                                            <option value="3">March</option>
                                            <option value="4">April</option>
                                            <option value="5">May</option>
                                            <option value="6">June</option>
                                            <option value="7">July</option>
                                            <option value="8">August</option>
                                            <option value="9">September</option>
                                            <option value="10">October</option>
                                            <option value="11">November</option>
                                            <option value="12">December</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <select name="birth-day" class="form-select">
                                            <option value="1" selected>1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="...">...</option>
                                            <option value="31">31</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <select name="birth-year" class="form-select">
                                            <option value="1" selected>1980</option>
                                            <option value="2">1981</option>
                                            <option value="3">1982</option>
                                            <option value="4">1983</option>
                                            <option value="5">1984</option>
                                            <option value="6">1985</option>
                                            <option value="7">1986</option>
                                            <option value="8">1987</option>
                                            <option value="9">1988</option>
                                            <option value="10">1989</option>
                                            <option value="11">1990</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </fieldset>

                <h6>Your experience</h6>
                <fieldset>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mt-4 mb-2 flex button_file">
                                <span class="text_button">tamplate file dapat di download disini</span>
                                <button type="button" class="btn btn-outline-primary btn-sm">
                                    <i class="ph-download ph- me-2"></i>
                                    Download file
                                </button>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Recommendations:</label>
                                <input type="file" class="form-control">
                                <span class="form-text text-muted">Accepted formats: pdf, doc. Max file size 2Mb</span>
                            </div>
                        </div>
                    </div>
                </fieldset>

                <h6>Additional info</h6>
                <fieldset>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mt-4 mb-2 flex button_file">
                                <span class="text_button">tamplate file dapat di download disini</span>
                                <button type="button" class="btn btn-outline-primary btn-sm">
                                    <i class="ph-download ph- me-2"></i>
                                    Download file
                                </button>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Recommendations:</label>
                                <input type="file" class="form-control">
                                <span class="form-text text-muted">Accepted formats: pdf, doc. Max file size 2Mb</span>
                            </div>
                        </div>
                    </div>
                </fieldset>

                <h6>Pembayaran</h6>
                <fieldset>

                </fieldset>
            </form>
        </div>
    </div>
    <!-- /basic setup -->
@endsection