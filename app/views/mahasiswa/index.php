<!DOCTYPE html>
<html>
<head>
    <title>Data Mahasiswa</title>

    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        table, th, td {
            border: 1px solid black;
            padding: 8px;
        }

        th {
            background-color: #dddddd;
        }
    </style>
</head>

<body>

    <h1>Data Mahasiswa</h1>

    <table>

        <tr>
            <th>No</th>
            <th>NPM</th>
            <th>Nama Lengkap</th>
            <th>Fakultas</th>
            <th>Jurusan</th>
            <th>Tempat Lahir</th>
            <th>Tanggal Lahir</th>
            <th>Jenis Kelamin</th>
            <th>Status</th>
        </tr>

        <?php $no = 1; ?>

        <?php if (!empty($mahasiswa)) : ?>

    <?php foreach ($mahasiswa as $mhs) : ?>

        <tr>
            <td><?= $mhs['npm']; ?></td>
        </tr>


        <tr>

            <td><?= $no++; ?></td>

            <td><?= $mhs['npm']; ?></td>

            <td><?= $mhs['nama_lengkap']; ?></td>

            <td><?= $mhs['fakultas']; ?></td>

            <td><?= $mhs['jurusan']; ?></td>

            <td><?= $mhs['tempat_lahir']; ?></td>

            <td>
                <?= date('d-m-Y', strtotime($mhs['tanggal_lahir'])); ?>
            </td>

            <td><?= $mhs['jenis_kelamin']; ?></td>

            <td>
                <?= ($mhs['status_id'] == 1) ? 'Aktif' : 'Nonaktif'; ?>
            </td>

        </tr>

        <?php endforeach; ?>

<?php else : ?>

    <tr>
        <td colspan="9">Data mahasiswa kosong</td>
    </tr>

<?php endif; ?>

    </table>

</body>
</html>