@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <canvas id="categoryPieChart"></canvas>
        </div>
    </div>
</div>

<script>
    var ctx = document.getElementById('categoryPieChart').getContext('2d');
    axios.get('/chart/category-distribution')
        .then(function (response) {
            var data = response.data;
            var labels = data.map(item => item.label);
            var values = data.map(item => item.value);

            var chart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: labels,
                    datasets: [{
                        data: values,
                        backgroundColor: [
                            // Add your preferred colors here
                        ],
                    }],
                },
            });
        })
        .catch(function (error) {
            console.log(error);
        });
</script>
@endsection
