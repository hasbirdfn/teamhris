<?php echo form_open_multipart('upload/do_upload'); ?>

<input type="file" name="userfile" size="20" />

<input type="text" name="upload_time" placeholder="YYYY-MM-DD HH:MM:SS" />

<select name="file_type">
    <option value="pdf">PDF</option>
    <option value="doc">DOC</option>
    <option value="docx">DOCX</option>
</select>

<br /><br />

<input type="submit" value="Upload" />

<?php echo form_close(); ?>