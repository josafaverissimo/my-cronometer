<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chronometer</title>
</head>

<body style="
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        min-height: 100vh;
        font-size: 5rem;
    ">
    <div style="display: flex; flex-direction: column; align-items: center;">
        <h1 style="margin: 0; padding-bottom: 0;">Meu cronômetro</h1>
        <span id="time"></span>
    </div>

    <div>
        <?php if (empty($dateTime)) : ?>
            <form id="cronometer-form">
                <input style="
                        width: 41rem;
                        height: 12rem;
                        font-size: 3rem;
                        text-align: center;
                    " type="text" name="time" value="23:59:59" hidden>
                <button type="submit" style="
                        width: 21rem;
                        height: 7rem;
                        font-size: 3rem;
                    ">Start Cronometer</button>
            </form>
        <?php endif; ?>
    </div>

    <footer>
        <script src="/cronometer/public/assets/js/scripts.js"></script>
        <?php if (!empty($dateTime)) : ?>
            <script>
                Cronometer.dateTimeStorage = "<?= $dateTime; ?>"
            </script>
        <?php endif; ?>
    </footer>
</body>

</html>