@extends('admin.layout')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-center"><i class="fa-solid fa-chart-line"></i> Admin Dashboard</h2>

    <div class="row g-4">
        <div class="col-md-3">
            <div class="card text-white bg-primary shadow-lg p-3">
                <div class="card-body text-center">
                    <i class="fa-solid fa-users fa-3x mb-3"></i>
                    <h5>Total Users</h5>
                    <h3>{{ \App\Models\User::count() }}</h3>
                    <div class="progress mt-2" style="height: 6px;">
                        <div class="progress-bar bg-light" role="progressbar" style="width: {{ (\App\Models\User::count() / 10) * 100 }}%;" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-success shadow-lg p-3">
                <div class="card-body text-center">
                    <i class="fa-solid fa-boxes fa-3x mb-3"></i>
                    <h5>Total Products</h5>
                    <h3>{{ \App\Models\Product::count() }}</h3>
                    <div class="progress mt-2" style="height: 6px;">
                        <div class="progress-bar bg-light" role="progressbar" style="width: {{ (\App\Models\Product::count() / 10) * 100 }}%;" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-warning shadow-lg p-3">
                <div class="card-body text-center">
                    <i class="fa-solid fa-user-shield fa-3x mb-3"></i>
                    <h5>Total Roles</h5>
                    <h3>{{ \App\Models\Role::count() }}</h3>
                    <div class="progress mt-2" style="height: 6px;">
                        <div class="progress-bar bg-light" role="progressbar" style="width: {{ (\App\Models\Role::count() / 10) * 100 }}%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-danger shadow-lg p-3">
                <div class="card-body text-center">
                    <i class="fa-solid fa-key fa-3x mb-3"></i>
                    <h5>Total Permissions</h5>
                    <h3>{{ \App\Models\Permission::count() }}</h3>
                    <div class="progress mt-2" style="height: 6px;">
                        <div class="progress-bar bg-light" role="progressbar" style="width: {{ (\App\Models\Permission::count() / 10) * 100 }}%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-md-8 mx-auto">
            <div class="card shadow-lg p-4">
                <h5 class="text-center"><i class="fa-solid fa-chart-bar"></i> User & Product Statistics</h5>
                <canvas id="dashboardChart"></canvas>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    var ctx = document.getElementById("dashboardChart").getContext("2d");
    new Chart(ctx, {
        type: "bar",
        data: {
            labels: ["Users", "Products", "Roles", "Permissions"],
            datasets: [{
                label: "Count",
                data: [
                    {{ \App\Models\User::count() }},
                    {{ \App\Models\Product::count() }},
                    {{ \App\Models\Role::count() }},
                    {{ \App\Models\Permission::count() }}
                ],
                backgroundColor: ["#007bff", "#28a745", "#ffc107", "#dc3545"],
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true,
                    position: 'top',
                },
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
});
</script>
@endsection
