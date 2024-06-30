<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получаем данные из формы
    $color = htmlspecialchars($_POST['color']);
    $size = htmlspecialchars($_POST['size']);
    $name = htmlspecialchars($_POST['name']);
    $phone = htmlspecialchars($_POST['phone']);

    // Токен вашего бота
    $botToken = "7349679896:AAG_tKMyrOqdaT06Vg6Jo0KA3jA2gPvyZJA";
    // ID чата (можно узнать у @userinfobot)
    $chatId = "-4218713109";

    // Формируем сообщение
    $message = "Новая заявка:\n\n";
    $message .= "Колір: " . $color . "\n";
    $message .= "Розмір: " . $size . "\n";
    $message .= "Ім'я: " . $name . "\n";
    $message .= "Телефон: " . $phone . "\n";

    // URL для отправки сообщения через Telegram API
    $url = "https://api.telegram.org/bot$botToken/sendMessage";

    // Параметры запроса
    $data = array(
        'chat_id' => $chatId,
        'text' => $message
    );

    // Инициализация cURL
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Выполнение запроса и получение результата
    $response = curl_exec($ch);
    curl_close($ch);

    // Проверка результата
    if ($response) {
        echo "Заявка успешно отправлена.";
    } else {
        echo "Ошибка при отправке заявки.";
    }
} else {
    echo "Неверный метод запроса.";
}
?>
