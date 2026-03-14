<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        table { width: 100%; border-collapse: collapse; margin: 1rem 0; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background: #f4f4f4; }
        .header { margin-bottom: 1.5rem; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Monthly Session Report</h2>
        <p><strong>Student:</strong> {{ $student->full_name }}</p>
        <p><strong>Month:</strong> {{ $month->format('F Y') }}</p>
    </div>

    @if($sessions->isEmpty())
        <p>No sessions recorded for this month.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Teacher</th>
                    <th>Start</th>
                    <th>End</th>
                    <th>Duration</th>
                    <th>Notes</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sessions as $session)
                    <tr>
                        <td>{{ $session->start_time->format('M d, Y') }}</td>
                        <td>{{ $session->teacher->full_name }}</td>
                        <td>{{ $session->start_time->format('h:i A') }}</td>
                        <td>{{ $session->end_time->format('h:i A') }}</td>
                        <td>{{ $session->duration_hours }} hrs</td>
                        <td>{{ Str::limit($session->notes, 50) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <p><strong>Total sessions:</strong> {{ $sessions->count() }}</p>
        <p><strong>Total hours:</strong> {{ round($sessions->sum(fn($s) => $s->start_time->diffInMinutes($s->end_time) / 60), 2) }} hrs</p>
    @endif

    <p style="margin-top: 2rem; color: #666; font-size: 0.9rem;">This is an automated report from Digital Education System.</p>
</body>
</html>
