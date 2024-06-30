const express = require('express');
const bodyParser = require('body-parser');
const axios = require('axios');
const app = express();
const port = 6000;

// Middleware для парсинга данных формы
app.use(bodyParser.urlencoded({ extended: true }));

app.post('/submit', async (req, res) => {
    const { color, size, name, phone } = req.body;

    const botToken = '7349679896:AAG_tKMyrOqdaT06Vg6Jo0KA3jA2gPvyZJA';
    const chatId = '-4218713109';
    const message = `Новая заявка:\n\nКолір: ${color}\nРозмір: ${size}\nІм'я: ${name}\nТелефон: ${phone}`;

    const url = `https://api.telegram.org/bot${botToken}/sendMessage`;

    try {
        const response = await axios.post(url, {
            chat_id: chatId,
            text: message
        });

        if (response.data.ok) {
            res.send("Заявка успешно отправлена.");
        } else {
            res.send("Ошибка при отправке заявки.");
        }
    } catch (error) {
        res.send("Ошибка при отправке заявки.");
    }
});

app.get('/', (req, res) => {
    res.send('Node.js сервер работает');
});

app.listen(port, () => {
    console.log(`Сервер запущен на порту ${port}`);
});
