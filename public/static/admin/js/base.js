$(function () {

});

function active(obj){
    var $this = $(obj);
    $this.siblings().removeClass('active');
    $this.addClass('active');
}

function ajax(obj, param){
    var $that = $(obj);
    var layer_index = layer.load();
    $that.attr('disabled', 'disabled');

    param.type = param.type || 'post';
    param.data = param.data || {};
    param.dataType = param.dataType || 'json';
    param.error = param.error || function (data) {
        layer.msg('error');
        console.log(data);
    };
    param.complete = param.complete || function () {
        layer.close(layer_index);
        $that.removeAttr('disabled');
    };

    $.ajax({
        url: param.url
        ,type: param.type
        ,data: param.data
        ,dataType: param.dataType
        ,success: function (data) {
            param.success(data);
        }
        ,error: function (data) {
            param.error(data);
        }
        ,complete: function () {
            param.complete();
        }
    });
}
