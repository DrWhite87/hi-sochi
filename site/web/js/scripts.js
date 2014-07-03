$(function() {
    count = 0;

    var checkout = $('.datepicker').datepicker({
        'format': 'dd/mm/yyyy',
        onRender: function(date) {
            //return date.valueOf() <= checkin.date.valueOf() ? 'disabled' : '';
            this.hide();
        }
    });

    /*
     $('body').on('change', '.ajax-upload-file', function(){
     $('form').ajaxSubmit({
     url: $(this).attr('url'),
     type: 'POST',
     data : $(this).serialize(),
     dataType:  'json',
     success: function(data) {
     check = count == 0 ? 'checked' : '';
     $('.ajax-upload-file').prepend('<br /><img src="' + data.filelink + '" width="200px" /><br /><br />' + 
     '<input type="radio" name="main_image" value="' + data.id + '" ' + check + '> Основное изображение <hr/>');
     count++;        
     }
     });
     });
     */

    $('body').on('change', '.ajax-upload-file', function() {
        thisInp = $(this);
        $('form').ajaxSubmit({
            url: '/web/admin/news/ajaxUploadImage',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(data) {
                thisInp.hide();
                thisInp.before('<div class="clear"></div><img src="' + data.filelink + '" width="200px" />');
                thisInp.after('<hr /><input type="file" class="ajax-upload-file" name="' + thisInp.attr('name') + '" id="' + thisInp.attr('id') + '">');
            }
        });

    });
});