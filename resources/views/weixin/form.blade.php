<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="/js/jquery-1.12.4.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" >
</head>
<body>

<form>
    <table>
        <tr>
            <td>一级菜单 名字 <input type="text" class="bst1"><input type="button" value="克隆" class="bst"></td>
        </tr>
        <tr>
            <td>二级菜单 类型<select class="op"><option >请选择</option><option >view</option><option >text</option></select>名字<input type='text' class="logs" >输入key<input type='text' class='userk'>输入URL<input type='text' class='urls'><input type='button' value='克隆' class='add'></td>
        </tr>
        <tr>
            <td>
        <input type="button" id="btn" value="生成">
            </td>
        </tr>
    </table>
</form>
</body>
</html>
<script>
    $(function() {
        $(document).on('click', '.bst', function () {
            _this = $(this);
            var bst1 = $('.bst1').val();
            //console.log(bst1);
            var _bst1 = "<div class='bst2'>名字<input type='text 'value="+ bst1 +"></div>"
            _this.parent().append(_bst1);
        });
        $(document).on('click', '.add', function () {
            _this = $(this);
            var logs = $('.logs').val();
            var userk = $('.userk').val();
            var urls = $('.urls').val();
            var op = $('.op').val();
            var _add = "<div class='bst2'><form>类型<select><option >" + op + "</option>名字 <input type='text' value=" + logs + ">输入key<input type='text' value=" + userk + ">输入URL<input type='text' value=" + urls + " ></form></div>"
            _this.parent().append(_add);

        });
        $('#btn').click(function () {
            _this = $(this);
            var bst1 = $('.bst1').val();
            var logs = $('.logs').val();
            var userk = $('.userk').val();
            var urls = $('.urls').val();
            var op = $('.op').val();
            //console.log(bst1);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{url("/weixin/forms")}}',
                type: 'post',
                data: {bst1: bst1, logs: logs, userk: userk, urls: urls, op: op},
                dataType: 'json',
                success: function (res) {
                    if(res==0){

                    }

                }
            });
        });
    })

</script>