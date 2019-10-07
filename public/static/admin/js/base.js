$(function () {

});

function active(obj){
    var $this = $(obj);
    $this.siblings().removeClass('active');
    $this.addClass('active');
}

function mform(url, id=0){
    var frame_w = parent.$('.main').width() || $(window).width();
    var frame_h = parent.$('.main').height() || $(window).height();
    console.log(frame_w);
    console.log(frame_h);
    var suffix = '';
    var title = '添加';
    if (id){
        suffix = '?id='+id;
        title = '修改';
    }
    var content_url = url+ suffix;
    layer.open({
        type: 2
        ,title: title
        ,content: content_url
        ,maxmin : true
        ,area: [frame_w, frame_h]
        // ,area: [900, 800]
        ,offset: 't'
    })
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
