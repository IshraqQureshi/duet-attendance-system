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



    $('.department_select').change();
    $('.semester_teacher').change();

    if( $('.subject_select').length > 0 ){
      const batchID = $('.subject_select').data('batch_id');
      const url = '/get-subject';
      const data = { batchID: batchID };
      console.log(data);
      ajaxFunc(url, data, 'subject_select', 'id', 'sujectName')
    }


});