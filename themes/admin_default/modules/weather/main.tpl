<!-- BEGIN: main -->
<!-- BEGIN: error -->
<div class="alert alert-danger">
    <strong>{ERROR}</strong>
</div>
<!-- END: error -->
<div class="table-responsive">
    <form method="post">
        <table class="table table-bordered table-striped table-hover">
            <caption>{LANG.add_city}</caption>
            <tbody>
            <tr>
                <td>{LANG.name_city}</td>
                <td><input type="text" name="name_city" id="name_city" class="form-control" value="{DATA.name_city}"></td>
            </tr>
            <tr>
                <td>{LANG.zipcode}</td>
                <td><input type="text" name="zipcode" id="zipcode" class="form-control" value="{DATA.zipcode}"></td>
            </tr>
            <tr>
                <td>{LANG.nation_name}</td>
                <td><input type="text" name="nation_name" id="nation_name" class="form-control" value="{DATA.nation_name}"></td>
            </tr>
            </tbody>
            <tfoot>
            <tr>
                <td colspan="2" class="text-center">
                    <button type="submit" class="btn btn-primary" name="submit" id="add_city">{LANG.save}</button>
                </td>
            </tfoot>
        </table>
    </form>
</div>
<div>
    <hr>
    <br>
    <h2 class="text-center"><strong>{LANG.list_city}</strong></h2>
    <table class="table table-bordered table-striped table-hover">
        <thead>
        <tr>
            <th class="text-center">{LANG.stt}</th>
            <th class="text-center">{LANG.name_city}</th>
            <th class="text-center">{LANG.zipcode}</th>
            <th class="text-center">{LANG.nation_name}</th>
            <th class="text-center">{LANG.action}</th>
        </tr>
        </thead>
        <tbody>
        <!-- BEGIN: loop -->
        <tr>
            <td>
                <select name="weight" class="form-control weight_{ROW.id}" onchange="nv_change_weight({ROW.id})">
                    <!-- BEGIN: weight -->
                    <option value="{WEIGHT}"{WEIGHT_SELECTED}>{WEIGHT}</option>
                    <!-- END: weight -->
                </select>
            </td>
            <td class="text-center">{ROW.name_city}</td>
            <td class="text-center">{ROW.zipcode}</td>
            <td class="text-center">{ROW.nation_name}</td>
            <td class="text-center">
                <a href="{ROW.url_edit}" class="btn btn-danger" >Sửa</a>
                <a href="{ROW.url_delete}"  onclick="return confirm('{LANG.confirm_delete}')" class="btn btn-success" >Xóa</a>
            </td>
        </tr>
        <!-- END: loop -->
        </tbody>
    </table>
</div>
<!-- BEGIN: generate_page -->
<div class="text-center">
    {GENERATE_PAGE}
</div>
<!-- END: generate_page -->
<script>
    function nv_change_weight(id){
        var new_weight=$('.weight_'+ id).val();
        $.ajax({
            url : script_name +'?' +nv_name_variable + '=' + nv_module_name
                +'&' +nv_fc_variable
                +'=main&change_weight=1&id='+ id + '&new_weight='+new_weight,
            success : function (result){
                if(result != 'ERR'){
                    location.reload();
                }
            }
        })
    }
</script>
<!-- END: main -->