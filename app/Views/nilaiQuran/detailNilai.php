<h3>Nilai Tahsin</h3>
<table class="table table-typo">
    <tbody>
        <tr>
            <th>
                <p>Fashohah</p>
            </th>
            <td><?= $tahsin['fashohah'] ?? '-' ?></td>
        </tr>
        <tr>
            <th>
                <p>Tajwid</p>
            </th>
            <td><?= $tahsin['tajwid'] ?? '-' ?></td>
        </tr>
        <tr>
            <th>
                <p>Kelancaran</p>
            </th>
            <td><?= $tahsin['kelancaran'] ?? '-' ?></td>
        </tr>
    </tbody>
</table>
<h3>Nilai Tahfidz</h3>
<table id="datatableDetail" class="display table table-striped table-hover">
    <thead>
        <tr>
            <th>Surah</th>
            <th>Halaman</th>
            <th>Ayat</th>
            <th>Nilai</th>
            <th>Aksi</th>
        </tr>
    </thead>
</table>