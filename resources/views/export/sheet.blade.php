<table>
    <thead>
    <tr>
        <th>Name</th>
        <th>Roll No</th>
        <th>Batch</th>
        <th>Department</th>
    </tr>
    </thead>
    <tbody>
    @foreach($students as $student)
        <tr>
            <td>{{ $student->first_name }} {{ $student->last_name }}</td>
            <td>{{ $student->roll_no }}</td>
            <td>{{ $student->batch->name }}</td>
            <td>{{ $student->batch->department->name }}</td>
        </tr>
    @endforeach
    </tbody>
</table>