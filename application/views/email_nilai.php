<table cellpadding="0" cellspacing="0" border="0" width="100%">
    <tr>
        <td align="center" bgcolor="#ffffff">
            <table cellpadding="0" cellspacing="0" border="0" width="600" style="border-collapse: collapse;">
                <tr>
                    <td>
                        <?php foreach ($dataposisi as $dp) : ?> <?php if ($dp['id_posisi'] == $id_posisi) : ?> <p>Terima kasih sudah mengikuti rangkaian seleksi untuk posisi <?= $dp['nama_posisi']; ?>, di PT. Sahaware Teknologi Indonesia, dengan ini kami mengumumkan bahwa Saudara Terpilih sebagai kandidat <?= $dp['nama_posisi']; ?>. Untuk tahap selanjutnya apakah bisa datang ke kantor sahaware untuk diskusi kompensasi lebih lanjut, informasi sebagai berikut</p>
                                </p>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        <h4>Tanggal</h4>
                        <p><?php echo $jadwal; ?></p>
                        <h4>Jam</h4>
                        <p><?php echo $mulai; ?>-<?php echo $akhir; ?></p>
                        <h4>Bertemu dengan</h4>
                        <p><?php echo $bertemu; ?></p>
                        <h4>Anda lulus dengan nilai tes </h4>
                        <p><?php echo $pg; ?></p>
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