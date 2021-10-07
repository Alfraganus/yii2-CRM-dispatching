<div class="alert alert-success">
    <strong> <h2 class="text-center">The vehicle infos</h2></strong>
</div>
<div class="container">
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Info keys</th>
            <th>Info values</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($documents as $documen):?>
            <?php $data = json_decode($documen->document); ?>
            <tr>
                <td style="width: 450px"><?=$name = $documen->documentName->required_document_name ?></td>
                <td>
                    <?= $data->$name?>
                </td>
            </tr>
        <?php endforeach;?>

        </tbody>
    </table>
</div>