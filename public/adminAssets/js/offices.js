$(document).ready(function () {


    //Timepicker Init

    $('#twenty-four').on('click', function () {

        if($(this).prop("checked") === true){
            console.log('checked');
            $('#worktime').css('visibility', 'hidden');
        } else {
            console.log('unchecked');
            $('#worktime').css('visibility', 'visible');
        }

    });
    var el_start = $('input[name="time_start"]');
    var el_end = $('input[name="time_end"]');

    $('.time_start').timepicker({
        timeFormat: 'HH:mm',
        interval: 30,
        minTime: '8:00',
        maxTime: '13:00',
        defaultTime: el_start.val() ? el_start.val() : '8:00',
        startTime: '8:00',
        dynamic: false,
        dropdown: true,
        scrollbar: true
    });

    $('.time_end').timepicker({
        timeFormat: 'HH:mm',
        interval: 30,
        minTime: '17:00',
        maxTime: '22:00',
        defaultTime: el_end.val() ? el_end.val() : '17:00',
        startTime: '17:00',
        dynamic: false,
        dropdown: true,
        scrollbar: true
    });

});
