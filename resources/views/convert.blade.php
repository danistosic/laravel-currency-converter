<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Currency Converter</title>

    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="card shadow p-4" style="max-width: 500px; width:100%;">
        
        <h1 class="text-center mb-4">Currency Converter</h1>

        <form action="/convert" method="POST">
            @csrf

            <div class="mb-3">
                <label for="amount" class="form-label">Amount</label>
                <input type="number" step="0.01" name="amount" id="amount" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="direction" class="form-label">Convert</label>
                <select name="direction" id="direction" class="form-select" required>
                    <option value="eur_usd">EUR → USD</option>
                    <option value="usd_eur">USD → EUR</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary w-100">Convert</button>
        </form>

        @if(isset($result))
            <div class="alert alert-info text-center mt-4">
                <strong>Result:</strong> {{ $result }}
            </div>
        @endif

    </div>
</div>

</body>
</html>




