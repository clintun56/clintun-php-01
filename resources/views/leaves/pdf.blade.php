<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ใบขอลา</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Arial', sans-serif;
            font-size: 12pt;
            line-height: 1.6;
            color: #333;
        }
        .container {
            max-width: 8.5in;
            height: 11in;
            margin: 0 auto;
            padding: 40px;
            background: white;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #333;
            padding-bottom: 15px;
        }
        .header h1 {
            font-size: 18pt;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .header p {
            font-size: 11pt;
            color: #666;
        }
        .content {
            margin: 30px 0;
        }
        .form-group {
            display: flex;
            margin-bottom: 15px;
            line-height: 1.8;
        }
        .form-label {
            width: 35%;
            font-weight: bold;
            color: #333;
        }
        .form-value {
            width: 65%;
            border-bottom: 1px dotted #999;
            padding-left: 10px;
            color: #555;
        }
        .status-section {
            margin-top: 40px;
            padding: 15px;
            background: #f5f5f5;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .status-label {
            font-weight: bold;
            margin-bottom: 10px;
            color: #333;
        }
        .status-badge {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 5px;
            font-weight: bold;
            color: white;
            margin-bottom: 10px;
        }
        .status-pending {
            background-color: #ff9800;
        }
        .status-approved {
            background-color: #4caf50;
        }
        .status-rejected {
            background-color: #f44336;
        }
        .footer {
            margin-top: 50px;
            text-align: center;
            font-size: 10pt;
            color: #999;
        }
        .signature-section {
            margin-top: 40px;
            display: flex;
            justify-content: space-around;
        }
        .signature-box {
            text-align: center;
            width: 45%;
        }
        .signature-line {
            border-top: 1px solid #333;
            margin-top: 40px;
            margin-bottom: 10px;
        }
        .signature-name {
            font-size: 10pt;
        }
        table {
            width: 100%;
            margin: 20px 0;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #999;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f0f0f0;
            font-weight: bold;
        }
        @media print {
            body {
                margin: 0;
                padding: 0;
            }
            .container {
                max-width: 100%;
                height: 100%;
                padding: 20mm;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>ใบขอลา</h1>
            <p>Leave Request Form</p>
        </div>

        <!-- Main Content -->
        <div class="content">
            <!-- Requester Info -->
            <div class="form-group">
                <span class="form-label">ชื่อผู้ขอลา:</span>
                <span class="form-value">{{ $leave->user->name }}</span>
            </div>

            <div class="form-group">
                <span class="form-label">ประเภทการลา:</span>
                <span class="form-value">
                    @php
                        $leaveTypes = \App\Models\Leave::getLeaveTypes();
                    @endphp
                    {{ $leaveTypes[$leave->leave_type] ?? $leave->leave_type }}
                </span>
            </div>

            <!-- Date Information -->
            <table>
                <tr>
                    <th style="width: 40%;">วันเริ่มต้น (Start Date)</th>
                    <th style="width: 30%;">วันสิ้นสุด (End Date)</th>
                    <th style="width: 30%;">จำนวนวัน (Days)</th>
                </tr>
                <tr>
                    <td>{{ $leave->start_date->format('d/m/Y') }}</td>
                    <td>{{ $leave->end_date->format('d/m/Y') }}</td>
                    <td style="text-align: center; font-weight: bold;">{{ $leave->total_days }} วัน</td>
                </tr>
            </table>

            <!-- Reason -->
            <div class="form-group">
                <span class="form-label">เหตุผล:</span>
                <span class="form-value">{{ $leave->reason ?? '(ไม่มี)' }}</span>
            </div>

            <!-- Status Section -->
            <div class="status-section">
                <div class="status-label">สถานะการขอลา (Status):</div>
                <span class="status-badge status-{{ $leave->status }}">
                    @if ($leave->status === 'pending')
                        รอการอนุมัติ (Pending)
                    @elseif ($leave->status === 'approved')
                        อนุมัติแล้ว (Approved)
                    @elseif ($leave->status === 'rejected')
                        ปฏิเสธแล้ว (Rejected)
                    @endif
                </span>

                @if ($leave->approved_by)
                    <div style="margin-top: 10px; font-size: 11pt;">
                        <strong>ผู้อนุมัติ:</strong> {{ $leave->approver->name ?? 'N/A' }}<br>
                        @if ($leave->approved_at)
                            <strong>วันที่อนุมัติ:</strong> {{ $leave->approved_at->format('d/m/Y H:i') }}<br>
                        @endif
                        @if ($leave->approval_comment)
                            <strong>หมายเหตุ:</strong> {{ $leave->approval_comment }}<br>
                        @endif
                    </div>
                @endif
            </div>

            <!-- Signature Section -->
            <div class="signature-section">
                <div class="signature-box">
                    <div style="font-size: 11pt; margin-bottom: 20px;">ลายมือชื่อผู้ขอลา</div>
                    <div class="signature-line"></div>
                    <div class="signature-name">{{ $leave->user->name }}</div>
                    <div style="font-size: 10pt; color: #999;">วันที่ {{ now()->format('d/m/Y') }}</div>
                </div>

                <div class="signature-box">
                    <div style="font-size: 11pt; margin-bottom: 20px;">ลายมือชื่อผู้อนุมัติ</div>
                    <div class="signature-line"></div>
                    <div class="signature-name">{{ $leave->approver->name ?? '___________________' }}</div>
                    <div style="font-size: 10pt; color: #999;">วันที่ ___/___/______</div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>เอกสารนี้เป็นใบขอลารายบุคคล / This is a leave request form</p>
            <p>วันที่พิมพ์: {{ now()->format('d/m/Y H:i:s') }}</p>
        </div>
    </div>
</body>
</html>
