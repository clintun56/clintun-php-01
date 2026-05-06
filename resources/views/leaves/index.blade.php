
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ระบบลา - Clin tun</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('css/portfolio.css') }}" rel="stylesheet">
    <style>
        .container-custom {
            max-width: 900px;
            margin: 60px auto;
            padding: 40px;
        }
        .table-custom {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        }
        .table-custom thead {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        .badge-pending { background-color: #f59e0b; }
        .badge-approved { background-color: #10b981; }
        .badge-rejected { background-color: #ef4444; }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container">
            <a class="navbar-brand" href="/" style="color: black; font-weight: 700;">
                <i class="fas fa-code" style="color: black;"></i> Clin tun
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="/">หน้าแรก</a></li>
                    @if (session('user'))
                        <li class="nav-item" style="margin-left: 20px;">
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <i class="fas fa-user-circle" style="color: #667eea;"></i>
                                <span style="color: white; font-weight: 600;">{{ session('user')['name'] }}</span>
                            </div>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-custom">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
            <h2 style="color: #667eea; font-weight: 700; margin: 0;">
                <i class="fas fa-list"></i> ระบบขอลา
            </h2>
            <a href="{{ route('leaves.create') }}" class="btn btn-primary-custom text-white">
                <i class="fas fa-plus"></i> ขอลาใหม่
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if ($leaves->count() > 0)
            <div class="table-responsive table-custom">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th><i class="fas fa-list"></i> ประเภทลา</th>
                            <th><i class="fas fa-calendar"></i> ระยะเวลา</th>
                            <th><i class="fas fa-clock"></i> จำนวนวัน</th>
                            <th><i class="fas fa-exclamation-circle"></i> สถานะ</th>
                            <th style="text-align: center;"><i class="fas fa-cogs"></i> จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($leaves as $leave)
                            <tr>
                                <td><strong>{{ $leaveTypes[$leave->leave_type] }}</strong></td>
                                <td>{{ $leave->start_date->format('d/m/Y') }} - {{ $leave->end_date->format('d/m/Y') }}</td>
                                <td><span style="font-weight: 600; color: #667eea;">{{ $leave->total_days }} วัน</span></td>
                                <td>
                                    @if ($leave->status == 'pending')
                                        <span class="badge badge-pending"><i class="fas fa-hourglass-half"></i> รอการอนุมัติ</span>
                                    @elseif ($leave->status == 'approved')
                                        <span class="badge badge-approved"><i class="fas fa-check-circle"></i> อนุมัติแล้ว</span>
                                    @else
                                        <span class="badge badge-rejected"><i class="fas fa-times-circle"></i> ปฏิเสธแล้ว</span>
                                    @endif
                                </td>
                                <td style="text-align: center;">
                                    <a href="{{ route('leaves.show', $leave) }}" class="btn btn-sm btn-outline-primary" title="ดูรายละเอียด">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('leaves.pdf', $leave) }}" class="btn btn-sm btn-outline-success" title="ดาวน์โหลด PDF" target="_blank">
                                        <i class="fas fa-file-pdf"></i>
                                    </a>
                                    @if ($leave->status == 'pending')
                                        <a href="{{ route('leaves.edit', $leave) }}" class="btn btn-sm btn-outline-warning" title="แก้ไข">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('leaves.destroy', $leave) }}" method="POST" style="display: inline;" onsubmit="return confirm('ยืนยันการลบ?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="ลบ">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div style="text-align: center; padding: 60px 20px; background: #f8f9fa; border-radius: 10px;">
                <i class="fas fa-inbox" style="font-size: 3rem; color: #ccc; margin-bottom: 1rem;"></i>
                <p style="color: #666; font-size: 1.1rem;">ยังไม่มีการขอลา</p>
                <a href="{{ route('leaves.create') }}" class="btn btn-primary-custom text-white" style="margin-top: 1rem;">
                    <i class="fas fa-plus"></i> ขอลาใหม่
                </a>
            </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>