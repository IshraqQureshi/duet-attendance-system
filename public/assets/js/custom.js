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
  });