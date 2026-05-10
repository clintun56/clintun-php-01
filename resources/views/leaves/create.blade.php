<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ขอลา - Clin tun</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('css/portfolio.css') }}" rel="stylesheet">
    <style>
        .form-container {
            max-width: 600px;
            margin: 60px auto;
            padding: 40px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }
        .form-title {
            color: #667eea;
            font-weight: 700;
            margin-bottom: 2rem;
        }
        .form-group label {
            font-weight: 600;
            color: #1a1a2e;
            margin-bottom: 0.7rem;
        }
        .form-control {
            border: 1.5px solid rgba(102, 126, 234, 0.2);
            border-radius: 8px;
            padding: 10px 15px;
            transition: all 0.3s ease;
        }
        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
        .btn-submit {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            font-weight: 600;
            padding: 12px 35px;
            margin-top: 1rem;
            width: 100%;
        }
        .alert {
            border-radius: 8px;
            border: none;
        }
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
                        <li class="nav-item"><a class="nav-link" href="{{ route('leaves.index') }}">ระบบลา</a></li>
                        <li class="nav-item" style="margin-left: 20px;">
                            <div style="display: flex; align-items: center; gap: 10px; background: linear-gradient(135deg, rgba(102, 126, 234, 0.15) 0%, rgba(240, 147, 251, 0.15) 100%); padding: 8px 16px; border-radius: 20px;">
                                <img 
                                    id="userAvatarCreate"
                                    src="{{ session('user')['avatar'] }}" 
                                    alt="{{ session('user')['name'] }}" 
                                    style="width: 32px; height: 32px; border-radius: 50%; object-fit: cover; border: 2px solid #667eea;"
                                    onerror="this.style.display='none'; document.getElementById('userAvatarFallbackCreate').style.display='inline';"
                                >
                                <i id="userAvatarFallbackCreate" class="fas fa-user-circle" style="color: #667eea; display: none;"></i>
                                <span style="color: white; font-weight: 600;">{{ session('user')['name'] }}</span>
                            </div>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <div class="form-container">
        <h2 class="form-title"><i class="fas fa-file-alt"></i> ขอลา</h2>

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show">
                <strong>ข้อผิดพลาด:</strong>
                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <form action="{{ route('leaves.store') }}" method="POST">
            @csrf

            <!-- ชื่อผู้ขอลา (แสดงเท่านั้น) -->
            <div class="form-group mb-4">
                <label for="user_name"><i class="fas fa-user"></i> ชื่อผู้ขอลา</label>
                <input type="text" class="form-control" id="user_name" value="{{ $user->name }}" readonly style="background-color: #f8f9fa;">
            </div>

            <!-- ประเภทการลา -->
            <div class="form-group mb-4">
                <label for="leave_type"><i class="fas fa-list"></i> ประเภทการลา</label>
                <select class="form-control @error('leave_type') is-invalid @enderror" id="leave_type" name="leave_type" required>
                    <option value="">-- เลือกประเภทการลา --</option>
                    @foreach ($leaveTypes as $key => $label)
                        <option value="{{ $key }}" {{ old('leave_type') == $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @error('leave_type')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- วันที่เริ่มต้น -->
            <div class="form-group mb-4">
                <label for="start_date"><i class="fas fa-calendar"></i> วันที่เริ่มต้น</label>
                <input type="date" class="form-control @error('start_date') is-invalid @enderror" id="start_date" name="start_date" required value="{{ old('start_date') }}">
                @error('start_date')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- วันที่สิ้นสุด -->
            <div class="form-group mb-4">
                <label for="end_date"><i class="fas fa-calendar"></i> วันที่สิ้นสุด</label>
                <input type="date" class="form-control @error('end_date') is-invalid @enderror" id="end_date" name="end_date" required value="{{ old('end_date') }}">
                @error('end_date')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- จำนวนวัน (แสดงเท่านั้น) -->
            <div class="form-group mb-4">
                <label for="total_days"><i class="fas fa-hourglass-half"></i> จำนวนวัน</label>
                <input type="number" class="form-control" id="total_days" readonly style="background-color: #f8f9fa; font-weight: 600; color: #667eea;">
            </div>

            <!-- เหตุผล -->
            <div class="form-group mb-4">
                <label for="reason"><i class="fas fa-pen"></i> เหตุผล (ถ้ามี)</label>
                <textarea class="form-control @error('reason') is-invalid @enderror" id="reason" name="reason" rows="4" placeholder="บอกเราถึงเหตุผลในการลา" style="resize: vertical;">{{ old('reason') }}</textarea>
                @error('reason')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- ปุ่ม -->
            <div class="row mt-5">
                <div class="col-6">
                    <a href="{{ route('leaves.index') }}" class="btn btn-outline-secondary w-100">
                        <i class="fas fa-arrow-left"></i> กลับ
                    </a>
                </div>
                <div class="col-6">
                    <button type="submit" class="btn btn-primary-custom btn-submit text-white">
                        <i class="fas fa-paper-plane"></i> ส่งขอลา
                    </button>
                </div>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // คำนวณจำนวนวันอัตโนมัติ
        const startDateInput = document.getElementById('start_date');
        const endDateInput = document.getElementById('end_date');
        const totalDaysInput = document.getElementById('total_days');

        function calculateDays() {
            if (startDateInput.value && endDateInput.value) {
                const start = new Date(startDateInput.value);
                const end = new Date(endDateInput.value);
                const days = Math.ceil((end - start) / (1000 * 60 * 60 * 24)) + 1;
                totalDaysInput.value = days > 0 ? days : 0;
            }
        }

        startDateInput.addEventListener('change', calculateDays);
        endDateInput.addEventListener('change', calculateDays);
    </script>
</body>
</html>