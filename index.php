<?php
require_once 'helpers.php';
date_default_timezone_set('Europe/Moscow');
$is_auth = rand(0, 1);

$user_name = 'Кирилл'; // укажите здесь ваше имя

$post_cards = [
    [
        'title' => 'Цитата',
        'type' => 'post-quote',
        'content' => 'Мы в жизни любим только раз, а после ищем лишь похожих',
        'author' => 'Лариса',
        'img' => 'userpic-larisa-small.jpg'
    ],
    [
        'title' => 'Игра престолов',
        'type' => 'post-text',
        'content' => 'Не могу дождаться начала финального сезона своего любимого сериала!',
        'author' => 'Владик',
        'img' => 'userpic.jpg'
    ],
    [
        'title' => 'Игра престолов',
        'type' => 'post-text',
        'content' => ' <?php Не могу дождаться начала финального сезона своего любимого сериала! ?> <script> Не могу дождаться начала финального сезона своего любимого сериала! </script> Не могу дождаться начала финального сезона своего любимого сериала! Не могу дождаться начала финального сезона своего любимого сериала! Не могу дождаться начала финального сезона своего любимого сериала! ',
        'author' => 'Владик',
        'img' => 'userpic.jpg'
    ],
    [
        'title' => 'Наконец, обработал фотки!',
        'type' => 'post-photo',
        'content' => 'rock-medium.jpg',
        'author' => 'Виктор',
        'img' => 'userpic-mark.jpg'
    ],
    [
        'title' => 'Моя мечта',
        'type' => 'post-photo',
        'content' => 'coast-medium.jpg',
        'author' => 'Лариса',
        'img' => 'userpic-larisa-small.jpg'
    ],
    [
        'title' => 'Лучшие курсы',
        'type' => 'post-link',
        'content' => 'www.htmlacademy.ru',
        'author' => 'Владик',
        'img' => 'userpic.jpg'
    ]
];
// первый вариант функции (использует 2 переменные и меньше итераций)
function cut_text($str,$length)
{
    if(iconv_strlen($str) <= $length){ //Использовал функцию iconv_strlen в место strlen
        return '<p>' . $str . '</p>';
    }
    $words_arr = explode(' ',$str);
    $index = count($words_arr) - 1;
    for ($i = $index; $i != 0; $i--){ // считаем длину и удаляем по одноиу слову с конца
        unset($words_arr[$i]);
        if(iconv_strlen(implode(' ', $words_arr)) <= $length){
            return '<p>' . implode(' ', $words_arr) . '... </p><a class="post-text__more-link" href="#">Читать далее</a>';
        }
    }
}

//добавляем в масив post_cards случайные даты публикаций
//эту дату будем выводить как оригинальную дату в атрибуте datetime
//также использовать для получения даты в формате «дд.мм.гггг чч: мм» для атрибута title
//а также для
foreach($post_cards as $index => $post_card){
    $post_cards[$index]['post_date'] = generate_random_date($index);
}

//функция для получения формата «дд.мм.гггг чч: мм», который будем выводить в атрибуте title
function get_date_format($original_format_date){
    $timestamp = strtotime($original_format_date);
    return date('d.m.Y H:i', $timestamp);
}

//функция для получения даты в относительном формате, которую будем выводить в нутри тега ti
function get_post_rel_date($post_date)
{
    $cur_date = strtotime('now');
    $post_date = strtotime($post_date);
    $post_interval = $cur_date - $post_date;
    $post_interval_min = floor(($post_interval)/(60));
    $post_interval_hour = floor(($post_interval)/(60*60));
    $post_interval_day = floor(($post_interval)/(60*60*24));
    $post_interval_week = floor(($post_interval)/(60*60*24*7));
    $post_interval_month = floor(($post_interval)/(60*60*24*30));

    if ( $post_interval_min < 60 ) {
        return $post_interval_min . ' ' . get_noun_plural_form($post_interval_min, 'минута', 'минуты', 'минут') . ' назад';
    } elseif ($post_interval_hour < 24 ) {
        return $post_interval_hour . ' ' . get_noun_plural_form($post_interval_hour, 'час', 'часа', 'часов') . ' назад';
    } elseif ($post_interval_day < 7) {
        return $post_interval_day . ' ' . get_noun_plural_form($post_interval_day, 'день', 'дня', 'дней') . ' назад';
    } elseif ($post_interval_week < 5) {
        return $post_interval_week . ' ' . get_noun_plural_form($post_interval_week, 'неделю', 'недели', 'недель') . ' назад';
    } else {
        return $post_interval_month . ' ' . get_noun_plural_form($post_interval_hour, 'месяц', 'месяца', 'месяцов') . ' назад';
    }
}


$main = include_template('main.php', ['post_cards' => $post_cards]);
$layout = include_template('layout.php', [
    'content' => $main,
    'title' => 'readme: популярное',
    'user_name' => $user_name,
    'is_auth' => $is_auth
]);
print($layout);
?>