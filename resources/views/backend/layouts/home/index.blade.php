@extends('backend.master')

@section('title')
    Admin Dashboard
@endsection

@push('styles')
    <style>
        /* ===== Dashboard Header ===== */
        .dashboard-header {
            margin-bottom: 2.5rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 2rem;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(102, 126, 234, 0.3);
            color: #fff;
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
        }

        .greeting-line {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .greeting-icon {
            display: inline-flex;
            width: 60px;
            height: 60px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            align-items: center;
            justify-content: center;
            font-size: 40px;
            flex-shrink: 0;
        }

        #greetingText {
            font-size: 1.8rem;
            font-weight: 700;
        }

        #greetingIcon.morning::before {
            content: "☀️";
        }

        #greetingIcon.afternoon::before {
            content: "🌤️";
        }

        #greetingIcon.evening::before {
            content: "🌙";
        }

        #greetingIcon.night::before {
            content: "⭐";
        }

        #currentDateTime,
        .dashboard-subtitle {
            margin-left: 45px;
            /* align with greeting text */
            opacity: 0.9;
            font-size: 1rem;
        }

        /* ===== Stat Cards ===== */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.5rem;
            margin-bottom: 3rem;
            text-align: center;
        }

        .stat-card {
            border-radius: 20px;
            padding: 2rem;
            color: #1a202c;
            background: #fff;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            text-align: center;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
        }

        .stat-card .stat-icon {
            width: 70px;
            height: 70px;
            font-size: 32px;
            margin: 0 auto 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 15px;
            background: #f1f5f9;
        }

        .stat-info p {
            font-weight: 600;
            text-transform: uppercase;
            margin-bottom: 0.5rem;
        }

        .stat-info h2 {
            font-size: 2.8rem;
            font-weight: 900;
            margin: 0;
        }

        .stat-info .stat-trend {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.4rem 0.8rem;
            background: #edf2f7;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.9rem;
            color: #4a5568;
        }

        /* ===== Tables & Content Cards ===== */
        .content-card {
            border-radius: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            padding: 2rem;
            background: #fff;
            border: 1px solid #e2e8f0;
            height: 100%;
        }

        .content-card h5 {
            font-size: 1.3rem;
            font-weight: 700;
            margin-bottom: 1rem;
            border-bottom: 3px solid #e2e8f0;
            padding-bottom: 0.75rem;
            text-align: center;
        }

        .table-modern thead {
            background: #f8fafc;
        }

        .table-modern th {
            font-weight: 700;
            color: #4a5568;
            text-align: center;
        }

        .table-modern tbody td {
            color: #2d3748;
            text-align: center;
        }

        .empty-state {
            padding: 2rem 0;
            text-align: center;
            color: #a0aec0;
        }

        /* ===== Charts ===== */
        .chart-wrapper {
            height: 340px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* ===== Responsive ===== */
        @media (max-width: 768px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }

            #greetingText {
                font-size: 1.6rem;
            }

            .stat-info h2 {
                font-size: 2rem;
            }
        }
    </style>
@endpush

@section('body')
    <!-- ===== Header ===== -->
    <div class="dashboard-header">
        <div class="greeting-line">
            <span class="greeting-icon" id="greetingIcon"></span>
            <span id="greetingText">Hello, Admin!</span>
        </div>
        <div class="greeting-line">
            <span id="currentDateTime"></span>
        </div>
        <div class="greeting-line">
            <span class="dashboard-subtitle">Here’s what’s happening with your platform today.</span>
        </div>
    </div>

    <!-- ===== Stat Cards ===== -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon">🤝</div>
            <div class="stat-info">
                <p>Total Partners</p>
                <h2>{{ number_format($totalPartners) }}</h2>
                <div class="stat-trend">⬆ Active Partners</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">👥</div>
            <div class="stat-info">
                <p>Total Employess</p>
                <h2>{{ number_format($totalEmployees) }}</h2>
                <div class="stat-trend">⬆ Team Members</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">👔</div>
            <div class="stat-info">
                <p>Total Management</p>
                <h2>{{ number_format($totalManagement) }}</h2>
                <div class="stat-trend">⬆ Management Team</div>
            </div>
        </div>
    </div>

    <!-- ===== Tables ===== -->
    <div class="row g-4 mb-4">
        <!-- Recent Partners -->
        <div class="col-lg-6">
            <div class="content-card">
                <h5>Recent Five Partners</h5>
                <div class="table-responsive">
                    <table class="table table-modern">
                        <thead>
                            <tr>
                                <th>Logo</th>
                                <th>Company</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentPartners as $partner)
                                <tr>
                                    <td>
                                        <img src="{{ $partner->logo ? asset($partner->logo) : asset('admin/assets/images/default.png') }}"
                                            alt="logo" class="rounded-circle" width="40" height="40">
                                    </td>
                                    <td>{{ $partner->company_name }}</td>
                                    <td>
                                        @if($partner->status == 1)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">Inactive</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">No partners found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Recent Contacts -->
        <div class="col-lg-6">
            <div class="content-card">
                <h5>Recent Five Contacts</h5>
                <div class="table-responsive">
                    <table class="table table-modern">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Service Type</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentContacts as $contact)
                                <tr>
                                    <td>{{ $contact->name }}</td>
                                    <td>{{ $contact->phone }}</td>
                                    <td>{{ $contact->service_type }}</td>
                                    <td>{{ $contact->created_at->format('M d, Y') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">No contacts found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- ===== Charts ===== -->
    <div class="row g-4">
        <div class="col-lg-6">
            <div class="content-card">
                <h5>Contact Overview</h5>
                <div class="chart-wrapper"><canvas id="contactChart"></canvas></div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="content-card">
                <h5>Partner Overview</h5>
                <div class="chart-wrapper"><canvas id="partnerChart"></canvas></div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <script>
        // ===== Dynamic Greeting =====
        function updateGreeting() {
            const now = new Date();
            const hour = now.getHours();
            const greetingText = document.getElementById('greetingText');
            const greetingIcon = document.getElementById('greetingIcon');
            const dateTime = document.getElementById('currentDateTime');

            greetingIcon.className = "greeting-icon"; 

            if (hour >= 5 && hour < 12) {
                greetingText.textContent = 'Good Morning, Admin!';
                greetingIcon.classList.add("morning");
            } else if (hour >= 12 && hour < 17) {
                greetingText.textContent = 'Good Afternoon, Admin!';
                greetingIcon.classList.add("afternoon");
            } else if (hour >= 17 && hour < 21) {
                greetingText.textContent = 'Good Evening, Admin!';
                greetingIcon.classList.add("evening");
            } else {
                greetingText.textContent = 'Good Night, Admin!';
                greetingIcon.classList.add("night");
            }

            dateTime.textContent = now.toLocaleString('en-US', {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });
        }

        updateGreeting();
        setInterval(updateGreeting, 60000);

        // ===== Chart 1: Contact Overview =====
        new Chart(document.getElementById('contactChart'), {
            type: 'bar',
            data: {
                labels: {!! json_encode($chartLabels) !!},
                datasets: [{
                    label: 'Contacts',
                    data: {!! json_encode($contactChartData) !!},
                    backgroundColor: ['#667eea', '#764ba2', '#11998e', '#38ef7d', '#ee0979', '#ff6a00'],
                    borderRadius: 12,
                    borderSkipped: false
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });

        // ===== Chart 2: Partner Overview =====
        new Chart(document.getElementById('partnerChart'), {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($chartLabels) !!},
                datasets: [{
                    label: 'Partners',
                    data: {!! json_encode($partnerChartData) !!},
                    backgroundColor: ['#fc4a1a', '#f7b733', '#11998e', '#38ef7d', '#667eea', '#764ba2'],
                    borderWidth: 4,
                    borderColor: '#fff'
                }]
            },
            options: {
                responsive: true,
                cutout: '70%',
                plugins: {
                    legend: {
                        position: 'bottom'
                    },
                    tooltip: {
                         callbacks: {
                            label: ctx => `${ctx.label}: ${ctx.raw.toLocaleString()}`
                        }
                    }
                }
            }
        });
    </script>
@endpush
