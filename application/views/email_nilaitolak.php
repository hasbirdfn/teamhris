<table cellpadding="0" cellspacing="0" border="0" width="100%">
    <tr>
        <td align="center" bgcolor="#ffffff">
            <table cellpadding="0" cellspacing="0" border="0" width="600" style="border-collapse: collapse;">
                <tr>
                    <td>

                        <?php foreach ($dataposisi as $dp) : ?>
                            <?php if ($dp['id_posisi'] == $id_posisi) : ?>
                                <p>Terima kasih sudah melamar untuk posisi <?= $dp['nama_posisi']; ?> ,PT Sahaware Teknologi Indonesia. Kami sangat mengapresiasi keinginan Saudara untuk bergabung dalam posisi tersebut. Namun demikian, untuk saat ini kita masih belum dapat bekerjasama. Kami akan tetap menyimpan data diri Saudara dan akan menghubungi apabila ada kesempatan untuk bekerjasama dilain waktu. </p>
                                </p>
                            <?php endif; ?>
                        <?php endforeach; ?>

                        <h4>Status</h4>
                        <p><?php echo $status ?></p>
                        <h4>Nilai Tes</h4>
                        <p><?php echo $pg; ?></p><br>
                        <p><?php echo $essay; ?></p>
                        <p>Best wishes for a successful job search. Thank you, again, for your interest in our company.</p><br>
                        <p> Human Capital,<br>
                            PT. Sahaware Teknologi Indonesia</p>
                    </td>

                </tr>
            </table>
        </td>
    </tr>
</table>