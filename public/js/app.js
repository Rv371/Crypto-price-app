// Function to fetch and update prices for all coins in the table
function updateAllPrices() {
    $("#crypto-table-body tr").each(function() {
        let symbol = $(this).attr("data-symbol");
        fetchLivePrice(symbol);
    });
}

// Function to fetch live price for a specific symbol
function fetchLivePrice(symbol) {
    $.ajax({
        url: '/crypto/price',
        method: 'GET',
        data: { symbol: symbol },
        success: function(response) {
            if(response.price) {
                $("#" + symbol + "-price").text(response.price);
            }
        },
        error: function() {
            console.error('Error fetching price for ' + symbol);
        }
    });
}

// Add coin to the table dynamically
function addCoin(symbol) {
    if (!$('#' + symbol + '-row').length) {
        let newRow = `<tr id="${symbol}-row" data-symbol="${symbol}">
                        <td>${symbol}</td>
                        <td id="${symbol}-price">Loading...</td>
                    </tr>`;
        $('#crypto-table-body').append(newRow);
        fetchLivePrice(symbol);
    }
}

// Handle form submission
$(document).ready(function() {
    $('#add-coin-form').on('submit', function(event) {
        event.preventDefault();
        let symbol = $('#coin-symbol').val().toUpperCase();
        addCoin(symbol);
        $('#coin-symbol').val('');
    });

    // Automatically refresh prices every 10 seconds
    setInterval(updateAllPrices, 10000);
});
