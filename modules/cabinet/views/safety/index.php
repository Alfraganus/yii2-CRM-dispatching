
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
        <th>View </th>


    </tr>
    </thead>
    <tbody>
    <?php foreach ($drivers as $driver): ?>
        <tr>
            <td><?=$driver['driver_fullname']?></td>
            <td><?=$numOfDocuments?></td>
            <td><?= $submittedDocuments = getUserSubmittedDocuments(
                    $driver['user_id'],
                    $company_id,
                    'driver',
                    true
                )?></td>
            <td><?=$numOfDocuments-$submittedDocuments?></td>
            <td>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width:<?=$percentage =get_percentage_two_numbers($numOfDocuments,$submittedDocuments)?>%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?=$percentage?>%</div>
                </div>
            </td>
            <td>
                <i  style="font-size: 28px;color: blue" class="fa fa-eye" aria-hidden="true"></i>
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