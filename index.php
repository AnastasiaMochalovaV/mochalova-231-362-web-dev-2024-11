<?php
function outNumAsLink($number)
{
    if ($number >= 2 && $number <= 9) {
        return "<a href='?content={$number}&html_type=" . ($_GET['html_type'] ?? 'TABLE') . "' class='number-link'>{$number}</a>";
    }
    return "<span class='number'>{$number}</span>";
}

function outTableForm($content) // табличная форма
{
    if ($content) {
        echo '<table class="large">';
        for ($i = 2; $i <= 9; $i++) {
            $result = $content * $i;
            $content_link = outNumAsLink($content);
            $i_link = outNumAsLink($i);
            $result_link = outNumAsLink($result);
            echo "<tr><td>{$content_link} x {$i_link} = {$result_link}</td></tr>";
        }
        echo '</table>';
    } else {
        echo '<table>';
        for ($i = 2; $i <= 9; $i++) {
            echo '<tr>';
            for ($j = 2; $j <= 9; $j++) {
                $result = $i * $j;
                $i_link = outNumAsLink($i);
                $j_link = outNumAsLink($j);
                $result_link = outNumAsLink($result);
                echo "<td>{$i_link} x {$j_link} = {$result_link}</td>";
            }
            echo '</tr>';
        }
        echo '</table>';
    }
}

function outDivForm($content) // блочная форма
{
    $large_class = $content ? 'large' : '';
    if ($content) {
        echo "<div class='ttRow {$large_class}'>";
        for ($i = 2; $i <= 9; $i++) {
            $result = $content * $i;
            $content_link = outNumAsLink($content);
            $i_link = outNumAsLink($i);
            $result_link = outNumAsLink($result);
            echo "<div class='cell'>{$content_link} x {$i_link} = {$result_link}</div>";
        }
        echo '</div>';
    } else {
        echo '<div class="grid">';
        for ($i = 2; $i <= 9; $i++) {
            echo '<div class="ttRow">';
            for ($j = 2; $j <= 9; $j++) {
                $result = $i * $j;
                $i_link = outNumAsLink($i);
                $j_link = outNumAsLink($j);
                $result_link = outNumAsLink($result);
                echo "<div class='cell'>{$i_link} x {$j_link} = {$result_link}</div>";
            }
            echo '</div>';
        }
        echo '</div>';
    }
}

$html_type = $_GET['html_type'] ?? 'TABLE';
$content = $_GET['content'] ?? '';
$current_time = date('Y-m-d H:i:s');
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/main.css" />
    <title>Лабораторная работа 11 - Мочалова А.В. - 231-362 - Таблица умножения</title>
</head>

<body>
    <div id="main_menu">
        <a href="?html_type=TABLE<?php if ($content) echo '&content=' . $content; ?>"
            <?php if (isset($_GET['html_type']) && $html_type == 'TABLE') echo 'class="selected"'; ?>>Табличная форма</a>
        <a href="?html_type=DIV<?php if ($content) echo '&content=' . $content; ?>"
            <?php if (isset($_GET['html_type']) && $html_type == 'DIV') echo 'class="selected"'; ?>>Блочная форма</a>
    </div>

    <div id="container">
        <div id="content_wrapper">
            <div id="product_menu">
                <a href="?content=&html_type=<?php echo $html_type; ?>"
                    <?php if (isset($_GET['content']) && $content == '') echo 'class="selected"'; ?>>Вся таблица умножения</a>
                <?php for ($i = 2; $i <= 9; $i++): ?>
                    <a href="?content=<?php echo $i; ?>&html_type=<?php echo $html_type; ?>"
                        <?php if (isset($_GET['content']) && $content == $i) echo 'class="selected"'; ?>>Таблица умножения на <?php echo $i; ?></a>
                <?php endfor; ?>
            </div>

            <div id="multiplication_table">
                <?php
                if ($html_type == 'TABLE') {
                    outTableForm($content);
                } else {
                    outDivForm($content);
                }
                ?>
            </div>
        </div>
    </div>

    <div id="footer">
        <p>Тип верстки: <?php echo $html_type == 'TABLE' ? 'Табличная' : 'Блочная'; ?></p>
        <p>Название таблицы умножения: <?php echo $content == '' ? 'Вся таблица умножения' : 'Таблица умножения на ' . $content; ?></p>
        <p>Дата и время: <?php echo $current_time; ?></p>
    </div>
</body>

</html>