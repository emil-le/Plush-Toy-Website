//Xác thực xóa dữ liệu
	$(document).ready(function(){
		// xác nhận xóa dữ liệu
		$('a.verify_action').click(function(){
			if(!confirm('Are you sure you want to delete?'))
			{
				return false;
			}
		});


		$('#checkAll').change(function(){
			$('.checkitem').prop("checked",$(this).prop("checked"));
		});

		// xóa category
		var $list_action 	= $('.list_action');//tim toi the co class = list_action
		$list_action.find('#submit').click(function(){ //tim toi the co id = submit,su kien click
			if(!confirm('Are you sure you want to delete?'))
			{
				return false;
			}
			
			var ids = new Array();
			$('[name="id[]"]:checked').each(function()
			{
				ids.push($(this).val());
			});
			if (!ids.length) return false;
			
			//link xoa du lieu
		    var url  = $(this).attr('url');
			//ajax để xóa
			$.ajax({
				url:'http://localhost/www/do-an-2017/admin/controller/CateController.php?action=deleteall',
				type: 'POST',
				data : {'ids': ids},
				success: function()
				{
					$(ids).each(function(id, val)
					{
						//xoa cac the <tr> chua danh muc tung ung
						$('tr.row_'+val).fadeOut();			
					});
				}
				
			})
			return false;
		});

		// end

		// xóa admin

		var $list_action 	= $('.list_actions');//tim toi the co class = list_action
		$list_action.find('#submit').click(function(){ //tim toi the co id = submit,su kien click
			if(!confirm('Bạn chắc chắn muốn xóa tất cả dữ liệu ?'))
			{
				return false;
			}
			
			var ids = new Array();
			$('[name="id[]"]:checked').each(function()
			{
				ids.push($(this).val());
			});
			if (!ids.length) return false;
			
			//link xoa du lieu
		    var url  = $(this).attr('url');
			//ajax để xóa
			$.ajax({
				url:'http://localhost/www/do-an-2017/admin/controller/AdminController.php?action=deleteall',
				type: 'POST',
				data : {'ids': ids},
				success: function()
				{
					$(ids).each(function(id, val)
					{
						//xoa cac the <tr> chua danh muc tung ung
						$('tr.row_'+val).fadeOut();			
					});
				}
				
			})
			return false;
		});



		

	});



function preview(input){
    if(input.files && input.files[0]){
        var reader = new FileReader();
        reader.onload = function(e){
            $("#form img").remove();
            $("#image").after('<img src="'+e.target.result+'" width="200" heigth="200" >');
        }
        reader.readAsDataURL(input.files[0]);
    }
}


$("#image").change(function(){

    preview(this);
});

(function($) {
    $.fn.checkFileType = function(options) {
        var defaults = {
            allowedExtensions: [],
            success: function() {},
            error: function() {}
        };
        options = $.extend(defaults, options);

        return this.each(function() {

            $(this).on('change', function() {
                var value = $(this).val(),
                    file = value.toLowerCase(),
                    extension = file.substring(file.lastIndexOf('.') + 1);

                if ($.inArray(extension, options.allowedExtensions) == -1) {
                    options.error();
                    $(this).focus();
                } else {
                    options.success();

                }

            });

        });
    };

})(jQuery);

$(function() {
    $('#image').checkFileType({
        allowedExtensions: ['jpg', 'jpeg','png','gif'],
        success: function() {
        },
        error: function() {
            alert('Không phải định dạng file img');
        }
    });

});
$(function() {
    $('#image_list').checkFileType({
        allowedExtensions: ['jpg', 'jpeg','png','gif'],
        success: function() {
        },
        error: function() {
            alert('Không phải định dạng file img');
        }
    });

});
	