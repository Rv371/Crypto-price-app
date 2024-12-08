<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crypto Prices</title>
</head>
<body>
<h1>Crypto Prices</h1>

<table border="1">
    <thead>
        <tr>
            <th>Crypto</th>
            <th>Price (USD)</th>
        </tr>
    </thead>
    <tbody id="crypto-prices">
    </tbody>
</table>

<script src="{{ mix('js/app.js') }}"></script>
<script>
    window.Echo.channel('crypto-prices')
        .listen('CryptoPriceUpdated', (event) => {
            const prices = event.crypto;
            let rows = '';
            for (const [coin, data] of Object.entries(prices)) {
                rows += `<tr>
                    <td>${coin.toUpperCase()}</td>
                    <td>${data.usd} USD</td>
                </tr>`;
            }
            document.getElementById('crypto-prices').innerHTML = rows;
        });
</script>

</body>
</html>
