<div class="row">
    <div class="col-xs-12">
        <!-- PAGE CONTENT BEGINS -->
        <div class="form-horizontal">

            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Courier Name </label>
                <label class="col-sm-1 control-label no-padding-right">:</label>
                <div class="col-sm-8">
                    <input type="text" id="couriername" name="couriername" placeholder="Courier Name"
                        value="<?php echo $selected->Courier_Name; ?>" class="col-xs-10 col-sm-4" />
                    <input name="id" id="id" type="hidden" value="<?php echo $selected->Courier_SlNo; ?>" />
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"></label>
                <label class="col-sm-1 control-label no-padding-right"></label>
                <div class="col-sm-8">
                    <button type="button" class="btn btn-sm btn-success" onclick="submit()" name="btnSubmit">
                        Update
                        <i class="ace-icon fa fa-arrow-right icon-on-right bigger-110"></i>
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>



<div class="row">
    <div class="col-xs-12">
        <div class="clearfix">
            <div class="pull-right tableTools-container"></div>
        </div>
        <div class="table-header">
            Courier Information
        </div>

        <!-- div.table-responsive -->

        <!-- div.dataTables_borderWrap -->
        <div id="saveResult">
            <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="center" style="display:none;">
                            <label class="pos-rel">
                                <input type="checkbox" class="ace" />
                                <span class="lbl"></span>
                            </label>
                        </th>
                        <th>SL No</th>
                        <th>Courier Name</th>
                        <th class="hidden-480">Description</th>

                        <th>Action</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    <?php 
					$query = $this->db->query("SELECT * FROM tbl_courier where status='a'");
					$row = $query->result();
					 ?>
                    <?php $i=1; foreach($row as $row){ ?>
                    <tr>
                        <td class="center" style="display:none;">
                            <label class="pos-rel">
                                <input type="checkbox" class="ace" />
                                <span class="lbl"></span>
                            </label>
                        </td>

                        <td><?php echo $i++; ?></td>
                        <td><a href="#"><?php echo $row->Courier_Name; ?></a></td>
                        <td class="hidden-480"><?php echo $row->Courier_Name; ?></td>
                        <td>
                            <div class="hidden-sm hidden-xs action-buttons">
                                <a class="blue" href="#">
                                    <i class="ace-icon fa fa-search-plus bigger-130"></i>
                                </a>

                                <a class="green"
                                    href="<?php echo base_url() ?>courieredit/<?php echo $row->Courier_SlNo; ?>"
                                    title="Eidt" onclick="return confirm('Are you sure you want to Edit this item?');">
                                    <i class="ace-icon fa fa-pencil bigger-130"></i>
                                </a>

                                <a class="red" href="#" onclick="deleted(<?php echo $row->Courier_SlNo; ?>)">
                                    <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                </a>
                            </div>
                        </td>

                        <td class="hidden-480">
                            <span
                                class="label label-sm label-info arrowed arrowed-righ"><?php //echo $row->ProductCategory_Name; ?></span>
                        </td>

                        <td></td>
                    </tr>

                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<script type="text/javascript">
function submit() {
    var couriername = $("#couriername").val();
    var id = $("#id").val();
    if (couriername == "") {
        $("#couriername").css("border-color", "red");
        return false;
    }
    var inputdata = 'couriername=' + couriername + '&id=' + id;
    alert(inputdata);
    var urldata = "<?php echo base_url(); ?>courierupdate";
    $.ajax({
        type: "POST",
        url: urldata,
        data: inputdata,
        success: function(data) {
            if (data == "true") {
                alert("Update Success");
                window.location.href = '<?php echo base_url()?>courier';
            }
        }
    });
}
</script>
<script type="text/javascript">
function deleted(id) {
    var deletedd = id;
    var inputdata = 'deleted=' + deletedd;
    var confirmation = confirm("are you sure you want to delete this ?");
    var urldata = "<?php echo base_url();?>Administrator/page/courierdelete";
    if (confirmation) {
        $.ajax({
            type: "POST",
            url: urldata,
            data: inputdata,
            success: function(data) {
                alert("Delete Success");
                location.reload();
            }
        });
    };
}
</script>