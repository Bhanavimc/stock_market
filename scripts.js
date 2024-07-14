document.addEventListener('DOMContentLoaded', function() {
    // Fetch and display stocks
    fetchStocks();
    // Fetch and display watchlist
    fetchWatchlist();
    // Fetch and display transactions
    fetchTransactions();
});

function fetchStocks() {
    fetch('../api/get_stocks.php')
        .then(response => response.json())
        .then(data => {
            let stocksList = document.getElementById('stocksList');
            stocksList.innerHTML = '<h3>Stocks</h3>';
            data.forEach(stock => {
                stocksList.innerHTML += `
                    <div class="card mb-2">
                        <div class="card-body">
                            <h5 class="card-title">${stock.name} (${stock.symbol})</h5>
                            <p class="card-text">Price: $${stock.price}</p>
                            <p class="card-text">Change: $${stock.change}</p>
                            <p class="card-text">Volume: ${stock.volume}</p>
                        </div>
                    </div>`;
            });
        });
}

function fetchWatchlist() {
    fetch('../api/get_watchlist.php')
        .then(response => response.json())
        .then(data => {
            let watchlist = document.getElementById('watchlist');
            watchlist.innerHTML = '<h3>Watchlist</h3>';
            data.forEach(stock => {
                watchlist.innerHTML += `
                    <div class="card mb-2">
                        <div class="card-body">
                            <h5 class="card-title">${stock.name} (${stock.symbol})</h5>
                            <p class="card-text">Price: $${stock.price}</p>
                            <p class="card-text">Change: $${stock.change}</p>
                            <p class="card-text">Volume: ${stock.volume}</p>
                        </div>
                    </div>`;
            });
        });
}

function fetchTransactions() {
    fetch('../api/get_transactions.php')
        .then(response => response.json())
        .then(data => {
            let transactionsList = document.getElementById('transactionsList');
            transactionsList.innerHTML = '<h3>Transactions</h3>';
            data.forEach(transaction => {
                transactionsList.innerHTML += `
                    <div class="card mb-2">
                        <div class="card-body">
                            <h5 class="card-title">${transaction.transaction_type} ${transaction.quantity} shares of ${transaction.stock_name}</h5>
                            <p class="card-text">Price: $${transaction.price}</p>
                            <p class="card-text">Date: ${transaction.date}</p>
                        </div>
                    </div>`;
            });
        });
}
