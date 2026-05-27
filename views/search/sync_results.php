<?php
/**
 * @var array<string, array<int, array<string, mixed>>> $results
 * @var int $sourceCount
 */
?>
<div class="container-xl px-4 mt-4">
    <div class="row">
        <div class="col-xl-12">
            <div class="card mb-8">
                <div class="card-header">Результаты</div>
                <div class="card-body">
<?php
$emptyCount = 0;
foreach ($results as $base => $rows) {
    if (count($rows) > 0) {
        echo $base . "\r\n <br /> <br /> ";
        foreach ($rows as $row) {
            echo implode(';', $row) . '<br /> <br />';
        }
    } else {
        $emptyCount++;
    }
}
if ($emptyCount === $sourceCount) {
    echo 'Ничего не найдено';
}
?>
                </div>
            </div>
        </div>
    </div>
</div>
