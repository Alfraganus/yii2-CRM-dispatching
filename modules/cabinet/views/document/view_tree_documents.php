<div class="alert alert-success">
    <strong> <h2 class="text-center">The document info</h2></strong>
</div>
<div class="container">
        <?php foreach ($documents as $index => $documen):?>

            <?php $user_documents = \app\models\UserUploadedDocuments::find()
                ->where(['company_id'=>$company_id,'document_id'=>$documen->id,'user_id'=>$user_id])
                ->all() ?>


        <?php if(!is_null($user_documents[0]['document_id'])): ?>
                <h2><?=$documen->required_document_name?></h2>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Info keys</th>
                <th>Info values</th>
            </tr>
            </thead>
            <tbody>

        <?php foreach ($user_documents as $document): ?>

            <tr>
                <td style="width: 450px"> <?=$document->documentChildName->document_name?></td>
                <td>
            <?php if(array_keys($document->document)[0] == 'text') :?>
            <?=$document->document['text']['text']?>
            <?php elseif(array_keys($document->document)[0] == 'date') :?>
                <?=$document->document['date']['date']?>
            <?php elseif(array_keys($document->document)[0] == 'file') :?>
                <a href="<?=\yii\helpers\Url::to(['download-file','id'=>$document->document_id])?>">
                    <button class="btn btn-success">Download</button>
                </a>
            <?php endif;?>
                </td>
            </tr>
        <?php endforeach;?>
            </tbody>
        </table>
     <?php endif?>
        <?php endforeach; ?>


</div>