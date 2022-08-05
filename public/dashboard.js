function showModalDefault(title,table,url,newtab,view){
    if(newtab == 1){
      window.open(url,'_blank');
    }else{
      $("#primary").modal('show') ;
      $("#title").text(title) ;
      showData(table,url,view);
    }
}

function showData(table,url,view){
    var data = {
      "table": table,
      "view":view,
      "_token": $('#token').val()
    };
    $.ajax({
      url : "/showtable/"+table,
      type: "POST",
      dataType : "JSON",
      data: data,
      success: function(data)
      { 
        
        $("#isi-modal").html(data.html);
        $("#save").attr("onclick","saveData('"+table+"','"+url+"','"+view+"')");
        $("#delete").attr("onclick","deleteData('"+table+"','"+view+"')");
               
      }
    });
}