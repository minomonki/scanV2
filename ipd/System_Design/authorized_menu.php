	<div><h3 style="text-decoration: underline">สิทธิ์การเข้าถึงเมนูระบบ</h3></div>
	<table width="80%" border="1" align="center" bordercolor="#c0c0c0" style="border-collapse: collapse">
	<tr>
	<td width="25%" align="left">
		<input type="checkbox" name="manage_doc" value="1" id="manage_doc" <?=$checkdoc?> />
		<label>จัดการเอกสาร</label>
	</td>
	<td width="25%" align="left">
		<input type="checkbox" name="manage_user" value="1" id="manage_user" <?=$checkuser?>/>
		<label>จัดการผู้ใช้งาน</label>
	</td>
	<td width="25%" align="left">
		<input type="checkbox" name="del_list" value="1" id="del_list" <?=$checkdel?>/>
		<label>ลบข้อมูล</label>
	</td>
	<td width="25%" align="left">
		<input type="checkbox" name="view_log" value="1" id="view_log" <?=$readlog?>/>
		<label>อ่าน Log</label>
	</td>
	</tr>
	<tr>
	<td align="left">
		<input type="checkbox" name="readXfile" value="3" id="readXfile" <?=$readXfile?>/>
		<label>อ่านเอกสารลับ</label>
	</td>
	<td align="left">
	<input type="checkbox" name="set_docpass" value="1" id="set_docpass" <?=$setdocpass?>/>
	<label>ระบบยืม</label>
	</td>
	<td align="left">
	<input type="checkbox" name="set_docsecret" value="1" id="set_docsecret" <?=$setdocsecret?>/>
	<label>จัดการเอกสารลับ</label>
	</td>
	<td align="left">
	<input type="checkbox" name="view_ansum" value="1" id="view_ansum" <?=$view_ansum?>/>
	<label>ตรวจสอบเอกสาร</label>
	</td>
	</tr>
	</table>
	<BR>
