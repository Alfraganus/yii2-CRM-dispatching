
<div class="container">
    <h2 class="text-center">Drivers submitted documents</h2>
</div>

<table class="table table-hover">
    <thead>
    <tr>
        <th>Driver name</th>
        <th>Documents need to be submitted</th>
        <th>Submitted documents</th>
        <th>Left unsubmitted documents</th>
        <th>Percentage</th>
        <th>View  documents </th>
        <th>send documents</th>


    </tr>
    </thead>
    <tbody>
    <?php foreach ($carriers as $carrier): ?>
        <tr>
            <td><?=$carrier['carrier_name']?></td>
            <td><?=$numOfDocuments?></td>
            <td><?= $submittedDocuments = getUserSubmittedDocuments(
                    $driver['user_id'],
                    $company_id,
                    'driver',
                    true,
                    2
                )?></td>
            <td><?=$numOfDocuments-$submittedDocuments?></td>
            <td>
                <div class="progress">
<!--                    <div class="progress-bar" role="progressbar" style="width:--><?//=$percentage =get_percentage_two_numbers($numOfDocuments,$submittedDocuments)?>/*%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">*/<?//=$percentage?><!--%</div>-->
                </div>
            </td>
            <td>
                <a href="<?=\yii\helpers\Url::to(['document/view-vehicle-document',
                    'company_id'=>$company_id,
                    'user_id'=>$driver['user_id'],
                    'role'=>'driver'])
                ?>">
                    <i  style="font-size: 28px;color: blue" class="fa fa-file" aria-hidden="true"></i>
                </a>
            </td>
            <td>
                <a href="<?=\yii\helpers\Url::to(['document/documents',
                    'user_id'=>$carrier['user_id'],
                    'role'=>'carrier',
                    'document_category'=>2
                ])?>">
                    <i  style="font-size: 28px;color: blue" class="fa fa-upload" aria-hidden="true"></i>
                </a>
            </td>
        </tr>
    <?php endforeach; ?>

    </tbody>
</table>





<style>
    td,th,tr {
        text-align: center;
    }
</style>