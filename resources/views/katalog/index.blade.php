@extends("layout.app")
@section("title", "Katalog")
@section("header", "Katalog")

@push ("css-libs")
    <meta name="csrf_token" content="{{csrf_token()}}" />
@endpush


@section("content")

<div class="header">
    <div class="left">
        <h1> @yield ("header") </h1>
        <ul class="breadcrumb">
            <li><a href="#">
                    Dashboard
                </a></li>
            /
            {{-- <li><a href="/katalog" class="active">Katalog</a></li> --}}
        </ul>
    </div>
    <a href="#" class="report">
        <i class='bx bx-cloud-download'></i>
        <span>Download CSV</span>
    </a>
</div>

<div class="row">
    <div class="col-md-4 mb-3">
        <div class="card">
            <div class="card-header">
                <h5>Judul Buku</h5>
            </div>

            <div class="d-flex card-body justify-content-center">
                <img src="https://bukukita.com/babacms/displaybuku/117226_f.jpg" alt="" width="270px" height="350px">
            </div>
            <div class="card-footer mb-3 text-end">
                <button class="btn btn-primary btn-sm" style="margin-right: 10px">Take Now</button>
                <button class="btn btn-success btn-sm">Details</button>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="card">
            <div class="card-header">
                <h5>Judul Buku</h5>
            </div>

            <div class="d-flex card-body justify-content-center">
                <img src="https://bukukita.com/babacms/displaybuku/117226_f.jpg" alt="" width="270px" height="350px">
            </div>
            <div class="card-footer mb-3 text-end">
                <button class="btn btn-primary btn-sm" style="margin-right: 10px">Take Now</button>
                <button class="btn btn-success btn-sm">Details</button>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="card">
            <div class="card-header">
                <h5>Judul Buku</h5>
            </div>

            <div class="d-flex card-body justify-content-center">
                <img src="https://bukukita.com/babacms/displaybuku/117226_f.jpg" alt="" width="270px" height="350px">
            </div>
            <div class="card-footer mb-3 text-end">
                <button class="btn btn-primary btn-sm" style="margin-right: 10px">Take Now</button>
                <button class="btn btn-success btn-sm">Details</button>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="card">
            <div class="card-header">
                <h5>Judul Buku</h5>
            </div>

            <div class="d-flex card-body justify-content-center">
                <img src="https://bukukita.com/babacms/displaybuku/117226_f.jpg" alt="" width="270px" height="350px">
            </div>
            <div class="card-footer mb-3 text-end">
                <button class="btn btn-primary btn-sm" style="margin-right: 10px">Take Now</button>
                <button class="btn btn-success btn-sm">Details</button>
            </div>
        </div>
    </div>
</div>
@endsection

<!-- <ul class="insights">
    <li>
        <i class='bx bx-calendar-check'></i>
        <span class="info">
            <h3>
                1,074
            </h3>
            <p>Paid Order</p>
        </span>
    </li>
    <li><i class='bx bx-show-alt'></i>
        <span class="info">
            <h3>
                3,944
            </h3>
            <p>Site Visit</p>
        </span>
    </li>
    <li><i class='bx bx-line-chart'></i>
        <span class="info">
            <h3>
                14,721
            </h3>
            <p>Searches</p>
        </span>
    </li>
    <li><i class='bx bx-dollar-circle'></i>
        <span class="info">
            <h3>
                $6,742
            </h3>
            <p>Total Sales</p>
        </span>
    </li>
</ul> -->
<!-- End of Insights -->

{{-- <div class="bottom-data">
    <div class="orders">
        <div class="header">
            <i class='bx bx-receipt'></i>
            <h3>Recent Orders</h3>
            <i class='bx bx-filter'></i>
            <i class='bx bx-search'></i>
        </div>
        <table>
            <thead>
                <tr>
                    <th>User</th>
                    <th>Order Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <img src="images/profile-1.jpg">
                        <p>John Doe</p>
                    </td>
                    <td>14-08-2023</td>
                    <td><span class="status completed">Completed</span></td>
                </tr>
                <tr>
                    <td>
                        <img src="images/profile-1.jpg">
                        <p>John Doe</p>
                    </td>
                    <td>14-08-2023</td>
                    <td><span class="status pending">Pending</span></td>
                </tr>
                <tr>
                    <td>
                        <img src="images/profile-1.jpg">
                        <p>John Doe</p>
                    </td>
                    <td>14-08-2023</td>
                    <td><span class="status process">Processing</span></td>
                </tr>
            </tbody>
        </table>
    </div> --}}

    {{-- <!-- Reminders -->
    <div class="reminders">
        <div class="header">
            <i class='bx bx-note'></i>
            <h3>Remiders</h3>
            <i class='bx bx-filter'></i>
            <i class='bx bx-plus'></i>
        </div>
        <ul class="task-list">
            <li class="completed">
                <div class="task-title">
                    <i class='bx bx-check-circle'></i>
                    <p>Start Our Meeting</p>
                </div>
                <i class='bx bx-dots-vertical-rounded'></i>
            </li>
            <li class="completed">
                <div class="task-title">
                    <i class='bx bx-check-circle'></i>
                    <p>Analyse Our Site</p>
                </div>
                <i class='bx bx-dots-vertical-rounded'></i>
            </li>
            <li class="not-completed">
                <div class="task-title">
                    <i class='bx bx-x-circle'></i>
                    <p>Play Footbal</p>
                </div>
                <i class='bx bx-dots-vertical-rounded'></i>
            </li>
        </ul>
    </div>
    <!-- End of Reminders--> --}}