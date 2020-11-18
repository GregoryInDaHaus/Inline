/**
 * ajax запрос к скрипту table.php
 * @param {string} request запрос в методе POST
 * @return таблицу персон с максимальными возрастами
 */
function table(request){
    $.ajax({
        type: "POST",
        url: "controller/table.php",
        data: {"agelist" : request},
        success: function(msg){
            console.log( JSON.parse(msg) );
            let ages = JSON.parse(msg);
            $.each(ages, function(i, parent){
                $('table').append(`<tr id="tr_${i}"></tr>`);
                $.each(parent, function(key, child){
                    if(key != 'id'){
                        let row = '<td>' + child + '</td>';
                        $(`#tr_${i}`).append(row);
                    }
                });
                
            });
            $().append();
        }
      });
}

//table('request_from_client');