<table cellpadding="0" cellspacing="0" border="0" width="100%">
    <tr>
        <td align="center" bgcolor="#ffffff">
            <table cellpadding="0" cellspacing="0" border="0" width="600" style="border-collapse: collapse;">
                <tr>
                    <td>
                        <?php foreach ($dataposisi as $dp) : ?>
                            <?php if ($dp['id_posisi'] == $id_posisi) : ?>
                                <p>Selamat, Terima kasih anda sudah mengikuti tahap interview untuk bergabung pada posisi <?= $dp['nama_posisi']; ?> PT. Sahaware Teknologi Indonesia, dengan ini kami mengundang Saudara untuk mengikuti sesi tes pelamar, informasi sebagai berikut:</p>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        <h4>Link Soal PG</h4>
                        <a href="<?= $pg . '?token=' . urlencode($token) . '&email=' . $email  ?> ">Link PG</a>
                        <h4>Link Upload Hasil</h4>
                        <p><?php echo $upload; ?></p>
                        <h4>Soal Essay</h4>
                        <p><?php echo $essay; ?></p>
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