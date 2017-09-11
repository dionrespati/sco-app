<div id="form_reg_members">
	<form class="form-horizontal" method="post" id="frm_reg2" name="frm_reg2" action="../preview_input_member/">
		<fieldset>
			<table class="table table-striped table-bordered" width="95%" align="center">
				<tr>
					<td colspan="4">
					<div class="alert1 alert-success">
						<strong>
						<center>
							SPONSOR & RECRUITER
						</center></strong>
					</div></td>
				</tr>
				<tr>
					<td width="15%">&nbsp;ID Sponsor</td>
					<td width="35%">
					<input type="text" name="idsponsor" id="idsponsor" class="span12" value="<?php echo $idsponsor; ?>" readonly="yes"/>
					</td>
					<td width="15%">&nbsp;&nbsp;Nama Sponsor</td>
					<td>
					<input type="text" name="nmsponsor" id="nmsponsor" class="span12" value="<?php echo $nmsponsor; ?>" readonly="yes"/>
					</td>
				</tr>

				<tr>
					<td>&nbsp;ID Rekruiter</td>
					<td>
					<input type="text" name="idrekrut" id="idrekrut" class="span12" value="<?php echo $idrekrut; ?>" readonly="yes"/>
					</td>
					<td>&nbsp;&nbsp;Nama Rekruiter</td>
					<td>
					<input type="text" name="nmrekrut" id="nmrekrut" class="span12" value="<?php echo $nmrekrut; ?>" readonly="yes"/>
					</td>
				</tr>

				<tr>
					<td colspan="4">
					<div class="alert1 alert-success">
						<strong>
						<center>
							DATA PERSONAL
						</center></strong>
					</div></td>
				</tr>
				<tr>
					<td>&nbsp;No Aplikasi</td>
					<td>
					<input tabindex="1" type="text" name="noapl" autofocus="autofocus" id="noapl" class="span12" placeholder="Wajib Isi" onchange="Member.checkDoubleInputMemb('api/member/double/','dfnotemp',this.value)" />
					</td>
					<td>&nbsp;&nbsp;Alamat</td>
					<td>
					<input tabindex="7" type="text" name="addr1" id="addr1" class="span12" placeholder="Wajib Isi" />
					</td>
				</tr>
				<tr>
					<td>&nbsp;Nama Member</td>
					<td>
					<input tabindex="2" type="text" name="nmmember" id="nmmember" class="span12" placeholder="Wajib Isi" />
					</td>
					<td>&nbsp;</td>
					<td>
					<input tabindex="8" type="text" name="addr2" id="addr2" class="span12" />
					</td>
				</tr>
				<tr>
					<td>&nbsp;No KTP</td>
					<td>
					<input tabindex="3" type="text" name="noktp" id="noktp" class="span12" placeholder="Wajib Isi" onchange="Member.checkDoubleInputMemb('api/member/double/','idno',this.value)" />
					</td>
					<td>&nbsp;</td>
					<td>
					<input tabindex="9" type="text" name="addr3" id="addr3" class="span12" />
					</td>
				</tr>
				<tr>
					<td>&nbsp;Tgl Lahir</td>
					<td>
					<input tabindex="4" type="text" name="tgllahir" id="tgllahir" class="span12" placeholder="dd/mm/yyyy" onchange="Member.checkBirthday()" />
					</td>
					<td>&nbsp;&nbsp;Kode Pos </td>
					<td>
					<input tabindex="10" type="text" name="kdpos" id="kdpos" class="span12" placeholder="Wajib Isi" onkeyup="this.value = this.value.replace(/[^0-9\.]/g,'')" value="000004" />
					</td>
				</tr>
				<tr>
					<td>&nbsp;Jenis Kelamin</td>
					<td>
					<select tabindex="5" id="sex" name="sex" class="span12">
						<option value="M">Pria</option>
						<option value="F">Wanita</option>
					</select></td>
					<td>&nbsp;&nbsp;Telepon Rumah</td>
					<td>
					<input tabindex="11" type="text" name="tel_hm"  id="tel_hm" class="span12" onkeyup="this.value = this.value.replace(/[^0-9\.]/g,'')"/>
					</td>
				</tr>
				<tr>
					<td>&nbsp;Email</td>
					<td>
					<input tabindex="6" type="text" name="email" id="email" class="span12" />
					</td>
					<td>&nbsp;&nbsp;Telepon HP</td>
					<td>
					<input tabindex="12" type="text" name="tel_hp" id="tel_hp"  class="span12" placeholder="Wajib Isi" onkeyup="this.value = this.value.replace(/[^0-9\.]/g,'')" onchange="Member.checkDoubleInputMemb('api/member/double/','tel_hp',this.value)" />
					</td>
				</tr>
				<tr>

				</tr>
				<tr>
					<td colspan="2">&nbsp;</td>
					<td>&nbsp;&nbsp;Area</td>
					<td>
					<select tabindex="13" id="area" name="area" class="span12" onchange="Member.setAreaBnsStatement()">

						<?php
						echo "<option value=\"\" selected>--Pilih disini--</option>";
						foreach ($show_state as $dta) {
							if ($state == $dta -> st_id) {
								echo "<option value=\"$dta->st_id\" selected>$dta->description</option>";
							} else {
								echo "<option value=\"$dta->st_id\">$dta->description</option>";
							}
						}
						?>
					</select></td>
				</tr>

				<tr>
					<td colspan="4">
					<div class="alert2 alert-success">
						<strong>
						<center>
							KARTU DAN STATEMENT BONUS
						</center></strong>
					</div></td>
				</tr>
				<tr>
					<td>&nbsp;Bank</td>
					<td>
					<select tabindex="14" name="bank" id="bank" class="span12" onchange="Member.selectBank()">
						&nbsp;
						<?php
						echo "<option value=\"\" selected>--Pilih disini--</option>";
						foreach ($bank as $row) {
							echo "<option value=\"$row->bankid-$row->description\">$row->description</option>";
						}
						?>
					</select></td>
					<td>&nbsp;&nbsp;Kartu & Stt Bns</td>
					<td>
					<select tabindex="15" id="stkarea" class="span12" name="stkarea" onblur="Member.listStockistByArea(this.value,'#bnstmt')" placeholder="Wajib diisi">
						<?php
						echo "<option value=\"\" selected>--Pilih disini--</option>";
						foreach ($show_state as $dta) {
							if ($states == $dta -> st_id) {
								echo "<option value=\"$dta->st_id\" selected>$dta->description</option>";
							} else {
								echo "<option value=\"$dta->st_id\">$dta->description</option>";
							}
						}
						?>
					</select></td>

				</tr>
				<tr>
					<td>&nbsp;No rekening</td>
					<td>
					<input tabindex="14" type="text" name="norek" id="norek" class="span12" onkeyup="this.value = this.value.replace(/[^0-9\.]/g,'')" disabled="yes"/>
					</td>
					<td>&nbsp;&nbsp;Stockist</td>
					<td><select tabindex="16" id="bnstmt" name="bnstmt" class="span12">

					</select></td>
				</tr>
				<tr>
					<td colspan="4">
					<input tabindex="17" value="<< Kembali" type="button" class="btn btn-warning" onclick="All.back_to_form(' .nextForm1',' .mainForm')"/>
					<input tabindex="18" type="button" name="submitted" id="submitted" class="btn btn-success" value="Simpan Data Member"  onclick="Member.saveRegMember()"/>
					<input type="hidden" name="voucherno" id="voucherno" value="<?php echo $voucherno; ?>"/>
					<input type="hidden" name="voucherkey" id="voucherno" value="<?php echo $voucherkey; ?>"/>
					<input type="hidden" name="regtype" id="regtype" value="<?php echo $regtype; ?>"/>
					<input type="hidden" name="tipe_input" id="tipe_input" value="<?php echo $tipe_input; ?>"/>
					<input type="hidden" name="chosevoucher" id="chosevoucher" value="<?php echo $chosevoucher; ?>"/>
					</td>
				</tr>
			</table>
		</fieldset>
	</form> </div>
<div id="result1"></div>
