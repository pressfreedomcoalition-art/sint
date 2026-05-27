<?php
/** @var array<string, mixed> $user */
$resultsUrl = BASE_URL . '/search_results.php?token=' . urlencode((string) $user['token']);
$requestUrl = BASE_URL . '/search_request.php?token=' . urlencode((string) $user['token']);
?>
<script>
    $('#search_by_name').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: $(this).attr('method'),
            url: '<?= $requestUrl ?>',
            data: $(this).serialize(),
            async: true,
            dataType: "html",
            beforeSend: function () {
                $("#message1").show();
            },
            success: function () {
                window.location.href = '<?= $resultsUrl ?>';
            }
        });
    });
    $('#search_by_phone').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: $(this).attr('method'),
            url: '<?= $requestUrl ?>',
            data: $(this).serialize(),
            async: true,
            dataType: "html",
            beforeSend: function () {
                $("#message2").show();
            },
            success: function () {
                window.location.href = '<?= $resultsUrl ?>';
            }
        });
    });
    $('#search_by_email').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: $(this).attr('method'),
            url: '<?= $requestUrl ?>',
            data: $(this).serialize(),
            async: true,
            dataType: "html",
            beforeSend: function () {
                $("#message3").show();
            },
            success: function () {
                window.location.href = '<?= $resultsUrl ?>';
            }
        });
    });
</script>
