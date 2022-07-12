<!DOCTYPE html>
<html>
<head>
	<title>Cetak Laporan</title>
    <link rel="shortcut icon" href="<?= base_url() ?>/docs/themeforest/base/assets/images/favicon.ico">
	<style type="text/css">
		table {
			font-family: "Times New Roman", serif;
			border-style: double;
			border-width: 3px;
			border-color: white;
		}
		table tr .text2 {
			text-align: right;
			font-size: 13px;
		}
		table tr .text {
			text-align: center;
			font-size: 13px;
		}
		table tr td {
			font-size: 13px;
		}

	</style>
</head>
<body>
	<center>
		<table width="625">
			<tr>
				<td><img src="<?= base_url() ?>/docs/img/logo.jpg" width="90" height="90"></td>
				<td>
				<center>
					<font size="4"><b>KLINIK MARYAM</b></font><br>
					<font size="2"><i>Desa Kedungpanji, Kec Lembeyan Kab. Magetan, Jawa Timur</i></font><br>
					<font size="2"><i>Email : klinikmaryam@gmail.com</i></font><br>
					<font size="3">MAGETAN (63372)</font>
				</center>
				</td>
			</tr>
			<tr>
				<td colspan="2"><b><hr></b></td>
			</tr>
		</table>
		<center>
			<h3>
				<?= $judul; ?>
			</h3>
		</center>
		<table width="625" border="1">
            <tr>
                <th style="text-align: center;">No</th>
                <th style="text-align: center;">Nama Pasien</th>
                <th style="text-align: center;">Nama Poli</th>
                <th style="text-align: center;">No Telp</th>
                <th style="text-align: center;">Alamat</th>
                <th style="text-align: center;">Tanggal Daftar</th>
            </tr>
        	<?php
            $no = 1;
            foreach ($laporan as $item) {
            ?>
            <tr>
                <td width="1%" style="text-align: center;"><?= $no++; ?></td>
                <td><?= $item['nama_pasien']; ?></td>
                <td style="text-align: center;"><?= $item['nama_poli']; ?></td>
                <td style="text-align: center;"><?= $item['no_telp_pasien']; ?></td>
                <td style="text-align: center;"><?= $item['alamat_pasien']; ?></td>
                <td style="text-align: center;"><?= $item['tanggal_daftar']; ?></td>
            </tr>
            <?php } ?>
		</table>
	</center>
</body>
	<script>
		window.print();
	</script>
</html>
