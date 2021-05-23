
        <div class="row">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header">
                        <h4>Invoices</h4>
                        <!-- <div class="card-header-action">
                            <a href="#" class="btn btn-danger">View More <i class="fas fa-chevron-right"></i></a>
                        </div> -->
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive table-invoice tableFixHead">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>OrderID</th>
                                        <th>Customer</th>
                                        <th>Phone</th>
                                        <th>Status</th>
                                        <th>Invoice</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if ($orderresult == '') { ?>
                                        <tr>
                                            <td colspan="5">
                                                <label>No Invoices to Display</label>
                                            </td>
                                        </tr>

                                    <?php   } else { ?>

                                        <?php foreach ($orderresult as $row) { ?>
                                            <tr>

                                                <td><b><?= @$row['id']; ?></b></td>
                                                <td><?= @$row['name']; ?></td>
                                                <td>
                                                <?= @$row['phone']; ?>
                                                </td>
                                                <td><?= @$row['status']; ?></td>
                                                <td>
                                                    <a href="#">Detail</a>
                                                </td>
                                            </tr>
                                    <?php   }
                                    }
                                    ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-4">
                <div class="card">
                    <div class="card-header">
                        <h4>Active Pincodes</h4>
                        <div class="card-header-action">
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#pincodemodel">
                                Add
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        
                        <div class="table-responsive tableFixHead">
                            <table class="table table-striped">
                                <tbody>
                                    <?php if ($pincodelist == '') { ?>
                                        <tr>
                                            <td colspan="2">
                                                <label>NO DATA FOUND</label>
                                            </td>
                                        </tr>

                                    <?php   } else { ?>

                                        <?php foreach ($pincodelist as $row) { ?>
                                            <tr>
                                                <td contenteditable="true" class="pincodeedit" id="<?= @$row['id']; ?>" title="<?= @$row['pincode']; ?>">
                                                    <?= @$row['pincode']; ?>
                                                </td>
                                            </tr>
                                    <?php   }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="card-stats">
                        <div class="card-stats-title">
                            Order Statistics
                            <!-- <div class="dropdown d-inline">
                                <a class="font-weight-600 dropdown-toggle" data-toggle="dropdown" href="#" id="orders-month">August</a>
                                <ul class="dropdown-menu dropdown-menu-sm">
                                    <li class="dropdown-title">Select Month</li>
                                    <li><a href="#" class="dropdown-item">January</a></li>
                                    <li><a href="#" class="dropdown-item">February</a></li>
                                    <li><a href="#" class="dropdown-item">March</a></li>
                                    <li><a href="#" class="dropdown-item">April</a></li>
                                    <li><a href="#" class="dropdown-item">May</a></li>
                                    <li><a href="#" class="dropdown-item">June</a></li>
                                    <li><a href="#" class="dropdown-item">July</a></li>
                                    <li><a href="#" class="dropdown-item active">August</a></li>
                                    <li><a href="#" class="dropdown-item">September</a></li>
                                    <li><a href="#" class="dropdown-item">October</a></li>
                                    <li><a href="#" class="dropdown-item">November</a></li>
                                    <li><a href="#" class="dropdown-item">December</a></li>
                                </ul>
                            </div> -->
                        </div>
                        <div class="card-stats-items">
                            <div class="card-stats-item">
                                <div class="card-stats-item-count"><?= @$list[0]['users']; ?></div>
                                <div class="card-stats-item-label">Users</div>
                            </div>
                            <div class="card-stats-item">
                                <div class="card-stats-item-count"><?= @$list[0]['products']; ?></div>
                                <div class="card-stats-item-label">Products</div>
                            </div>
                            <div class="card-stats-item">
                                <div class="card-stats-item-count"><?= @$list[0]['orders']; ?></div>
                                <div class="card-stats-item-label">Total Orders</div>
                            </div>
                        </div>
                    </div>