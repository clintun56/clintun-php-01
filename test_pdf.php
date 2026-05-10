<?php
require 'vendor/autoload.php';

$leave = new class {
    public $id = 1;
    public $leave_type = 'sick';
    public $start_date = '2026-05-08';
    public $end_date = '2026-05-09';
    public $total_days = 2;
    public $reason = 'ป่วยหวัด';
    public $status = 'pending';
    public $user = null;
    public $approver = null;
};

$leave->user = new class { public $id = 1; public $name = 'Test User'; };
$leaveTypes = ['sick' => 'ลาป่วย'];

\Barryvdh\DomPDF\Facade\Pdf::loadView('leaves.pdf', compact('leave', 'leaveTypes'))->save('/tmp/test_direct.pdf');
echo "✅ PDF created successfully\n";
