var app = {
    init:function(){

        $('body').on('dragenter' , '#drag_upload_file', app.loadDragEnter);
        $('body').on('dragover' , '#drag_upload_file', app.loadDragOver);
        $('body').on('drop' , '#drag_upload_file', app.loadDrop);
        $('body').on('change' ,'#file', app.ManualLoad);
    },

    loadDragEnter:function(e){
        e.stopPropagation();
        e.preventDefault();
        $('#drop_file_zone').css('border', '2px solid #0B85A1');
    },

    loadDragOver:function(e){
        e.stopPropagation();
        e.preventDefault();
    },
   


    ManualLoad:function(e){
        console.log('manualtest')
       var file = this.files;
       console.log(file);
       var fd = new FormData();
       fd.append('file', file);
       fd.append('username', file);
       console.log(fd);
        
       var jqXHR = $.ajax({

        url: 'http://localhost/projet-perso/omega-gif/public/user/drop-gif' ,
        method: 'POST',
        dataType: 'json',
        data:fd,
        processData: false,
        contentType: false,
        cache: false,
        traditional: true,
        enctype: 'multipart/form-data',

   
    })
   
       jqXHR.done(
       
       alert('upload effectué'),
        $('#file').val('')
       
       );

    },
    loadDrop:function(e){
        
        $('#drop_file_zone').css('border', ' 5px dashed #999 ');
        e.preventDefault();
        var files = e.originalEvent.dataTransfer.files;
        var obj = $("#box__dragndrop");
        console.log(files.length);
        
       
        //We need to send dropped files to Server
    
        for (var i = 0; i < files.length; i++) 
        {
            var fd = new FormData();
            var username = $('#username').val();
            fd.append('file', files[i]);
            fd.append('username', username);
            console.log(files[i])
            console.log(fd);

            var jqXHR = $.ajax({

                url: 'http://localhost/projet-perso/omega-gif/public/user/drop-gif' ,
                method: 'POST',
                dataType: 'json',
                data:fd,
                processData: false,
                contentType: false,
                cache: false,
                traditional: true,
                enctype: 'multipart/form-data',

        
            })
        
            jqXHR.done(
            
            alert('upload effectué')
            
            
            );
        }
    },

  
  
}
$(app.init);