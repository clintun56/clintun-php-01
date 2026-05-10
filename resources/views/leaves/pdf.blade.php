<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>ใบขอลา</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: dejavusans;
            font-size: 10pt;
            line-height: 1.3;
            color: #000;
            background: white;
        }
        
        .page {
            width: 21cm;
            height: 29.7cm;
            padding: 10mm 12mm;
            margin: 0 auto;
            background: white;
            display: flex;
            flex-direction: column;
        }
        
        .header {
            text-align: center;
            border-bottom: 1.5px solid #000;
            padding-bottom: 5px;
            margin-bottom: 8px;
        }
        
        .header h1 {
            font-size: 12pt;
            font-weight: bold;
            margin: 0;
        }
        
        .header p {
            font-size: 8pt;
            color: #666;
            margin: 1px 0 0 0;
        }
        
        .section {
            margin-bottom: 6px;
        }
        
        .section-title {
            font-weight: bold;
            background: #f0f0f0;
            padding: 3px 5px;
            margin-bottom: 4px;
            font-size: 9pt;
        }
        
        .row {
            margin-bottom: 3px;
        }
        
        .label {
            font-weight: bold;
            width: 30%;
            display: inline-block;
            padding-right: 5px;
            font-size: 9pt;
        }
        
        .value {
            width: 65%;
            display: inline-block;
            border-bottom: 1px dotted #999;
            padding: 0 2px;
            font-size: 9pt;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 5px 0;
            font-size: 9pt;
        }
        
        table th {
            background: #e0e0e0;
            border: 1px solid #999;
            padding: 2px 3px;
            text-align: left;
            font-weight: bold;
            font-size: 8pt;
        }
        
        table td {
            border: 1px solid #999;
            padding: 2px 3px;
            font-size: 9pt;
        }
        
        .status-box {
            background: #f9f9f9;
            border: 1px solid #ddd;
            padding: 5px;
            margin: 4px 0;
            font-size: 9pt;
        }
        
        .status-badge {
            display: inline-block;
            padding: 3px 6px;
            border-radius: 2px;
            font-weight: bold;
            font-size: 8pt;
            margin-bottom: 4px;
        }
        
        .status-pending {
            background: #ffe0b2;
            color: #e65100;
        }
        
        .status-approved {
            background: #c8e6c9;
            color: #2e7d32;
        }
        
        .status-rejected {
            background: #ffcdd2;
            color: #c62828;
        }
        
        .signature-row {
            margin-top: 8px;
            display: inline-block;
            width: 48%;
            vertical-align: top;
            margin-right: 2%;
            text-align: center;
            font-size: 8pt;
        }
        
        .signature-line {
            border-top: 1px solid #000;
            margin: 12px 5px 2px 5px;
            height: 15px;
        }
        
        .signature-name {
            font-size: 8pt;
            margin-top: 1px;
            min-height: 10px;
        }
        
        .signature-date {
            font-size: 7pt;
            color: #666;
            margin-top: 1px;
        }
        
        .footer {
            margin-top: 5px;
            padding-top: 3px;
            border-top: 1px solid #ddd;
            text-align: center;
            font-size: 7pt;
            color: #666;
        }
        
        .avatar-section {
            text-align: center;
            margin: 3px 0 5px 0;
        }
        
        .avatar-image {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #667eea;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="page">
        <!-- Header -->
        <div class="header">
            <h1>ใบขอลา</h1>
            <p>Leave Request Form</p>
            
            @if ($leave->user->avatar)
                <div class="avatar-section">
                    <img 
                        src="{{ $leave->user->avatar }}" 
                        alt="{{ $leave->user->name }}" 
                        class="avatar-image"
                    >
                </div>
            @endif
        </div>

        <!-- Main Content -->
        
        <!-- Section 1: Requester Information -->
        <div class="section">
            <div class="section-title">ข้อมูลผู้ขอลา (Requester Information)</div>
            
            <div class="row">
                <span class="label">ชื่อผู้ขอลา:</span>
                <span class="value">{{ $leave->user->name }}</span>
            </div>
            
            <div class="row">
                <span class="label">ประเภทการลา:</span>
                <span class="value">
                    @php
                        $leaveTypes = \App\Models\Leave::getLeaveTypes();
                        $leaveType = $leaveTypes[$leave->leave_type] ?? $leave->leave_type;
                    @endphp
                    {{ $leaveType }}
                </span>
            </div>
        </div>

        <!-- Section 2: Leave Duration -->
        <div class="section">
            <div class="section-title">ระยะเวลาการลา (Leave Duration)</div>
            
            <table>
                <tr>
                    <th style="width: 35%;">วันเริ่มต้น<br>(Start Date)</th>
                    <th style="width: 35%;">วันสิ้นสุด<br>(End Date)</th>
                    <th style="width: 30%;">จำนวนวัน<br>(Total Days)</th>
                </tr>
                <tr>
                    <td>{{ $leave->start_date->format('d/m/Y') }}</td>
                    <td>{{ $leave->end_date->format('d/m/Y') }}</td>
                    <td style="text-align: center; font-weight: bold;">{{ $leave->total_days }} วัน</td>
                </tr>
            </table>
        </div>

        <!-- Section 3: Reason -->
        <div class="section">
            <div class="section-title">เหตุผลในการลา (Reason)</div>
            
            <div style="border: 1px solid #999; padding: 5px; min-height: 20px; background: #fafafa; font-size: 9pt;">
                {{ $leave->reason ?? '(ไม่มี)' }}
            </div>
        </div>

        <!-- Section 4: Status -->
        <div class="section">
            <div class="section-title">สถานะการขอลา (Status)</div>
            
            <div class="status-box">
                @if ($leave->status === 'pending')
                    <div class="status-badge status-pending">รอการอนุมัติ (Pending)</div>
                @elseif ($leave->status === 'approved')
                    <div class="status-badge status-approved">อนุมัติแล้ว (Approved)</div>
                @elseif ($leave->status === 'rejected')
                    <div class="status-badge status-rejected">ปฏิเสธแล้ว (Rejected)</div>
                @endif
                
                @if ($leave->approved_by && $leave->approver)
                    <div style="margin-top: 3px; font-size: 9pt;">
                        <strong>ผู้อนุมัติ (Approver):</strong> {{ $leave->approver->name }}
                    </div>
                @endif
                
                @if ($leave->approved_at)
                    <div style="margin-top: 2px; font-size: 9pt;">
                        <strong>วันที่อนุมัติ (Approval Date):</strong> {{ $leave->approved_at->format('d/m/Y H:i') }}
                    </div>
                @endif
                
                @if ($leave->approval_comment)
                    <div style="margin-top: 2px; font-size: 9pt;">
                        <strong>หมายเหตุ (Comment):</strong> {{ $leave->approval_comment }}
                    </div>
                @endif
            </div>
        </div>

        <!-- Section 5: Signatures -->
        <div>
            <div class="signature-row">
                <div style="font-weight: bold; margin-bottom: 4px; font-size: 9pt;">ลายมือชื่อผู้ขอลา</div>
                <div style="font-size: 7pt; color: #666; margin-bottom: 2px;">Requester Signature</div>
                 <div class="signature-name">{{ $leave->user->name }}</div>
                <div class="signature-date">วันที่: {{ now()->format('d/m/Y') }}</div>
                <div class="signature-line"></div>
               
            </div>
            
            <div class="signature-row">
                <div style="font-weight: bold; margin-bottom: 4px; font-size: 9pt;">ลายมือชื่อผู้อนุมัติ</div>
                <div style="font-size: 7pt; color: #666; margin-bottom: 2px;">Approver Signature</div>
                <div class="signature-line"></div>
                <div class="signature-name">
                    @if ($leave->approver)
                        {{ $leave->approver->name }}
                    @else
                        _____________________
                    @endif
                </div>
                <div class="signature-date">วันที่: ___/___/_______</div>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p style="margin: 0; padding: 0;">เอกสารนี้เป็นใบขอลารายบุคคล / This is a leave request form</p>
            <p style="margin: 1px 0 0 0; padding: 0;">วันที่พิมพ์: {{ now()->format('d/m/Y H:i:s') }}</p>
        </div>
    </div>
</body>
</html>
