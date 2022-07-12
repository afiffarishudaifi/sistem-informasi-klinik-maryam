<html>
    <head>
    <title>No Antrian</title>
    </head>
    <body>
        <center>
            <table style='width:auto; font-size:8pt; font-family:tahoma; border-collapse: collapse;'>
                <tr>
                    <td align='center'>
                        <span style='font-size:12pt'><img src="<?= base_url('/docs/img/logo.jpg') ?>"></span></br>
                    </td>
                    <td align='center'>
                        <span style='font-size:12pt'><b>Klinik Maryam</b></span></br>
                    </td>
                </tr>
                <tr>
                    <td align='center'>
                    </td>
                    <td align='center'>
                        </br>Desa Kedungpanji, Kec Lembeyan
                        Kab. Magetan, Jawa Timur
                        Indonesia </br>
                        Telp : 0594094545
                    </td>
                </tr>
                <tr>
                    <td align='center' style='font-size:72pt' colspan="2">
                        <?= $antrian ?>
                    </td>
                </tr>
                <tr>
                    <td align='center' colspan="2" style='font-size:12pt'>
                        <?= $poli ?>
                    </td>
                </tr>
                <tr>
                    <td align="right">Nama Pasien</td>
                    <td> : <?= $data_pasien['nama_pasien'] ?></td>
                </tr>
                <tr>
                    <td align="right">Alamat Pasien</td>
                    <td> : <?= $data_pasien['alamat_pasien'] ?></td>
                </tr>
                <tr>
                    <td align="right">Jenis Kelamin</td>
                    <td> : <?= $data_pasien['jenis_kelamin'] ?></td>
                </tr>
                <tr>
                    <td align="right">Tanggal Daftar</td>
                    <td> : <?= $tanggal_daftar ?></td>
                </tr>
                <tr>
                    <td align="right">Agama</td>
                    <td> : <?= $data_pasien['agama'] ?></td>
                </tr>
            </table>
        </center>
    </body>
</html>
