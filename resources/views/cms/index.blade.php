@extends('cms.layouts.master')
@section('title', 'Sample Page')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
    <h3>Dashboard</h3>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card height-equal">
                    <div class="card-header">
                        <h5>URL clicked ({{ date('M Y') }})</h5>
                    </div>
                    <div class="card-body">
                        <div id="url-clicked"></div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-xl-6 box-col-6">
                <div class="card height-equal">
                    <div class="card-header">
                        <h5>Total Clicked by Link Name ({{ date('M Y') }})</h5>
                    </div>
                    <div class="card-body apex-chart">
                        <div id="total-clicked"></div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-xl-6 box-col-6">
                <div class="card height-equal">
                    <div class="card-header">
                        <h5>URL clicked ({{ date('M Y') }})</h5>
                    </div>
                    <div class="card-body">
                        <div id="days-clicked"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('assets/js/chart/apex-chart/apex-chart.js') }}"></script>
    {{-- <script src="{{ asset('assets/js/chart/apex-chart/chart-custom.js') }}"></script> --}}
    <script>
        //line chart

        var options = {
            chart: {
                height: 350,
                type: 'bar',
                stacked: true,
                toolbar: {
                    show: false
                }
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    borderRadius: 0,
                    dataLabels: {
                        total: {
                            enabled: true,
                            style: {
                                fontSize: '13px',
                                fontWeight: 100
                            }
                        }
                    }
                },
            },
            responsive: [{
                breakpoint: 480,
                options: {
                    legend: {
                        position: 'bottom',
                        offsetX: -10,
                        offsetY: 0
                    }
                }
            }],
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'smooth'
            },
            series: [
                @foreach ($user->links as $link)
                    {
                        name: '{{ $link->name }}',
                        data: [
                            @foreach ($link->line_chart as $chart)
                                {{ $chart['total'] }},
                            @endforeach
                        ]
                    },
                @endforeach
            ],

            xaxis: {
                type: 'day',
                categories: [
                    @foreach ($ranges as $range)
                        "{{ date('d', strtotime($range)) }}",
                    @endforeach
                ],
            },
            tooltip: {
                x: {
                    format: 'dd'
                },
            },
            colors: ["#ed254e", "#3c4853", "#f38155", "#f9dc5c", "#f7eead", "#7495be", "#f4fffd", "#171e26", "#022e64",
                "#7c8ea2"
            ],
        }

        var chart = new ApexCharts(document.querySelector("#url-clicked"), options);
        chart.render();
    </script>
    <script>
        //pie chart\
        var options8 = {
            chart: {
                width: 500,
                type: 'pie',
            },
            labels: [
                @foreach ($user->pie_chart as $chart)
                    '{{ $chart->link_name }}',
                @endforeach
            ],
            series: [
                @foreach ($user->pie_chart as $chart)
                    {{ $chart->total }},
                @endforeach
            ],
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200
                    },
                    legend: {
                        show: true,
                        position: 'bottom'
                    }
                }
            }],
            colors: ["#ed254e", "#3c4853", "#f38155", "#f9dc5c", "#f7eead", "#7495be", "#f4fffd", "#171e26", "#022e64",
                "#7c8ea2"
            ],
        }

        var chart8 = new ApexCharts(
            document.querySelector("#total-clicked"),
            options8
        );

        chart8.render();
    </script>
    <script>
        //line chart

        var options = {
            chart: {
                height: 350,
                type: 'bar',
                toolbar: {
                    show: false
                }
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    borderRadius: 0,
                    dataLabels: {
                        total: {
                            enabled: true,
                            style: {
                                fontSize: '13px',
                                fontWeight: 100
                            }
                        }
                    }
                },
            },
            responsive: [{
                breakpoint: 480,
                options: {
                    legend: {
                        position: 'bottom',
                        offsetX: -10,
                        offsetY: 0
                    }
                }
            }],
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'smooth'
            },
            series: [{
                name: 'Total',
                data: [
                    @foreach ($user->days as $day)
                        {{ $day['total'] }},
                    @endforeach
                ]
            }],
            xaxis: {
                type: 'text',
                categories: [
                    @foreach ($user->days as $day)
                        "{{ $day['name'] }}",
                    @endforeach
                ],
            },
            tooltip: {
                x: {
                    format: 'dd'
                },
            },
            colors: ["#ed254e", "#3c4853", "#f38155", "#f9dc5c", "#f7eead", "#7495be", "#f4fffd", "#171e26", "#022e64",
                "#7c8ea2"
            ],
        }

        var chart = new ApexCharts(document.querySelector("#days-clicked"), options);
        chart.render();
    </script>
@endsection
