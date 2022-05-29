$(function () {
    $("#dataTable").DataTable({
      "responsive": true,
      "autoWidth": false,
    });

    $( ".days" ).datepicker();

    $( ".days" ).datepicker('option','beforeShowDay',function(date){
      var td = date.getDay();
      var ret = [(date.getDay() != 0 && date.getDay() != 6),'',(td != 'Sat' && td != 'Sun')?'':'only on workday'];
      return ret;
    });

    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    const generateSelectBox = (data, value, label, selectedValue) => {
      let html = '';
      for (const i of data){
        let selected = false;
        if( selectedValue == i[value] ) {
          selected = true
        }
        html += `<option value="${i[value]}" ${selected ? "selected" : ""}>${i[label]}</option>`;

      }
      if(html == '') {
        html = '<option>Please Select</option>'
      }
      return html;
    }

    const showWait = (show) => {
      if(show) {
        $('.waitAlertOverlay').addClass('show');
        $('.waitAlert').addClass('show');
      } else {
        $('.waitAlertOverlay').removeClass('show');
        $('.waitAlert').removeClass('show');
      }
    }

    const ajaxFunc = (url, data, selectClass, value, label) => {
      showWait(true);
      $.ajax({
        url: url,
        type: 'post',
        data: data,
        success: (res) => {
          const selectedValue = $(`.${selectClass}`).data('selected');
          const options = generateSelectBox(res, value, label, selectedValue);
          $(`.${selectClass}`).html(options);
          setTimeout(() => {
            showWait(false);
          }, 1000);
        }
      })
    }

    $(document).on('change', '.department_select' , function(){            
      const department_id = $(this).val();
      const url = '/get-semester';
      const data = { department_id: department_id };
      ajaxFunc(url, data, 'semester_select', 'id', 'name')
    });

    $(document).on('change', '.semester_teacher' , function(){            
      const semester_id = $(this).val();
      const url = '/get-teacher';
      const data = { semester_id: semester_id };
      ajaxFunc(url, data, 'teacher_select', 'id', 'teacherName')
    });

    $(document).on('change', '.days_attendance_select' , function(){            
      const day = $(this).val();
      const url = '/get-department';
      const data = { day: day };
      ajaxFunc(url, data, 'department_attendance_select', 'id', 'name');
      setTimeout(() => {
        if( $('.department_attendance_select').val() != 'Please Select' ){
          $('.department_attendance_select').change();
        }
      }, 2000)
    });

    $(document).on('change', '.department_attendance_select' , function(){            
      const department_id = $(this).val();
      const url = '/get-batch';
      const data = { department_id: department_id };
      ajaxFunc(url, data, 'batch_attendance_select', 'id', 'name')
      setTimeout(() => {
        if( $('.batch_attendance_select').val() != 'Please Select' ){
          $('.batch_attendance_select').change();
        }
      }, 2000)
    });

    $(document).on('change', '.batch_attendance_select' , function(){            
      const batch_id = $(this).val();
      const url = '/get-subject-attendance';
      const data = { batchID: batch_id };
      ajaxFunc(url, data, 'subject_attendance_select', 'id', 'sujectName')
      setTimeout(() => {
        if( $('.subject_attendance_select').val() != 'Please Select' ){
          $('.subject_attendance_select').change();
        }
      }, 2000)
    });

    $(document).on('change', '.subject_attendance_select' , function(){            
      const subject_id = $(this).val();
      const url = '/get-sections';
      const data = { subject_id: subject_id };
      ajaxFunc(url, data, 'section_attendance_select', 'id', 'section')
      setTimeout(() => {
        if( $('.section_attendance_select').val() != 'Please Select' ){
          $('.section_attendance_select').change();
        }
      }, 2000)
    });



    $('.department_select').change();
    $('.semester_teacher').change();

    if( $('.subject_select').length > 0 ){
      const batchID = $('.subject_select').data('batch_id');
      const url = '/get-subject';
      const data = { batchID: batchID };
      console.log(data);
      ajaxFunc(url, data, 'subject_select', 'id', 'sujectName')
    }


    $('.present_mark_btn').click(function(){
      const department_id = $('input[name=department_id]').val();
      const batch_id = $('input[name=batch_id]').val();
      const section_id = $('input[name=section_id]').val();
      const subject_id = $('input[name=subject_id]').val();
      const date = $('input[name=date]').val();

      const students = {};
      $("input:checkbox[name=studentID]").each(function(){
        const studentID = $(this).val();
        if($(this).prop('checked')) {
          students[studentID] = 1;
        } else {
          students[studentID] = 0;
        }
      });

      const data = {
        department_id: department_id,
        batch_id: batch_id,
        section_id: section_id,
        subject_id: subject_id,
        students: students,
        date: date
      }

      showWait(true);
      $.ajax({
        url: '/mark-attendance',
        type: 'post',
        data: data,
        success: (res) => {          
          setTimeout(() => {
            showWait(false);
          }, 1000);
          const data = JSON.parse(res);
          if(data.status){
            alert('Attendance Marked');            
          } else {
            alert('Something went wrong, please contact developer');
          }
          window.location.reload();
        }
      })

      
    })


});