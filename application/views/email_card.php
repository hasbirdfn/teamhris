<table cellpadding="0" cellspacing="0" border="0" width="100%">
    <tr>
        <td align="center" bgcolor="#ffffff">
            <table cellpadding="0" cellspacing="0" border="0" width="600" style="border-collapse: collapse;">
                <tr>
                    <td>
                        <?php foreach ($dataposisi as $dp) : ?>
                            <?php if ($dp['id_posisi'] == $id_posisi) : ?>
                                <p>Terima kasih sudah tertarik untuk bergabung pada posisi <?= $dp['nama_posisi']; ?> PT. Sahaware Teknologi Indonesia, dengan ini kami mengundang Saudara untuk mengikuti sesi Interview, pada:
                                </p>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        <h4>Hari/ Tanggal:</h4>
                        <p><?php echo $tanggal; ?></p>
                        <h4>Pukul:</h4>
                        <p><?php echo $mulai; ?>-<?php echo $akhir; ?></p>
                    </td>

                </tr>


                <tr>
                    <td bgcolor="#ffffff" align="center" style="padding: 20px;">
                        <a href="<?php echo $gmeet; ?>" target="_blank" style="color: #000000; text-decoration: none; font-size: 18px; font-weight: bold;">Klik Join Interview </a>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>Terima Kasih <br>
                            Best Regards,<br>
                            Human Capital,<br>
                            PT. Sahaware Teknologi Indonesia</p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>