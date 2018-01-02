jQuery(function($) {
  var bookedDays = ["2011-9-20","2011-9-29","2011-10-9",,"2011-10-23"];

  function assignCalendar(id){
    $('<div class="calendar" />')
      .insertAfter( $(id) )
      .datepicker({
        dateFormat: 'dd-mm-yy',
        minDate: new Date(),
        maxDate: '+1y',
        altField: id,
        firstDay: 1,
        showOtherMonths: true,
        dayNamesMin: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S'],
        beforeShowDay: isAvailable })
      .prev().hide();
  }

  function isAvailable(date){
    var dateAsString = date.getFullYear().toString() + "-" + (date.getMonth()+1).toString() + "-" + date.getDate();
    var result = $.inArray( dateAsString, bookedDays ) ==-1 ? [true] : [false];
    return result
  }

  assignCalendar('#date_in_input');
});

