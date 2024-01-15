<h1>Daftar Artikel</h1>


<table border="1" width="100%" cellspacing="0">
    <thead>
        <tr>
            <th>#</th>
            <th>Title</th>
            <th>Author</th>
            <th>Created at</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $i=1;
        foreach ($artikel as $artikel) : ?>
            <tr>
                <th><?= $i ?></th>
                <td><?= $artikel->title; ?></td>
                <td><?= $artikel->username; ?></td>
                <td><?= $artikel->created_at; ?></td>
            </tr>
        <?php 
        $i++;
        endforeach; ?>
    </tbody>
</table>