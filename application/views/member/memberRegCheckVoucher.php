<div class="mainForm">
    <form class="form-horizontal" enctype="multipart/form-data" id="formCheckVoucher">
        <fieldset>      
            <div class="control-group">
                <label class="control-label" for="typeahead">Tipe Registrasi</label>
                <div class="controls">
                    <select id="tipe_input" name="tipe_input">
                        <option value="1">Single</option>
                        <option value="2">Couple/Suami-istri</option>

                    </select>	

                </div>
                <label class="control-label" for="typeahead">Pilih Voucher/Pending</label>
                <div class="controls">
                    <select id="chosevoucher" name="chosevoucher" onchange="Member.setChooseVoucher()">
                        <option value="0">Pending Voucher</option>
                        <option value="1">Voucher</option>

                    </select>	
                    <span><strong>Sisa Input Pending Voucher <?php echo $this->stockist . " : " . $limit[0]->limitstock; ?></strong></span>
                </div>
                <label class="control-label" for="typeahead">Voucher No</label>
                <div class="controls">
                    <input type="text" readonly="readonly" class="TabOnEnter span3 vch" id="voucherno" name="voucherno" onchange="Member.voucherCheck()" />	
                </div>
                <label class="control-label" for="typeahead">Voucher Key</label>
                <div class="controls">
                    <input type="text" readonly="readonly" class="TabOnEnter span3 vch" id="voucherkey" name="voucherkey" onchange="Member.voucherCheck()"  />	
                </div>
                <label class="control-label" for="typeahead">Rekruiter</label>
                <div class="controls">
                    <input type="text" class="TabOnEnter idmemb_width" id="idrekrut" name="idrekrut" onchange="All.getFullNameByID(this.value, 'api/member/check', '#nmrekrut')"  />
                    <input type="text" class="TabOnEnter fullnm_width" id="nmrekrut" name="nmrekrut" readonly="readonly"  />	
                </div>
                <label class="control-label" for="typeahead">Sponsor</label>
                <div class="controls">
                    <input type="text" class="TabOnEnter idmemb_width" id="idsponsor" name="idsponsor" onchange="All.getFullNameByID(this.value, 'api/member/check', '#nmsponsor')"  />
                    <input type="text" class="TabOnEnter fullnm_width" id="nmsponsor" name="nmsponsor" readonly="readonly"  />	
                </div>

                <label class="control-label" for="typeahead">&nbsp</label>                             
                <div class="controls"  id="inp_btn">
                    <input type="button" id="btn_input_user" class="btn btn-primary .submit" name="save" value="Submit" onclick="Member.inputMember()" />
                    <input type="reset" class="btn btn-reset" value="Reset" />
                    <input type="hidden" id="validVoucher" name="validVoucher" value="0" />
                    <input type="hidden" id="sisaPendingVch" name="sisaPendingVch" value="<?php echo $limit[0]->limitstock; ?>" />
                </div>
                <label class="control-label" for="typeahead">&nbsp</label>
                <div class="controls vchresult">

                </div>	
            </div> <!-- end control-group -->

        </fieldset>
        <div class="result"></div>
    </form>   

</div><!--/end mainForm-->
