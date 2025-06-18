document.addEventListener('DOMContentLoaded', () => {
    // API de boas-vindas
    const welcomeEl = document.getElementById('welcome');
    if (welcomeEl) {
        fetch('api/saudacao.php')
            .then(res => res.json())
            .then(data => { welcomeEl.innerText = data.mensagem; })
            .catch(err => {
                console.error('Erro ao carregar saudação:', err);
                welcomeEl.innerText = 'Bem-vindo!';
            });
    }
    // API de temperatura
    const weatherEl = document.getElementById('weather');
    if (weatherEl) {
        fetch('https://api.open-meteo.com/v1/forecast?latitude=-29.7&longitude=-51.1&current_weather=true')
            .then(res => res.json())
            .then(data => {
                const temp = data.current_weather.temperature;
                weatherEl.innerText = `Temperatura atual: ${temp}°C`;
            })
            .catch(err => {
                console.error('Erro ao carregar clima:', err);
                weatherEl.innerText = 'Não foi possível carregar a temperatura';
            });
    }
});