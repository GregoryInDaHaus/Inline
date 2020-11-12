function table(){
    $.ajax({
        type: "POST",
        url: "controller/table.php",
        data: "agelist",
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
table();