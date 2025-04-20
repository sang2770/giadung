@extends('layouts.admin')
@section('content')
<div class="main-content-inner">

    <div class="main-content-wrap">
        <div class="tf-section-2 mb-30">
            <div class="flex gap20 flex-wrap-mobile">
                <div class="w-half">
                    <div class="wg-chart-default mb-20">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap14">
                                <div class="image ic-bg">
                                    <i class="icon-shopping-bag"></i>
                                </div>
                                <div>
                                    <div class="body-text mb-2">Tổng đơn hàng</div>
                                    <h4>{{ $totalOrders }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="wg-chart-default mb-20">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap14">
                                <div class="image ic-bg">
                                    <i class="icon-shopping-bag"></i>
                                </div>
                                <div>
                                    <div class="body-text mb-2">Tổng người dùng</div>
                                    <h4>{{ $totalUsers }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="wg-chart-default mb-20">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap14">
                                <div class="image ic-bg">
                                    <i class="icon-dollar-sign"></i>
                                </div>
                                <div>
                                    <div class="body-text mb-2">Tổng doanh thu</div>
                                    <h4>{{ number_format($totalRevenue, 0, ',', '.') }} đ</h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="wg-chart-default">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap14">
                                <div class="image ic-bg">
                                    <i class="icon-dollar-sign"></i>
                                </div>
                                <div>
                                    <div class="body-text mb-2">Tổng lợi nhuận</div>
                                    <h4>{{ number_format($totalProfit, 0, ',', '.') }} đ</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="w-half">
                    <div class="wg-chart-default mb-20 p-4 bg-white rounded-xl">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center gap-4">
                                <div class="image ic-bg bg-blue-100 p-3 rounded-full">
                                    <i class="icon-shopping-bag text-blue-600 text-xl"></i>
                                </div>
                                <div>
                                    <div class="body-text mb-2 font-medium text-gray-500">Doanh thu</div>
                                    <h4 id="revenue-value" class="text-2xl font-bold text-gray-800">0 đ</h4> <!-- Hiển thị mặc định là 0 -->
                                </div>
                            </div>
                        </div>
                    
                        <form id="revenue-filter-form">
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div>
                                    <label for="from_date" class="block text-sm text-gray-600 mb-1">Từ ngày</label>
                                    <input type="date" name="from_date" id="from_date" class="w-full border border-gray-300 rounded px-3 py-2">
                                </div>
                                <div>
                                    <label for="to_date" class="block text-sm text-gray-600 mb-1">Đến ngày</label>
                                    <input type="date" name="to_date" id="to_date" class="w-full border border-gray-300 rounded px-3 py-2">
                                </div>
                                <div class="flex items-end">
                                    <button type="submit" style="background-color: brown; margin-top: 5px" class="text-white px-4 py-2 rounded hover:bg-blue-700 w-full">Lọc</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    

                    <div class="wg-chart-default mb-20 p-4 bg-white rounded-xl">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center gap-4">
                                <div class="image ic-bg bg-blue-100 p-3 rounded-full">
                                    <i class="icon-shopping-bag text-blue-600 text-xl"></i>
                                </div>
                                <div>
                                    <div class="body-text mb-2 font-medium text-gray-500">Lợi nhuận</div>
                                    <h4 id="profit-value" class="text-2xl font-bold text-gray-800">0 đ</h4>
                                </div>
                            </div>
                        </div>
                    
                        <form id="profit-filter-form">
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div>
                                    <label for="profit_from_date" class="block text-sm text-gray-600 mb-1">Từ ngày</label>
                                    <input type="date" name="from_date" id="profit_from_date" class="w-full border border-gray-300 rounded px-3 py-2">
                                </div>
                                <div>
                                    <label for="profit_to_date" class="block text-sm text-gray-600 mb-1">Đến ngày</label>
                                    <input type="date" name="to_date" id="profit_to_date" class="w-full border border-gray-300 rounded px-3 py-2">
                                </div>
                                <div class="flex items-end">
                                    <button type="submit" style="background-color: brown; margin-top: 5px" class="text-white px-4 py-2 rounded hover:bg-blue-700 w-full">Lọc</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    
                </div>

            </div>

            <div class="wg-box">
                <div class="flex items-center justify-between" style="justify-content: center;">
                    <h5>Biểu đồ số đơn hàng và người dùng theo tháng</h5>
                </div>
                <div class="flex flex-wrap gap40">
                    
                </div>
                {{-- <div id="line-chart-8"></div> --}}
                <canvas id="barChart" height="250"></canvas>
            </div>

        </div>
        {{-- <div class="tf-section mb-30">

            <div class="wg-box">
                <div class="flex items-center justify-between">
                    <h5>Recent orders</h5>
                    <div class="dropdown default">
                        <a class="btn btn-secondary dropdown-toggle" href="#">
                            <span class="view-all">View all</span>
                        </a>
                    </div>
                </div>
                <div class="wg-table table-all-user">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 80px">OrderNo</th>
                                    <th>Name</th>
                                    <th class="text-center">Phone</th>
                                    <th class="text-center">Subtotal</th>
                                    <th class="text-center">Tax</th>
                                    <th class="text-center">Total</th>

                                    <th class="text-center">Status</th>
                                    <th class="text-center">Order Date</th>
                                    <th class="text-center">Total Items</th>
                                    <th class="text-center">Delivered On</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center">1</td>
                                    <td class="text-center">Divyansh Kumar</td>
                                    <td class="text-center">1234567891</td>
                                    <td class="text-center">$172.00</td>
                                    <td class="text-center">$36.12</td>
                                    <td class="text-center">$208.12</td>

                                    <td class="text-center">ordered</td>
                                    <td class="text-center">2024-07-11 00:54:14</td>
                                    <td class="text-center">2</td>
                                    <td></td>
                                    <td class="text-center">
                                        <a href="#">
                                            <div class="list-icon-function view-icon">
                                                <div class="item eye">
                                                    <i class="icon-eye"></i>
                                                </div>
                                            </div>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div> --}}
    </div>

</div>


@endsection

@push('scripts')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    fetch('/admin/chart-data')
        .then(response => response.json())
        .then(data => {
            const labels = Object.keys(data).map(month => `Tháng ${month}`);
            const orderData = Object.values(data).map(item => item.orders);
            const userData = Object.values(data).map(item => item.users);

            const ctx = document.getElementById('barChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [
                        {
                            label: 'Số đơn hàng',
                            data: orderData,
                            backgroundColor: 'rgba(75, 192, 192, 0.7)',
                        },
                        {
                            label: 'Số người dùng',
                            data: userData,
                            backgroundColor: 'rgba(255, 99, 132, 0.7)',
                        }
                    ]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        // title: {
                        //     display: true,
                        //     text: 'Số đơn hàng và người dùng theo tháng'
                        // }
                    }
                }
            });
        });
</script>

<script>
    document.getElementById('revenue-filter-form').addEventListener('submit', function (e) {
        e.preventDefault(); // Ngừng hành động mặc định của form

        // Lấy giá trị từ các trường ngày
        const fromDate = document.getElementById('from_date').value;
        const toDate = document.getElementById('to_date').value;

        // Gửi yêu cầu AJAX tới controller với dữ liệu từ form
        fetch("{{ route('admin.revenue.filter') }}", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ from_date: fromDate, to_date: toDate })
        })
        .then(response => response.json()) // Chuyển đổi phản hồi thành JSON
        .then(data => {
            // Cập nhật lại doanh thu và lợi nhuận sau khi nhận được dữ liệu từ server
            const formattedRevenue = new Intl.NumberFormat('vi-VN').format(data.totalRevenue);
            document.getElementById('revenue-value').textContent = formattedRevenue + ' đ';
        })
        .catch(error => console.error('Lỗi khi lọc:', error));
    });

    $('#profit-filter-form').submit(function(e) {
        e.preventDefault();

        let fromDate = $('#profit_from_date').val();
        let toDate = $('#profit_to_date').val();

        $.ajax({
            url: '{{ route("admin.profit.filter") }}',
            method: 'GET',
            data: {
                from_date: fromDate,
                to_date: toDate
            },
            success: function(response) {
                const totalProfit = response.totalProfit || 0;
                $('#profit-value').text(new Intl.NumberFormat('vi-VN').format(totalProfit) + ' đ');
            },
            error: function() {
                alert('Đã có lỗi xảy ra khi lọc lợi nhuận');
            }
        });
    });

</script>
@endpush