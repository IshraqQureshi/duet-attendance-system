<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Attendance Sheet</title>
</head>
<body style="font-family: Arial;margin: 0">
    
    @foreach($sections as $key => $value)
        @foreach($timeTable as $data)
            @if(GeneralHelper::getEnumValue('SubjectType', $data->subject->type) == 'Lab')
                @php
                    $students = GeneralHelper::get_students_single($data->batch_id, $data->section_id);
                @endphp
            @else
                @php
                    $students = GeneralHelper::get_students($data->batch_id, $key);
                @endphp
            @endif
            
            @if(count($students) > 0)
                <div style="page-break-after: always;">
                    <div style="position: relative;">
                        <div style="width: 100px;position: absolute;left: 0;top: 0;">
                            <img src="/assets/img/duet_logo.png" alt="Dawood University" style="max-width: 100%">
                        </div>
                        <div style="width: calc(100% - 250px);margin: 0 auto 30px;">
                            <h1 style="text-align: center;margin: 0 0 5px;font-size: 16px;line-height: 1.7;">Dawood University of Engineering and Technology</h1>
                            <h2 style="font-size: 16px;margin: 0;text-align: center;line-height: 1.7;">Class Attendance Sheet</h2>
                            <h2 style="font-size: 16px;margin: 0;text-align: center;line-height: 1.7;">{{ $data->department->name }}</h2>   
                        </div>
                    </div>
                    <div>
                        <div style="display: flex;justify-content: space-between;margin-bottom: 30px;">
                            <div>
                                <h3 style="font-size: 14px;font-weight: 400;margin: 0;line-height: 1.7;"><strong>Batch: </strong>{{ $data->batch_id }}</h3>
                                <h3 style="font-size: 14px;font-weight: 400;margin: 0;line-height: 1.7;"><strong>Subject: </strong>{{ $data->subject->name }}</h3>
                                <h3 style="font-size: 14px;font-weight: 400;margin: 0;line-height: 1.7;"><strong>Timing: </strong>From {{ date('h:i A', strtotime($data->start_time)) }} to {{ date('h:i A', strtotime($data->end_time)) }}</h3>
                            </div>
                            <div>
                                <h3 style="font-size: 14px;font-weight: 400;margin: 0;line-height: 1.7;"><strong>Date: </strong>{{ $sheetDate }}</h3>
                                <h3 style="font-size: 14px;font-weight: 400;margin: 0;line-height: 1.7;"><strong>Day: </strong>{{ $day }}</h3>
                                <h3 style="font-size: 14px;font-weight: 400;margin: 0;line-height: 1.7;"><strong>Teacher: </strong>{{ $data->subject->teacher->first_name }} {{ $data->subject->teacher->last_name }}</h3>
                            </div>
                        </div>
                        <div>
                            <h3 style="font-size: 14px;font-weight: 400;margin: 0;line-height: 1.7;"><strong>Topic: </strong><span style="width: 500px;height: 10px;border-bottom: 1px solid #000;display: inline-block;vertical-align: text-bottom;"></span></h3>
                            <h3 style="font-size: 14px;font-weight: 400;margin: 0;line-height: 1.7;"><strong>Note: </strong>Circle the present and  cross the absent students.</h3>
                        </div>
                        <div style="display: flex;margin: 30px 0;flex-wrap: wrap;justify-content: flex-start;">                
                            @foreach($students as $index => $std)
                            <div style="width: 120px;height: 50px;border: 1px solid #000;display: flex;justify-content: center;align-items: center;font-size: 12px">
                                {{ $std->roll_no }}
                            </div>
                            @endforeach
                        </div>
                        <div>
                            <h3 style="font-size: 14px;font-weight: 400;margin: 0;line-height: 1.7;text-align: right;"><strong>Teacher Sign:</strong><span style="width: 200px;height: 10px;border-bottom: 1px solid #000;display: inline-block;vertical-align: text-bottom;"></span></h3>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    @endforeach

    <script>
        window.print();
    </script>

</body>
</html>