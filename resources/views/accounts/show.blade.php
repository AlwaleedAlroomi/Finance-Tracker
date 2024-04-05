@extends('layout.base')
@section('link-style')
    <link rel="stylesheet" href="{{ url('css/show_acc.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
@endsection
@section('content')
    <div class="container">
        <div class="btn">
            <a class="edit" href="{{ route('accounts.edit', $account) }}">Edit Account</a>
            <a class="delete" href="{{ route('accounts.delete', $account) }}"
                onclick="return confirm('Do you want to delete this product?');">Delete Account</a>
        </div>
        <div class="acc-container">
            <div class="acc-details">
                <h2>Account Name: {{ $account->acc_name }}</h2>
                <h3>Account Balance: {{ $account->amount }}</h3>
            </div>
            <div class="income-canva">
                <canvas id="income-chart"></canvas>
            </div>
        </div>
        <div class="income-details">
            <table id="income-table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($incomes as $income)
                        <tr id="income" data-id="{{ $income->id }}">
                            <td>{{ $income->date }}</td>
                            <td>{{ $income->name }}</td>
                            <td>{{ $income->description }}</td>
                            <td>{{ $income->amount }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script>
        var rows = document.querySelectorAll('#income-table tbody tr');
        rows.forEach(function(row) {
            row.addEventListener('click', function() {
                var id = row.getAttribute('data-id');
                console.log(id);
                window.location.href = "/incomes/" + id + "/show";
            });
        })

        const uniqueXValues = [];
        const summedAmounts = [];
        let xValue, index, amount;
        @foreach ($incomes as $income)
            xValue = "{{ $income->date }}"; // Assuming 'name' represents x-value
            amount = {{ $income->amount }}; // Get the amount

            // Check if the x-value already exists in the uniqueXValues array
            index = uniqueXValues.indexOf(xValue);
            if (index !== -1) {
                // If the x-value exists, add the amount to the corresponding index in summedAmounts
                summedAmounts[index] += amount;
            } else {
                // If the x-value is new, push it to uniqueXValues and add the amount to summedAmounts
                uniqueXValues.push(xValue);
                summedAmounts.push(amount);
            }
        @endforeach

        const chart = new Chart('income-chart', {
            type: 'line',
            data: {
                labels: uniqueXValues,
                datasets: [{
                    backgroundColor: "green",
                    data: summedAmounts
                }]
            },
            options: {
                legend: {
                    display: false
                },
                title: {
                    display: true,
                    text: "Income Data"
                }
            },
        });
    </script>
@endsection
