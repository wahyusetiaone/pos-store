<?php
    $title='Point of Sale';
    $subTitle = 'Dashboard';
    $script = '<script>
            // ===================== Income VS Expense Start ===============================
            function createChartTwo(chartId, color1, color2) {
                var options = {
                    series: [{
                        name: "Income",
                        data: ' . json_encode(array_values($monthlyIncomes)) . '
                    }, {
                        name: "Expense",
                        data: ' . json_encode(array_values($monthlyExpenses)) . '
                    }],
                    legend: {
                        show: false
                    },
                    chart: {
                        type: "area",
                        width: "100%",
                        height: 270,
                        toolbar: {
                            show: false
                        }
                    },
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        curve: "smooth",
                        width: 3,
                        colors: [color1, color2],
                        lineCap: "round"
                    },
                    grid: {
                        show: true,
                        borderColor: "#D1D5DB",
                        strokeDashArray: 1,
                        position: "back"
                    },
                    fill: {
                        type: "gradient",
                        gradient: {
                            shade: "light",
                            type: "vertical",
                            shadeIntensity: 0.5,
                            opacityFrom: [0.4, 0.6],
                            opacityTo: [0.3, 0.3],
                            stops: [0, 100]
                        }
                    },
                    xaxis: {
                        categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"]
                    },
                    yaxis: {
                        labels: {
                            formatter: function(value) {
                                return "Rp " + new Intl.NumberFormat("id-ID").format(value);
                            }
                        }
                    }
                };

                var chart = new ApexCharts(document.querySelector(`#${chartId}`), options);
                chart.render();
            }

            createChartTwo("incomeExpense", "#487FFF", "#FF9F29");

            // ================================ Overall Report Donut chart ================================
            var options = {
                series: ['.$totalPurchases.', '.$totalSales.', '.$totalExpenses.', '.$grossProfit.'],
                colors: ["#FF9F29", "#487FFF", "#45B369", "#9935FE"],
                labels: ["Pembelian", "Penjualan", "Pengeluaran", "Laba Kotor"],
                chart: {
                    type: "donut",
                    height: 270
                },
                plotOptions: {
                    pie: {
                        donut: {
                            size: "85%"
                        }
                    }
                },
                dataLabels: {
                    enabled: true,
                    formatter: function (val) {
                        return Math.round(val) + "%";
                    }
                }
            };

            var chart = new ApexCharts(document.querySelector("#userOverviewDonutChart"), options);
            chart.render();

            // ================================ Purchase & sale chart ================================
            var options = {
                series: [{
                    name: "Pembelian",
                    data: ' . json_encode(array_values($weeklyPurchases)) . '
                }, {
                    name: "Penjualan",
                    data: ' . json_encode(array_values($weeklySales)) . '
                }],
                colors: ["#45B369", "#FF9F29"],
                chart: {
                    type: "bar",
                    height: 260,
                    toolbar: {
                        show: false
                    }
                },
                plotOptions: {
                    bar: {
                        borderRadius: 4,
                        columnWidth: 8
                    }
                },
                xaxis: {
                    categories: ["Sen", "Sel", "Rab", "Kam", "Jum", "Sab", "Min"]
                },
                yaxis: {
                    labels: {
                        formatter: function(value) {
                            return "Rp " + new Intl.NumberFormat("id-ID").format(value);
                        }
                    }
                }
            };

            var chart = new ApexCharts(document.querySelector("#purchaseSaleChart"), options);
            chart.render();
            </script>';
?>

<?php $__env->startSection('content'); ?>
    <div class="row gy-4">
        <div class="col-12">
            <div class="card radius-12">
                <div class="card-body p-16">
                    <div class="row gy-4">
                        <div class="col-xxl-3 col-xl-4 col-sm-6">
                            <div class="px-20 py-16 shadow-none radius-8 h-100 gradient-deep-1 left-line line-bg-primary position-relative overflow-hidden">
                                <div class="d-flex flex-wrap align-items-center justify-content-between gap-1 mb-8">
                                    <div>
                                        <span class="mb-2 fw-medium text-secondary-light text-md">Total Penjualan</span>
                                        <h6 class="fw-semibold mb-1">Rp <?php echo e(number_format($todaySales, 0, ',', '.')); ?></h6>
                                    </div>
                                    <span class="w-44-px h-44-px radius-8 d-inline-flex justify-content-center align-items-center text-2xl mb-12 bg-primary-100 text-primary-600">
                                        <i class="ri-shopping-cart-fill"></i>
                                    </span>
                                </div>
                                <p class="text-sm mb-0">
                                    <?php if($salesGrowth > 0): ?>
                                        <span class="bg-success-focus px-1 rounded-2 fw-medium text-success-main text-sm">
                                            <i class="ri-arrow-right-up-line"></i> <?php echo e(number_format($salesGrowth, 1)); ?>%
                                        </span>
                                    <?php else: ?>
                                        <span class="bg-danger-focus px-1 rounded-2 fw-medium text-danger-main text-sm">
                                            <i class="ri-arrow-right-down-line"></i> <?php echo e(number_format(abs($salesGrowth), 1)); ?>%
                                        </span>
                                    <?php endif; ?>
                                    Dari bulan lalu
                                </p>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-xl-4 col-sm-6">
                            <div class="px-20 py-16 shadow-none radius-8 h-100 gradient-deep-2 left-line line-bg-lilac position-relative overflow-hidden">
                                <div class="d-flex flex-wrap align-items-center justify-content-between gap-1 mb-8">
                                    <div>
                                        <span class="mb-2 fw-medium text-secondary-light text-md">Total Pembelian</span>
                                        <h6 class="fw-semibold mb-1">Rp <?php echo e(number_format($totalPurchasesThisMonth, 0, ',', '.')); ?></h6>
                                    </div>
                                    <span class="w-44-px h-44-px radius-8 d-inline-flex justify-content-center align-items-center text-2xl mb-12 bg-lilac-200 text-lilac-600">
                                        <i class="ri-handbag-fill"></i>
                                    </span>
                                </div>
                                <p class="text-sm mb-0">
                                    <?php if($purchaseGrowth > 0): ?>
                                        <span class="bg-success-focus px-1 rounded-2 fw-medium text-success-main text-sm">
                                            <i class="ri-arrow-right-up-line"></i> <?php echo e(number_format($purchaseGrowth, 1)); ?>%
                                        </span>
                                    <?php else: ?>
                                        <span class="bg-danger-focus px-1 rounded-2 fw-medium text-danger-main text-sm">
                                            <i class="ri-arrow-right-down-line"></i> <?php echo e(number_format(abs($purchaseGrowth), 1)); ?>%
                                        </span>
                                    <?php endif; ?>
                                    Dari bulan lalu
                                </p>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-xl-4 col-sm-6">
                            <div class="px-20 py-16 shadow-none radius-8 h-100 gradient-deep-3 left-line line-bg-success position-relative overflow-hidden">
                                <div class="d-flex flex-wrap align-items-center justify-content-between gap-1 mb-8">
                                    <div>
                                        <span class="mb-2 fw-medium text-secondary-light text-md">Total Pendapatan</span>
                                        <h6 class="fw-semibold mb-1">Rp <?php echo e(number_format($incomeThisMonth, 0, ',', '.')); ?></h6>
                                    </div>
                                    <span class="w-44-px h-44-px radius-8 d-inline-flex justify-content-center align-items-center text-2xl mb-12 bg-success-200 text-success-600">
                                        <i class="ri-money-dollar-circle-fill"></i>
                                    </span>
                                </div>
                                <p class="text-sm mb-0">
                                    <?php if($incomeGrowth > 0): ?>
                                        <span class="bg-success-focus px-1 rounded-2 fw-medium text-success-main text-sm">
                                            <i class="ri-arrow-right-up-line"></i> <?php echo e(number_format($incomeGrowth, 1)); ?>%
                                        </span>
                                    <?php else: ?>
                                        <span class="bg-danger-focus px-1 rounded-2 fw-medium text-danger-main text-sm">
                                            <i class="ri-arrow-right-down-line"></i> <?php echo e(number_format(abs($incomeGrowth), 1)); ?>%
                                        </span>
                                    <?php endif; ?>
                                    Dari bulan lalu
                                </p>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-xl-4 col-sm-6">
                            <div class="px-20 py-16 shadow-none radius-8 h-100 gradient-deep-4 left-line line-bg-warning position-relative overflow-hidden">
                                <div class="d-flex flex-wrap align-items-center justify-content-between gap-1 mb-8">
                                    <div>
                                        <span class="mb-2 fw-medium text-secondary-light text-md">Total Pengeluaran</span>
                                        <h6 class="fw-semibold mb-1">Rp <?php echo e(number_format($expensesThisMonth, 0, ',', '.')); ?></h6>
                                    </div>
                                    <span class="w-44-px h-44-px radius-8 d-inline-flex justify-content-center align-items-center text-2xl mb-12 bg-warning-focus text-warning-600">
                                        <i class="ri-wallet-3-fill"></i>
                                    </span>
                                </div>
                                <p class="text-sm mb-0">
                                    <?php if($expenseGrowth > 0): ?>
                                        <span class="bg-danger-focus px-1 rounded-2 fw-medium text-danger-main text-sm">
                                            <i class="ri-arrow-right-up-line"></i> <?php echo e(number_format($expenseGrowth, 1)); ?>%
                                        </span>
                                    <?php else: ?>
                                        <span class="bg-success-focus px-1 rounded-2 fw-medium text-success-main text-sm">
                                            <i class="ri-arrow-right-down-line"></i> <?php echo e(number_format(abs($expenseGrowth), 1)); ?>%
                                        </span>
                                    <?php endif; ?>
                                    Dari bulan lalu
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xxl-8">
            <div class="card h-100">
                <div class="card-body p-24 mb-8">
                    <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between">
                        <h6 class="mb-2 fw-bold text-lg mb-0">Pendapatan vs Pengeluaran</h6>
                        <select class="form-select form-select-sm w-auto bg-base border text-secondary-light">
                            <option value="yearly">Tahunan</option>
                            <option value="monthly">Bulanan</option>
                            <option value="weekly">Mingguan</option>
                        </select>
                    </div>
                    <ul class="d-flex flex-wrap align-items-center justify-content-center my-3 gap-24">
                        <li class="d-flex flex-column gap-1">
                            <div class="d-flex align-items-center gap-2">
                                <span class="w-8-px h-8-px rounded-pill bg-primary-600"></span>
                                <span class="text-secondary-light text-sm fw-semibold">Pendapatan</span>
                            </div>
                            <div class="d-flex align-items-center gap-8">
                                <h6 class="mb-0">Rp <?php echo e(number_format($incomeThisMonth, 0, ',', '.')); ?></h6>
                                <span class="text-<?php echo e($incomeGrowth >= 0 ? 'success' : 'danger'); ?>-600 d-flex align-items-center gap-1 text-sm fw-bolder">
                                    <?php echo e(number_format(abs($incomeGrowth), 1)); ?>%
                                    <i class="ri-arrow-<?php echo e($incomeGrowth >= 0 ? 'up' : 'down'); ?>-s-fill d-flex"></i>
                                </span>
                            </div>
                        </li>
                        <li class="d-flex flex-column gap-1">
                            <div class="d-flex align-items-center gap-2">
                                <span class="w-8-px h-8-px rounded-pill bg-warning-600"></span>
                                <span class="text-secondary-light text-sm fw-semibold">Pengeluaran</span>
                            </div>
                            <div class="d-flex align-items-center gap-8">
                                <h6 class="mb-0">Rp <?php echo e(number_format($expensesThisMonth, 0, ',', '.')); ?></h6>
                                <span class="text-<?php echo e($expenseGrowth >= 0 ? 'danger' : 'success'); ?>-600 d-flex align-items-center gap-1 text-sm fw-bolder">
                                    <?php echo e(number_format(abs($expenseGrowth), 1)); ?>%
                                    <i class="ri-arrow-<?php echo e($expenseGrowth >= 0 ? 'up' : 'down'); ?>-s-fill d-flex"></i>
                                </span>
                            </div>
                        </li>
                    </ul>
                    <div id="incomeExpense" class="apexcharts-tooltip-style-1"></div>
                </div>
            </div>
        </div>

        <div class="col-xxl-4 col-md-6">
            <div class="card h-100">
                <div class="card-header">
                    <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between">
                        <h6 class="mb-2 fw-bold text-lg">Ringkasan</h6>
                        <select class="form-select form-select-sm w-auto bg-base border text-secondary-light">
                            <option value="yearly">Tahunan</option>
                            <option value="monthly">Bulanan</option>
                            <option value="weekly">Mingguan</option>
                        </select>
                    </div>
                </div>
                <div class="card-body p-24">
                    <div class="mt-32">
                        <div id="userOverviewDonutChart" class="mx-auto apexcharts-tooltip-z-none"></div>
                    </div>
                    <div class="d-flex flex-wrap gap-20 justify-content-center mt-48">
                        <div class="d-flex align-items-center gap-8">
                            <span class="w-16-px h-16-px radius-2 bg-primary-600"></span>
                            <span class="text-secondary-light">Pembelian</span>
                        </div>
                        <div class="d-flex align-items-center gap-8">
                            <span class="w-16-px h-16-px radius-2 bg-lilac-600"></span>
                            <span class="text-secondary-light">Penjualan</span>
                        </div>
                        <div class="d-flex align-items-center gap-8">
                            <span class="w-16-px h-16-px radius-2 bg-warning-600"></span>
                            <span class="text-secondary-light">Pengeluaran</span>
                        </div>
                        <div class="d-flex align-items-center gap-8">
                            <span class="w-16-px h-16-px radius-2 bg-success-600"></span>
                            <span class="text-secondary-light">Laba Kotor</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xxl-4 col-md-6">
            <div class="card h-100">
                <div class="card-header">
                    <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between">
                        <h6 class="mb-2 fw-bold text-lg mb-0">Pembelian & Penjualan</h6>
                        <select class="form-select form-select-sm w-auto bg-base text-secondary-light">
                            <option value="weekly">Minggu Ini</option>
                            <option value="monthly">Bulan Ini</option>
                            <option value="yearly">Tahun Ini</option>
                        </select>
                    </div>
                </div>
                <div class="card-body p-24">
                    <ul class="d-flex flex-wrap align-items-center justify-content-center my-3 gap-3">
                        <li class="d-flex align-items-center gap-2">
                            <span class="w-12-px h-8-px rounded-pill bg-warning-600"></span>
                            <span class="text-secondary-light text-sm fw-semibold">Pembelian: Rp <?php echo e(number_format($totalPurchasesThisMonth, 0, ',', '.')); ?></span>
                        </li>
                        <li class="d-flex align-items-center gap-2">
                            <span class="w-12-px h-8-px rounded-pill bg-success-600"></span>
                            <span class="text-secondary-light text-sm fw-semibold">Penjualan: Rp <?php echo e(number_format($monthSales, 0, ',', '.')); ?></span>
                        </li>
                    </ul>
                    <div id="purchaseSaleChart" class="margin-16-minus y-value-left"></div>
                </div>
            </div>
        </div>

        <div class="col-xxl-8">
            <div class="card h-100">
                <div class="card-header">
                    <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between">
                        <h6 class="mb-2 fw-bold text-lg mb-0">Transaksi Terakhir</h6>
                        <a href="<?php echo e(route('sales.index')); ?>" class="text-primary-600 hover-text-primary d-flex align-items-center gap-1">
                            Lihat Semua
                            <iconify-icon icon="solar:alt-arrow-right-linear" class="icon"></iconify-icon>
                        </a>
                    </div>
                </div>
                <div class="card-body p-24">
                    <div class="table-responsive scroll-sm">
                        <table class="table bordered-table mb-0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Jenis Pembayaran</th>
                                    <th>Dibayar</th>
                                    <th>Sisa</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $recentSales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $sale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="text-secondary-light"><?php echo e($index + 1); ?></td>
                                    <td class="text-secondary-light"><?php echo e(\Carbon\Carbon::parse($sale->sale_date)->format('d M Y')); ?></td>                                    <td class="text-secondary-light"><?php echo e($sale->payment_method); ?></td>
                                    <td class="text-secondary-light">Rp <?php echo e(number_format($sale->paid, 0, ',', '.')); ?></td>
                                    <td class="text-secondary-light">Rp <?php echo e(number_format($sale->total - $sale->paid, 0, ',', '.')); ?></td>
                                    <td class="text-secondary-light">Rp <?php echo e(number_format($sale->total, 0, ',', '.')); ?></td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Project\Experiment\pos_app\resources\views/dashboard/index.blade.php ENDPATH**/ ?>