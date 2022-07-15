<html>
    <head>
    <title>No Antrian</title>
    </head>
    <body>
        <center>
            <table style='width:auto; font-size:4pt; font-family:tahoma; border-collapse: collapse;'>
                <tr>
    				<td>
    				    <center>
    				        <img src="<?= $foto ?>" width="30" height="30">
    				    </center>
    				</td>
    			</tr>
                <tr>
    				<td>
        				<center>
        					<font size="1"><b>KLINIK MARYAM</b></font><br>
        					<font><i>Desa Kedungpanji, Kec Lembeyan</i></font><br>
        					<font><i>Kab. Magetan, Jawa Timur</i></font><br>
        					<font><i>Email : klinikmaryam@gmail.com</i></font>
        				</center>
    				</td>
    			</tr>
                <tr>
                    <td align='center' style='font-size:22pt'>
                        <?= $antrian ?>
                    </td>
                </tr>
                <tr>
                    <td align='center' style='font-size:8pt'>
                        <?= $poli ?>
                    </td>
                </tr>
                <tr>
                    <td align='center'>
                        Nama : <?= $data_pasien['nama_pasien'] ?>
                    </td>
                </tr>
                <tr>
                    <td align='center'>
                        Alamat : <?= $data_pasien['alamat_pasien'] ?>
                    </td>
                </tr>
                <tr>
                    <td align='center'>
                        Tanggal Daftar : <?= $tanggal_daftar ?>
                    </td>
                </tr>
            </table>
        </center>
    </body>
</html>
