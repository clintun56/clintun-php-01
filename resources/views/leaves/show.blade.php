<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายละเอียดการขอลา</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px 0;
        }
        .navbar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .navbar-brand {
            font-weight: bold;
            color: #667eea !important;
        }
        .container {
            max-width: 700px;
            margin-top: 30px;
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.95);
        }
        .card-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 15px 15px 0 0 !important;
            padding: 20px;
        }
        .card-title {
            font-size: 1.5rem;
            font-weight: bold;
            margin: 0;
        }
        .detail-row {
            display: flex;
            padding: 15px 0;
            border-bottom: 1px solid #eee;
        }
        .detail-row:last-child {
            border-bottom: none;
        }
        .detail-label {
            font-weight: 600;
            color: #667eea;
            min-width: 150px;
        }
        .detail-value {
            color: #333;
            flex: 1;
        }
        .badge-pending {
            background-color: #ffc107;
            color: #000;
        }
        .badge-approved {
            background-color: #28a745;
        }
        .badge-rejected {
            background-color: #dc3545;
        }
        .btn-group-vertical {
            gap: 10px;
        }
        .btn {
            border-radius: 8px;
            padding: 10px 20px;
            font-weight: 500;
        }
        .nav-link {
            color: #667eea !important;
            margin: 0 10px;
            transition: all 0.3s;
        }
        .nav-link:hover {
            color: #764ba2 !important;
            text-decoration: underline;
        }
        .pdf-preview-modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            /* max-width: 1500px; */
            background-color: rgba(0, 0, 0, 0.7);
            padding: 0;
        }
        .pdf-preview-modal.show {
            display: flex;
        }
        .pdf-preview-content {
            background-color: #fefefe;
            margin: auto;
            padding: 0 ;
            border-radius: 15px;
            width: 100%;
            max-width: 1300px;
            height: 100%;
            max-height: 800px;
            display: flex;
            flex-direction: column;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }
        .pdf-preview-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 20px;
            border-bottom: 1px solid #eee;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 15px 15px 0 0;
        }
        .pdf-preview-body {
            flex: 1;
            overflow: hidden;
        }
        .pdf-preview-body iframe {
            width: 100%;
            height: 100%;
            border: none;
        }
        .pdf-preview-footer {
            display: flex;
            gap: 10px;
            padding: 15px 20px;
            border-top: 1px solid #eee;
            background: #f8f9fa;
            border-radius: 0 0 15px 15px;
        }
        .pdf-preview-footer button {
            flex: 1;
            padding: 10px 20px;
            font-weight: 500;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s;
        }
        .pdf-preview-footer .btn-close {
            background: #6c757d;
            color: white;
        }
        .pdf-preview-footer .btn-close:hover {
            background: #5a6268;
        }
        .pdf-preview-footer .btn-download {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        .pdf-preview-footer .btn-download:hover {
            opacity: 0.9;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">
                <i class="fas fa-leaf"></i> Clin tun
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="/">หน้าแรก</a></li>
                    <li class="nav-item"><a class="nav-link" href="/#skills">ทักษะ</a></li>
                    <li class="nav-item"><a class="nav-link" href="/#services">บริการ</a></li>
                    <li class="nav-item"><a class="nav-link" href="/#contact">ติดต่อ</a></li>
                    @if (session('user'))
                        <li class="nav-item"><a class="nav-link" href="{{ route('leaves.index') }}"><i class="fas fa-file-alt"></i> ระบบลา</a></li>
                    @endif
                </ul>
                @if (session('user'))
                    <div style="display: flex; align-items: center; gap: 15px;">
                        <div style="display: flex; align-items: center; gap: 10px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 8px 15px; border-radius: 20px; color: white;">
                            <img 
                                id="userAvatarShow"
                                src="{{ session('user')['avatar'] }}" 
                                alt="{{ session('user')['name'] }}" 
                                style="width: 32px; height: 32px; border-radius: 50%; object-fit: cover; border: 2px solid white;"
                                onerror="this.style.display='none'; document.getElementById('userAvatarFallbackShow').style.display='inline';"
                            >
                            <i id="userAvatarFallbackShow" class="fas fa-user-circle" style="color: white; display: none; font-size: 1.2rem;"></i>
                            <span style="font-weight: 600;">{{ session('user')['name'] }}</span>
                        </div>
                        <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger btn-sm">
                                <i class="fas fa-sign-out-alt"></i> ออก
                            </button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">
                    <i class="fas fa-file-alt"></i> รายละเอียดการขอลา
                </h5>
            </div>
            <div class="card-body p-4">
                <!-- Status Badge -->
                <div style="margin-bottom: 20px; text-align: center;">
                    @if ($leave->status === 'pending')
                        <span class="badge badge-pending" style="font-size: 0.95rem;">
                            <i class="fas fa-hourglass-half"></i> รอการอนุมัติ
                        </span>
                    @elseif ($leave->status === 'approved')
                        <span class="badge badge-approved" style="font-size: 0.95rem;">
                            <i class="fas fa-check-circle"></i> อนุมัติแล้ว
                        </span>
                    @elseif ($leave->status === 'rejected')
                        <span class="badge badge-rejected" style="font-size: 0.95rem;">
                            <i class="fas fa-times-circle"></i> ปฏิเสธแล้ว
                        </span>
                    @endif
                </div>

                <!-- Leave Details -->
                <div class="detail-row">
                    <span class="detail-label"><i class="fas fa-list"></i> ประเภทการลา:</span>
                    <span class="detail-value">
                        @php
                            $leaveTypes = \App\Models\Leave::getLeaveTypes();
                        @endphp
                        {{ $leaveTypes[$leave->leave_type] ?? $leave->leave_type }}
                    </span>
                </div>

                <div class="detail-row">
                    <span class="detail-label"><i class="fas fa-calendar-alt"></i> วันเริ่มต้น:</span>
                    <span class="detail-value">{{ $leave->start_date->format('d/m/Y') }}</span>
                </div>

                <div class="detail-row">
                    <span class="detail-label"><i class="fas fa-calendar-alt"></i> วันสิ้นสุด:</span>
                    <span class="detail-value">{{ $leave->end_date->format('d/m/Y') }}</span>
                </div>

                <div class="detail-row">
                    <span class="detail-label"><i class="fas fa-calculator"></i> จำนวนวัน:</span>
                    <span class="detail-value"><strong>{{ $leave->total_days }} วัน</strong></span>
                </div>

                <div class="detail-row">
                    <span class="detail-label"><i class="fas fa-sticky-note"></i> เหตุผล:</span>
                    <span class="detail-value">{{ $leave->reason ?? '(ไม่มี)' }}</span>
                </div>

                @if ($leave->status !== 'pending')
                    @if ($leave->approved_by)
                        <div class="detail-row">
                            <span class="detail-label"><i class="fas fa-user-check"></i> ผู้อนุมัติ:</span>
                            <span class="detail-value">{{ $leave->approver->name ?? 'N/A' }}</span>
                        </div>
                    @endif

                    @if ($leave->approved_at)
                        <div class="detail-row">
                            <span class="detail-label"><i class="fas fa-clock"></i> วันที่อนุมัติ:</span>
                            <span class="detail-value">{{ $leave->approved_at->format('d/m/Y H:i') }}</span>
                        </div>
                    @endif

                    @if ($leave->approval_comment)
                        <div class="detail-row">
                            <span class="detail-label"><i class="fas fa-comment"></i> หมายเหตุ:</span>
                            <span class="detail-value">{{ $leave->approval_comment }}</span>
                        </div>
                    @endif
                @endif

                <!-- Action Buttons -->
                <div style="margin-top: 30px; display: flex; gap: 10px; justify-content: center;">
                    <a href="{{ route('leaves.index') }}" class="btn btn-outline-primary">
                        <i class="fas fa-arrow-left"></i> กลับไป
                    </a>

                    <button type="button" class="btn btn-outline-success" onclick="openPdfPreview('{{ route('leaves.pdf-view', $leave) }}', '{{ route('leaves.pdf', $leave) }}')">
                        <i class="fas fa-file-pdf"></i> ดูตัวอย่าง PDF
                    </button>

                    @if ($leave->status === 'pending' && $leave->user_id === session('user')['id'])
                        <a href="{{ route('leaves.edit', $leave) }}" class="btn btn-warning text-white">
                            <i class="fas fa-edit"></i> แก้ไข
                        </a>
                        <form method="POST" action="{{ route('leaves.destroy', $leave) }}" style="display: inline;" onsubmit="return confirm('ยืนยันการลบ?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-trash"></i> ลบ
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- PDF Preview Modal -->
    <div id="pdfPreviewModal" class="pdf-preview-modal">
        <div class="pdf-preview-content">
            <div class="pdf-preview-header">
                <h5 style="margin: 0;">
                    <i class="fas fa-file-pdf"></i> ตัวอย่าง PDF
                </h5>
                <button type="button" style="background: none; border: none; color: white; font-size: 1.5rem; cursor: pointer;" onclick="closePdfPreview()">
                    &times;
                </button>
            </div>
            <div class="pdf-preview-body">
                <iframe id="pdfFrame" src=""></iframe>
            </div>
            <div class="pdf-preview-footer">
                <button class="btn-close" onclick="closePdfPreview()">
                    <i class="fas fa-times"></i> ปิด
                </button>
                <button class="btn-download" id="downloadBtn" type="button">
                    <i class="fas fa-download"></i> ดาวน์โหลด
                </button>
            </div>
        </div>
    </div>

    <script>
        let pdfViewUrl = '';
        let pdfDownloadUrl = '';

        function openPdfPreview(viewUrl, downloadUrl) {
            pdfViewUrl = viewUrl;
            pdfDownloadUrl = downloadUrl;
            document.getElementById('pdfFrame').src = viewUrl;
            document.getElementById('pdfPreviewModal').classList.add('show');
            document.body.style.overflow = 'hidden';
            
            // Set download button
            document.getElementById('downloadBtn').onclick = function() {
                const link = document.createElement('a');
                link.href = downloadUrl;
                link.download = 'leave_' + new Date().getTime() + '.pdf';
                link.target = '_blank';
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            };
        }

        function closePdfPreview() {
            document.getElementById('pdfPreviewModal').classList.remove('show');
            document.getElementById('pdfFrame').src = '';
            document.body.style.overflow = 'auto';
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            const modal = document.getElementById('pdfPreviewModal');
            if (event.target === modal) {
                closePdfPreview();
            }
        };
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
